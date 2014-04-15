<?php

class Email extends CI_Controller
{

    function _construct()
    {
    parent::Controller();
    }
    
    function index()
    {
      $this->load->view('newsletter');
      
    }
    function send()
    {
     echo "hello from send function";
     $this->load->library('form_validation');
     //field name,error masseg, validation
     $this->form_validation->set_rules('name','Name', 'trim|required');
     $this->form_validation->set_rules('email','Email Adress', 'trim|required|valid_email');
     $this->form_validation->set_message('email','Error messge');
     if($this->form_validation->run() == FALSE)
     {
        echo "false validation";
     $this->load->view('newsletter');
     }                  
     else
     {
     echo "form was sent.";
     $name = $this->input->post('name');
     $email = $this->input->post('email');
     echo $name;
     echo $email;
     }
    
    
    }

}


?>