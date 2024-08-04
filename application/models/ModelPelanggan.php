<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelPelanggan extends CI_Model
{
    var $table = 'pelanggan';
    public function getpelanggan()
    {
        $this->db->select('p.id_pelanggan, p.username, p.nomor_kwh, p.nama_pelanggan, p.alamat, 
                           pg.bulan, pg.meter_awal, pg.meter_akhir, 
                           (pg.meter_akhir - pg.meter_awal) AS jumlah_meter');
        $this->db->from('pelanggan p');
        $this->db->join('penggunaan pg', 'p.id_pelanggan = pg.id_pelanggan', 'left');
        $this->db->order_by('p.id_pelanggan', 'ASC');
        return $this->db->get();
    }

    public function tambahPelanggan($data)
    {
        return $this->db->insert('pelanggan', $data);
    }

    public function tambahTagihan($data)
    {
        return $this->db->insert('tagihan', $data);
    }

    public function tambahPenggunaan($data)
    {
        return $this->db->insert('penggunaan', $data);
    }

    public function simpanData($data = null)
    {
        $this->db->insert('pelanggan', $data);
    }
    public function cekData($where = null)
    {
        return $this->db->get_where('pelanggan', $where)->row_array();
        //$this->db->last_query();
    }
    public function getUserWhere($where = null)
    {
        return $this->db->get_where('pelanggan', $where);
    }
    public function getpelang($id = null)
    {
        if (empty($id)) {
            return [];
        }

        $this->db->select('pelanggan.id_pelanggan, pelanggan.nama_pelanggan, penggunaan.bulan, penggunaan.tahun, penggunaan.meter_awal, penggunaan.meter_akhir');
        $this->db->from('pelanggan');
        $this->db->join('penggunaan', 'penggunaan.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->where('pelanggan.id_pelanggan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getNamaPelanggan($id_tagihan)
    {
        $this->db->select('tagihan.*, pelanggan.nama_pelanggan');
        $this->db->from('tagihan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
        $this->db->where('tagihan.id_tagihan', $id_tagihan);
        return $this->db->get()->row_array();
    }

    public function getTarif($id_tagihan)
    {
        $this->db->select('tagihan.*, pelanggan.id_tarif');
        $this->db->from('tagihan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
        $this->db->where('tagihan.id_tagihan', $id_tagihan);
        return $this->db->get()->row_array();
    }

    public function getTagihan($id_tagihan)
    {
        $this->db->select('tagihan.*, penggunaan.meter_awal, penggunaan.meter_akhir');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
        $this->db->where('tagihan.id_tagihan', $id_tagihan);
        return $this->db->get()->row_array();
    }

    public function getTarifByIdPelanggan($id_pelanggan)
    {
        $this->db->select('tarif.tarifperkwh');
        $this->db->from('tarif');
        $this->db->join('pelanggan', 'pelanggan.id_tarif = tarif.id_tarif');
        $this->db->where('pelanggan.id_pelanggan', $id_pelanggan);
        return $this->db->get()->row_array();
    }

    public function calculateTotalCost($id_tagihan)
    {
        $tagihan = $this->getTagihan($id_tagihan);
        $tarif = $this->getTarifByIdPelanggan($tagihan['id_pelanggan']);

        if ($tagihan && $tarif) {
            $usage = $tagihan['meter_akhir'] - $tagihan['meter_awal'];
            $totalCost = $usage * $tarif['tarifperkwh'] + 2500;
            return $totalCost;
        }
        return 0;
    }
    public function getTagihanByPelanggan($id_pelanggan)
    {
        $this->db->select('tagihan.*, penggunaan.meter_awal, penggunaan.meter_akhir, pelanggan.nama_pelanggan');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan');
        $this->db->where('tagihan.id_pelanggan', $id_pelanggan);
        $query = $this->db->get();
        return $query->result_array();
    }
}
