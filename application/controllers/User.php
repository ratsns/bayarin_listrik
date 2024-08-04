<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
    }

    public function index()
    {
        $data = [
            'judul' => 'Cantac Us',
            'css'   => array('style'),
            'js'    => array(),
            'result'   => ''
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/ContacUs/index', $data);
        $this->load->view('template/ContacUs/ContacUs', $data);
        $this->load->view('template/footer', $data);
    }

    public function message()
    {
        // echo '<pre>';
        // print_r('test');
        // echo '</pre>';
        // $data = array(
        //     'firstname' => $this->input->post('firstname'),
        //     'lastname' => $this->input->post('lastname'),
        //     'email' => $this->input->post('email'),
        //     'subject' => $this->input->post('subject'),
        //     'message' => $this->input->post('message'),

        // );

        $this->contact_model->insert();
        // pre('masuk');
        if ($this->db->affected_rows() > 0) {
            //echo '<pre>', print_r($this->db->affected_rows()), '</pre>';
            //echo "<script>alert('Sukses Mengirim Pesan');</script>";
            $data = $this->session->set_flashdata('success', "Sukses Mengirim Pesan");
            // redirect('home', $data);
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('template/ContacUs/index', $data);
            $this->load->view('template/ContacUs/ContacUs', $data);
            $this->load->view('template/footer', $data);
            redirect('contact', $data);
        }
    }
}
