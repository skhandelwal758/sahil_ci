<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function register()
	{	
		$this->load->library('form_validation');

        $this->form_validation->set_message('is_unique','This email already exists!');
        
		$this->form_validation->set_rules('name','Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password', 'required');
		$this->form_validation->set_rules('conPassword','Confirm Password', 'required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run()){
            $this->load->model('Register_model');
            $formArray=array();
			$formArray['name'] = $this->input->post('name');
			$formArray['email'] = $this->input->post('email');
			$formArray['password'] = $this->input->post('password');
            $this->Register_model->register($formArray);

            $this->session->set_flashdata('msg','Your account has been created successfully!');
            redirect(base_url().'index.php/Welcome/index');
		} else{
			// echo validation_errors();
			$this->load->view('register');
		}
	}
	}
