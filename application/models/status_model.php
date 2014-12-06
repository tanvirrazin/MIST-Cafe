<?php

    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Status_model extends CI_Model
    {
        public  $id;
        public  $user_id;
        public  $body;
        public  $datetime;
        private $table_name;

        private $fields = array('id', 'user_id', 'body', 'datetime');

        public function __construct()
        {
            parent::__construct();
            $this->table_name   = 'status';
            $this->load->database();
        }

        private function validate_new_status()
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('form-status-submit', 'Status', 'required');

            return $this->form_validation->run();
        }


        public function write_new_status()
        {
            if( $this->validate_new_status() != TRUE )
            {
                $this->load->helper('url');
                redirect(site_url('home'));
            }

            $this->load->model('user_model', 'user');

            $user_id        = $this->user->id;
            $status_body    = $this->input->post('status-body');
            $type           = $this->input->post('status-type');

            $data           = array(
                'user_id'   =>  $user_id,
                'body'      =>  $status_body,
                'type'      =>  (string)$type
            );

            return $this->db->insert($this->table_name, $data);
        }

        public function get_public_status_front_page($per_page=10)
        {
            $this->load->database();

            $query = "SELECT * FROM status WHERE type='1' ORDER BY datetime DESC LIMIT " . $this->db->escape($per_page) ;
            $public_raw_statuses = $this->db->query($query);

            $public_statuses = null;
            foreach($public_raw_statuses->result_array() as $raw_status)
            {
                $sentiel_status = new Status_model();

                foreach($this->fields as $field)
                {;
                    $sentiel_status->$field = $raw_status[$field];
                }
                $public_statuses[] = $sentiel_status;
            }

            return $public_statuses;
        }

        public function get_username()
        {
            $this->load->database();

            $sql_query = "SELECT * FROM user WHERE id=" . $this->db->escape($this->user_id) . " LIMIT 1";
            $query = $this->db->query($sql_query);

            if($query->num_rows()==0)
            {
                log_message('error', "user_id of status \"{$this->body}\" not found.");
            }

            return $query->row()->username;
        }

    }