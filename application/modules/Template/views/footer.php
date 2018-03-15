</div>
<?php
      $controller = $this->uri->segment(1);
 ?>
  <nav id="context-menu" class="context-menu">
    <ul class="context-menu__items">
      <li class="context-menu__item">
        <a href="javascript:void(0);" class="context-menu__link" data-action="Edit"><i class="fa fa-edit"></i> Edit Task</a>
      </li>
      
    </ul>
  </nav>
  
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Modal Content is Responsive</h4> </div>
                                              <form name="titleform" class="TitleForm" method="post">
                                        <div class="modal-body">
                                          
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label recipient-heading">:</label>
                                                    <input type="text" class="form-control" name="titletext" id="recipient-name"> 
                                                    </div>
                                       
                                         
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                        </div>
                                           </form>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                               <div id="Return-Pos" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content coldtl">
                                  
                                                                 
                           
                                  </div>
                             </div>
                            </div>  
                            
                            
                            
                            
                            
<!-- basic scripts -->
<!-- jQuery -->
<script src="<?php echo base_url('public_html/plugins/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('public_html/assets/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url('public_html/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/datatables/jquery.dataTables.min.js')?>"></script>
<!-- Editable -->
<script src="<?php echo base_url('public_html/plugins/bower_components/jquery-datatables-editable/jquery.dataTables.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/tiny-editable/mindmup-editabletable.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/tiny-editable/numeric-input-example.js')?>"></script>


<script src="<?php echo base_url('public_html/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/validator.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/bootstrap-select/bootstrap-select.min.js')?>"></script>
<!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url('public_html/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')?>"></script>
    
<!--<script src="<?php #echo base_url('public_html/assets/js/jquery.validate.min.js')?>"></script>-->

<!-- Notification Toast Plugin JavaScript -->

<script src="<?php echo base_url('public_html/plugins/bower_components/toast-master/js/jquery.toast.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/toastr.js')?>"></script>


<!--slimscroll JavaScript -->
<script src="<?php echo base_url('public_html/assets/js/jquery.slimscroll.js')?>"></script>
<!--Wave Effects -->
<script src="<?php echo base_url('public_html/assets/js/waves.js')?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('public_html/assets/js/custom.js')?>"></script>
<!-- Flot Charts JavaScript -->
<script src="<?php echo base_url('public_html/plugins/bower_components/flot/jquery.flot.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js')?>"></script>
<!-- Sparkline charts -->
<script src="<?php echo base_url('public_html/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')?>"></script>
<!-- EASY PIE CHART JS -->
<script src="<?php echo base_url('public_html/plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')?>"> </script>
<script src="<?php echo base_url('public_html/plugins/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js')?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('public_html/assets/js/custom.min.js')?>"></script>

<script src="<?php echo base_url('public_html/assets/js/cbpFWTabs.js')?>"></script>
<script type="text/javascript">
        (function () {
                [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });
        })();
    </script>
<!--Style Switcher -->
<script src="<?php echo base_url('public_html/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')?>"></script>
<!-- Stylish Tabs JavaScript -->

<!-- Editable -->
<!--
<script src="<?php echo base_url('public_html/plugins/bower_components/jsgrid/db.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/jsgrid/dist/jsgrid.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/jsgrid-init.js')?>"></script>

-->
<!-- Treeview Plugin JavaScript -->
<script src="<?php echo base_url('public_html/plugins/bower_components/bootstrap-treeview-master/dist/bootstrap-treeview.min.js')?>"></script>
<!--<script src="<?php echo base_url('public_html/plugins/bower_components/bootstrap-treeview-master/dist/bootstrap-treeview-init.js')?>"></script>-->


<script src="<?php echo base_url('public_html/assets/js/moment.js')?>"></script>

<script src="<?php echo base_url('public_html/assets/js/form-operations.js')?>"></script>

<!-- Sweet-Alert  -->
<script src="<?php echo base_url('public_html/plugins/bower_components/sweetalert/sweetalert.min.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js')?>"></script>

<!-- Select2 JS -->
<script src="<?php echo base_url('public_html/assets/js/select2.full.js')?>"></script>

<!-- Context Menu  -->

<!-- mask  -->
<script src="<?php echo base_url('public_html/assets/js/mask.js')?>"></script>
<!-- mask  -->

<!-- nestable  -->
<script src="<?php echo base_url('public_html/assets/js/jquery.nestable.js')?>"></script>
<!-- nestable  -->

