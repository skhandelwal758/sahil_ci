<?php
class Register_model extends CI_Model
{
    public function register($formArray)
    {
        $this->db->insert('user', $formArray);
    }

    public function isValidate($email, $password)
    {
        $query = $this->db->where(['email' => $email, 'password' => $password])
            ->get('user');

        if ($query->num_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
