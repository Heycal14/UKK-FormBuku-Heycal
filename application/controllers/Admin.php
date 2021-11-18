<?php

defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
    }


    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'total_buku' => $this->m_admin->total_buku(),
            'total_kategori' => $this->m_admin->total_kategori(),
            'isi' => 'v_admin'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
}

/* End of fils Home.php */
