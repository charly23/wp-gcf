jQuery ( function() 
    {
        var $params = jQuery;
        var $scripts = ajax_script.ajax_url;
        var $debug = '';
        var $loader_gif = '';

        var $error_message = ajax_script.form_error_message;

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
                           $loads.addClass( 'ajaxs-true' );
                      },
                      error : function( xhr, status, err ) {
                           // Handle errors
                      },
                      success : function( html, data ) {
                           console.log( html );  
                           $params( $setups ).html( html );
                           $loads.removeClass( 'ajaxs-true' );
                      }
              } ) . done ( function( html, data ) {
                      $loads.removeClass( 'ajaxs-true' );
                  }
              );       
        }

        /** 
          * wp ajaxs : form submit
          * actions submit scriptions
          * events handler on-click
        **/

        function get_field_data_id ( $this=null ) 
        { 
            return $params($this).parents( '.wp-gcf-footer' ).parents( '.wp-gcf-form' ).find( '.wp-gcf-header input.form-id_value' ).val();
        }

        function get_field_data ( $this, $class ) 
        {
            var $body_area = $params($this).parents( '.wp-gcf-footer' ).prev( '.wp-gcf-boby' );
            var $arrs = [ 'field-html-7' ];
            var $value = []; 

            var $data_id = [];
            var $data_value = [];

            var $multi_value = ['field-radio-box', 'field-checkbox-box'];

            /** --- ISSUE
            $body_area.find( $class ).each( function(i)
                {   
                    var $filter = $params(this).attr( 'class' ).split( ' ' );

                    if( $filter[1] !== $arrs[0] ) {

                        var $cls = $params(this).find( '.field-data' ).attr( 'class' ).split( ' ' );
                        var $val = $params(this).find( '.field-data' ).val();

                        $value[i] = { 'field' : $cls[1], 'value' : $val };
                    }
                }
            ); --- END **/

            $body_area.find( '.field-data' ).each( function(i)
                {
                    var $empty = '';
                    var $data_id = $params(this).attr( 'class' ).split( ' ' );
                    var $input_wrap = $params(this).parents( '.field-value' ).find( '.error-message' );

                    if( $data_id[1] == $multi_value[0] ) {
                        if( $params(this).is( ':checked' ) == true ) {
                            $data_value = $params(this).val();
                        } else {
                            $data_value = null;
                        }
                    } else if ( $data_id[1] == $multi_value[1] ) {
                        if( $params(this).is( ':checked' ) == true ) {
                            $data_value = $params(this).val();
                        } else {
                            $data_value = null;
                        }
                    } else {
                        // empty filter validate
                        if( $params(this).val().length !== 0 ) {
                            $data_value = $params(this).val();
                            $input_wrap.removeClass( 'error-message-validate' );
                            $input_wrap.text( $empty );
                        } else {
                            $input_wrap.addClass( 'error-message-validate' );
                            $input_wrap.text( $error_message['empty'] );
                        }
                        
                    }

                    // console.log( $error_message );
                    console.log( $data_id[1]  );

                    $value[i] = { 'field':$data_id[1], 'value':$data_value };
                    
                }
            );
          
            return $value;
        }

        $params ( '.wp-gcf-form .wp-gcf-footer' ).on( 'click', '.wp-gcf_submit input', function () 
            {

                var $ids = get_field_data_id(this);
                var $values = get_field_data( this, '.field-value' );

                var $datas = { 'form_id':$ids, 'data':$values }; 

                var $loader_gif_var = $params(this).parents( '.wp-gcf_submit' ).find( 'span.wp-gcf__loader' );

                ajax_actions( 'ajaxs_get_field_data', $datas, $debug, $loader_gif_var );
            }
        );

        // END    
    }
);