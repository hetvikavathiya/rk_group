<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inquiry extends CI_Controller
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
        $data['page_name'] = "inquiry";
        $data['page_title'] = "inquiry";
        $this->load->view('admin/common', $data);
    }

    public function delete()
    {
        $id =  $this->input->post('id');
        $query = $this->db->get_where('feedback', ['id' => $id]);
        if ($query->num_rows() > 0) {
            $this->db->where('id', $id)->delete('feedback');
            $message = ['class' => 'success', 'message' => 'feedback deleted successfully!'];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/feedback'));
        } else {
            $message = ['class' => 'success ', 'message' => 'feedback  not deleted!'];
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/feedback'));
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
        $this->db->from('inquiry');
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
        $this->db->from('inquiry');
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
            <a data-id="' . $record['id'] . '" class="fa fa-trash-o deleterecord" style="font-size:30px" id=""delete>

        </a>
            ';

            $data[] = array(
                'action' => $action,
                'id' => $i,
                'name' => $record['name'],
                'mobile_no' => $record['mobile_no'],
                'inquiry' => $record['inquiry'],
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
