<?php

class Edit_activity_types extends CI_Controller
{
   public  $selected_source;
   function __construct()
    {
    parent::__construct();
     $this->load->model('edit_model');
     $this->selected_source = -1;
    }
  
  function index()
  {
      
      if($this->uri->segment(3) != '') $this->selected_source = $this->uri->segment(3);
      $this->load->model('edit_model');
      $sources = $this->edit_model->list_sources();
      $activity_types = $this->edit_model->list_activity_types();
      $data['sources'] = $sources;
      $data['activity_types'] = $activity_types;
      if(isset($this->selected_source))
        {
        
        $data['selected'] = $this->selected_source; 
       
        }
      
      $this->load->view('edit_activity_types_view', $data);
      
     
      
  }
  
  
  
  function add_activity_type()
  {
    $activity_title = $this->input->post('new_activity_type');
    $source_id = $this->input->post('source');
    $id = $this->edit_model->add_activity_type($source_id, $activity_title);
    echo "New activity was successfully added.";
    $this->index();
    
  
  }
  
  
  function delete_activity_type()
  {
      $number_of_activities = $this->input->post('number_of_activity_types');
      for($i=0;$i<$number_of_activities;$i++)
      {
       if($this->input->post('activity'.$i) != '')
       {
          $this->edit_model->delete_activity_type($this->input->post('activity'.$i));
          echo "Activity was successfully deleted" ;
       } 
       //
      
      }
      $this->index();
      
  }
}

?>