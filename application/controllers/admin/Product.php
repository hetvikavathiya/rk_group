<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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
    public function index($params = "", $params1 = "")
    {


        $data['page_name'] = "product";
        $data['page_title'] = "product";
        $this->load->view('admin/common', $data);
    }
    public function add()
    {
        $this->form_validation->set_rules('category_id', 'category_id', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('discription', 'destination');

        if ($this->form_validation->run() == FALSE) {
            $message = ['class' => 'danger', 'message' => validation_errors()];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/product'));
        } else {
            $post = $this->input->post();
            $data = array();
            $data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
            $data['name'] = $this->security->xss_clean($this->input->post('name'));
            $data['discription'] = $this->security->xss_clean($this->input->post('discription'));

            if (!empty($_FILES['image']['name'])) {

                $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload/product/';
                $config['allowed_types'] = "jpg|png|jpeg|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('image');
                $data['image'] = $file_name;
            }

            $insert = $this->db->insert('product', $data);

            if (isset($insert)) {
                $message = array('message' => 'product Add Successfully', 'class' => 'success');
            } else {
                $message = array('message' => 'product Add Falied', 'class' => 'error');
            }
            $this->session->set_flashdata('flash_message', $message);
            redirect(site_url('admin/product'), 'refresh');
        }
    }

    public function edit($param = "edit")
    {
        $id = $this->security->xss_clean($param);
        $page_data['page_title'] = "Edit product ";
        $page_data['page_name'] = "product";
        $page_data['update_data'] = $this->db->get_where('product', ['id' => $id])->row_array();
        $page_data['data'] = $this->db->get('product')->result_array();
        $this->load->view('admin/common', $page_data);
    }
    public function update()
    {

        $id = $this->input->post('id');
        $this->form_validation->set_rules('category_id', 'category_id', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('discription', 'destination');

        if ($this->form_validation->run() == false) {
            $message = ['class' => 'danger', 'message' => validation_errors()];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/product'));
        } else {

            $data = array();
            $data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
            $data['name'] = $this->security->xss_clean($this->input->post('name'));
            $data['discription'] = $this->security->xss_clean($this->input->post('discription'));

            if (!empty($_FILES['image']['name'])) {
                $row_data  =  $this->db->get_where('product', array('id' => $id))->row('image');
                if (!empty($row_data) && file_exists("./upload/product/" . $row_data)) {
                    unlink("./upload/product/" . $row_data);
                }
                $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload/product';
                $config['allowed_types'] = "jpg|png|jpeg|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('image');
                $data['image'] = $file_name;
            }

            $update =  $this->db->where('id', $id)->update('product', $data);


            if (isset($update)) {
                $message = array('message' => "product Updated", 'class' => 'success');
            } else {
                $message = array('message' => "Failed to Update product ", 'class' => 'error');
            }
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/product'));
        }
    }


    public function delete($param = "delete")
    {
        $id =  $this->input->post('id');
        $query = $this->db->get_where('product', ['id' => $id]);
        if ($query->num_rows() > 0) {
            $this->db->where('id', $id)->delete('product');
            $message = array('message' => 'Deleted Successfully', 'class' => 'success');
        } else {
            $message = array('message' => 'Deleted Falied', 'class' => 'error');
        }
        $this->session->set_flashdata('flash_message', $message);
        redirect(base_url('admin/product'));
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
            $search_arr[] = " (product.name like '%" . $searchValue . "%' or category.name like '%" . $searchValue . "%' or product.discription like '%" . $searchValue . "%') ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('product.*,category.name as cname');
        $this->db->from('product');
        $this->db->join('category', 'category.id = product.category_id', 'left');
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
        $this->db->select('product.*,category.name as cname');
        $this->db->from('product');
        $this->db->join('category', 'category.id = product.category_id', 'left');
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
                $image = base_url('/upload/product/') . $record['image'];
                $image = '<a href="' . $image . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
            } else {
                $image = '';
            }

            $action = '
            <a href="' . base_url('admin/product/edit/') . $record['id'] . '" class="fa fa-edit" style="font-size:30px" >
            </a>
            <a data-id="' . $record['id'] . '" class="fa fa-trash-o deleterecord" style="font-size:30px" id=""delete>

        </a>
            ';

            $data[] = array(
                'action' => $action,
                'id' => $i,
                'category' => $record['cname'],
                'image' => $image,
                'name' => $record['name'],
                'discription' => $record['discription'],
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
