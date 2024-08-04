<?php

class Layanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('global_helper');
        check_login();
        $this->load->helper('string');
        $this->load->model('ModelLayanan');
        $this->load->model('ModelTagihan');
        $this->load->model('ModelPelanggan');
    }

    public function index()
    {
        $data = [
            'judul' => 'Layanan'
        ];

        $data['pelanggan'] = $this->ModelPelanggan->getpelanggan()->result_array();

        $this->load->view('pelanggan/pelanggan_header', $data);
        $this->load->view('pelanggan/pelanggan_topbar', $data);
        $this->load->view('template/layanan/section-1', $data);
        $this->load->view('pelanggan/pelanggan_footer', $data);
    }

    public function inquiry()
    {
        $url = 'https://mobilepulsa.net/api/v1/bill/check';
        $char = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $shuffled = str_shuffle($char);
        $rand = substr($shuffled, 0, 10);
        $ref_id = 'IAK-' . $rand;

        $data = [
            'commands'    => 'inq-pasca',
            'username'    => '085771522432',
            'code'        => 'PLNPOSTPAID',
            'hp'          => $_POST('id'),
            'ref_id'      => $ref_id,
            'sign'        => md5('085771522432' . '749669a17d2c55989oPJ' . $ref_id)
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        pre($result);
        return $result;
    }
    public function search()
    {
        $data['pelanggan'] = [];
        $data['id'] = '';
        $data['judul'] = 'Halaman Pencarian';

        if ($this->input->post('submit')) {
            $data['id'] = $this->input->post('id');
            $data['pelanggan'] = $this->ModelPelanggan->getpelang($data['id']);
        }

        $this->load->view('pelanggan/pelanggan_header', $data);
        $this->load->view('pelanggan/pelanggan_topbar', $data);
        $this->load->view('template/layanan/section-1', $data);
        $this->load->view('pelanggan/pelanggan_footer', $data);
    }
    public function tagihan($id_pelanggan)
    {
        $data['tagihan'] = $this->ModelPelanggan->getTagihanByPelanggan($id_pelanggan);
        // pre($data);
        $data['judul'] = 'Detail Tagihan';

        // pre($data['tagihan']);
        $this->load->view('pelanggan/pelanggan_header', $data);
        $this->load->view('pelanggan/pelanggan_topbar', $data);
        $this->load->view('pelanggan/tagihan', $data);
        $this->load->view('pelanggan/pelanggan_footer', $data);
    }

    public function proses_pembayaran($id_tagihan)
    {
        $tagihan = $this->ModelPelanggan->getTagihan($id_tagihan);
        $totalCost = $this->ModelPelanggan->calculateTotalCost($id_tagihan);

        $data = [
            'judul'          => 'Pembayaran',
            'tagihan'        => $tagihan,
            'total_cost'     => $totalCost,
            'nama_pelanggan' => $this->ModelPelanggan->getNamaPelanggan($id_tagihan),
            'pelanggan'      => $this->ModelPelanggan->getTagihanByPelanggan($id_tagihan),
            'id_tarif'       => $this->ModelPelanggan->getTarif($id_tagihan)
        ];

        $this->load->view('pelanggan/pelanggan_header', $data);
        $this->load->view('pelanggan/pelanggan_topbar', $data);
        $this->load->view('pelanggan/proses_pembayaran', $data);
        $this->load->view('pelanggan/pelanggan_footer', $data);
    }

    public function bayar()
    {
        $id_tagihan         = htmlspecialchars($this->input->post('id_tagihan'));
        $id_pelanggan       = htmlspecialchars($this->input->post('idpel'));
        $tanggal_pembayaran = date('Y-m-d');
        $bulan_bayar        = htmlspecialchars($this->input->post('bulan'));
        $biaya_admin        = htmlspecialchars($this->input->post('badmin'));
        $total_bayar        = htmlspecialchars($this->input->post('total'));
        $id_user            = 1;

        $total_bayar = str_replace(['Rp', ',', ' '], '', $total_bayar);

        $dataPembayaran = [
            'id_pembayaran'       => random_string('basic', 16),
            'id_tagihan'          => $id_tagihan,
            'id_pelanggan'        => $id_pelanggan,
            'tanggal_pembayaran'  => $tanggal_pembayaran,
            'bulan_bayar'         => $bulan_bayar,
            'biaya_admin'         => $biaya_admin,
            'total_bayar'         => $total_bayar,
            'id_user'             => $id_user,
        ];

        $this->db->insert('pembayaran', $dataPembayaran);

        $tagihan = $this->ModelPelanggan->getTagihan($id_tagihan);
        if ($tagihan) {
            $id_penggunaan = $tagihan['id_penggunaan'];

            $dataUpdate = [
                'status' => 'Lunas'
            ];

            $this->db->where('id_tagihan', $id_tagihan);
            $this->db->update('tagihan', $dataUpdate);

            $this->db->where('id_penggunaan', $id_penggunaan);
            $this->db->delete('penggunaan');
        }

        $this->session->set_flashdata('success', 'Proses Pembayaran Telah Sukses ');
        redirect('pelanggan/dashboard');
    }
}
