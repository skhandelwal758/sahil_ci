<?php
    class Register_model extends CI_Model{
        public function register($formArray){
            $this->db->insert('user',$formArray);
        }
    }
?>