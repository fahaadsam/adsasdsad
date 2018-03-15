<?php 

### All header section are here !
$this->load->view('Template/header');

### All nav section are here !
$this->load->view('Template/nav');

### All sidebar section are here !
//$this->load->view('Template/sidebar');

### All breadcrumbs section are here !
#$this->load->view('Template/breadcrumbs');


#### Module Content come from controller
$this->load->view($content);


### modals popup 
// $this->load->view('Template/models_popup');
###  Module Right Side Bar
#$this->load->view('Template/rightsidebar');

### ALL js links here
$this->load->view('Template/footer');

?>
