<?php    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Home extends CI_controller
    {
        public function __construct()
        {
            parent::__construct();

            if( $this->session->userdata('is_loggedin') != TRUE )
            {
                $this->load->helper('url');

                $this->session->set_userdata('message', 'You are not Logged in!');
                redirect('landing');
            }
        }

        private function load_view_all_part($data=NULL)
        {
            $this->load->view('themes/default/header', $data);
            $this->load->view('home_view', $data);
            $this->load->view('themes/default/footer');
        }

        public function index()
        {
            $this->load->model('status_model', 'status');
            $this->load->helper(array('form', 'url'));

            $data['title']          = 'Home';
            $data['is_loggedin']    = $this->session->userdata('is_loggedin')? TRUE: FALSE;
            $data['message']        = $this->session->flashdata('message');

            $this->load_view_all_part($data);
        }

        public function status()
        {
            $this->load->model('status_model', 'status');
            $this->load->helper(array('url'));
            $this->load->library(array('form_validation'));

            $this->form_validation->set_rules('status-body', 'Status', 'required');
            if($this->form_validation->run() === FALSE )
            {
                redirect(site_url("home"));
            }

            if($this->status->write_new_status()===TRUE)
            {
                $this->session->set_flashdata('message', 'Your status has been updated!');
            }
            else
            {
                $this->session->set_flashdata('message', 'Oops! There was problem. Why don\'t just make another one, huh?');
            }

            redirect(site_url("home"));
        }

        public function logout()
        {
            $this->load->helper('url');

            $this->session->set_userdata('is_loggedin', FALSE);
            $this->session->set_userdata('user_id', FALSE);
            // session_destroy... ?!?!
            $this->session->set_flashdata('message', 'Goodbye!');

            redirect(site_url("landing"));
        }
    }
