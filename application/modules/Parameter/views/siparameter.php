<?php
$controller =   $this->uri->segment(1);
$view       =   $this->uri->segment(2);
$id         =   $this->uri->segment(3);
$pageTitle  =   'Parameter';
?>
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
        <!--row -->
        <div class="row">
            <!-- PAGE CONTENT BEGINS -->
            <div class="col-xs-12">
                <?php
                if($this->session->flashdata('msg')){
                    foreach($this->session->flashdata('msg') as $key => $value):
                    if($key == 'update' || $key == 'saved'){
                        $alert_class = 'alert-success';
                    }else{
                        $alert_class = 'alert-danger';
                    }
                ?>
                <div class="alert alert-block <?php echo $alert_class; ?>">
                    <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                    </button>
                    <p>
                        <strong>
                            <i class="icon-ok"></i>
                            <?php echo ucwords(strtolower($key)); ?> !
                        </strong>
                        <?php echo $value; ?>
                    </p>    
                </div>
                <?php
                    break;
                    endforeach;
                    $msg = $this->session->flashdata('msg');
                    if($msg['type']=='DEF_SET_NE') { ?>

                    <script type="text/javascript">
                     setTimeout(function() {$(document).ready(function () {
                        $('#configuration')[0].click();
                    });}, 5);
                    </script>
                    <?php
                    }
                }?>
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="table-header">
                            Results for <?=$pageTitle;?>
                            <div class="clearfix"></div>
                            <div class="p-5"></div>
                        </div>
                <div class="white-box">
                <section class="">
                    <div class="sttabs tabs-style-linetriangle">
                    <nav>
                        <ul>
                            <li><a href="#e" id="general"><span>General</span></a></li>
                             <li><a href="#ne" id="configuration" ><span>Configuration</span></a>
                            </li>
                        </ul>
                    </nav>
                     <div class="content-wrap">
                     <section id="e" class="fade">
                            <div class="table-responsive">
                                <table id="generaltable" class="table color-table info-table">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Data</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>                          
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section id="ne" class="fade">
                            <div class="table-responsive">
                                <table id="configurationtable" class="table color-table info-table">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Data</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>                         
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        </div><!-- content-wrap -->
                        </div><!-- tabs -->
                        </section>
                        </div><!-- white box -->
                    </div>
                    <!-- /.container-fluid -->
                </div>                       
            </div>
        </div>
        <footer class="footer text-center"> 2017 &copy; Dawat-e-Islami.net </footer>
    </div>
</div>