<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $result = $this->db->select('p.*,C.name as category')
            ->join('category C', 'C.id = P.category_id', "left")
            ->get('product P')->result_array();

        $page_data['page_name'] = "frontend/our_product";
        $page_data['page_title'] = "Product";
        $page_data['product'] = $result;
        $page_data['category'] = $this->db->get('category')->result_array();

        $this->load->view('frontend/comman', $page_data);
    }
}
