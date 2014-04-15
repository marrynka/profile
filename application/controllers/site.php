<?php 

class Site extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct()
    {
    parent::__construct();
    $this->is_logged_in();
    }
   function members_area()
   {
   $this->load->view('members_area');
   }
   function is_logged_in()
   {
          echo 'hello';
          $is_logged_in = $this->session->userdata('is_logged_in');
          if(!isset($is_logged_in) || $is_logged_in != true)
          {
          echo 'You dont have a permission';
          die();
          }
   }
   
   function index()
   {
   $this->load->model('data_model');
   $data['records'] = $this->data_model->getAll();
   $this->load->view('home',$data);
   }
	public function index1()
	{
    $this->load->model('site_model');
    $data['records'] = $this->site_model->getAll();
     $data['name'] = "Maria";
     $data['lastName'] = "Sormanova";
	   $this->load->view('home', $data);
	}
  public function dosomething()
	{
		echo "doing";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */