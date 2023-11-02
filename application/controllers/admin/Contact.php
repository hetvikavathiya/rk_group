<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
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
        $data['page_name'] = "contact";
        $data['page_title'] = "contact";
        $this->load->view('admin/common', $data);
    }

    public function edit($param = '')
    {
        $id = $this->security->xss_clean($param);
        $page_data['id'] = $id;
        $page_data['update_data'] = $this->db->get_where('contact', ['id' => $id])->row_array();
        $page_data['data'] = $this->db->get('contact')->result_array();
        $page_data['page_name'] = "contact";
        $page_data['page_title'] = "contact";
        $this->load->view('admin/common', $page_data);
    }

    public function update($param = '')
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('number', 'number', 'required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('address', 'address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $message = ['class' => 'danger', 'message' => validation_errors()];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/contact/edit/1'));
        } else {
            $id = $this->input->post('id');
            $post = $this->input->post();
            $data = array();
            $data['email'] = $post['email'];
            $data['number'] = $post['number'];
            $data['address'] = $post['address'];
            $query = $this->db->get_where('contact', ['id' => $id]);
            if ($query->num_rows() == 1) {
                $this->db->where('id', $id)->update('contact', $data);
                $message = ['class' => 'success', 'message' => 'contact updated successfully!'];
                $this->session->set_flashdata('flash_message', $message);
                redirect(base_url('admin/contact/edit/1'));
            } else {
                $message = ['class' => 'danger', 'message' => 'contact does not updated!'];
                $this->session->set_flashdata('flash_message', $message);
                redirect(base_url('admin/contact/edit/1'));
            }
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
            $search_arr[] = " (number like '%" . $searchValue . "%' ) ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('*');
        $this->db->from('contact');
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
        $this->db->from('contact');
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
            <a href="' . base_url('admin/contact/edit/') . $record['id'] . '" class="fa fa-edit" style="font-size:30px" >
            </a>

            ';

            $data[] = array(
                'action' => $action,
                'id' => $i,
                'email' => $record['email'],
                'number' => $record['number'],
                'address' => $record['address'],
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
