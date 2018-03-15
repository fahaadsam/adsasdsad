var addvalid = false;
var AddProFlag = false;
$(".ClipBoard").hide();
$('.formDInput input').prop('disabled', true);
$('.InitelStat').prop('disabled', true);
$("[name='ca_active_tag']").bootstrapSwitch();
$("[name='ca_active_tag']").bootstrapSwitch("disabled", true);
$("#mayNagative").bootstrapSwitch("disabled", true);
$(".gennext").prop("disabled", true);
$(".ForEdit").prop("disabled", true);
//$(".Group").prop("checked", true);

$('.childChain').change(function(){
	$(".locationCode").val(this.value);
});

function groupset(){
	$('.groupset').change(function(){

	    $.ajax({
	        url: BASEURL+"Inventory_Documenttype/GetGroupItem",
	        type: "POST",
	        data: {'code':this.value},
	        dataType: "json",
	        success : function(response){
	            globalCount = response.list.length-1;
	            $('.globalCountNumber').val(globalCount);
	            $('.itemGroupSet').html('<option value="">Select an Option</option>');
	            $('.itemGroupSet').trigger("chosen:updated");
	          //  $('.itemGroupSet').reset();

	        }
	    });
	});
}
groupset();
function allowsupplier(){
$('.groupsup').change(function(){
	$('.allowsupplier').empty('');
		  $.ajax({
		         url: BASEURL+"Purchase_Setup_Supplier/GetAllowedSupplier",
		         type: "POST",
		         data: {'code':this.value},
		         dataType: "json",
		         success : function(response){
		        	 for(var i=0;i<response.list.length;i++){
		        	  var option=$('<option></option>').text(response.list[i]['sup_name']);
		        	      option.val(response.list[i]['sup_code']);
		        	    $('.allowsupplier').append(option);
		        	}
		        	let supcode = $('.supcode').val();
		        	    $('.allowsupplier').val(supcode);
		         }
		     });
});
}
allowsupplier();
function allowcst(){
$('.groupcst').change(function(){
	$('.allowcst').empty('');
		  $.ajax({
		         url: BASEURL+"POS_Customer/GetAllowedCustomer",
		         type: "POST",
		         data: {'code':this.value},
		         dataType: "json",
		         success : function(response){
		        	 for(var i=0;i<response.list.length;i++){
		        	  var option=$('<option></option>').text(response.list[i]['cst_title']);
		        	      option.val(response.list[i]['cst_code']);		        	     
		        	    $('.allowcst').append(option);		        	   
		        	 }
		        	 let cstcode = $('.cstcode').val();
		        	  $('.allowcst').val(cstcode);	        	
		         }
		     });
});
}allowcst();
$("#coa_code").focus();

$('.ForReset').click(function() {
	$("tr.tableclass").removeClass('highlighted');
	$('.formDInput input').prop('disabled', true);
	$('.InitelStat').prop('disabled', true);
	$("#mySwitch").bootstrapSwitch("disabled", true);
	$("#mayNagative").bootstrapSwitch("disabled", true);
	$(".gennext").prop("disabled", true);
	$(".ForEdit").prop("disabled", true);
	$(".ForAddNew").prop("disabled", false);
	$(".ClipBoard").hide();
	glflage = false;
	addvalid = false;

});

 

$.fn.cleardefault = function() {
    return this.focus(function(e) {
        if( this.value == this.defaultValue ) {           
            var t = this;
            window.setTimeout(function() {
                t.setSelectionRange(0,0);
                //t.setCursorPosition(0);
            }, 0);
        }
    }).blur(function(e) {
        if( !this.value.length ) {
            this.value = this.defaultValue;
            
        }
    });
};


$(".cursorStart").cleardefault();

/*
var from = '2017/09';
var to = '2017/09'; 

var currentdate = formatDate(new Date());
console.log('from '+from);
console.log('to '+to);
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('/');
}
console.log('current '+currentdate);

function isFromBiggerThanTo(dtmfrom, current, dtmto ){
   return new Date(current).getTime() >= new Date(dtmfrom).getTime()    && new Date(current).getTime() <=  new Date(dtmto).getTime();
}

console.log('compare '+isFromBiggerThanTo(from,currentdate, to)); //true

*/