<script src="<?php  echo base_url('public_html/plugins/bower_components/switchery/dist/switchery.min.js')?>"></script> 
<!--<script src="<?php  #echo base_url('public_html/plugins/bower_components/custom-select/custom-select.min.js')?>" type="text/javascript"></script> -->
<script src="<?php  echo base_url('public_html/plugins/bower_components/bootstrap-select/bootstrap-select.min.js')?>" type="text/javascript"></script> 
<script src="<?php  echo base_url('public_html/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')?>"></script> 
<script src="<?php  echo base_url('public_html/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php  echo base_url('public_html/plugins/bower_components/multiselect/js/jquery.multi-select.js')?>"></script>

<!-- Context Menu  -->
<script>
    $('.alert').delay(8000).fadeOut(300);
</script>

<!--[if !IE]> -->
<!--
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo base_url('public_html/assets/js/jquery-2.0.3.min.js')?>'>"+"<"+"/script>");
</script>
-->
<!-- <![endif]-->
<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo base_url('public_html/assets/js/jquery-1.10.2.min.js')?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<!--
<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?php echo base_url('public_html/assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
</script>
<script src="<?php echo base_url('public_html/assets/js/bootstrap.min.js')?>">              </script>
<script src="<?php echo base_url('public_html/assets/js/typeahead-bs2.min.js')?>">          </script>
-->
<script src="<?php echo base_url('public_html/right-context-work.js')?>"></script>

<!-- page specific plugin scripts -->
<!-- inline scripts related to this page 
	<script type="text/javascript" src="<?php echo base_url('public_html/assets/chosen/jquery-1.7.1.min.js')?> "></script>
	-->
		<script type="text/javascript" src="<?php echo base_url('public_html/assets/chosen/chosen.jquery.js')?>"></script>
		
		<script type="text/javascript" src="<?php echo base_url('public_html/assets/chosen/chosen.ajaxaddition.jquery.js')?>"></script>

<?php
    if(file_exists('application/modules/CustomJS/views/js.php') == true){
        $this->load->view('CustomJS/js');
    }
    
    if(file_exists('application/modules/CustomJS/views/track_changes.php') == true){
        $this->load->view('CustomJS/track_changes');
    }
    
    foreach (Modules::$locations as $location => $offset) 
	{	
	    if(file_exists($location.$controller.'/views/js.php') == true){
	        $this->load->view($controller.'/js');
	    }
	}
?>
<script type="text/javascript">
jQuery(document).ready(function () {
                // Switchery
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('.js-switch').each(function () {
                    new Switchery($(this)[0], $(this).data());
                });
                // For select 2
                $(".select2").select2();
                $('.selectpicker').selectpicker();
                //Bootstrap-TouchSpin
                $(".vertical-spin").TouchSpin({
                    verticalbuttons: true
                    , verticalupclass: 'ti-plus'
                    , verticaldownclass: 'ti-minus'
                });
                var vspinTrue = $(".vertical-spin").TouchSpin({
                    verticalbuttons: true
                });
                if (vspinTrue) {
                    $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                }
                $("input[name='tch1']").TouchSpin({
                    min: 0
                    , max: 100
                    , step: 0.1
                    , decimals: 2
                    , boostat: 5
                    , maxboostedstep: 10
                    , postfix: '%'
                });
                $("input[name='tch2']").TouchSpin({
                    min: -1000000000
                    , max: 1000000000
                    , stepinterval: 50
                    , maxboostedstep: 10000000
                    , prefix: '$'
                });
                $("input[name='tch3']").TouchSpin();
                $("input[name='tch3_22']").TouchSpin({
                    initval: 40
                });
                $("input[name='tch5']").TouchSpin({
                    prefix: "pre"
                    , postfix: "post"
                });
                // For multiselect
                $('#pre-selected-options').multiSelect();
                $('#optgroup').multiSelect({
                    selectableOptgroup: true
                });
                $('#public-methods').multiSelect();
                $('#select-all').click(function () {
                    $('#public-methods').multiSelect('select_all');
                    return false;
                });
                $('#deselect-all').click(function () {
                    $('#public-methods').multiSelect('deselect_all');
                    return false;
                });
                $('#refresh').on('click', function () {
                    $('#public-methods').multiSelect('refresh');
                    return false;
                });
                $('#add-option').on('click', function () {
                    $('#public-methods').multiSelect('addOption', {
                        value: 42
                        , text: 'test 42'
                        , index: 0
                    });
                    return false;
                });
            });
        </script>
<!-- icheck  -->
<script src="<?php echo base_url('public_html/plugins/bower_components/icheck/icheck.min.js')?>"></script>
<script src="<?php echo base_url('public_html/plugins/bower_components/icheck/icheck.init.js')?>"></script>
<!-- icheck  -->

</body>
</html>