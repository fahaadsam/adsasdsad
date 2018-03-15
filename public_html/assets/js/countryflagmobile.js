	
//	var input_mobile_no = $("#mobile_no");
// var output = $("#output");

    var errorMsg = $("#error-msg");
    var validMsg = $("#valid-msg");
    
    function initiateFlagMobile(input_mobile_no) {
        // var appContext = "<?php echo base_url(); ?>";
        // alert(appContext);
    	input_mobile_no.intlTelInput({
    		excludeCountries: ["il"],
    		separateDialCode: true,
    		nationalMode: true,
    		utilsScript:  appContext + "public_html/assets/build/js/utils.js",
    		onlyCountries: ['pk' /* ,'us','af','ax','al','dz','id' */],
    		
    	});
    	
    	setFlagMoblieEvents(input_mobile_no);
    }

    function setFlagMoblieEvents(input_mobile_no) {
    	
    	input_mobile_no.on("countrychange", function(e, countryData) {
    		
    		$("#get_number").val($(this).intlTelInput("getNumber"));
    	   
        });
    	
    	// listen to "keyup", but also "change" to update when the user selects
		// a
    	// country
    	input_mobile_no.on("keyup change", function() {
    
    		$("#get_number").val($(this).intlTelInput("getNumber"));
            // alert('alert');
    	});
    	
    	// on blur: validate
    	input_mobile_no.on("keyup change", function() {
    		reset($(this));
    		if ($.trim($(this).val())) {
    			if ($(this).intlTelInput("isValidNumber")) {
    				validMsg.removeClass("hide");
    			} else {
    				$(this).addClass("error");
    				errorMsg.removeClass("hide");
    			}
    		}
    	});
    }
    
	function reset(input_mobile_no) 
	{ 
		input_mobile_no.removeClass("error");
		errorMsg.addClass("hide");
		validMsg.addClass("hide"); 
	}