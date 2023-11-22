<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $categories = $this->db->get('category')->result_array();
        $i = 0;
        foreach ($categories as $category) {
            $result[$i] = $this->db->select('product.*, category.name as category_name')
                ->from('product')
                ->join('category', 'category.id = product.category_id')
                ->where('product.category_id', $category['id'])
                ->limit(3)
                ->get()
                ->result_array();
            $i++;
        }

        $page_data['product'] = $result;
        $page_data['page_name'] = "frontend/home";
        $page_data['page_title'] = "Home";
        $page_data['slider'] = $this->db->get('slider')->result_array();
        $page_data['category'] = $this->db->get('category')->result_array();
        $page_data['team'] = $this->db->get('team')->result_array();
        $page_data['inquiry'] = $this->db->get('inquiry')->result_array();
        $page_data['feedback'] = $this->db->get('feedback')->result_array();
        $page_data['contact'] = $this->db->get('contact')->row_array();
        $this->load->view('frontend/comman', $page_data);
    }
}
