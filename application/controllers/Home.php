<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
    }


    public function index()
    {
        $data = array(
            'title' => 'Home',
            'buku' => $this->m_home->get_all_data(),
            'isi' => 'v_home'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function kategori($id_kategori)
    {
        $kategori = $this->m_home->kategori($id_kategori);
        $data = array(
            'title' => 'Kategori buku : ' . $kategori->nama_kategori,
            'buku' => $this->m_home->get_all_data_buku($id_kategori),
            'isi' => 'v_kategori_buku'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function detail_buku($id_buku)
    {
        $data = array(
            'title' => 'Detail buku',
            'gambar'=> $this->m_home->gambar_buku($id_buku),
            'buku' => $this->m_home->detail_buku($id_buku),
            'isi' => 'v_detail_buku'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

    public function search(){
        $keyword = $this->input->post('keyword');
        $data = array(
            'title' => "Search Buku",
            'buku' => $this->m_home->get_keyword($keyword),
            'isi' => 'v_search_buku'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

    }
}

/* End of fils Home.php */
