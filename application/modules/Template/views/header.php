<?php
    header('Access-Control-Allow-Origin: *'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8" />
    <title> Web ERP</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- basic styles -->
	<!-- country code and telephone picker START -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/build/css/intlTelInput.css')?>">
    <!-- country code and telephone picker END -->
    
    <script type="text/javascript">
        var BASEURL         =   "<?php echo base_url()?>";
    </script>

    <link href="<?php echo base_url('public_html/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet')?>" />
	<link type="text/css" rel="stylesheet" media="screen" href="<?php echo base_url('public_html/assets/chosen/chosen.css')?>">

    <!-- animation CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/css/animate.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/build/css/intlTelInput.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/right-context-work.css')?>" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/css/style.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/css/custom_style.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')?>" />
<!--    <link rel="stylesheet" href="<?php #echo base_url('public_html/plugins/bower_components/custom-select/custom-select.css')?>" /> -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/switchery/dist/switchery.min.css')?>" /> 
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/bootstrap-select/bootstrap-select.min.css')?>" /> 
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/multiselect/css/multi-select.css')?>" />
    
    
    <!-- color CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/assets/css/colors/blue.css')?>" />

    <!-- Menu CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')?>" />
    
    <!-- New Plugin CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/datatables/jquery.dataTables.min.css')?>" />
    <link href="<?php echo base_url('public_html/assets/bootstrap/dist/css/buttons.dataTables.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public_html/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.css')?>" rel="stylesheet">
    <!-- New Plugin CSS -->
    <link href="<?php echo base_url('public_html/plugins/bower_components/toast-master/css/jquery.toast.css')?>" rel="stylesheet">
    
    <!-- vector map CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/css-chart/css-chart.css')?>" />

    <!--alerts CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/sweetalert/sweetalert.css')?>" />

    <!-- Editable CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public_html/plugins/bower_components/jquery-datatables-editable/datatables.css')?>" />
    <!-- Date picker plugins css -->
    <link href="<?php echo base_url('public_html/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')?>" rel="stylesheet" type="text/css" />
	<!-- nestable css -->
	<link href="<?php echo base_url('public_html/assets/css/jquery.nestable.css')?>" rel="stylesheet" type="text/css" />
    <!-- Select2 css -->
    <link href="<?php echo base_url('public_html/assets/css/select2.min.css'); ?>" rel="stylesheet">
    <style>
    *{
        font-size: 12px;
    }
	.child-items{padding:5px 0;}
    </style>
</head>

