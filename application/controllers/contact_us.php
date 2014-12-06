<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Razin
 * Date: 1/16/12
 * Time: 4:06 PM
 * To change this template use File | Settings | File Templates.
 */

    class Contact_us extends CI_controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        private function load_contact_us_view($data=NULL)
        {
            $this->load->view('themes/default/header', $data);
            $this->load->view('contact_us_view', $data);
            $this->load->view('themes/default/footer');
        }

        public function index()
        {
            $this->load->helper('url');

            $data['title'] = 'Contact_us';

            $this->load_contact_us_view($data);
        }
    }
