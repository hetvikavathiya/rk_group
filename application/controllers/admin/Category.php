<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
        $data['page_name'] = "category";
        $data['page_title'] = "Category";
        $this->load->view('admin/common', $data);
    }
    public function add()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');

        if ($this->form_validation->run() == false) {
            $message = array('message' => validation_errors(), 'class' => 'error');
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/category'), 'refresh');
        } else {
            $data['name'] = $this->security->xss_clean($this->input->post('name'));

            $insert = $this->db->insert('category', $data);
            if (isset($insert)) {
                $message = array('message' => 'Add Successfully', 'class' => 'success');
            } else {
                $message = array('message' => 'Add Falied', 'class' => 'error');
            }
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/category'), 'refresh');
        }
    }

    public function edit($param = '')
    {
        $id = $this->security->xss_clean($param);
        $page_data['update_data'] = $this->db->get_where('category', ['id' => $id])->row_array();
        $page_data['data'] = $this->db->get('category')->result_array();
        $page_data['page_name'] = "category";
        $page_data['page_title'] = "category";
        $this->load->view('admin/common', $page_data);
    }

    public function update($param = '')
    {
        $id = $this->security->xss_clean($param);

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $message = ['class' => 'danger', 'message' => validation_errors()];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/category'));
        } else {
            $id = $this->input->post('id');
            $post = $this->input->post();
            $data = array();
            $data['name'] = $post['name'];
            $query = $this->db->get_where('category', ['id' => $id]);
            if ($query->num_rows() == 1) {
                $this->db->where('id', $id)->update('category', $data);
                $message = ['class' => 'success', 'message' => 'category updated successfully!'];
                $this->session->set_flashdata('flash_message', $message);
                redirect(base_url('admin/category/'));
            } else {
                $message = ['class' => 'danger', 'message' => 'category does not updated!'];
                $this->session->set_flashdata('flash_message', $message);
                redirect(base_url('admin/category'));
            }
        }
    }


    public function delete($param = '')
    {
        $id = $this->input->post('id');
        $query = $this->db->get_where('category', ['id' => $id]);
        if ($query->num_rows() > 0) {
            $this->db->where('id', $id)->delete('category');
            $message = ['class' => 'success', 'message' => 'Category deleted successfully!'];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/category'));
        } else {
            $message = ['class' => 'success ', 'message' => 'category  not deleted!'];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/category'));
        }
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
            $search_arr[] = " (name like '%" . $searchValue . "%') ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('*');
        $this->db->from('category');
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
        $this->db->from('category');
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
            $action = '
            <a href="' . base_url('admin/category/edit/') . $record['id'] . '" class="fa fa-edit" style="font-size:30px" >
            </a>
            <a data-id="' . $record['id'] . '" class="fa fa-trash-o deleterecord" style="font-size:30px" id=""delete>

        </a>
            ';

            $data[] = array(
                'action' => $action,
                'id' => $i,
                'name' => $record['name'],
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
