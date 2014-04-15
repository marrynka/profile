<?php
Class Edit extends CI_Controller
{
    
    function __construct()
    {
      parent::__construct();
      $this->load->model('edit_model');
    
    }
    
    function index()
    { 
      $data['options'] = TRUE;
      $this->load->view('edit_view', $data);
      
      
      
    }
    function sources()
    {
      $sources = $this->edit_model->list_sources(); 
      $data['sources'] = $sources;
      $data['options'] = FALSE;
      $this->load->view('edit_view', $data);
    }
    function achievements()
    {
    
    }
    function badges()
    {
      
    }
    function add_source()
    {
      $source_title = $this->input->post('new_source'); 
      $id = $this->edit_model->add_source($source_title);
      $this->selected_source = $id;
      echo "New source was successfully added.". $this->input->post('return');
      if($this->input->post('return')== 'edit')
      {
      redirect('edit/index/'.$id);
      }
      $this->index();
  
    }
    function delete_source()
    {
      $number_of_sources = $this->input->post('number_of_sources');
      for($i=0;$i<$number_of_sources;$i++)
      {
       if($this->input->post('source'.$i) != '')
       {
          $this->edit_model->delete_source($this->input->post('source'.$i));
          echo "Source was successfully deleted" ;
       } 
       //
      
      }
      $this->index();
      
    }
}

?>