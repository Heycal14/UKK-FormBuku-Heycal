<?php

defined('BASEPATH') or exit('No direct script access allowed');

class gambarbuku extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_gambarbuku');
        $this->load->model('m_buku');
    }


    public function index()
    {
        $data = array(
            'title' => 'Gambar buku',
            'gambarbuku' => $this->m_gambarbuku->get_all_data(),
            'isi' => 'gambarbuku/v_index',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function add($id_buku)
    {
        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan Gambar',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambarbuku/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Add Gambar buku',
                    'error_upload' => $this->upload->display_errors(),
                    'buku' => $this->m_buku->get_data($id_buku),
                    'gambar' => $this->m_gambarbuku->get_gambar($id_buku),
                    'isi' => 'gambarbuku/v_add',
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambarbuku/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_buku' => $id_buku,
                    'keterangan' => $this->input->post('keterangan'),
                    'gambar' => $upload_data['uploads']['file_name'],
                );
                $this->m_gambarbuku->add($data);
                $this->session->set_flashdata('pesan', 'Gambar Berhasil Ditambahkan!!!');
                redirect('gambarbuku/add/' . $id_buku);
            }
        }
        $data = array(
            'title' => 'Add Gambar buku',
            'buku' => $this->m_buku->get_data($id_buku),
            'gambar' => $this->m_gambarbuku->get_gambar($id_buku),
            'isi' => 'gambarbuku/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
    public function delete($id_buku ,$id_gambar)
    {
        //hapus gambar
        $gambar = $this->m_gambarbuku->get_data($id_gambar);
        if ($gambar->gambar != "") {
            unlink('./assets/gambarbuku/' . $gambar->gambar);
        }
        //end
        $data = array('id_gambar' => $id_gambar);
        $this->m_gambarbuku->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!!!');
        redirect('gambarbuku/add/' . $id_buku);
    }
}

/* End of fils Home.php */
