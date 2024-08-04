<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('check_login')) {
    function check_login()
    {
        $ci = &get_instance();
        $ci->load->library('session');

        if ($ci->session->userdata('username') == FALSE) {
            $ci->session->set_userdata('session_login', current_url());
            $ci->session->set_flashdata('message', 'Harap login terlebih dahulu');
            redirect('pelanggan');
        }
    }
}

if (!function_exists('pre')) {
    function pre($array = array(), $exit = true)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        if ($exit) exit;
    }
}
