<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginstatus') != 1 || $this->session->userdata('admin_id') == "" && ($this->session->userdata('user_type') != "Admin")) {
			$message = array('message' => "Your Session has Been Expired.!!", 'class' => 'error');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url(), 'refresh');
		}
		$this->load->library('image_lib');
		$this->load->library('date_time');
	}
	public function index()
	{
		$page_data['page_name'] = "customer";
		$page_data['page_title'] = "Customer";
		$this->load->view('admin/common', $page_data);
	}
	public function add()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('aadhar_card', 'Aadhar Card', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$message = array('message' => validation_errors(), 'class' => 'error');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url('admin/customer'), 'refresh');
		} else {
			$data['first_name'] = $this->security->xss_clean($this->input->post('first_name'));
			$data['middle_name'] = $this->security->xss_clean($this->input->post('middle_name'));
			$data['aadhar_card'] = $this->security->xss_clean($this->input->post('aadhar_card'));
			$data['last_name'] = $this->security->xss_clean($this->input->post('last_name'));
			$data['status'] = $this->security->xss_clean($this->input->post('status'));
			$data['address'] = $this->security->xss_clean($this->input->post('address'));
			$data['document_type'] = $this->security->xss_clean($this->input->post('document_type'));
			$data['alternate_mobile_no'] = $this->security->xss_clean($this->input->post('a_mobile'));
			$data['city'] = $this->security->xss_clean($this->input->post('city'));
			$data['email'] = $this->security->xss_clean($this->input->post('email'));
			$data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
			$data['password'] = sha1($this->security->xss_clean($this->input->post('password')));
			$password =$this->security->xss_clean($this->input->post('password'));
			if (!empty($_FILES['photo']['name'])) {
				$file_ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['image_library']    = 'gd2';
                $config['quality']      = 60;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
				$file_ext = pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
				$file_ext = pathinfo($_FILES['frontside_document']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
				$file_ext = pathinfo($_FILES['backside_document']['name'], PATHINFO_EXTENSION);
				$rand = substr(md5(microtime()), rand(0, 26), 3);
				$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
				$config['upload_path'] = './upload';
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
			$this->db->select('aadhar_card');
			$this->db->from('customer');
			$this->db->where('aadhar_card', $data['aadhar_card']);
			$adhar_num_rows = ($this->db->get()->num_rows());

			$this->db->select('mobile');
			$this->db->from('customer');
			$this->db->where('mobile', $data['mobile']);
			$num_rows = ($this->db->get()->num_rows());
			if ($num_rows == 0 && $adhar_num_rows == 0) {
				$insert = $this->db->insert('customer', $data);
				$insert_id = $this->db->insert_id();
				$this->load->model('send_mail');
				$this->send_mail->email($insert_id,$password);
				if (isset($insert)) {
					$message = array('message' => 'Add Successfully', 'class' => 'success');
				} else {
					$message = array('message' => 'Add Falied', 'class' => 'error');
				}
				$this->session->set_flashdata('flash_message', $message);
		        redirect(site_url('admin/customer_report'), 'refresh');
			} else {
				$message = array('message' => 'Mobile And Aadhar No Is Unique', 'class' => 'error');
				$this->session->set_flashdata('flash_message', $message);
				redirect(base_url('admin/customer'), 'refresh');
			}
		}
	}
	public function email(){
	   // 	$this->load->model('send_mail');
				// $this->send_mail->account(1);
				//  $this->load->model('send_wp');
	   // $this->send_wp->register(1,'harshil@password');
// 	$this->load->view('credit_view');
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
			redirect(base_url('admin/customer'), 'refresh');
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
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
				$config['allowed_types'] = "jpg|png|jpeg|webp";
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
		    redirect(site_url('admin/account/profile/'.$param), 'refresh');
		}else{
		    redirect(site_url('admin/customer_report'), 'refresh');
		}
	}
}
