<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_report extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('loginstatus') != 2 || $this->session->userdata('admin_id') == "" && ($this->session->userdata('user_type') != "employee")) {
			$message = array('message' => "Your Session has Been Expired.!!", 'class' => 'danger');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url(), 'refresh');
		}
	}
	public function index()
	{
        $array_permission = explode(',',$this->session->userdata('permission'));
        if(in_array("Manage Customer", $array_permission)){
            $this->db->select('*');
    		$this->db->from('customer');
    		$page_data['customer'] = $this->db->get()->result_array();
    		$page_data['page_name'] = "customer_report";
    		$page_data['page_title'] = "Customer Report";
    		$this->load->view('employee/common', $page_data);
        }else{
            redirect(base_url('employee/dashboard'), 'refresh');
        }
		
	}
	public function edit($param = '',$param2="")
	{
		$costomer_id = $this->security->xss_clean($param);
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $costomer_id);
		if(!empty($param2)){
		    $page_data['check'] = 'account';
		}
		$page_data['row_data'] = $this->db->get()->row_array();
		$page_data['page_name'] = "customer";
		$page_data['page_title'] = "Customer";
		$this->load->view('employee/common', $page_data);
	}
	public function report()
	{
        $array_permission = explode(',',$this->session->userdata('permission'));
        if(in_array("Manage Customer", $array_permission)){
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
			$search_arr[] = " (aadhar_card like '%" . $searchValue . "%') ";
		}
		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}
		## Total number of records without filtering
        $this->db->select('*');
		$this->db->from('customer');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		if ($status != '') {
			$this->db->where('status',$status);
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
		$this->db->from('customer');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		if ($status != '') {
			$this->db->where('status',$status);
		}
		// $this->db->order_by($columnName, $columnSortOrder);
		$this->db->order_by('id', 'desc');
		$this->db->limit($rowperpage, $start);
		// $this->db->group_by("order.id");
		$records = $this->db->get()->result_array();
		$data = array();
		$i = 1;
		foreach ($records as $record) {
			$edit = base_url('employee/customer_report/edit/') . $record['id'];
		
			
			$backside_document = base_url('upload/') . $record['backside_document'];
			if(!empty($record['photo'])){
			    $photo = base_url('upload/') . $record['photo'];
			    $r_photo = '<a href="' . $photo . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			}else{
			    $r_photo = '';
			}
			if(!empty($record['signature'])){
		    	$signature = base_url('upload/') . $record['signature'];
			    $r_signature = '<a href="' . $signature . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			}else{
			    $r_signature = '';
			}
			if(!empty($record['frontside_document'])){
		    	$frontside_document = base_url('upload/') . $record['frontside_document'];
			    $r_frontside_document = '<a href="' . $frontside_document . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			}else{
			    $r_frontside_document = '';
			}
			if(!empty($record['backside_document'])){
		    	$backside_document = base_url('upload/') . $record['backside_document'];
			    $r_backside_document = '<a href="' . $backside_document . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			}else{
			    $r_backside_document = '';
			}
			
			
			
			$data[] = array(
				'edit' => '<a href="' . $edit . '"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>',
				'id' => $i,
				'aadhar' => $record['aadhar_card'],
				'name' => $record['first_name'] . $record['middle_name'] . $record['last_name'],
				'mobile' => $record['mobile'],
				'a_mobile' => $record['alternate_mobile_no'],
				'address' => $record['address'],
				'email' => $record['email'],
				'city' => $record['city'],
				'photo' => $r_photo,
				'signature' => $r_signature,
				'frontside_document' => $r_frontside_document,
				'backside_document' => $r_backside_document,
				'document_type' => $record['document_type'],
				'status' => $record['status'],
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
        }else{
            redirect(base_url('employee/dashboard'), 'refresh');
        }
	}
			public function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
    
    
    imagejpeg($image, $destination, $quality);

    return $destination;
    }
	public function update($param = '')
	{
		$costomer_id = $this->security->xss_clean($param);
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('aadhar_card', 'Aadhar Card', 'trim|required');
		$this->form_validation->set_rules('password', 'Password');
		if ($this->form_validation->run() == false) {
			$message = array('message' => validation_errors(), 'class' => 'error');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url('employee/customer'), 'refresh');
		} else {
		    $check =  $this->security->xss_clean($this->input->post('check'));
			$data['first_name'] = $this->security->xss_clean($this->input->post('first_name'));
			$data['middle_name'] = $this->security->xss_clean($this->input->post('middle_name'));
			$data['last_name'] = $this->security->xss_clean($this->input->post('last_name'));
			$data['status'] = $this->security->xss_clean($this->input->post('status'));
			$data['address'] = $this->security->xss_clean($this->input->post('address'));
			$data['aadhar_card'] = $this->security->xss_clean($this->input->post('aadhar_card'));
			$data['document_type'] = $this->security->xss_clean($this->input->post('document_type'));
			$data['alternate_mobile_no'] = $this->security->xss_clean($this->input->post('a_mobile'));
			$data['city'] = $this->security->xss_clean($this->input->post('city'));
			$data['email'] = $this->security->xss_clean($this->input->post('email'));
			$data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
			$password = sha1($this->security->xss_clean($this->input->post('password')));
			if (!empty($password)) {
				$data['password'] = $password;
			}
			if (!empty($_FILES['photo']['name'])) {
				$row_data  =  $this->db->get_where('customer', array('id' => $costomer_id))->row('photo');
				if (!empty($row_data) && file_exists("./upload/" . $row_data)) {
					unlink("./upload/" . $row_data);
				}
				$file_ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
				$config['file_name'] = $file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->do_upload('photo');
				$data['photo'] = $file_name;
					$newfile_name=date('Ymdhis').$rand.'new.'.$file_ext;
                        $destination_img ='./upload/'.$newfile_name;
                        $fileName ='./upload/'.$file_name;
                        $d = $this->compress($fileName, $destination_img,50);
    			
    			unlink($fileName);
			    $data['photo'] = $newfile_name;
			}
			if (!empty($_FILES['signature']['name'])) {
				$row_data  =  $this->db->get_where('customer', array('id' => $costomer_id))->row('signature');
				if (!empty($row_data) && file_exists("./upload/" . $row_data)) {
					unlink("./upload/" . $row_data);
				}
				$file_ext = pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
				$config['file_name'] = $file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->do_upload('signature');
				$data['signature'] = $file_name;
					$newfile_name=date('Ymdhis').$rand.'new.'.$file_ext;
                        $destination_img ='./upload/'.$newfile_name;
                        $fileName ='./upload/'.$file_name;
                        $d = $this->compress($fileName, $destination_img,50);
    			
    			unlink($fileName);
			    $data['signature'] = $newfile_name;
			}
			if (!empty($_FILES['frontside_document']['name'])) {
				$row_data  =  $this->db->get_where('customer', array('id' => $costomer_id))->row('frontside_document');
				if (!empty($row_data) && file_exists("./upload/" . $row_data)) {
					unlink("./upload/" . $row_data);
				}
				$file_ext = pathinfo($_FILES['frontside_document']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
				$config['file_name'] = $file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->do_upload('frontside_document');
				$data['frontside_document'] = $file_name;
					$newfile_name=date('Ymdhis').$rand.'new.'.$file_ext;
                        $destination_img ='./upload/'.$newfile_name;
                        $fileName ='./upload/'.$file_name;
                        $d = $this->compress($fileName, $destination_img,50);
    			
    			unlink($fileName);
			    $data['frontside_document'] = $newfile_name;
			}
			if (!empty($_FILES['backside_document']['name'])) {
				$row_data  =  $this->db->get_where('customer', array('id' => $costomer_id))->row('backside_document');
				if (!empty($row_data) && file_exists("./upload/" . $row_data)) {
					unlink("./upload/" . $row_data);
				}
				$file_ext = pathinfo($_FILES['backside_document']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
				$config['file_name'] = $file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->do_upload('backside_document');
				$data['backside_document'] = $file_name;
					$newfile_name=date('Ymdhis').$rand.'new.'.$file_ext;
                        $destination_img ='./upload/'.$newfile_name;
                        $fileName ='./upload/'.$file_name;
                        $d = $this->compress($fileName, $destination_img,50);
    			
    			unlink($fileName);
			    $data['backside_document'] = $newfile_name;
			}
			$this->db->where('id', $param);
			$update = $this->db->update('customer', $data);

			if (isset($update)) {
				$message = array('message' => "Customer Details Updated", 'class' => 'success');
			} else {
				$message = array('message' => "Failed to Update Customer", 'class' => 'error');
			}
		}
		$this->session->set_flashdata('flash_message', $message);
		if(!empty($check)){
		    redirect(site_url('employee/account/profile/'.$param), 'refresh');
		}else{
		    redirect(site_url('employee/customer_report'), 'refresh');
		}
	}
}
