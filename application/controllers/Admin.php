<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('ModelAdmin');
        $this->load->model('ModelPelanggan');
        $this->load->model('ModelTarif');
        $this->load->model('ModelPembayaran');
        $this->load->model('ModelTagihan');
        $this->load->helper('string');
    }
    public function index()
    {
        $data['judul'] = 'Admin';
        $data['user'] = $this->ModelAdmin->cekData(['username' => $this->session->userdata('username')]);
        $data['anggota'] = $this->ModelAdmin->getUserLimit()->result_array();
        // $data['buku'] = $this->ModelPemesanan->getBuku()->result_array();
        // $data['jumlah_pemesan'] = $this->db->count_all('buku');

        $this->load->view('template/admin/admin_header', $data);
        // $this->load->view('template/admin/admin_sidebar', $data);
        // $this->load->view('template/admin/admin_topbar', $data);
        $this->load->view('template/admin/index', $data);
        $this->load->view('template/admin/admin_footer');
    }
    public function layanan()
    {
        $data['judul'] = 'Daftar Pelanggan';
        $data['pelanggan'] = $this->ModelPelanggan->getpelanggan()->result_array();
        // pre($data);
        // $data['anggota'] = $this->ModelAdmin->getUserLimit()->result_array();
        // $data['buku'] = $this->ModelPemesanan->getBuku()->result_array();
        // $data['jumlah_pemesan'] = $this->db->count_all('buku');

        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/layanan', $data);
        $this->load->view('template/admin/admin_footer');
    }

    public function tambah_pelanggan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Masukkan nama pelanggan dengan benar'
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Masukkan username pelanggan dengan benar',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Masukkan password pelanggan dengan benar',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Masukkan alamat pelanggan dengan benar',
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul' => 'Tambah Pelanggan'
            ];

            $this->load->view('template/admin/admin_header', $data);
            $this->load->view('template/admin/tambah_pelanggan', $data);
            $this->load->view('template/admin/admin_footer');
        } else {
            $dataPelanggan = [
                'id_pelanggan'       => random_string('basic', 16),
                'username'           => htmlspecialchars($this->input->post('username')),
                'password'           => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nomor_kwh'          => random_string('basic', 16),
                'nama_pelanggan'     => htmlspecialchars($this->input->post('nama')),
                'alamat'             => htmlspecialchars($this->input->post('alamat')),
                'id_tarif'           => htmlspecialchars($this->input->post('idtarif')),
            ];

            $this->ModelPelanggan->tambahPelanggan($dataPelanggan);

            $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Pelanggan Berhasil Ditambahkan</div>');
            redirect('admin/layanan');
        }
    }

    public function hapus_pelanggan($id)
    {
        $pelanggan = $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row_array();

        if ($pelanggan) {
            $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pelanggan berhasil dihapus</div>');
            redirect('admin/layanan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pelanggan gagal dihapus</div>');
            redirect('admin/layanan');
        }
    }
    public function tagihan()
    {
        $data = [
            'judul' => 'Manajemen Tagihan',
            'pelanggan' => $this->ModelPelanggan->getpelanggan()->result_array(),
        ];

        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/manajemen_tagihan', $data);
        $this->load->view('template/admin/admin_footer');
    }

    public function buat_tagihan($id = NULL)
    {
        $this->form_validation->set_rules('idpen', 'ID Penggunaan', 'required', [
            'required' => 'Harap pilih ID Penggunaan dengan benar'
        ]);

        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Harap pilih status dengan benar'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $penggunaan = $this->db->get_where('penggunaan', ['id_pelanggan' => $id])->result_array();

            $data = [
                'judul' => 'Buat Tagihan',
                'penggunaan' => $penggunaan,
                'pelanggan' => $this->ModelPelanggan->getpelanggan()->result_array(),
                'id_pelanggan' => $id,
            ];

            $this->load->view('template/admin/admin_header', $data);
            $this->load->view('template/admin/buat_tagihan', $data);
            $this->load->view('template/admin/admin_footer');
        } else {
            $idTagih = random_string('basic', 16);

            $dataTagihan = [
                'id_tagihan' => $idTagih,
                'id_penggunaan' => htmlspecialchars($this->input->post('idpen')),
                'bulan' => htmlspecialchars($this->input->post('bulan')),
                'tahun' => htmlspecialchars($this->input->post('tahun')),
                'jumlah_meter' => htmlspecialchars($this->input->post('jumlah')),
                'status' => htmlspecialchars($this->input->post('status')),
                'id_pelanggan' => htmlspecialchars($this->input->post('idpel')),
            ];

            if ($this->ModelPelanggan->tambahTagihan($dataTagihan)) {
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Berhasil menambahkan tagihan pada pelanggan</div>');
                redirect('admin/tagihan');
            } else {
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Gagal menambahkan tagihan pada pelanggan</div>');
                redirect('admin/tagihan/' . $id);
            }
        }
    }

    public function penggunaan()
    {
        $data = [
            'judul' => 'Manajemen Penggunaan',
            'penggunaan' => $this->ModelPelanggan->getpelanggan()->result_array(),
        ];

        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/manajemen_penggunaan', $data);
        $this->load->view('template/admin/admin_footer');
    }

    public function tambah_penggunaan($id = NULL)
    {
        $this->form_validation->set_rules('bulan', 'Bulan', 'required', [
            'required' => 'Harap masukkan bulan dengan benar'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun', 'required', [
            'required' => 'Harap masukkan tahun dengan benar'
        ]);
        $this->form_validation->set_rules('mawal', 'Meter Awal', 'required', [
            'required' => 'Harap masukkan no. meter awal dengan benar'
        ]);
        $this->form_validation->set_rules('makhir', 'Meter Akhir', 'required', [
            'required' => 'Harap masukkan no. meter akhir dengan benar'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul' => 'Tambah Penggunaan',
                'pelanggan' => $this->ModelPelanggan->getpelanggan()->result_array(),
                'id_pelanggan' => $id,
            ];

            $this->load->view('template/admin/admin_header', $data);
            $this->load->view('template/admin/tambah_penggunaan', $data);
            $this->load->view('template/admin/admin_footer');
        } else {
            $idpen = random_string('basic', 16);

            $dataPenggunaan = [
                'id_penggunaan' => $idpen,
                'id_pelanggan'  => htmlspecialchars($this->input->post('idpel')),
                'bulan'         => htmlspecialchars($this->input->post('bulan')),
                'tahun'         => htmlspecialchars($this->input->post('tahun')),
                'meter_awal'    => htmlspecialchars($this->input->post('mawal')),
                'meter_akhir'   => htmlspecialchars($this->input->post('makhir')),
            ];

            if ($this->ModelPelanggan->tambahPenggunaan($dataPenggunaan)) {
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-success" role="alert">Berhasil menambahkan penggunaan pada pelanggan</div>');
                redirect('admin/penggunaan');
            } else {
                $this->session->set_flashdata('message', '<div style="color: #FFF; background: #1f283E;" class="alert alert-danger" role="alert">Gagal menambahkan penggunaan pada pelanggan</div>');
                redirect('admin/tambah_penggunaan/' . $id);
            }
        }
    }


    public function get_bulan_tahun($id_penggunaan)
    {
        $this->db->select('bulan, tahun');
        $this->db->from('penggunaan');
        $this->db->where('id_penggunaan', $id_penggunaan);
        $result = $this->db->get()->row_array();

        if ($result) {
            echo json_encode([
                'bulan' => $result['bulan'],
                'tahun' => $result['tahun']
            ]);
        } else {
            echo json_encode([
                'bulan' => '',
                'tahun' => ''
            ]);
        }
    }

    public function get_meter($id_penggunaan)
    {
        $this->db->select('meter_awal, meter_akhir');
        $this->db->from('penggunaan');
        $this->db->where('id_penggunaan', $id_penggunaan);
        $result = $this->db->get()->row_array();

        if ($result) {
            echo json_encode([
                'meter_awal' => $result['meter_awal'],
                'meter_akhir' => $result['meter_akhir']
            ]);
        } else {
            echo json_encode([
                'meter_awal' => '',
                'meter_akhir' => ''
            ]);
        }
    }
    // public function pembayaran_list()
    // {
    //     $this->load->model('ModelTagihan');
    //     $data['pembayaran'] = $this->ModelTagihan->get_pembayaran_list();
    //     $data['judul'] = 'Data Pembayaran Listrik';
    //     $this->load->view('admin/pembayaran_list', $data);
    // }


    public function pembayaran()
    {
        // Load model
        $this->load->model('ModelTagihan');

        // Retrieve data
        $data['pembayaran'] = $this->ModelTagihan->get_pembayaran_list();
        $data['judul'] = 'Manajemen Pembayaran';

        // Load views
        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/pembayaran', $data); // Update this view to handle the data
        $this->load->view('template/admin/admin_footer');
    }
    public function form_tambah_tarif()
    {
        $data['judul'] = 'Tambah Tarif';
        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/form_tambah_tarif', $data);
        $this->load->view('template/admin/admin_footer');
    }
    public function tambah_tarif()
    {
        $data = [
            'id_tarif'    => htmlspecialchars($this->input->post('id_tarif')),
            'daya'        => htmlspecialchars($this->input->post('daya')),
            'tarifperkwh' => htmlspecialchars($this->input->post('tarifperkwh')),
        ];

        $this->ModelTarif->tambahTarif($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data tarif berhasil ditambahkan.</div>');
        redirect('admin/tampil_tarif');
    }
    // Fungsi untuk menampilkan tarif
    public function tampil_tarif()
    {
        $data = [
            'judul' => 'Data Tarif',
            'tarif' => $this->ModelTarif->getTarif()
        ];

        $this->load->view('template/admin/admin_header', $data);
        $this->load->view('template/admin/tarif', $data);
        $this->load->view('template/admin/admin_footer');
    }
    public function delete($id_pembayaran = null)
    {
        if ($id_pembayaran === null) {
            // Menangani kasus ketika ID tidak diberikan
            $this->session->set_flashdata('message', 'ID Pembayaran tidak ditemukan.');
            redirect('admin/pembayaran'); // Redirect kembali ke halaman pembayaran
        }

        // Panggil model untuk menghapus pembayaran dan tagihan
        $this->load->model('ModelPembayaran');
        $this->load->model('ModelTagihan');

        // Hapus dari tabel pembayaran dan tagihan
        $result = $this->ModelPembayaran->delete_pembayaran_dan_tagihan($id_pembayaran);

        if ($result) {
            $this->session->set_flashdata('message', 'Pembayaran dan tagihan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('message', 'Gagal menghapus pembayaran dan tagihan.');
        }

        redirect('admin/pembayaran'); // Redirect kembali ke halaman pembayaran
    }
}
