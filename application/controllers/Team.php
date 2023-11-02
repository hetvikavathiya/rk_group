<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $page_data['page_name'] = "frontend/our_team";
        $page_data['page_title'] = "Team";
        $page_data['team'] = $this->db->get('team')->result_array();
        $this->load->view('frontend/comman', $page_data);
    }
}
