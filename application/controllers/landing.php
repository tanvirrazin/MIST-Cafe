<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: shishir
 * Date: 1/10/12
 * Time: 10:27 PM
 * To change this template use File | Settings | File Templates.
 */
class Landing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if( $this->session->userdata('is_loggedin') === TRUE )
        {
            $this->load->helper('url');
            redirect('home');
        }
    }

    private function load_view_all_part($data=NULL)
    {
        $this->load->view('themes/default/header', $data);
        $this->load->view('front_page', $data);
        $this->load->view('themes/default/footer');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('user_model');
        $this->load->model('status_model');

        $data['title'] = "Welcome to your heaven!";
        $data['is_loggedin'] = $this->session->userdata('is_loggedin') ;
        $data['message'] = $this->session->flashdata('message');

        $this->load_view_all_part($data);
    }

    public function login()
    {
        $this->load->model('user_model', 'user');

        $ret_log_in = $this->user->is_loggedin();
        if($ret_log_in)
        {
            $this->session->set_userdata('is_loggedin', TRUE);
            $this->session->set_userdata('user_id', $ret_log_in->id);
            $this->session->set_flashdata('message', 'You have successfully logged in!');
            redirect('home');
        }
        else
        {
            $this->session->set_userdata('is_loggedin', FALSE);
            redirect('landing');
        }
    }

    public function sign_up()
    {
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');
        $this->load->model('user_model','user');
        $this->load->database();

        $this->form_validation->set_rules('username','Username','required|min_length[5]|max_length[40]');// to add later |is_unique[users.username]
        $this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[40]');
        $this->form_validation->set_rules('passconfm','Password Confirmation','required');
        $this->form_validation->set_rules('email','E-mail Address','required|min_length[5]|max_length[40]');//|is_unique[users.email]
        $this->form_validation->set_rules('phone','Phone No.','min_length[5]|max_length[20]');//|is_unique[users.email]

        $data['title'] = "sign up";
        if($this->form_validation->run() === FALSE )
        {
            redirect(site_url("landing"));
        }

        $feed['username']       = $this->input->post('username');
        $feed['password']       = $this->input->post('password');
        $feed['email']          = $this->input->post('email');
        $feed['phone']          = $this->input->post('phone');
        $feed['gender']         = $this->input->post('gender');
        $feed['address']        = $this->input->post('address');

        $this->user->insert_user($feed);
        $this->session->set_flashdata('message', "You have successfully signed up.");
        redirect(site_url("landing"));
    }

    public function logout(){
        $this->load->model('user_model', 'user');
        $this->session->set_userdata('is_loggedin', FALSE);
        redirect('landing');
    }
}

