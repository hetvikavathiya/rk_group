<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_report extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 1 || $this->session->userdata('admin_id')=="" && ($this->session->userdata('user_type') !="Admin")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $page_data['page_name'] = "user_report";
        $page_data['page_title'] = "User Report";
        $this->load->view('admin/common',$page_data);
	}
		public function edit($param=''){
	    $admin_id = $this->security->xss_clean($param);
	    if($admin_id == 1){
	        redirect(base_url('admin/user_report'),'refresh');
	    }else{
            $this->db->select('*');
    	    $this->db->from('admin');
    	    $this->db->where('id',$admin_id);
    	    $page_data['row_data'] = $this->db->get()->row_array();
            $page_data['page_name'] = "manage_user";
            $page_data['page_title'] = "Edit User";
            $this->load->view('admin/common',$page_data);
	    }
	    
	}
	 public function report(){
        
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
       
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (id like '%" . $searchValue . "%') ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering

        $records = $this->db->select('*')->from('admin')->where(array('user_type !='=>'Admin'))->order_by('id', 'asc')->get();
        $this->db->where(array('user_type !='=>'Admin'));
        $totalRecords = $records->num_rows();

        ## Total number of record with filtering
        $records = $this->db->select('*')->from('admin')->where(array('user_type !='=>'Admin'))->order_by('id', 'asc')->get();
        $this->db->where(array('user_type !='=>'Admin'));
        $totalRecordwithFilter = $records->num_rows();

        ## Fetch records
        $this->db->select('*');
        $this->db->from('admin');
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->where(array('user_type !='=>'Admin'));
        // $this->db->order_by($columnName, $columnSortOrder);
        $this->db->order_by('id', 'desc');
        $this->db->limit($rowperpage, $start);
        // $this->db->group_by("order.id");
        $records = $this->db->get()->result_array();
        $data = array();
        $i = 1;
        foreach ($records as $record) {
            
            if($record['status'] == 1){
                $color = 'text-success';
                $text = 'Active';
            }else{
                $text = 'InActive';
                $color = 'text-danger';
            }
            
            $edit = base_url('admin/user_report/edit/').$record['id'];
            $data[] = array(
                'edit' => '<a href="'.$edit.'"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>',
                'id' => $i,
                'name' => $record['first_name'] .' '.$record['middle_name'] .' '.$record['last_name'],
                'mobile' => $record['mobile'],
                'address'=>$record['address'],
                'city' => $record['city'],
                'user_type'=> $record['user_type'],
                'permission'=> $record['permission'],
                'status' =>'<span class="'.$color.'">'.$text.'</span>',
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

