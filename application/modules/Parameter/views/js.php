<script>
    <?php $controller = $this->uri->segment(1);?>
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();

    datatablelist("configurationtable","","general");
    datatablelist("generaltable");
    function datatablelist(tableid,trclass=null,id=null){
    	// var dataTable = $('#'+tableid).DataTable( {});
        if(id!=null){
         var url = "<?php echo base_url($controller.'/getList'); ?>?id="+id;
        }
        else{
          var url = "<?php echo base_url($controller.'/getList'); ?>";
        }
        var dataTable = $('#'+tableid).DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url :  url, // json datasource
            type: "post", 
            error: function(){  
                $("."+tableid+"-grid-error").html("");
                $("#"+tableid+"-grid").append('<tbody class="'+tableid+'-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#"+tableid+"-grid_processing").css("display","none");
        },complete: function () {
               $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
               try{
               datatbl_function();
               }
               catch(e){}
               dataTable
                .rows()
                .nodes()
                .to$()
                .attr( 'id','exercises-tr' );
            if(trclass!=null){
                dataTable
                .rows()
                .nodes()
                .to$()
                .attr( 'class',trclass );
                }
                $('#'+tableid+'_filter').hide();
            }
        }
    });

    
    $('#' + tableid + ' thead th').each(function(i) {
        var title = $(this).text();
        if(title!='' && title !='Status' && title !='Print'){
            $(this).html('<input type="text" placeholder="Search ' + title + '" class="searchtbl"/>');
        }
    });

    var typingTimer;
    var doneTypingInterval = 500;
    var table = $('#' + tableid).DataTable();
    $('#' + tableid + ' thead input').on('keyup',function(){

        var thisinput = $(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            table
                .column(thisinput.parent().index() + ':visible')
                .search(thisinput.val())
                .draw();
        }, doneTypingInterval);
      
    });
    $('.searchtbl').on('click', function(e) {
        e.stopPropagation();
    });

}
</script>