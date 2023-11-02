<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $page_data['page_name'] = "frontend/aboutus";
        $page_data['page_title'] = "About us";
        $this->load->view('frontend/comman', $page_data);
    }
}
