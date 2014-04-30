<?php
class Edit_userprofile extends CI_Controller
{

    function __construct()
    {
		parent::__construct();

		$subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2); //creates the various parts  
		$this->profile_of = $subdomain_arr[0]; //assigns the first part  
		if(!$this->is_permitted()) 
		{
			echo "Permission denied";
			die();
		}
    }
    function is_logged_in()
    {
          
          $is_logged_in = $this->session->userdata('is_logged_in');
          if(!isset($is_logged_in) || $is_logged_in != true)
          {
				return FALSE;
          }
          return $this->session->userdata('username');
    }
    function is_permitted()
	{
			  return $this->session->userdata('username')== $this->profile_of;
	}
		
	function index($change_info_errors=null, $change_password_errors=null)
	{
		 
		if(!$this->is_permitted())
		{
			echo "You dont have a permission to edit ". $this->profile_of. " profile";
		}
		else
		{
			$this->load->model('userprofile_model');
			$this->load->model('membership_model');
			$query = $this->userprofile_model->all($this->profile_of);
			$data['header'] = array(
										  'title' => 'Editovanie profilu používateľa '. $this->profile_of,
										  'apps' => $this->membership_model->get_apps(),
										  'header' => 'Editovanie profilu',
										  'is_logged_in' => $this->is_logged_in(),
										);
				
			$data['main_content'] = 'edit_userprofile_view';
			$data['left_content'] = 'left_edit_userprofile_view';
			$data['main_contents_data'] = array(	
													'records' => $query,
													'errors' => $change_info_errors,
													
													
				
													);
			$data['left_contents_data']= array
												(
													'errors'=>$change_password_errors,
													
												);
				
			$this->load->view('includes/template',$data);
			
			
			
			
			
		}
		
    }
    
    function avatar_change()
    {
		
		$this->load->helper(array('url','form'));
		$config['upload_path'] = './images/users/'.$this->profile_of.'/';
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '10000';
		$config['max_width']  = '50000';
		$config['max_height']  = '80000';
		$config['file_name'] = 'avatar.jpg';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
			
			$this->index( $this->upload->display_errors(),null);
		}
		else
		{
			//resize the image
			$config['image_library'] = 'gd2';
			$config['source_image']	= './images/users/'.$this->profile_of.'/avatar.jpg';
			//$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 178;
			$config['height']	= 250;

			$this->load->library('image_lib', $config); 

			$this->image_lib->resize();
			redirect('edit_userprofile','refresh');
		}
	}
    function information_change()
    {
		$this->load->library('form_validation');
    //field name, error message, validation rules
    $this->form_validation->set_rules('first_name','Name','trim|required');
    $this->form_validation->set_rules('last_name','Last Name','trim|required');
    $this->form_validation->set_rules('email_address','Email','trim|required|valid_email');
    $this->form_validation->set_rules('occupation','Occupation','trim|required');
    $this->form_validation->set_rules('about_short','About_short','trim|max_length[250]');
    $this->form_validation->set_rules('about_long','About long','trim|max_length[250]');
    if($this->form_validation->run()==FALSE)
    {
       $this->index();
    }
    else
    {
		$this->load->model('membership_model');
		$status = $this->membership_model->change_information($this->session->userdata('username'));
		if($status == 'ok')
		{
			//ak sa podarilo prehodime na signup successfull, co je login form s napisom, ze sa zaregistroval
			
			$this->index('Údaje boli úspene zmenené ',null);
		   
		
		}
		else
		{
			//zobrazime znova formular + kde nastala chyba:
			
			$this->index($status,null);
			
		}
    
    }
	}
    function password_change()
    {
		$this->load->library('form_validation');
		$this->load->model('membership_model');
		//field name, error message, validation rules
		$this->form_validation->set_rules('new_password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('new_password2','Password Confirmation','trim|required|matches[new_password]');
		if(!$this->membership_model->validate())
		{
			$this->index(null,'Zlé heslo');
		}
		if($this->form_validation->run()==FALSE)
		{
		   $this->index(null,null);
		}
		//zadla spravne stare heslo aj nove dvakrat rovnake, takze ho zmenme:
		
		if( $this->membership_model->change_password($this->input->post('username'),$this->input->post('new_password')))
		{
			$this->index(null,'Heslo bolo úspešne zmenené');
		}
		else
		{
			$this->index(null, 'Nastal problém s databázou, heslo nebolo zmenené');
		}
	}
    
    
    
    
    
    
}
?>
