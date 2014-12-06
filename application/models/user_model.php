<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: shishir
 * Date: 1/11/12
 * Time: 3:45 PM
 * To change this template use File | Settings | File Templates.
 */
    class User_model extends CI_Model
    {
        public $id;
        public $username;
        public $password;
        public $email;
        public $phone;
        public $gender;
        public $address;

        private $table_name;

        public function __construct()
        {
            parent::__construct();
            $this->table_name   = "user";
            $this->load->database();
            $this->find_myself();
        }

        /**
         * It automatically loads the current user profile onto $this
         */
        private   function find_myself()
        {
            $user_id = $this->session->userdata('user_id');
            if($user_id===FALSE)
                return FALSE;

            $sql_query  = "SELECT * FROM " . $this->table_name . " WHERE id=" . $this->db->escape($user_id) . " LIMIT 1";
            $query      = $this->db->query($sql_query);

            if($query->num_rows() != 1)
                return FALSE;

            $ret_object = $query->row();

            // Make it dynamic
            $this->id           = $ret_object->id;
            $this->username     = $ret_object->username;
            $this->password     = $ret_object->password;
            $this->email        = $ret_object->email;
            $this->phone        = $ret_object->phone;
            $this->gender       = $ret_object->gender;
            $this->address      = $ret_object->address;

            return TRUE;
        }

        private  function validate_form_login_input()
        {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[30]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[30]');

            return $this->form_validation->run();
        }

        public function is_loggedin()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if( $this->validate_form_login_input() == FALSE )
                return FALSE;

            $query = "SELECT * FROM user WHERE username=" . $this->db->escape($username) . " AND password=" .
                $this->db->escape($password) . " LIMIT 1" ;

            $query = $this->db->query($query);

            return $query->num_rows()==1? $query->row(): FALSE;
        }

        public function insert_user($feed){

            $data =array(
                'username'  =>  $feed['username'],
                'password'  =>  $feed['password'],
                'email'     =>  $feed['email'],
                'phone'     =>  $feed['phone'],
                'gender'    =>  $feed['gender'],
                'address'   =>  $feed['address']
            );
            return $this->db->insert('user', $data);
        }
    }