<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {


        $page_data['page_name'] = "frontend/our_services";
        $page_data['page_title'] = "services";
        $this->load->view('frontend/comman', $page_data);
    }
}
