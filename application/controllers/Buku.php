<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_buku');
        $this->load->model('m_kategori');
    }

    // List all your items
    public function index()
    {
        $data = array(
            'title' => 'Buku',
            'buku' => $this->m_buku->get_all_data(),
            'isi' => 'buku/v_buku'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {

        $this->form_validation->set_rules(
            'judul',
            'Judul buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'pengarang',
            'Pengarang buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'penerbit',
            'Penerbit buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Add buku',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'buku/v_add'
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'judul' => $this->input->post('judul'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'pengarang' => $this->input->post('pengarang'),
                    'penerbit' => $this->input->post('penerbit'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                );
                $this->m_buku->add($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!!!');
                redirect('buku');
            }
        }


        $data = array(
            'title' => 'Add buku',
            'kategori' => $this->m_kategori->get_all_data(),
            'isi' => 'buku/v_add'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Update one item
    public function edit($id_buku = NULL)
    {
        $this->form_validation->set_rules(
            'judul',
            'Judul buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'pengarang',
            'pengarang buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'penerbit',
            'pengarang buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );

        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi buku',
            'required',
            array('required' => '%s Harus Diissi!!!')
        );


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Edit buku',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'buku' => $this->m_buku->get_data($id_buku),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'buku/v_edit'
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            } else {
                //hapus gambar
                $buku = $this->m_buku->get_data($id_buku);
                if ($buku->gambar != "") {
                    unlink('./assets/gambar/' . $buku->gambar);
                }
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_buku' => $id_buku,
                    'judul' => $this->input->post('judul'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'pengarang' => $this->input->post('pengarang'),
                    'penerbit' => $this->input->post('penerbit'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                );
                $this->m_buku->edit($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Diganti!!!');
                redirect('buku');
            }
            //jika ganti gambar
            $data = array(
                'id_buku' => $id_buku,
                'judul' => $this->input->post('judul'),
                'id_kategori' => $this->input->post('id_kategori'),
                'pengarang' => $this->input->post('pengarang'),
                'penerbit' => $this->input->post('penerbit'),
                'deskripsi' => $this->input->post('deskripsi'),
            );
            $this->m_buku->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diganti!!!');
            redirect('buku');
        }


        $data = array(
            'title' => 'Edit buku',
            'kategori' => $this->m_kategori->get_all_data(),
            'buku' => $this->m_buku->get_data($id_buku),
            'isi' => 'buku/v_edit'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Delete one item
    public function delete($id_buku = NULL)
    {
        //hapus gambar
        $buku = $this->m_buku->get_data($id_buku);
        if ($buku->gambar != "") {
            unlink('./assets/gambar/' . $buku->gambar);
        }
        //end
        $data = array('id_buku' => $id_buku);
        $this->m_buku->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!!!');
        redirect('buku');
    }
}

/* End of file buku.php */