$(".ForAddNew").click(function() {
	$('.formDInput input').prop('disabled', false);
	$('.InitelStat').prop('disabled', false);
	$("[name='ca_active_tag']").bootstrapSwitch();
	$("[name='ca_active_tag']").bootstrapSwitch("disabled", false);
	$("#mayNagative").bootstrapSwitch("disabled", false);
	$('.formDInput').trigger("reset");
	$(".ForEdit").prop("disabled", true);
	$(".gennext").prop("disabled", true);
	$(".type_g").prop("disabled", true);
	$(".ForEdit").prop('disabled', true);
	$("#foraditop").prop('disabled', true);
	$(".ClipBoard").hide();
	glflage = false;
	addvalid = true;

});

$(".tabrow").click(function() {
	var $row = $(this).closest("tr");
});

$(".ForEdit").click(function() {
	var tabIdRoe = $("#coa_code").val();
	var title = $("#item-title").val();
	
	if (tabIdRoe != "" && title != "") {
		$('.formDInput input').prop('disabled', false);
		$('.InitelStat').prop('disabled', false);
		$("#mySwitch").bootstrapSwitch();
		$("#mySwitch").bootstrapSwitch("disabled", false);
		$("#mayNagative").bootstrapSwitch("disabled", false);
		$(".gennext").prop("disabled", true);
		$(".ForEdit").prop("disabled", true);
		$(".ForAddNew").prop("disabled", true);
		$(".type_g").prop("disabled", true);
		$("#coa_code").prop('disabled', true);
		$("#foraditop").prop('disabled', false);
		$(".ClipBoard").hide();
		glflage = true;

	} else {
		$("#foraditop").prop('disabled', true);
		$("#coa_code").prop('disabled', true);
		$('.formDInput input').prop('disabled', true);
		$('.InitelStat').prop('disabled', true);
		$("#mySwitch").bootstrapSwitch();
		$("#mySwitch").bootstrapSwitch("disabled", true);
		$("#mayNagative").bootstrapSwitch("disabled", true);
		$('.formDInput').trigger("reset");
		addvalid = false;

	}

});

$(".ClipBoard").click(function(){
	$('.formDInput input').prop('disabled', false);
	$('.InitelStat').prop('disabled', false);
	$("[name='ca_active_tag']").bootstrapSwitch();
	$("[name='ca_active_tag']").bootstrapSwitch("disabled", false);
	$("#mayNagative").bootstrapSwitch("disabled", false);
	$(".ForEdit").prop("disabled", true);
	$(".gennext").prop("disabled", true);
	$(".type_g").prop("disabled", true);
	$("#foraditop").prop('disabled', true);
	glflage = false;
	addvalid = true;
	$(".ClipBoard").hide();
	
});


$(".gennext").click(function() {

	var scode = $("#coa_code").val();
	if (scode != "" && addvalid == false) {
		$('.formDInput input').prop('disabled', false);
		$('.InitelStat').prop('disabled', false);
		$("[name='ca_active_tag']").bootstrapSwitch();
		$("[name='ca_active_tag']").bootstrapSwitch("disabled", false);
		$("#mayNagative").bootstrapSwitch("disabled", false);
		$('.formDInput').trigger("reset");
		glflage = false;
		addvalid = true;
		var json={};
		var request = $.ajax({
			url : BASEURL + "Template/gennext",
			type : "POST",
			data : {
				'itemcode' : scode,
				'tbl_name' : 'gl_chartofacc',
				'column_name' : 'ca_acc_code',
				'lvl_column' : 'ca_lvl',
				'maskcode' : '0000000151'
			},
			dataType : "json",
			success : function(response) {

				$("#coa_code").val(response);
				$("#foraditop").val(response);
			}
		});

		$(".type_g").prop("disabled", true);
		$(".ForEdit").prop('disabled', true);
		
		$(".ClipBoard").hide();

	}
});

