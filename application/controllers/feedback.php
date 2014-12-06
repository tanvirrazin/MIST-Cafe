<?php 
	class feedback extends CI_Controller{
		function index(){
			$this->load->helper(array('url','form'));
			$this->load->library('form_validation');
            $this->load->model('feedback_model','fm');
            $this->load->database();

			$this->form_validation->set_rules('name','Name','required|min_length[5]|max_length[12]');// to add later |is_unique[users.username]
			$this->form_validation->set_rules('room','Room No.','required|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('email','E-mail Address','required|min_length[5]|max_length[20]');//|is_unique[users.email]
			$this->form_validation->set_rules('phone','Phone No.','min_length[5]|max_length[20]');//|is_unique[users.email]
			$this->form_validation->set_rules('opinion','Opinion','required');//|is_unique[users.email]

			$data['title'] = "Feedback";
			$this->load->view('themes/default/header',$data);
			if($this->form_validation->run() == FALSE){
				$this->load->view('feedback_view');				
			}
			else
            {
                $feed['name']       = $_POST['name'];
                $feed['room']       = $_POST['room'];
                $feed['email']      = $_POST['email'];
                $feed['phone']      = $_POST['phone'];
                $feed['opinion']    = $_POST['opinion'];

                $this->fm->insert_feedback($feed);
                $this->session->flashdata['message'] = "Thanks for your advice Our developers will work on it.";
                redirect(base_url()."index.php/". $this->session->userdata('is_loggedin')? "home" : "landing");
//                echo "Thanks for your advice Our developers will work on it.";
            }
			$this->load->view('themes/default/footer');
			
		}
	}