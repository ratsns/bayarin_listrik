<?php

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['string', 'global_helper']);
        $this->load->library('session');
        $this->load->database();
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Masukkan username dengan benar',
            'trim' => 'Karakter tidak boleh mengandung spasi'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Masukkan password dengan benar',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul' => 'Halaman Login'
            ];

            $this->load->view('pelanggan/login', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $pelanggan = $this->db->get_where('pelanggan', ['username' => $username])->row_array();

        if ($pelanggan) {
            if (password_verify($password, $pelanggan['password'])) {
                $data = [
                    'username'       => $pelanggan['username'],
                    'nama'           => $pelanggan['nama'],
                    'nama_pelanggan' => $pelanggan['nama_pelanggan'],
                    'nomor_kwh'      => $pelanggan['nomor_kwh'],
                ];

                $this->session->set_userdata($data);
                redirect('pelanggan/dashboard');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password yang Anda masukkan salah</div>');
                redirect('pelanggan');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Username tidak ditemukan</div>');
            redirect('pelanggan');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Masukkan nama dengan benar',
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Masukkan username dengan benar',
            'trim' => 'Karakter tidak boleh mengandung spasi'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Masukkan password dengan benar',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Masukkan alamat dengan benar',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul' => 'Halaman Register'
            ];

            $this->load->view('pelanggan/register', $data);
        } else {
            $idpel = random_string('basic', 16);
            $nokwh = random_string('basic', 16);

            $data = [
                'id_pelanggan'   => htmlspecialchars($idpel),
                'username'       => htmlspecialchars($this->input->post('username')),
                'password'       => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nomor_kwh'      => htmlspecialchars($nokwh),
                'nama_pelanggan' => htmlspecialchars($this->input->post('nama', true)),
                'alamat'         => htmlspecialchars($this->input->post('alamat', true)),
                'id_tarif'       => 1
            ];

            $this->db->insert('pelanggan', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Berhasil registrasi, silahkan login. </div>');
            } else {
                log_message('error', 'Database insert failed: ' . $this->db->last_query());
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"> Registrasi gagal, silahkan coba lagi. </div>');
            }
            redirect('pelanggan');
        }
    }
    public function dashboard()
    {
        $data = [
            'judul' => 'Dashboard Pelanggan',
            'pelanggan'  => $this->db->get_where('pelanggan', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view('pelanggan/pelanggan_header', $data);
        $this->load->view('pelanggan/dashboard', $data);
        $this->load->view('pelanggan/pelanggan_footer');
    }

    public function profil()
    {
        $data = [
            'judul' => 'Profil',
            'pelanggan'  => $this->db->get_where('pelanggan', ['username' => $this->session->userdata('username')])->row_array()
        ];

        $this->load->view('pelanggan/pelanggan_header', $data);
        $this->load->view('pelanggan/profil', $data);
        $this->load->view('pelanggan/pelanggan_footer');
    }
    public function logout()
    {
        $this->session->unset_userdata('id_pelanggan');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('nama_pelanggan');
        $this->session->unset_userdata('nomor_kwh');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda telah logout</div>');
        redirect('pelanggan');
    }
}
