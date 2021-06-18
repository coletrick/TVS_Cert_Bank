



    jQuery("#bulk-add-form").submit( function(e) {
        
        if( parseInt(jQuery("#cert-add-start").val()) >= parseInt(jQuery("#cert-add-end").val()) ) {
            jQuery( "#add-error" ).text("Please input an ending number greater than the starting number!" ).show();
            e.preventDefault();
        } else {
        
            e.preventDefault(); 

            jQuery.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
                data : {action: "bulk_add_certs", starting_num : jQuery("#cert-add-start").val(), ending_num : jQuery("#cert-add-end").val(), school_name : jQuery("#school-name").val(), nonce : jQuery("#cert-nonce").val()},
                success: function(response) {
                    if (response.type === true) {
                        jQuery( "#add-error" ).hide();
                        jQuery( "#certs-added" ).text( "The certificate numbers " + response.starting_num + " through " + response.ending_num + " were successfully added to School (" + response.school_name + ")" ).show();
                        jQuery( "#certs-avail" ).text( "There are " + response.certs_avail + " certificate numbers available").show();
                    }
                    if (response.duplicate === true) { 
                        jQuery( "#certs-added" ).hide();
                        jQuery( "#certs-avail" ).hide();
                        jQuery( "#add-error" ).text( "You entered a duplicate number! (" + response.duplicate_num + ")" ).show();
                    }
                    if (response.type === false) {
                        jQuery( "#certs-added" ).hide();
                        jQuery( "#certs-avail" ).hide();
                        jQuery( "#add-error" ).text( "There was an error!" ).show();
                    }
                    if (response.nonce_failed === true) { 
                        jQuery( "#certs-added" ).hide();
                        jQuery( "#certs-avail" ).hide();
                        jQuery( "#add-error" ).text( "GET OUT!!" ).show();
                    }
                }
            })   
        }
    });


    jQuery("#remaining-certs-form").submit( function(e) {
        
        e.preventDefault(); 

        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : myAjax.ajaxurl,
            data : {action: "remaining_certs", school_name : jQuery("#remaining-certs-school-name").val(), nonce : jQuery("#remaining-nonce").val()},
            success: function(response) {
                
                if (response.nonce_failed === true) { 
                    jQuery( "#remaining-certs-error" ).text( "GET OUT!!" ).show();
                }
                
                jQuery( "#remaining-certs-error" ).hide(); 
                jQuery( "#remaining-certs" ).text( "There are " + response.remaining_certs + " in School (" + response.school_name + ")" ).show();
            }
        })   
    });



    jQuery("#cert-display-form").submit( function(e) {
        
            e.preventDefault(); 

            jQuery.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
                data : {action: "display_cert_nums", school_name : jQuery("#search-school-name").val(), assigned : jQuery("#assigned-unassigned").val(), nonce : jQuery("#display-nonce").val()},
                success: function(response) {

                    if (response.nonce_failed === true) { 
                        jQuery( "#add-error" ).text( "GET OUT!!" ).show();
                    }
                    jQuery( "#add-error" ).hide();
                    jQuery(".display-certs").remove();
                    jQuery("#cert-numbers tbody").append(response.certs_display);
                }
            })   
    });


    jQuery("#cert-search-form").submit( function(e) {
        
            e.preventDefault(); 

            jQuery.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
                data : {action: "cert_num_search", school_name : jQuery("#cert-search-school-name").val(), search_num : jQuery("#cert-search-num").val(), nonce : jQuery("#search-nonce").val()},
                success: function(response) {

                    jQuery( "#delete-success" ).hide();
                    jQuery( "#delete-error" ).hide();
                    jQuery(".delete-certs").remove();
                    
                    if (response.nonce_failed === true) {
                        jQuery( "#search-error" ).hide(); 
                        jQuery( "#delete-error" ).text( "GET OUT!!" ).show();
                    }
                    if (response.not_found === true ) {
                        jQuery( "#search-error" ).hide();
                        jQuery( "#search-error" ).text( "Certificate number " + response.cert_num + " from School (" + response.school_name + ") cannot be found!" ).show();
                    }
                    if (response.not_found === false ) {
                        jQuery( "#search-error" ).hide();
                        jQuery("#cert-searched-numbers tbody").append(response.searched_certs);
                    }
                }
            })   
    });


    jQuery("#cert-delete-form").submit( function(e) {
        
            e.preventDefault(); 

            jQuery.ajax({
                type : "post",
                dataType : "json",
                url : myAjax.ajaxurl,
                data : {action: "cert_num_delete", school_name : jQuery("#cert-delete-school").val(), cert_num : jQuery("#cert-delete-num").val(),  checkbox : jQuery("#cert-delete-checkbox").val(), nonce : jQuery("#delete-nonce").val()},
                success: function(response) {
                    
                    if (response.nonce_failed === true) { 
                        jQuery( "#delete-error" ).text( "GET OUT!!" ).show();
                    }
                    if (response.type === false) { 
                        jQuery( "#delete-success" ).hide();
                        jQuery( "#delete-error" ).text( "There was an error deleting certificate number " + response.cert_num + " from School (" + response.school_name + ")!" ).show();
                    }
                    if (response.type === true) {
                        jQuery( "#delete-error" ).hide(); 
                        jQuery( "#delete-success" ).text( "The certificate number " + response.cert_num + " was successfully deleted from School (" + response.school_name + ")" ).show();
                    }
                }
            })   
    });

         

        


    

