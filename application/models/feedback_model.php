<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Razin
 * Date: 1/19/12
 * Time: 5:26 PM
 * To change this template use File | Settings | File Templates.
 */

    class feedback_model extends CI_Model{

        public function insert_feedback($feed){

            if(isset($feed)){
                $data = array('name'=>$feed['name'],
                              'room'=>$feed['room'],
                              'email'=>$feed['email'],
                              'phone'=>$feed['phone'],
                              'opinion'=>$feed['opinion']
                            );
                $this->db->insert('feedback', $data);
            }
        }
    }