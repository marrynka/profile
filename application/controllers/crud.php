<?php


class Crud extends CI_Controller
{
    function index()
    {
    $data=array();
    //$this->load->view('options_view');
    if($query = $this->crud_model->get_records())
    {
      $data['records'] = $query;
    }
    $this->load->view('options_view',$data);
    }
    function create()
    {
      $data= array(
       'title' => $this->input->post('title'),
       'contents' => $this->input->post('contents')  
      );
      $this->crud_model->add_record($data);
      $this->index();
    }
    function delte()
    {
      $this->crud_model->delete_row();
      $this->index();
    }
    function update()
    {
    $data = array(
      'title' => 'Updated lucka',
      'contents' => 'strasne updatnuta'
    
    );
    $this->crud_model->update_record($data);
    $this->index();
    }
}
?>