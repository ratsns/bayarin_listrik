<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelTarif extends CI_Model
{
    var $table = 'tarif';

    public function tambahTarif($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getTarif()
    {
        $this->db->select('id_tarif, daya, tarifperkwh');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
}
