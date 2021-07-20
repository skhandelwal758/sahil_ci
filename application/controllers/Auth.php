<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function register()
    {

        $this->form_validation->set_message('is_unique', 'This email already exists!');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('conPassword', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $this->load->model('Register_model');
            $this->load->helper('string');
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['password'] = md5($this->input->post('password'));
            $formArray['token'] = random_string('alnum', 12);
            $this->Register_model->register($formArray);

            $this->session->set_flashdata('msg', 'Your account has been created successfully!');
            redirect(base_url() . 'index.php/Welcome/index');
        } else {
            // echo validation_errors();
            $this->load->view('register');
        }
    }


    public function login()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $this->load->model('Register_model');

            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            if ($this->Register_model->isValidate($email, $password)) {
                $this->session->set_userdata('email', $email);
                return redirect('Auth/welcome');
            } else {
                $this->session->set_flashdata('msg', 'Invalid credentials!');
                redirect(base_url() . 'index.php/Welcome/login');
            }
        } else {
            // echo validation_errors();
            $this->load->view('login');
        }
    }

    public function welcome()
    {
        if (!$this->session->userdata('email'))
            return redirect('Welcome/login');

        $this->load->view('dashboard');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        return redirect('Welcome/login');
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run()) {
            $this->load->model('Register_model');

            $email = $this->input->post('email');
            $userdata = $this->Register_model->verifyEmail($email);
            if (!empty($userdata)) {
                $subject = 'Reset Password Link';
                $token = $userdata->token;
                $message = 'Hi ' . $userdata->name . '<br><br>'
                    . 'Your reset password request has been recieved. Please click the below link to reset your password.<br><br>'
                    . '<a href="' . base_url() . '/Auth/reset_password/' . $token . '">Click here to reset your password</a><br><br>'
                    . 'Thanks';
                $this->load->library('Phpmailer_lib');
                
                $mail = $this->Phpmailer_lib->load();
                // echo $userdata->name;

                $mail->$this->ClearAddresses();
                $mail->$this->ClearAttachments();
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = "true";
                $mail->SMTPSecure = "tls";
                $mail->Port = "587";
                $mail->Username = "skhandelwal758.sk@gmail.com";
                $mail->Password = "khandelwal2000";
                $mail->setFrom("skhandelwal758.sk@gmail.com");
                $mail->Body = "This is plain text email body";
                $mail->addAddress("sumangupta61216@gmail.com");
                
                $mail->Subject = $subject;
                $mail->Body = $message;
  
                if (!$mail->send()) {
                    // $mail->ErrorInfo;
                    echo "email not sent";
                } else {
                    $this->session->set_flashdata('msg', 'Reset password lin sent to your mail. Check it!');
                    redirect(base_url() . 'index.php/Auth/forgot_password');
                }
            } else {
                $this->session->set_flashdata('msg', 'Email does not exist!');
                redirect(base_url() . 'index.php/Auth/forgot_password');
            }
        } else {
            $this->load->view("forgot_password");
        }
    }
}