$('#COA_Manege tbody').on( 'click', 'tr', function () {
					if (glflage == true) {
						swal(
								'Oops...',
								'Please click cancel to edit other then selected data !',
								'error');
						return false;
					}
					if (addvalid == true) {
						return false;
					}
					$("tr.tableclass").removeClass('highlighted');
					$(this).addClass('highlighted');
					var tableData = $(this).children("td").map(function() {
						return $(this).text();
					}).get();
					$(".ClipBoard").show();
					$("#foraditop").val($.trim(tableData[0]));
					$("#coa_code").val($.trim(tableData[0]));
					$("#item-title").val($.trim(tableData[1]));
					$("#other_title").val($.trim(tableData[2]));
					$(".ForEdit").prop("disabled", false);
					$(".gennext").prop("disabled", false);
					$(".ForAddNew").prop("disabled", true);
					$("." + $.trim(tableData[3])).prop('checked', true);
					var groupclass = $.trim(tableData[5]).split(' ').join('-');
					var ubtGroup = groupclass.replace(/\//g, "");
					$('.' + ubtGroup).prop('checked', true);
					$("." + $.trim(tableData[4])).prop('checked', true);

					if ($.trim(tableData[6]) == "Yes") {
						$("#mayNagative").bootstrapSwitch("disabled", false);
						$("#mayNagative").bootstrapSwitch('state', true, false);
						$("#mayNagative").bootstrapSwitch("disabled", true);
					} else {
						$("#mayNagative").bootstrapSwitch("disabled", false);
						$("#mayNagative").bootstrapSwitch('state', false, true);
						$("#mayNagative").bootstrapSwitch("disabled", true);

					}

					if ($.trim(tableData[7]) == "Active") {
						$("#mySwitch").bootstrapSwitch("disabled", false);
						$("#mySwitch").bootstrapSwitch('state', true, false);
						$("#mySwitch").bootstrapSwitch("disabled", true);
					} else {
						$("#mySwitch").bootstrapSwitch("disabled", false);
						$("#mySwitch").bootstrapSwitch('state', false, true);
						$("#mySwitch").bootstrapSwitch("disabled", true);

					}
				});
function arrSum(arr) {
	var sum = 0;
	for (var i = 0; i < arr.length; i++) {
		if (typeof arr[i] == 'object') {
			sum += arrSum(parseInt(arr[i]));
		} else if (Number(arr[i])) {
			sum += parseInt(arr[i]);
		}
	}
	return sum;
}

$("#coa_code").keyup(function() {

	var mcode = $("#maskjs").val();
	var actcode = $("#coa_code").val();
	var rcode = actcode.replace(/-/g, '');
	var rcode = rcode.replace(/_/g, '').length;
	mcoden = arrSum(mcode);
	if (rcode == mcoden) {
		$(".Detail").prop('checked', true);
		$(".Group").prop('checked', false);
		catype = 0;

	} else {
		$(".Group").prop('checked', true);
		$(".Detail").prop('checked', false);
		catype = 1;
	}
	sentcode = $("#coa_code").val();

	sentcode = sentcode.replace(/_/g, '');

	sentcode = sentcode.substr(0, sentcode.length);
	var lastDash = sentcode.lastIndexOf('-');
	sentcode = sentcode.substr(0, lastDash);

	regmask(JSON.parse($("#maskjs").val()), sentcode);

});

function regmask(maskpatren, comcode) {
	var data = maskpatren;

	var regexStr = "^";

	var strVal = $.trim(comcode);
	var lastChar = strVal.slice(-1);
	if (lastChar == '-') {
		strVal = strVal.slice(0, -1);
	}
	// Read Value
	var str = strVal;

	var arr = [];

	arr = str.split('-');

	for (var i = 0; i < arr.length; i++) {
		if (i > 0) {
			regexStr += "-";
		}
		regexStr += "[0-9+]{" + data[i] + "}";
		if (i == data.length - 1) {
			regexStr += "$";
		}
	}

	if (str.match(regexStr)) {
		$(".Haserror").hide();
		return true;
	} else {
		$(".Haserror").show();
		$(".Haserror").text("Please Fill Mask Under - Section !");
		return false;
	}
}
$("#crapsearch").keyup(function(){
	 _this = this;
	 // Show only matching TR, hide rest of them
	 $.each($("#table tbody").find("tr"), function() {
	     if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
	        $(this).hide();
	     else
	          $(this).show();                
	 });
	}); 
// Product class Product class Product class 
$(".gennextP").click(function() {

	var pcode = $("#item-code").val();
	if (pcode != "") {
		$(".SubmitProducts").trigger("reset");
		$(".SubmitProducts input").prop("disabled", false);
		$(".SubmitProducts textarea").prop("disabled", false);
		$(".SubmitProducts select").prop("disabled", false);
		$(".dreamdis").bootstrapSwitch("disabled", false);
		$('.SubmitProducts').trigger("reset");
		ProFlage = false;
		AddProFlag = true;
		var json = {};
		var request = $.ajax({
			url : BASEURL + "Template/gennext",
			type : "POST",
			data : {
				'itemcode' : pcode,
				'tbl_name' : 'si_items',
				'column_name' : 'itm_itemcode',
				'lvl_column' : 'itm_level',
				'maskcode' : '0000000100'
			},
			dataType : "json",
			success : function(response) {

				$("#item-code").val(response);
				chkproduct();
			}
		});
		$(".gennextP").prop("disabled", true);
		$(".ForEditProduct").prop("disabled", true);
		$(".ForAddNewProduct").prop("disabled", false);
		$('.ForSubmitProduct').prop('disabled', false);
		$(".ForClipBoardProducts").hide();
		$("#img-upload").hide();
		$(".close").hide();

	}
});

$("#item-code").change(function() {
	regmask(JSON.parse($("#maskjsProduct").val()), $("#item-code").val());
})

 
//        var table = $('#employee-grid').DataTable();
         
//        $('#employee-grid tbody').on('click', 'tr', function () {
//	
//	if (ProFlage == true) {
//		swal(
//				'Oops...',
//				'Please click cancel to edit other then selected data !',
//				'error');
//		return false;
//	}
//	if(AddProFlag == true){
//		swal(
//				'Oops...',
//				'Please click cancel to edit other then selected data !',
//				'error');
//		return false;
//	}
//			
//			$("tr").removeClass('highlighted');
//			$(this).addClass('highlighted');
//			var tableData = $(this).children("td").map(function() {
//				return $(this).text();
//			}).get();
//			if(tableData){
//				$(".ForEditProduct").prop("disabled",false);
//				$(".ForAddNewProduct").prop("disabled",true);
//				$(".gennextP").prop("disabled",false);
//			}
//            $(".ForClipBoardProducts").show();
//             $("#cid").val(1);
//             $("#item-code").val($.trim(tableData[0]));
//             $("#id").val($.trim(tableData[0]));
//             $("#description").val($.trim(tableData[1]));
//             $("#old-item-code").val($.trim(tableData[2]));
//             $("#detail-description").val($.trim(tableData[3]));
//             $("#product-group").val($.trim(tableData[4]));
//             $("#product-type").val($.trim(tableData[5]));
//             $("#item-type").val($.trim(tableData[6]));
//             if($.trim(tableData[7])==0){//active status
//                    $("#status").bootstrapSwitch("disabled", false);
//                    $("#status").bootstrapSwitch('state', false, true);
//                    $("#status").bootstrapSwitch("disabled", true);
//                }
//             else{
//                    $("#status").bootstrapSwitch("disabled", false);
//                    $("#status").bootstrapSwitch('state', true, false);
//                    $("#status").bootstrapSwitch("disabled", true);
//                }
//            //Importable
//             if($.trim(tableData[8])==0){
//                    $("#importable").bootstrapSwitch("disabled", false);
//                    $("#importable").bootstrapSwitch('state', false, true);
//                    $("#importable").bootstrapSwitch("disabled", true);
//                }
//             else{
//                    $("#importable").bootstrapSwitch("disabled", false);
//                    $("#importable").bootstrapSwitch('state', true, false);
//                    $("#importable").bootstrapSwitch("disabled", true);
//                }
//            //Type
//            if($.trim(tableData[9])==1){
//                $("#group").prop("checked", true);
//                $("#detail").prop("checked", false);
//            }
//             else{
//                $("#group").prop("checked", false);
//                $("#detail").prop("checked", true);
//                }
//            $("#default_buy_price").val($.trim(tableData[10]));
//            $("#default_sell_price").val($.trim(tableData[11]));
//            $("#default_sell_tax").val($.trim(tableData[12]));
//            $("#tare_weight").val($.trim(tableData[13]));
//
//            $("#buy_unit").val($.trim(tableData[14]));
//            $("#store_unit").val($.trim(tableData[15]));
//            $("#sell_unit").val($.trim(tableData[16]));
//            $("#lead_time").val($.trim(tableData[17]));
//            $("#record_level").val($.trim(tableData[18]));
//            $("#recordqty").val($.trim(tableData[19]));
//            $("#buy_to_store").val($.trim(tableData[20]));
//            $("#sell_to_store").val($.trim(tableData[21]));
//            $("#salestax").val($.trim(tableData[22]));
//            $("#curavgprice").val($.trim(tableData[23]));
//            $("#buffer_stock").val($.trim(tableData[24]));
//            if($.trim(tableData[25])==0){//active status
//                    $("#q_cable").bootstrapSwitch("disabled", false);
//                    $("#q_cable").bootstrapSwitch('state', false, true);
//                    $("#q_cable").bootstrapSwitch("disabled", true);
//                }
//             else{
//                    $("#q_cable").bootstrapSwitch("disabled", false);
//                    $("#q_cable").bootstrapSwitch('state', true, false);
//                    $("#q_cable").bootstrapSwitch("disabled", true);
//                }
//            var id=1;
//            var n=26;
//    		doAjax(); 
//			function doAjax() 
//			{
//			    if(n<=84){
//			        setTimeout(function(){
//			        var thisObj = $.trim(tableData[n]);
//			        if(thisObj >0){	
//			        var json = {};
//			        var iat_code = thisObj;
//			        var itemcode =$.trim(tableData[0]);
//			        var istbs_code ="istbs_code_"+id;
//			        $( "#istbs_code_"+id ).empty();
//			        $.ajax({
//			            url: "Inventory_Products/get_product_attributes1",
//			            type: "POST",
//			            data: {'iat_code':iat_code,'itemcode':itemcode, 'istbs_code':istbs_code, 'cid':id},
//			            dataType: "html",
//			            success : function(response){
//			                //$( "#istbs_code_"+id ).html(response);
//			                $("#iat_code_"+id).val($.trim(tableData[n]));
//			                $( "#istbs_code_"+id ).append(response);
//			                n+=2;
//			                id=id+1;
//			            }
//
//
//			        });  
//			     }//if 
//			     else{
//			     	$("#iat_code_"+id).val(0);
//			     	$( "#istbs_code_"+id ).html("<option value='0'>Select Option</option>");
//			     	n+=2;
//			     	id=id+1;
//			     }
//			     
//			     doAjax();},100); 
//
//			}  
//			} 
//			$("#discount").val($.trim(tableData[86]));
//			if($.trim(tableData[87])!=''){
//				$("#img-upload").show();
//				$("#img-upload").attr('src', '../public_html/upload/'+$.trim(tableData[87])+'.jpg');
//				$("#item-image-name").val($.trim(tableData[87]));
//			}
//			else{
//				$(".close").hide();
//				$("#item-image-name").val("");
//				$("#img-upload").hide();}
//			if($.trim(tableData[88])==1){
//
//            $('#general1')[0].click();
//            $(".sttabs li").hide();
//			$(".tab-current").show();
//			}
//			else{
//				$(".sttabs li").show();
//				}
//});

function closeimage() {
	var image = $("#item-image-name").val();
	if (image != '') {
		$(".close").show();
	} else {
		$(".close").hide();
	}
}

function ProductAditValues(data) {
	$(".SubmitProducts input").prop("disabled", true);
	$(".SubmitProducts textarea").prop("disabled", true);
	$(".SubmitProducts select").prop("disabled", true);
	//	$(".SubmitProducts input").bootstrapSwitch("disabled", true);

}
$(".gennextP").prop("disabled", true);
$(".SubmitProducts input").prop("disabled", true);
$(".SubmitProducts textarea").prop("disabled", true);
$(".SubmitProducts select").prop("disabled", true);
$(".ForEditProduct").prop("disabled", true);
$(".ForClipBoardProducts").hide();

$(".close").hide();
$('.ForSubmitProduct').prop('disabled', true);

$(".ForEditProduct").click(function() {
	var tabRow = $("#item-code").val();
	var des = $("#description").val();

	if (tabRow != "") {
		$(".SubmitProducts input").prop("disabled", false);
		$(".SubmitProducts textarea").prop("disabled", false);
		$(".SubmitProducts select").prop("disabled", false);
		$(".dreamdis").bootstrapSwitch("disabled", false);
		$("#item-code").prop("disabled", true);
		$(".gennextP").prop("disabled", true);
		$(".ForAddNewProduct").prop("disabled", true);
		$(".ForClipBoardProducts").hide();
		$('.ForSubmitProduct').prop('disabled', false);
		closeimage();
		ProFlage = true;
	}
});
//Copy For ClipBoard Products
$(".ForClipBoardProducts").click(function() {
	pcode = $("#item-code").val();
	$(".SubmitProducts input").prop("disabled", false);
	$(".SubmitProducts textarea").prop("disabled", false);
	$(".SubmitProducts select").prop("disabled", false);
	$(".dreamdis").bootstrapSwitch("disabled", false);
	$(".gennextP").prop("disabled", true);
	$(".ForAddNewProduct").prop("disabled", true);
	$('.ForSubmitProduct').prop('disabled', false);
	closeimage();
	AddProFlag = true;
	ProFlage = false;
	var json = {};
	var request = $.ajax({
		url : BASEURL + "Template/gennext",
		type : "POST",
		data : {
			'itemcode' : pcode,
			'tbl_name' : 'si_items',
			'column_name' : 'itm_itemcode',
			'lvl_column' : 'itm_level',
			'maskcode' : '0000000100'
		},
		dataType : "json",
		success : function(response) {

			$("#item-code").val(response);
		}
	});
	$(".ForClipBoardProducts").hide();
});

$(".ForAddNewProduct").click(function() {
	$(".SubmitProducts").trigger("reset");
	$(".SubmitProducts input").prop("disabled", false);
	$(".SubmitProducts textarea").prop("disabled", false);
	$(".SubmitProducts select").prop("disabled", false);
	$(".dreamdis").bootstrapSwitch("disabled", false);
	$(".ForEditProduct").prop("disabled", true);
	$(".ForClipBoardProducts").hide();
	$('.ForSubmitProduct').prop('disabled', false);
	$("#img-upload").hide();
	$(".close").hide();
	AddProFlag = true;
});

$(".ForResetProduct").click(function() {
	$("tr").removeClass('highlighted');
	$(".SubmitProducts").trigger("reset");
	$(".SubmitProducts input").prop("disabled", true);
	$(".SubmitProducts textarea").prop("disabled", true);
	$(".SubmitProducts select").prop("disabled", true);
	$(".dreamdis").bootstrapSwitch("disabled", true);
	$(".ForAddNewProduct").prop("disabled", false);
	$(".ForEditProduct").prop("disabled", true);
	$('.ForSubmitProduct').prop('disabled', true);
	$(".ForClipBoardProducts").hide();
	$(".populatedOptions").html('<option value="0">Select Option</option>');
	$("#img-upload").hide();
	$(".close").hide();
	ProFlage = false;
	AddProFlag = false;
});


$(".BGintity").change(function(){
	  $.ajax({
       url: BASEURL+"Inventory_LegalEntity/listFatch",
       type: "POST",
       data: {'code':this.value,'tbl_name':'bg'},
       dataType: "html",
       success : function(response){               
         $(".intityOp").html(response);
       }
   });	
});
$(".intityOp").change(function(){
	$('.subicode').empty();
	  $.ajax({
         url: BASEURL+"Inventory_LegalEntity/listFatch",
         type: "POST",
         data: {'code':this.value,'tbl_name':'in'},
         dataType: "html",
         success : function(response){               
           $(".opcode,.ou_code").html(response);
         }
     });	
});

$(".opcode").change(function(){
	 $.ajax({
        url: BASEURL+"Inventory_LegalEntity/listFatch",
        type: "POST",
        data: {'code':this.value,'tbl_name':'op'},
        dataType: "html",
        success : function(response){    
//        	console.log(response);
          $(".loccode").html(response);
        }
    });	
});


$(".ou_code").change(function(){
	 $.ajax({
        url: BASEURL+"Inventory_LegalEntity/listFatch",
        type: "POST",
        data: {'code':this.value,'tbl_name':'sub'},
        dataType: "html",
        success : function(response){    
//        	console.log(response);
          $(".subicode").html(response);
        }
    });	
});

function openPrintWindow(url, name, specs) {
	  var printWindow = window.open(url, name, specs);
	    var printAndClose = function() {
	        if (printWindow.document.readyState == 'complete') {
	            clearInterval(sched);
// 	            printWindow.print();
//	            printWindow.close();
	        }
	    }
	    var sched = setInterval(printAndClose, 200);
	};
function nextLetter(s){
    return s.replace(/([a-zA-Z])[^a-zA-Z]*$/, function(a){
        var c= a.charCodeAt(0);
        switch(c){
            case 90: return 'A';
            case 122: return 'a';
            default: return String.fromCharCode(++c);
        }
    });
}
function chkcode(){
  var mcode = $("#maskjsCost").val();
  var actcode = $("#cost-code").val();
  var rcode = actcode.replace(/-/g,'');
  var rcode = rcode.replace(/_/g,'').length;
  mcoden = arrSum(mcode);
  if(rcode == mcoden || rcode == (mcoden-1)){
    $("#detail").prop('checked', true);
    $("#group").prop('checked', false);
    $("#detail").prop('disabled', false); 
    $("#group").prop('disabled', true); 

    catype = 0;
    
  }else{  
    $("#group").prop('checked', true);
    $("#detail").prop('checked', false);
    $("#detail").prop('disabled', true); 
    $("#group").prop('disabled', false); 
    catype = 1;
  }
}
function CallRecords(id,doc) {
	var request = $.ajax({
		url : BASEURL + "Template/Models_popup",
		type : "POST",
		data : {
			'code' : id,
			'doc' : doc
		},
		dataType : "html",
		success : function(response) {
			$(".coldtl").html(response);
			$("#Return-Pos").modal();
		}
	});

}
function CallReturnRecords(id,doc) {
	var request = $.ajax({
		url : BASEURL + "Template/Models_popup",
		type : "POST",
		data : {
			'code' : id,
			'doc' : doc,
			'return' : true
		},
		dataType : "html",
		success : function(response) {
			$(".coldtl").html(response);
			$("#Return-Pos").modal();
		}
	});
}
//function move() {
//	  var elem = document.getElementById("myBar");   
//	  var width = 10;
//	  var id = setInterval(frame, 10);
//	  function frame() {
//	    if (width >= 100) {
//	      clearInterval(id);
//	    } else {
//	      width++; 
//	      elem.style.width = width + '%'; 
//	      elem.innerHTML = width * 1  + '%';
//	    }
//	  }
//	}

/* clone of tr each input */
// var cloned = $('table tr:last').clone(true);
// $('.analysistab tr:last').find(':input').each(function() {
// });
// $('.analysistab > tbody').append(cloned);
