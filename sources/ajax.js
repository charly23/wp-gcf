jQuery ( function() 
    {
        var $params  = jQuery;
        var $scripts = ajax_script.ajax_url;
        var $debugs  = '#wp-gcf__wrap .ajaxs-results';

        var $fields_results = $params( '.add_new-left_inner_wrap' );

        var $fields_handler = '.add_new-left_inner_wrap .add_new-left_inner_get_standard_option';
        var $loader_gif     = '.add_new-right_inner_publish_option .publish-title';
        var $confirmation_gif = '.confirmation-right_inner_publish_option .publish-title';
        var $notification_gif = '.notification-right_inner_publish_option .publish-title';
        var $smtp_gif = '.smtp_inner_publish_option .publish-title';

        var $field_standard_title = {'text':'Single Text','textarea':'Textarea','select-box':'Select Box','radio':'Radio Box','checkbox':'Checkbox','number':'Number','html':'HTML','hidden':'Hidden' };
        var $field_advanced_title = { 'name':'Name','date':'Date','time':'Time','phone':'Phone','address':'Address','website':'Website','email':'Email','file-upload':'File Upload' };

        /**
          * wp ajaxs (error) custom function
          * actions scripting
          * events handler
        **/
        
        function ajax_results_classes ( $this, $flts )
        {
            if( $flts == 'before' ){
               $params( $this ).addClass( 'before--ajax' );
            } else if ( $flts == 'error' ){
               $params( $this ).removeClass( 'before--ajax' );
               $params( $this ).addClass( 'error--ajax' );  
            } else if ( $flts == 'success' ){
               $params( $this ).removeClass( 'before--ajax' );
               $params( $this ).addClass( 'success--ajax' );   
            } else if ( $flts == 'done' ) {
               $params( $this ).removeClass( 'before--ajax' );
               $params( $this ).removeClass( 'success--ajax' );
               $params( $this ).addClass( 'done--ajax' );  
            }      
        }
        
        /**
          * wp ajaxs custom function
          * actions scripting
          * events handler
        **/
          
        function ajax_actions ( actions, vals, sets, load )
        {
              var $scripts = ajax_script.ajax_url;
              var $values  = vals;
              var $setups  = sets;  
              var $loads   = load;
    
              $params.ajax ( 
              {
                      data: 
                      { 
                         action : actions, 
                         value  : $values,
                      },
                      type   : 'POST',
                      url    : $scripts,
                      beforeSend : function() { 
                           $params( $loads ).addClass( 'ajaxs-true' );
                      },
                      error : function( xhr, status, err ) {
                           // Handle errors
                      },
                      success : function( html, data ) {
                           $params( $setups ).html( html );
                           $params( $loads ).removeClass( 'ajaxs-true' );
                      }
              } ) . done ( function( html, data ) {
                      $params( $loads ).removeClass( 'ajaxs-true' );
                  }
              );       
        }

        function ajax_actions_filters ( actions, vals, sets, load )
        {
              var $scripts = ajax_script.ajax_url;
              var $values  = vals;
              var $setups  = sets;  
              var $loads   = load;
    
              $params.ajax ( 
              {
                      data: 
                      { 
                         action : actions, 
                         value  : $values,
                      },
                      type   : 'POST',
                      url    : $scripts,
                      beforeSend : function() { 
                           $params( $loads ).addClass( 'ajaxs-true' );
                      },
                      error : function( xhr, status, err ) {
                           // Handle errors
                      },
                      success : function( html, data ) {
                           $params( $setups ).html( html );
                           $params( $loads ).removeClass( 'ajaxs-true' );
                      }
              } ) . done ( function( html, data ) {
                      $params( $loads ).removeClass( 'ajaxs-true' );
                  }
              );       
        }

        /**
          * wp ajaxs custom function
          * actions scripting
          * action sort validate data enabled handler
          * add new (sidebar) functionalities
        **/

        var $form_validate = ajax_script.form_validate;

        var fixHelper = function( e, ui )  {
             ui.children().each( function () {
                    $params(this).width( $params(this).width() );
                }
             );
             return ui;
        };

        function ajax_actions_get_fields ( actions, vals, sets, load )
        {
              var $scripts = ajax_script.ajax_url;
              var $values  = vals;
              var $setups  = sets;  
              var $loads   = load;
      
              $params.ajax ( 
              {
                      data: 
                      { 
                         action : actions, 
                         value  : $values,
                      },
                      type   : 'POST',
                      url    : $scripts,
                      beforeSend : function() { 
                           $params( $loads ).addClass( 'ajaxs-true' );
                      },
                      error : function( xhr, status, err ) {
                           // Handle errors
                      },
                      success : function( html, data ) {
                           $params( $setups ).append( html );
                           $params( $loads ).removeClass( 'ajaxs-true' );
                      }
              } ) . done ( function( html, data ) {
                      $params( $loads ).removeClass( 'ajaxs-true' );
                  } 
              );       
        }

        function ajax_actions_get_fields_default ( actions, vals, sets, load )
        {
              var $scripts = ajax_script.ajax_url;
              var $values  = vals;
              var $setups  = sets;  
              var $loads   = load;
      
              $params.ajax ( 
              {
                      data: 
                      { 
                         action : actions, 
                         value  : $values,
                      },
                      type   : 'POST',
                      url    : $scripts,
                      beforeSend : function() { 
                           $params( $loads ).addClass( 'ajaxs-true' );
                      },
                      error : function( xhr, status, err ) {
                           // Handle errors
                      },
                      success : function( html, data ) {
                           $params( $setups ).html( html );
                           $params( $loads ).removeClass( 'ajaxs-true' );
                      }
              } ) . done ( function( html, data ) {
                      $params( $loads ).removeClass( 'ajaxs-true' );
                  } 
              );       
        }

        /**
         * field : manager section
         * insert form handlers
         * START
        **/

        function get_field_data_value () 
        {
            var $idvl = $params('.wp_gcf_inner-top .form-id-value').val();
            var $name = $params('.wp_gcf_inner-top .form-name-value').val();
            var $exct = $params('.wp_gcf_inner-bottom .add-field-item .add-field-excerpt').val();
            var $desc = $params('.wp_gcf_inner-bottom .add-field-item .add-field-desc').val();
            var $brow = $params('.wp_gcf_inner-bottom .add-field-item .field-item-browse .browse-input').val();

            return { 'id':$idvl, 'name':$name, 'excerpt':$exct, 'content':$desc, 'browse':$brow };
        }

        function get_field_data_settings () 
        {
            $item = $params( '.add_new-setting_inner_wrap .add_new-setting_item' );

            var $texts = $item.find( '.setting_button-text' ).val();
            var $class = $item.find( '.setting_class-name' ).val();

            if( $item.find( '.setting_entry-limit' ).is(':checked') == true ) {
              var $limit = 1;
            } else {
              var $limit = 0;
            }

            if( $item.find( '.setting_logged-in' ).is(':checked') == true ) {
              var $login = 1;
            } else {
              var $login = 0;
            }

            return { 'button_text':$texts, 'class_name':$class, 'entry_limit':$limit, 'logged-in':$login };
        }

        function get_status_field_filter () 
        {
            var $sts = $params('.publish-status_pad .field-status-value').val();

            return $sts;
        }

        function get_date_field_filter () 
        {
            var $dtm = $params('.publish-date_pad .field-date-month').val();
            var $dtd = $params('.publish-date_pad .field-date-day').val();
            var $dty = $params('.publish-date_pad .field-date-year').val();
            var $frt = $params('.publish-date_pad .field-date-format').val();

            return { 'value':$dtm+'-'+$dtd+'-'+$dty, 'format':$frt };
        }

        function get_data_advanced_filter ( $input=null, $ids=null ) 
        {
            var $data = null;

            if( $ids == 11 ) {
                var $lname = $params($input).find( '.field-pad_item input.field-name-placeholder1' ).val();
                var $fname = $params($input).find( '.field-pad_item input.field-name-placeholder2' ).val();
                var $mname = $params($input).find( '.field-pad_item input.field-name-placeholder3' ).val();
                var $data = { 'lastname':$lname, 'firstname':$fname, 'middlename':$mname };
            } else if ( $ids == 12 ) {
                var $format = $params($input).find( '.field-pad_item select.field-date-format_select' ).val();
                var $custom = $params($input).find( '.field-pad_item input.field-date-format_custom' ).val();
                var $data = { 'format':$format, 'custom':$custom };
            } else if ( $ids == 13 ) {
                var $format = $params($input).find( '.field-pad_item select.field-time-format_select' ).val();
                var $custom = $params($input).find( '.field-pad_item input.field-time-format_custom' ).val();
                var $data = { 'format':$format, 'custom':$custom };
            } else if ( $ids == 14 ) {
                var $format = $params($input).find( '.field-pad_item select.field-phone-format_select' ).val();
                var $custom = $params($input).find( '.field-pad_item input.field-phone-format_custom' ).val();
                var $data = { 'format':$format, 'custom':$custom };
            } else if ( $ids == 15 ) {
                var $format = $params($input).find( '.field-pad_item select.field-address-format_select' ).val();
                var $data = { 'format':$format };
            } else if ( $ids == 16 ) {  
                var $block = $params($input).find( '.field-pad_item input.field-website-input' ).val();
                var $data = { 'block_domain':$block };
            } else if ( $ids == 17 ) {
                var $block = $params($input).find( '.field-pad_item input.field-email-input' ).val();
                var $data = { 'block_domain':$block };
            } else if ( $ids == 18 ) {
                var $type = $params($input).find( '.field-pad_item input.field-file-upload' ).val();
                var $data = { 'type':$type };
            }

            return $data;
        }

        function get_box_field_filter ( $input=null, $ids=null, $counts=null) 
        {
            var $nms = $params($input).find('.field-pad_item input.field-name-box').val();
            
            if ( $params($input).find('.field-pad_item input.field-required-box').is(':checked') ) {
                var $rqd = $params($input).find('.field-pad_item input.field-required-box').val();
            } else {
                var $rqd = 0;
            }

            var $dsc = $params($input).find('.field-pad_item textarea.field-description-box').val();

            if( $ids == 11 ) {
              
            } else if ( $ids == 12 ) {
              var $plh = $params($input).find('.field-pad_item input.field-placeholder-box').val();
            } else {
              var $plh = $params($input).find('.field-pad_item input.field-placeholder-box').val();
            }

            var $max = $params($input).find('.field-pad_item input.field-max-box').val();

            var $cls = $params($input).find('.field-pad_item input.field-class-box').val();

            if( $ids == 3 ) {

                var $vals = [];
                var $txts = [];
                var $fields = [];

                $params($input).find( '.select-box_pad-item' ).each(function(i)
                    { 
                        $vals[i] = $params(this).find('input.select-item-value').val();
                        $txts[i] = $params(this).find('input.select-item-text').val();

                        $fields[i] = { 'value':$vals, 'text':$txts };
                    }
                );
            }

            if( $ids == 4 ) {

                var $vals = [];
                var $lbls = [];
                var $fields = [];

                $params($input).find( '.radiobox_pad-item' ).each(function(i)
                    { 
                        $vals[i] = $params(this).find('input.radiobox-item-value').val();
                        $lbls[i] = $params(this).find('input.radiobox-item-label').val();

                        $fields[i] = { 'value':$vals, 'label':$lbls };
                    }
                );
            }

            if( $ids == 5 ) {

                var $vals = [];
                var $lbls = [];
                var $fields = [];

                $params($input).find( '.checkbox_pad-item' ).each(function(i)
                    { 
                        $vals[i] = $params(this).find('input.checkbox-item-value').val();
                        $lbls[i] = $params(this).find('input.checkbox-item-label').val();

                        $fields[i] = { 'value':$vals, 'label':$lbls };
                    }
                );
            }

            if( $ids == 7 ) 
            {
                $vals = $params($input).find('.field-html-box').val();
                $fields = { 'value':$vals, 'text':0 };
            }

            var $advanced = get_data_advanced_filter( $input, $ids );

            if ( $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-top').is(':checked') ) {
                var $field_position = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-top').val();
            } else {
                if ( $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-bottom').is(':checked') ) {
                  var $field_position = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-bottom').val();
                } else {
                  var $field_position = 0;
                }
            }

            var $field_id = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-id-value').val();
            var $error_message = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-error').val();
            var $error_class = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-class').val();

            if ( $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-error-top').is(':checked') ) {
                var $error_position = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-error-top').val();
            } else {
                if ( $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-error-bottom').is(':checked') ) {
                  var $error_position = $params($input).find('.field-box-setting_bottom .field-box-setting_item input.field-display-error-bottom').val();
                } else {
                  var $error_position = 0;
                }
            }

            $settings = { 'field_position':$field_position,'field_id':$field_id,'error_message':$error_message,'error_class':$error_class,'error_position':$error_position };

            return {'id':$ids,'name':$nms,'required':$rqd,'description':$dsc,'placeholder':$plh,'max':$max,'class':$cls,'field_count':$counts,'datas':$fields,'advanced':$advanced, 'setting':$settings };
        }

        /**
         * field : manager section
         * insert form handlers
         * END
        **/

        $params( '.add_new-right_inner_standard_option' ).sortable ( 
            {
                 items: 'a.button',
                 helper: fixHelper,
                 appendTo: document.body,
                 revert: 100,
                 placeholder: 'ui-state-highlight',
                 // connectWith: ".add_new-left_inner_get_standard_option",
                 stop: function( event, ui ) {

                    var $vals = $params(this).attr( 'href' );
                    var $data = { 'id':$vals, 'field':$form_validate };

                    ajax_actions_get_fields_default( 'ajaxs_get_fields_standard_defaults', $data, '.add_new-right_inner_standard_option.ui-sortable', $loader_gif );
                 } 
            }
        );

        $params( '.add_new-left_inner_get_standard_option' ).sortable ( 
            {
                 items: '.add_new-left_inner_get_standard_fields',
                 helper: fixHelper,
                 appendTo: document.body,
                 revert: 100,
                 placeholder: 'ui-state-highlight',
                 stop: function( event, ui ) {

                    var $field_i = 0;

                    var $values = get_field_data_value();
                    var $setting = get_field_data_settings();
                    var $status = get_status_field_filter();
                    var $datevl = get_date_field_filter();

                    var $id = []; 
                    $params( '.wp-gcf__add_new_wrap .get_standard-form input.hidden-field-id' ).each(function(i)
                        {
                            $id[i] = $params(this).val();
                        }
                    );

                    var $field = []; 
                    $params( '.wp-gcf__add_new_wrap .get_standard-form' ).each(function(i)
                        {
                            var $ids = $params(this).find('input.hidden-field-id').val();
                            $field[i] = get_box_field_filter(this, $ids, $field_i++ ); 
                        }
                    );

                    var $data = { 'values':$values, 'setting':$setting, 'status':$status, 'date':$datevl, 'id_position':$id, 'field':$field };

                    ajax_actions_filters( 'ajaxs_insert_fields_form', $data, '', $loader_gif );
                 } 
            }
        );

        

        $params( '.add_new-right_inner_standard_option' ).on( 'click', 'a.button', function (e) 
            {
                var $vals = $params(this).attr( 'href' );
                var $data = { 'id':$vals, 'field':$form_validate };

                ajax_actions_get_fields( 'ajaxs_get_fields', $data, $fields_handler, $loader_gif );

                return false;
            }
        );

        $params( '.add_new-right_inner_advanced_option' ).on( 'click', 'a.button', function (e) 
            {
                var $vals = $params(this).attr( 'href' );
                var $data = { 'id':$vals, 'field':$form_validate };

                ajax_actions_get_fields( 'ajaxs_get_advanced_fields', $data, $fields_handler, $loader_gif );

                return false;
            }
        );

        /**
          * wp ajaxs custom function
          * actions scripting
          * action sort validate data enabled handler
          * add new (sidebar) functionalities
          * - END
        **/
        
        /**
          * INSERT FIELDS
          * ajax insert action function
          * action update included data handler
          * insert/update functionalities event
        **/

        function get_box_titled_filter ($ids) 
        {
            if( $ids == 1 ) {
              return $field_standard_title['text'];
            } else if ( $ids == 2 ) {
              return $field_standard_title['textarea'];
            } else if ( $ids == 3 ) {
              return $field_standard_title['select-box'];
            } else if ( $ids == 4 ) {
              return $field_standard_title['radio'];
            } else if ( $ids == 5 ) {
              return $field_standard_title['checkbox'];
            } else if ( $ids == 6 ) {
              return $field_standard_title['number'];
            } else if ( $ids == 7 ) {
              return $field_standard_title['html'];
            } else if ( $ids == 8 ) {
              return $field_standard_title['hidden'];
            } else if ( $ids == 11 ) {
              return $field_advanced_title['name'];
            } else if ( $ids == 12 ) {
              return $field_advanced_title['date'];
            } else if ( $ids == 13 ) {
              return $field_advanced_title['time'];
            } else if ( $ids == 14 ) {
              return $field_advanced_title['phone'];
            } else if ( $ids == 15 ) {
              return $field_advanced_title['address'];
            } else if ( $ids == 16 ) {
              return $field_advanced_title['website'];
            } else if ( $ids == 17 ) {
              return $field_advanced_title['email'];
            } else if ( $ids == 18 ) {
              return $field_advanced_title['file-upload'];
            }
        }

        $params ( '.add_new-left_inner_get_standard_option' ).on( 'keyup', 'input.field-name-box', function() 
            {
                var $val = $params(this).val();
                var $ids = $params(this).parents('.add_new-left_inner_get_standard_fields').find('input.hidden-field-id').val();
                var $span = '<span class="field-drop_box active-box"></span>';

                var $titled = get_box_titled_filter( $ids );

                $params(this).parents( '.add_new-left_inner_get_standard_fields' ).find( '.field-box-title .get_standard-inner_left' ).html( $span+$titled+' : '+ $val );
            }
        );

        var $redirect = ajax_script.redirect;

        $params ( '.add_new-right_inner_publish_option' ).on( 'click', 'a.submit_insert_field-form.button', function()
            {
                var $field_i = 0;
                var $idvl = $params('.wp_gcf_inner-top .form-id-value').val();

                var $values = get_field_data_value();
                var $setting = get_field_data_settings();
                var $status = get_status_field_filter();
                var $datevl = get_date_field_filter();

                var $id = []; 
                $params( '.wp-gcf__add_ne w_wrap .get_standard-form input.hidden-field-id' ).each(function(i)
                    {
                        $id[i] = $params(this).val();
                    }
                );

                var $field = [];
                $params( '.wp-gcf__add_new_wrap .get_standard-form' ).each(function(i)
                    {
                        var $ids = $params(this).find('input.hidden-field-id').val();
                        $field[i] = get_box_field_filter(this, $ids, $field_i++ ); 
                    }
                );

                var $data = { 'values':$values, 'setting':$setting, 'status':$status, 'date':$datevl, 'id_position':$id, 'field':$field };

                ajax_actions_filters( 'ajaxs_insert_fields_form', $data, $debugs, $loader_gif );

                if( $idvl == 0 ) {
                    window.location = $redirect;
                }

                return false;
            } 
        );

        // Quick Edit : Ajax Handler

        $params ( '.manager-quick-item.item-submit' ).on( 'click', '.manager-quick-submit', function ()
            {
                var $ids = $params(this).parents( '.manager-option-tr' ).find( 'input.option-checkbox' ).val();
                var $name = $params(this).parents( '.manager-quick-edit_wrap' ).find( '.manager-quick-name' ).val();
                var $content = $params(this).parents( '.manager-quick-edit_wrap' ).find( '.manager-content-input' ).val();
                var $excerpt = $params(this).parents( '.manager-quick-edit_wrap' ).find( '.manager-quick-excerpt' ).val();
                var $status = $params(this).parents( '.manager-quick-edit_wrap' ).find( '.manager-quick-status' ).val();

                var $data = { 'id':$ids, 'name':$name, 'content':$content, 'excerpt':$excerpt, 'status':$status };

                ajax_actions_filters( 'ajaxs_quick_fields', $data, $debugs, '' );
            }
        );

        // Confirmation : Ajax Handler

        $params ( '.confirmation-right_inner_publish_option' ).on( 'click', 'a.submit_insert_confirmation-form.button', function()
            {
                var $values = get_field_data_value();
                var $page = $params( '.confirmation-left_page-item' ).find( '.confirmation-active-page' ).val();

                if( $params( '.confirmation-left_page-item' ).find( '.confirmation-active-page' ).is(':checked') ) {
                    var $active = $params( '.confirmation-left_page-item' ).find( '.confirmation-active-page' ).val();
                } else {
                    if( $params( '.confirmation-left_message-item' ).find( '.confirmation-active-message' ).is(':checked') ) {
                      var $active = $params( '.confirmation-left_message-item' ).find( '.confirmation-active-message' ).val();
                    } else {
                      var $active = 0;
                    }
                }

                var $page = $params( '.confirmation-left_page-item' ).find( '.confirmation-page-value' ).val();
                var $page_message = $params( '.confirmation-left_page-item' ).find( '.confirmation-page-message' ).val();
                var $message_value = $params( '.confirmation-left_message-item' ).find( '.confirmation-message-value' ).val();

                var $confirm = { 'active':$active, 'page':$page, 'page_message':$page_message, 'message_value':$message_value };
                var $data = { 'values':$values, 'confirmation':$confirm };

                ajax_actions_filters( 'ajaxs_insert_confirmation_form', $data, '', $confirmation_gif );
            }
        );

        // Notification : Ajax Handler

        $params ( '.notification-right_inner_publish_option' ).on( 'click', 'a.submit_insert_notification-form.button', function()
            {
                var $values = get_field_data_value();
                var $name = $params( '.notification-left_inputs' ).find( '.notification-name-value' ).val();

                var $to = [];
                $params( '.notification-left_item input.notification-to-value' ).each( function(i)
                    {
                        $to[i] = $params(this).val();
                    }
                ); 

                var $cc = [];
                $params( '.notification-left_item input.notification-cc-value' ).each( function(i)
                    {
                        $cc[i] = $params(this).val();
                    }
                );

                var $bcc = [];
                $params( '.notification-left_item input.notification-bcc-value' ).each( function(i)
                    {
                        $bcc[i] = $params(this).val();
                    }
                );

                var $subject = $params( '.notification-left_inputs' ).find( '.notification-subject-value' ).val();
                var $message = $params( '#wp-notification-message-value-wrap' ).find( '#notification-message-value' ).val();
 
                var $notification = { 'name':$name, 'to':$to, 'cc':$cc, 'bcc':$bcc, 'subject':$subject, 'message':$message };
                var $data = { 'values':$values, 'notification':$notification };

                ajax_actions_filters( 'ajaxs_insert_notification_form', $data, '', $notification_gif );

                return false;
            } 
        );

        $params ( '.notification-right_inner_email_option' ).on( 'click', 'a.submit_insert_notification-form.button', function() 
            {

                var $idvl = $params('.wp_gcf_inner-top .form-id-value').val();

                var $vals = [];
                $params( '.notification-email-value.selected-email' ).each( function(i)
                    {
                        $vals[i] = $params(this).find( 'input.email-value' ).val();
                    }
                ); 

                var $emails = { 'form_id':$idvl, 'emails':$vals };

                ajax_actions_filters( 'ajaxs_submit_notification_email', $emails, $debugs, $notification_gif );
            } 
        );

        // ENTRIES : Ajax Handler

        $params( '.entries_header .entries-header_menu, .entries_header .entries-header_menu' ).on( 'click', '.entries-header_menu-item, .entries-header_menu-item', function()
            {
                var $idvl = $params('.wp_gcf_inner-top .form-id-value').val();
                var $slug = $params(this).find( 'input.menu-item-slug_id' ).val();
                var $value= [];

                if( $params( '.entries-items_fields.items-data' ).find( '.entries-items_fields-data.field-item-'+$slug ).is( ':visible' ) == true ) {
                    $params( '.entries-items_fields.items-data' ).find( '.entries-items_fields-data.field-item-'+$slug ).hide();
                } else {
                    $params( '.entries-items_fields.items-data' ).find( '.entries-items_fields-data.field-item-'+$slug ).show();
                }

                $params('.entries-header_menu-item, .entries-header_menu-item').each(function(i)
                    {
                        var $classes = $params(this).attr( 'class' ).split( ' ' );
                        var $field = $params(this).find( 'input.menu-item-slug_id' ).val();
                        if( $classes[2] == 'active-entries-fields' ) {
                            $value[i] = { 'name':$field };
                            $params( 'div.entries-items_fields.items-data .entries-item-validate' ).hide();
                        }
                    }
                );

                var $val_length = $value.length;

                if( $val_length == 0 ) {
                    $params( 'div.entries-items_fields.items-data .entries-item-validate' ).show();
                }
                
                var $data = { 'form_id':$idvl, 'fields':$value };

                ajax_actions_filters( 'ajaxs_entries_setting_form', $data, $debugs, '' );
            }
        );

        $params( '.entries_header .entries-header_inner' ).on ( 'click', 'a.entries-delete_btn', function()
            {
                var $checked = [];
                
                $params( 'input.entries-item__selected' ).each( function(i)
                    {
                        var $ids = $params(this).val();

                        if( $params(this).is( ':checked' ) == true ) {
                            $checked[i] = $ids;
                            $params( '.entries_body-items.entries-item-' + $ids ).remove();
                        } else {
                            $checked[i] = 0;
                        }
                    }
                );

                ajax_actions_filters( 'ajaxs_entries_delete_data', $checked, $debugs, '' );
            }
        );

        // SMTP : Ajax Handler

        function smtp_fields () 
        {
            var $host = $params( '.smtp-body-wrap .smtp-host-value' ).val();

            if ( $params( '.smtp-body-wrap .smtp-auth-value' ).is(':checked') ) {
              var  $auth = 2;
            } else {
              var  $auth = 1;
            }

            var $port = $params( '.smtp-body-wrap .smtp-port-value' ).val();

            var $user = $params( '.smtp-body-wrap .smtp-username-value' ).val();
            var $pass = $params( '.smtp-body-wrap .smtp-password-value' ).val();

            if( $params( '.smtp-body-wrap .smtp-secure-ssl' ).is(':checked') ) {
                var $secure = 1;
            } else {
                var $secure = 2;
            }

            var $from = $params( '.smtp-body-wrap .smtp-from-value' ).val();
            var $from_name = $params( '.smtp-body-wrap .smtp-from-name' ).val();

            return { 'wp-gcf-host':$host,'wp-gcf-smtp-auth':$auth,'wp-gcf-port':$port,'wp-gcf-user':$user,'wp-gcf-pass':$pass,'wp-gcf-smtp-secure':$secure,'wp-gcf-from':$from,'wp-gcf-from-name':$from_name };
        }

        $params( '.smtp_inner_publish_option' ).on( 'click', 'a.submit_insert_smtp-form.button', function()
            {
                var $data = smtp_fields();
                ajax_actions_filters( 'ajaxs_insert_smtp_form', $data, $debugs, $smtp_gif );
                return false;
            } 
        );

        $params( '.smtp_inner_publish_option' ).on( 'click', 'a.submit_send_smtp-test.button', function()
            {
                var $data = smtp_fields();
                ajax_actions_filters( 'ajaxs_smtp_action_send', $data, '.wp-gcf__smtp_wrap .wp_gcf_inner-top.wp_gcf_smtp_inner-top', $smtp_gif );
                return false;
            } 
        );

        // ACTION : Ajax Handler

        function option_action_setup ( $ids=null ) 
        {
            if( $ids == 0 ) {

                var $value = $params( '.manager_option_search.placeholder' ).val();

                var $actions = { 'action_id':$ids, 'action_setup':0, 'value':$value };
                var $outputs = '.wp-gcf__manager_wrap .wp_gcf_inner-center.wp_gcf_manager_inner-center';

            } else if ( $ids == 1 ) {

                var $del_id = [];
                $params( '.wp_gcf_manager_inner-center .manager-option-tr' ).each( function(i) 
                  {
                    if( $params(this).find( 'input.option-checkbox' ).is( ':checked' ) == true ) {
                        var $del_action_id = $params(this).find( 'input.option-checkbox' ).val();
                        $del_id[i] = $params(this).find( 'input.option-checkbox' ).val();
                        $params(this).parents('tbody#the-list').find('tr#post-'+$del_action_id ).hide();
                    } else {
                        $del_id[i] = 0;
                    }
                  }
                );

                var $actions = { 'action_id':$ids, 'action_setup':$del_id };
                var $outputs = $debugs;
            
            } else if ( $ids == 2 ) {

                var $move_id = [];
                $params( '.wp_gcf_manager_inner-center .manager-option-tr' ).each( function(i) 
                  {
                    if( $params(this).find( 'input.option-checkbox' ).is( ':checked' ) == true ) {
                        var $move_action_id = $params(this).find( 'input.option-checkbox' ).val();
                        $move_id[i] = $params(this).find( 'input.option-checkbox' ).val();
                        $params(this).parents('tbody#the-list').find('tr#post-'+$move_action_id ).hide();
                    } else {
                        $move_id[i] = 0;
                    }
                  }
                );

                var $actions = { 'action_id':$ids, 'action_setup':$move_id };
                var $outputs = $debugs;

            }

            ajax_actions_filters( 'ajaxs_option_action_setup', $actions, $outputs, '' );
        }

        $params ( '.manager-bottom-menu' ).on( 'click', '.manager_option_submit', function ()
            {
                var $options_id = $params(this).parents( '.manager-bottom-menu' ).find( '.manager_option_select' ).val();
                option_action_setup( $options_id );
            }
        );

        // OPTION : Ajax Handler

        $params( '.add_new-option_inner_left .add_new-option_content' ).on( 'click', 'a.apperance-btn', function()
          {
              var $idvl = $params('.wp_gcf_inner-top .form-id-value').val();

              if( $params(this).parents('.add_new-option_content').find( '.inner-item input.apperance-date' ).is( ':checked' ) == true ) {
                  var $date_option = 1;
              } else {
                  var $date_option = 0;
              }

              if( $date_option == 1 ) {
                  $params( '.add_new-right_inner_publish_option .publish-date_pad .field-date-format' ).show();
              } else {
                  $params( '.add_new-right_inner_publish_option .publish-date_pad .field-date-format' ).hide();
              }
              
              if( $params(this).parents('.add_new-option_content').find( '.inner-item input.apperance-advanced' ).is( ':checked' ) == true ) {
                  var $advanced_option = 1;
              } else {
                  var $advanced_option = 0;
              }

              if( $advanced_option == 1 ) {
                  $params( '.wp_gcf_add_new_inner-center .add_new-right_inner_wrap .add_new-right_inner_advanced_option' ).show();
              } else {
                  $params( '.wp_gcf_add_new_inner-center .add_new-right_inner_wrap .add_new-right_inner_advanced_option' ).hide();
              }

              if( $params(this).parents('.add_new-option_content').find( '.inner-item input.apperance-upload' ).is( ':checked' ) == true ) {
                  var $upload_option = 1;
              } else {
                  var $upload_option = 0;
              }

              if( $upload_option == 1 ) {
                  $params( '.wp_gcf_add_new_inner-bottom .add-field-pad .add-field-pad_right .add-field-item' ).show();
              } else {
                  $params( '.wp_gcf_add_new_inner-bottom .add-field-pad .add-field-pad_right .add-field-item' ).hide();
              }

              var $data = { 'form_id':$idvl, 'date_option':$date_option, 'advanced_option':$advanced_option, 'upload_option':$upload_option };

              ajax_actions_filters( 'ajaxs_add_new_option', $data, $debugs, $loader_gif );
          }
        );

        // END
    }
);