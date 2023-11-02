<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('loginstatus') != 1 || $this->session->userdata('admin_id') == "" && ($this->session->userdata('user_type') != "Admin")) {
            $message = array('message' => "Your Session has Been Expired.!!", 'class' => 'error');
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url(), 'refresh');
        }
    }
    public function index()
    {
        $data['page_name'] = "slider";
        $data['page_title'] = "Slider";
        $data['data'] = $this->db->get('slider')->result_array();
        $this->load->view('admin/common', $data);
    }
    public function add()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('priority', 'priority', 'required|is_unique[slider.priority]');

        if ($this->form_validation->run() == FALSE) {
            $message = ['class' => 'danger', 'message' => validation_errors()];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/slider'));
        } else {
            $post = $this->input->post();
            $data = array();
            $data['title'] = $this->input->post('title');
            $data['priority'] = $this->input->post('priority');

            if (!empty($_FILES['image']['name'])) {

                $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload/slider/';
                $config['allowed_types'] = "jpg|png|jpeg|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('image');
                $data['image'] = $file_name;
            }

            $insert = $this->db->insert('slider', $data);

            if (isset($insert)) {
                $message = array('message' => 'Add Successfully', 'class' => 'success');
            } else {
                $message = array('message' => 'Add Falied', 'class' => 'error');
            }
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('admin/slider'), 'refresh');
        }
    }

    public function edit($param = "edit")
    {
        $id = $this->security->xss_clean($param);
        $page_data['page_title'] = "Edit Slider ";
        $page_data['page_name'] = "slider";
        $page_data['update_data'] = $this->db->get_where('slider', ['id' => $id])->row_array();
        $page_data['data'] = $this->db->get('slider')->result_array();
        $this->load->view('admin/common', $page_data);
    }
    public function update($param = "update")
    {

        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('priority', 'priority', 'required');

        if ($this->form_validation->run() == false) {
            $message = ['class' => 'danger', 'message' => validation_errors()];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/slider'));
        } else {

            $data = array();
            $data['title'] = $this->security->xss_clean($this->input->post('title'));
            $data['priority'] = $this->security->xss_clean($this->input->post('priority'));

            if (!empty($_FILES['image']['name'])) {
                $row_data  =  $this->db->get_where('slider', array('id' => $id))->row('image');
                if (!empty($row_data) && file_exists("./upload/slider" . $row_data)) {
                    unlink("./upload/slider/" . $row_data);
                }
                $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload/slider/';
                $config['allowed_types'] = "jpg|png|jpeg|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('image');
                $data['image'] = $file_name;
            }

            $update =  $this->db->where('id', $id)->update('slider', $data);


            if (isset($update)) {
                $message = array('message' => "slider Details Updated", 'class' => 'success');
            } else {
                $message = array('message' => "Failed to Update slider", 'class' => 'error');
            }
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/slider'));
        }
    }


    public function delete($param = "delete")
    {
        $id = $this->input->post('id');
        $query = $this->db->get_where('slider', ['id' => $id]);
        if ($query->num_rows() > 0) {
            $this->db->where('id', $id)->delete('slider');
            $message = array('message' => 'Deleted Successfully', 'class' => 'success');
        } else {
            $message = array('message' => 'Deleted Falied', 'class' => 'error');
        }
        $this->session->set_flashdata('flash_message', $message);
        redirect(base_url('admin/slider'));
    }

    public function report()
    {

        $postData = $this->security->xss_clean($this->input->get());
        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        $status = $postData['select'];

        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (title like '%" . $searchValue . "%' or priority like '%" . $searchValue . "%') ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('*');
        $this->db->from('slider');
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->order_by('id', 'desc');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->num_rows();
        $totalRecords = $records;

        ## Total number of record with filtering
        $totalRecordwithFilter = $records;
        ## Fetch records
        $this->db->select('*');
        $this->db->from('slider');
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->order_by('id', 'desc');
        $this->db->limit($rowperpage, $start);
        // $this->db->group_by("order.id");

        $records = $this->db->get()->result_array();
        $data = array();
        $i = 1;
        foreach ($records as $record) {
            if (!empty($record['image'])) {
                $image = base_url('/upload/slider/') . $record['image'];
                $image = '<a href="' . $image . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
            } else {
                $image = '';
            }

            $action = '
            <a href="' . base_url('admin/slider/edit/') . $record['id'] . '" class="fa fa-edit" style="font-size:30px" >
            </a>
            <a data-id="' . $record['id'] . '" class="fa fa-trash-o deleterecord" style="font-size:30px" id=""delete>

        </a>
            ';

            $data[] = array(
                'action' => $action,
                'id' => $i,
                'image' => $image,
                'title' => $record['title'],
                'priority' => $record['priority'],
                'created_at' => $record['created_at'],
            );
            $i++;
        }
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }
}
