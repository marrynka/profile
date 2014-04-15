<?php
	$data['title'] = $header['title'];
	$data['apps'] = $header['apps'];
	$data['header'] = $header['header'];
    $data['is_logged_in'] = $header['is_logged_in'];
    $this->load->view('includes/header',$data);
?> 

<div id="main_content">
<?php
    $data['main_content'] = $main_content;
	$data['main_contents_data'] = $main_contents_data;
    $this->load->view('includes/content', $data);
?>
</div>
<?php
    $this->load->view('includes/footer');
?>
