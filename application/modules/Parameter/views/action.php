<?php
    $controller =   $this->uri->segment(1);
    $view       =   $this->uri->segment(2);
    $id         =   $this->uri->segment(3);
    $pageTitle  =   'Parameter';
	if(isset($result_set)){
        $row = $result_set;
    }
	$id              = $this->uri->segment(3);
    
if($id){
$OperationLog = array();
if(isset($row[0]->par_code)){
    $OperationLog['par_code']=$par_code = $row[0]->par_code;
}
if(isset($row[0]->par_desc)){
    $OperationLog['par_desc']=$par_desc = $row[0]->par_desc;
}
if(isset($row[0]->par_data)){
    $OperationLog['par_data']=$par_data = $row[0]->par_data;
}
if(isset($row[0]->par_group)){
    $OperationLog['par_group']=$par_group = $row[0]->par_group;
}
}
$lastID = 0;
if(isset($last_id)){
    $lastID = $last_id;
    
}
?>
<style>
    .input-group{
        width:95%;
    }
</style>
<!-- Page Content -->
<div class="page-content" id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?=$pageTitle;?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li>Dashboard</li>
                    <li class="active"><?=$pageTitle;?> Details</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <h1>
            <a href="<?php echo base_url($controller); ?>/" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
        </h1>
    </div><!-- /.page-header -->
	<div class="row">
        <div class="col-xs-12">
            <div class="col-xs-2"></div>
            <div class="col-xs-8">
            <!-- PAGE CONTENT BEGINS -->
            <?php
				$attributes = array(  
							'class'              => 'form-horizontal form-validate-group',
                            'id'                 => 'selectbox_validate', 
							'role'               => 'form',
                            'data-toggle'        => 'validator'
                            );
                echo form_open(base_url($controller.'/command'), $attributes);
                //error_log('log op '.print_r($OperationLog,true));
                if(isset($id)){ ?><input type="hidden" name="old_data" value="<?php echo base64_encode(serialize($OperationLog));?>"/><?php } ?>
                <div class="white-box">
                    <h2 class="box-title m-b-20 text-center"><?=$pageTitle;?></h2>
                    <input type="hidden" name="id" id="id" value="<?php if(isset($par_code)){echo $par_code;}?>">
                    
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="code">Code:</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="input-group">
                                <input type="text" name="code" id="code" value="<?php if(isset($par_code)){echo $par_code;}else{echo str_pad($lastID, 6, '0', STR_PAD_LEFT);} ?>" readonly class="col-xs-12 col-sm-6 required-field form-control" tabindex="1" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="description">Description</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="input-group">
                                <textarea old-username="<?php if(isset($par_desc)){echo $par_desc;} ?>" id="description" name="description" class="col-xs-12 col-sm-6 form-control" placeholder="Description" tabindex="3" readonly ><?php if(isset($par_desc)){echo $par_desc;} ?></textarea>
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="data">Data</label>
                        <div class="col-xs-12 col-sm-9 <?php if (form_error('data')) { echo "has-error";} ?>">
                            <div class="input-group">
                                <input old-username="<?php if(isset($par_data)){echo $par_data;} ?>" id="data" value="<?php if(isset($par_data)){echo $par_data;} ?>" name="data" class="col-xs-12 col-sm-6 required-field form-control" placeholder="Data" tabindex="3" maxlength="100" required> 
                            </div>
                            <?php echo form_error('data', '<div for="data" class="alert-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <button class="btn btn-info waves-effect waves-light m-t-10 btn-validate pull-right" type="submit">
                            <i class="icon-ok bigger-110"></i>Process
                        </button>
                    </div>
                    </section>
                    </div>
                    </div>
                    </section>
                </div> <!-- white box -->   
            </div>
        </div>
    </div>
    <div class="space-2"></div>
    <div class="clearfix form-actions">
        <div class="col-md-offset-6 col-md-9"></div>
    </div>
    <?php echo form_close();  ?>
    <!-- PAGE CONTENT ENDS -->
    <footer class="footer text-center"> 2017 &copy; Dawat-e-Islami.net </footer>
</div><!-- /.col -->
