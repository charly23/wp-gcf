
<?php  if( ! class_exists( 'add_new_center' ) or wp_die ( 'error found.' ) ) :

    class add_new_center extends html_var
    {

        public static $slug = 'add_new';

        public function __construct() 
        {
               parent::__construct();
               new html( true );
               new standard( true );
               new advanced( true );
               new input( true );
        }

        public static function form () 
        {
            $html = null;

            $html .= self::form_setting();
            $html .= self::form_left();
            $html .= self::form_right();
            $html .= self::form_last();

            return $html;   
        }

        /**
         * Form : Setting
         * structure setting element
         * structure setting form/ui
        **/

        public static function form_setting ( $slug='setting' ) 
        {
            $html = null;
            
            $ids = input::get_is_object_element( 'edit' );

            $rows = unserialize( db::query_rows_id( $ids )->form );

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_wrap' ) );

            $html .= self::_span( array( 'class' => 'setting-title' ) );
            $html .= __( 'Form Settings', 'result' );
            $html .= self::_spanend();

            $button_text = isset( $rows['setting']['button_text'] ) ? trim( $rows['setting']['button_text'] ) : null;

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_item button-text' ) );
            $html .= __( 'Button text', 'result' );
            $html .= self::_br();
            $html .= input::text( array( 'class' => 'setting_button-text text-field', 'id' => 'setting_button-text', 'value' => $button_text ) );
            $html .= self::_divend();

            $class_name = isset( $rows['setting']['class_name'] ) ? trim( $rows['setting']['class_name'] ) : null;

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_item class-name' ) );
            $html .= __( 'Class name', 'result' );
            $html .= self::_br();
            $html .= input::text( array( 'class' => 'setting_class-name text-field', 'id' => 'setting_class-name', 'value' => $class_name ) );
            $html .= self::_divend();

            $entry_limit = isset( $rows['setting']['entry_limit'] ) ? trim( $rows['setting']['entry_limit'] ) : 0;

            if ( $entry_limit != 0 ) {
                $is_entry_limit = array( 'class' => 'setting_entry-limit', 'id' => 'setting_entry-limit', 'value' => $entry_limit, 'checked' => 'checked' );
            } else {
                $is_entry_limit = array( 'class' => 'setting_entry-limit', 'id' => 'setting_entry-limit', 'value' => $entry_limit );
            }

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_item entry-limit' ) );
            $html .= __( 'Enable entry limit', 'result' );
            $html .= self::_br();
            $html .= input::checkbox( $is_entry_limit );
            $html .= self::_divend();
            
            $logged_in = isset( $rows['setting']['logged-in'] ) ? trim( $rows['setting']['logged-in'] ) : 0;

            if ( $logged_in != 0 ) {
                $is_loggend_in = array( 'class' => 'setting_logged-in', 'id' => 'setting_logged-in', 'value' => $logged_in, 'checked' => 'checked' );
            } else {
                $is_loggend_in = array( 'class' => 'setting_logged-in', 'id' => 'setting_logged-in', 'value' => $logged_in );
            }

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_item logged-in' ) );
            $html .= __( 'Require user to be logged in', 'result' );
            $html .= self::_br();
            $html .= input::checkbox( $is_loggend_in );
            $html .= self::_divend();
            
            $html .= self::_divend();

            return $html;
        }

        /**
         * Form : Left
         * structure left element
         * structure left form/ui
        **/

        public static function form_left ( $slug='left' ) 
        {
            $html = null;

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_wrap' ) );
            $html .= self::form_get_standard_option();
            $html .= self::_divend();

            return $html;
        }

        public static function form_get_standard_option ( $slug='left' ) 
        {
            $html = null;

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_get_standard_option' ) );

            $html .= self::_p( array( 'class' => 'message' ) );
            $html .= __( 'Please select (click/drag) available fields to generate or build your personlize form.', 'message' );
            $html .= self::_pend();

            $html .= self::form_get_standard_option_result_field( $slug );

            $html .= self::_divend();

            return $html;
        }

        public static function form_get_standard_option_result_field ( $slug='left' ) 
        {
            $html = null;

            $ids = input::get_is_object_element( 'edit' );
            $rows = unserialize( db::query_rows_id( $ids )->form );

            $i_1 = 0; $i_11 = 0;
            $i_2 = 0; $i_12 = 0;
            $i_3 = 0; $i_13 = 0;
            $i_4 = 0; $i_14 = 0;
            $i_5 = 0; $i_15 = 0;
            $i_6 = 0; $i_16 = 0;
            $i_7 = 0; $i_17 = 0;
            $i_8 = 0; $i_18 = 0;

            if( isset( $rows['field'] ) ) : foreach( $rows['field'] as $key => $result ) :

                $ids = intval( $result['id'] );
                
                /**
                 * standard number 1-8
                **/

                if( $ids == 1 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_1++ );
                }
                if( $ids == 2 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_2++ );
                }
                if( $ids == 3 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_3++ );
                }
                if( $ids == 4 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_4++ );
                }
                if( $ids == 5 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_5++ );
                }
                if( $ids == 6 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_6++ );
                }
                if( $ids == 7 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_7++ );
                }
                if( $ids == 8 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_8++ );
                }

                /**
                 * advanced number 11-18
                **/

                if( $ids == 11 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_11++ );
                }
                if( $ids == 12 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_12++ );
                }
                if( $ids == 13 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_13++ );
                }
                if( $ids == 14 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_14++ );
                }
                if( $ids == 15 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_15++ );
                }
                if( $ids == 16 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_16++ );
                }
                if( $ids == 17 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_17++ );
                }
                if( $ids == 18 ) {
                    $html .= self::form_get_standard_option_result( $slug, $result, $i_18++ );
                }

            endforeach; 
            endif;

            return $html;
        }

        public static function form_get_standard_option_result ( $slug='left', $results=array(), $counts=null ) 
        {
            $html = null;

            $ids = !empty( $results[0]['id'] ) ? $results[0]['id'] : $results['id'];

            $fields_id = advanced::fields_id();

            if( in_array( $ids, $fields_id ) ) {
                $class_advanced = 'add_new_advanced_fields';
            } else { 
                $class_advanced = null;
            }

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_get_standard_fields ' . $class_advanced ) ); 

                $html .= self::_div( array( 'class' => 'get_standard-form' ) ); 

                    $html .= input::hidden( array( 'name' => 'hidden-field-id', 'class' => 'hidden-field-id', 'value' => $ids ) );

                    $is_counts = ( $counts ) == 0 ? 1 : $counts + 1;

                    $html .= input::hidden( array( 'name' => 'hidden-field-type_count', 'class' => 'hidden-field-type_count', 'value' => $is_counts ) );

                    $html .= self::_div( array( 'class' => 'field-box-title' ) );
                    $html .= self::form_get_standard_option_head_cntr( $results );
                    $html .= self::_divend();

                    $html .= self::form_get_standard_option_fields_settings( $results );

                    $html .= self::form_get_standard_option_input_fields( $results, $is_counts );
                
                $html .= self::_divend();

            $html .= self::_divend();  

            if( !empty( $results[0]['id'] ) ) {
                _e( $html, 'html' );
            } else {
                return $html;
            }

        }

        public static function form_get_standard_option_head_cntr ( $results=null ) 
        {
            $html = null;

            $ids  = !empty( $results[0]['id'] ) ? $results[0]['id'] : $results['id'];

            $data_standard = standard::get_fields_by_id( $ids );
            $data_advanced = advanced::get_fields_by_id( $ids );

            if( !empty( $results['name'] ) ) {

                if ( !is_null( $data_standard[0]['name'] ) ) {
                    $label = $data_standard[0]['name'];
                } else if ( !is_null( $data_advanced[0]['name'] ) ) {
                    $label = $data_advanced[0]['name'];
                } else {
                    $label = null;
                }

                $name =  $label . ' : ' . $results['name'];
            } else {
                $name = $results[0]['name'];
            }

            $html .= self::_div( array( 'class' => 'get_standard-inner_left' ) ); 

            $html .= self::_span( array( 'class' => 'field-drop_box' ) );
            $html .= self::_spanend();

            $html .= __( $name, 'result' );
            $html .= self::_divend();  

            $html .= self::_div( array( 'class' => 'get_standard-inner_right' ) );

            $html .= self::_span( array( 'class' => 'field-close_box' ) );
            $html .= self::_spanend();

            $html .= self::_span( array( 'class' => 'field-drag_box' ) );
            $html .= self::_spanend();

            $html .= self::_divend();  

            return $html;
        }

        public static function form_get_standard_option_fields_settings ( $results=null ) 
        {
            $html = null;

            $html .= self::_div( array( 'class' => 'field-box-setting_top' ) ); 
            $html .= self::_span( array( 'class' => 'field-setting_box' ) );
            $html .= self::_spanend();
            $html .= self::_divend();

            $html .= self::_div( array( 'class' => 'field-box-setting_bottom' ) ); 

            $html .= self::_div( array( 'class' => 'field-box-setting_title' ) ); 
            $html .= __( 'Field Position', 'result' );
            $html .= self::_divend();

            $field_position = isset( $results['setting']['field_position'] ) ? $results['setting']['field_position'] : null;

            if ( $field_position == 1 ) {
                $field_display_top = array( 'name' => 'field-display-top', 'class' => 'field-display-top', 'value' => 1, 'checked' => 'checked' );
                $field_display_bottom = array( 'name' => 'field-display-bottom', 'class' => 'field-display-bottom', 'value' => 2 );  
            } else if ( $field_position == 2 ) {
                $field_display_top = array( 'name' => 'field-display-top', 'class' => 'field-display-top', 'value' => 1 );
                $field_display_bottom = array( 'name' => 'field-display-bottom', 'class' => 'field-display-bottom', 'value' => 2, 'checked' => 'checked' ); 
            } else {
                $field_display_top = array( 'name' => 'field-display-top', 'class' => 'field-display-top', 'value' => 1 );
                $field_display_bottom = array( 'name' => 'field-display-bottom', 'class' => 'field-display-bottom', 'value' => 2 );
            }

            $html .= self::_div( array( 'class' => 'field-box-setting_item' ) );
            $html .= __( 'Top', 'result' );
            $html .= input::checkbox( $field_display_top );
            $html .= __( 'Bottom', 'result' );
            $html .= input::checkbox( $field_display_bottom );
            $html .= self::_divend();

            $id_default = !empty( $results['class'] ) ? $results['class'] : 'field-'. sanitize::title( $results['name'] );

            $field_id = isset( $results['setting']['field_id'] ) ? $results['setting']['field_id'] : 'field-'. sanitize::title( $results['name'] );

            $html .= self::_div( array( 'class' => 'field-box-setting_item' ) );
            $html .= __( "ID : {$id_default}", 'result' );
            $html .= self::_br();
            $html .= input::text( array( 'name' => 'field-id-value', 'class' => 'field-id-value', 'value' => $field_id ) );
            $html .= self::_divend();

            $html .= self::_div( array( 'class' => 'field-box-setting_title' ) ); 
            $html .= __( 'Error Validate', 'result' );
            $html .= self::_divend();

            $error_message = isset( $results['setting']['error_message'] ) ? $results['setting']['error_message'] : null;

            $html .= self::_div( array( 'class' => 'field-box-setting_item' ) );
            $html .= __( ' Message', 'result' );
            $html .= self::_br();
            $html .= input::text( array( 'name' => 'field-display-error', 'class' => 'field-display-error', 'value' => $error_message ) );
            $html .= self::_divend();

            $error_class = isset( $results['setting']['error_class'] ) ? $results['setting']['error_class'] : null;

            $html .= self::_div( array( 'class' => 'field-box-setting_item' ) );
            $html .= __( 'Class', 'result' );
            $html .= self::_br();
            $html .= input::text( array( 'name' => 'field-display-class', 'class' => 'field-display-class', 'value' => $error_class ) );
            $html .= self::_divend();

            $error_position = isset( $results['setting']['error_position'] ) ? $results['setting']['error_position'] : null;
            if( $error_position == 1 ) {
               $error_display_top = array( 'name' => 'field-display-error-top', 'class' => 'field-display-error-top', 'value' => 1, 'checked' => 'checked' ); 
               $error_display_bottom = array( 'name' => 'field-display-error-bottom', 'class' => 'field-display-error-bottom', 'value' => 2 );
            } else if ( $error_position == 2 ) {
               $error_display_top = array( 'name' => 'field-display-error-top', 'class' => 'field-display-error-top', 'value' => 1 );
               $error_display_bottom = array( 'name' => 'field-display-error-bottom', 'class' => 'field-display-error-bottom', 'value' => 2, 'checked' => 'checked' ); 
            } else {
                $error_display_top = array( 'name' => 'field-display-error-top', 'class' => 'field-display-error-top', 'value' => 1 );
                $error_display_bottom = array( 'name' => 'field-display-error-bottom', 'class' => 'field-display-error-bottom', 'value' => 2 );
            }

            $html .= self::_div( array( 'class' => 'field-box-setting_item' ) );
            $html .= __( 'Top', 'result' );
            $html .= input::checkbox( $error_display_top );
            $html .= __( 'Bottom', 'result' );
            $html .= input::checkbox( $error_display_bottom );
            $html .= self::_divend();

            $html .= self::_divend();

            return $html;
        }

        public static function form_get_standard_option_input_fields ( $results=array(), $counts=null ) 
        {
            $html = null;
            $i = 0;

            $datas = !empty( $results[0] ) ? $results[0] : $results;

            $ids  = !empty( $results[0]['id'] ) ? $results[0]['id'] : $results['id'];

            $standard = standard::get_fields_by_id( $ids );
            $advanced = advanced::get_fields_by_id( $ids );

            if( !empty( $results[0] ) ) {

                $field = array ( 
                    'text',
                    'textarea',
                    'select',
                    'radio',
                    'checkbox',
                    'number',
                    'html',
                    'hidden',
                    'name',
                    'date',
                    'time',
                    'phone',
                    'address',
                    'website',
                    'email',
                    'file-upload'
                );

                if( $field ) : foreach( $field as $key => $fields ) :

                    if ( in_array( $fields, $datas ) ) $html .= self::form_get_standard_option_field_data( $fields, array(), $counts );

                endforeach;
                endif;

            } else {

                $field = array ( 
                    1 => 'text',
                    2 => 'textarea',
                    3 => 'select',
                    4 => 'radio',
                    5 => 'checkbox',
                    6 => 'number',
                    7 => 'html',
                    8 => 'hidden',
                    11 => 'name',
                    12 => 'date',
                    13 => 'time',
                    14 => 'phone',
                    15 => 'address',
                    16 => 'website',
                    17 => 'email',
                    18 => 'file-upload'
                );

                if( $field ) : foreach( $field as $key => $fields ) :

                    if( $standard[0]['slug'] == $fields ) $html .= self::form_get_standard_option_field_data( $fields, $datas, $counts );
                    if( $advanced[0]['slug'] == $fields ) $html .= self::form_get_standard_option_field_data( $fields, $datas, $counts );
                    
                endforeach;;
                endif;

            }

            return $html;
        }

        public static function form_get_standard_option_field_data ( $slug=null, $results=array(), $counts=null ) 
        {
            $html = null;

            $slug_standard = standard::fields_slug();
            $slug_advanced = advanced::fields_slug();
            
            if ( $slug != false ) :

            $name = isset( $results['name'] ) ? $results['name'] : null;

            $html .= self::_div( array( 'class' => 'field-pad_item' ) );
            $html .= __( 'Name', 'label' );
            $html .= self::_br();
            $html .= input::text( array( 'name' => 'field-name-box', 'class' => 'field-name-box', 'value' => $name ) );

            $html .= __( 'Required', 'label' );
            if( isset( $results['required'] ) and $results['required'] == 1 ) {
                $required = array( 'name' => 'field-required-box', 'class' => 'field-required-box', 'value' => 1, 'checked' => 'checked' );
            } else {
                $required = array( 'name' => 'field-required-box', 'class' => 'field-required-box', 'value' => 1 ); 
            }
            
            $html .= input::checkbox( $required );
            $html .= self::_divend();

            $desc = isset( $results['description'] ) ? $results['description'] : null;

            if ( in_array( $slug, $slug_standard ) ) :
                if( $slug == 'html' ) :
                    $html .= self::_div( array( 'class' => 'field-pad_item' ) );
                    $html .= __( 'HTML', 'label' );
                    $html .= self::_br();
                    $html .= self::form_get_standard_option_field_html( $results );
                    $html .= self::_divend();
                endif;
            endif;

            $html .= self::_div( array( 'class' => 'field-pad_item' ) );
            $html .= __( 'Description', 'label' );
            $html .= self::_br();
            $html .= html::textarea( array( 'text' => $desc, 'class' => 'field-description-box', 'name' => 'field-description-box' ) );
            $html .= self::_divend();

            $placeholder = isset( $results['placeholder'] ) ? $results['placeholder'] : null;
            $is_advanced = $results['advanced'];

            $html .= self::_div( array( 'class' => 'field-pad_item' ) );

            if ( in_array( $slug, $slug_standard ) ) :
                $html .= __( 'Placeholder', 'label' );
                $html .= self::_br();
                $html .= input::text( array( 'name' => 'field-placeholder-box', 'class' => 'field-placeholder-box', 'value' => $placeholder ) );
            endif;

            if ( in_array( $slug, $slug_advanced ) ) :
                if( $slug == 'name' ) :
                    $html .= __( 'Placeholder', 'label' );
                    $html .= self::_br();

                    $lastname = isset( $is_advanced['lastname'] ) ? $is_advanced['lastname'] : 'Lastname';
                    $firstname = isset( $is_advanced['firstname'] ) ? $is_advanced['firstname'] : 'Firstname';
                    $middlename = isset( $is_advanced['middlename'] ) ? $is_advanced['middlename'] : 'Middlename';

                    $html .= input::text( array( 'name' => 'field-name-placeholder1', 'class' => 'field-name-placeholder1', 'value' => $lastname ) );
                    $html .= input::text( array( 'name' => 'field-name-placeholder2', 'class' => 'field-name-placeholder2', 'value' => $firstname ) );
                    $html .= input::text( array( 'name' => 'field-name-placeholder3', 'class' => 'field-name-placeholder3', 'value' => $middlename ) );
                elseif ( $slug == 'date' ) :
                    $html .= __( 'Date : Format', 'label' );
                    $html .= self::_br();

                    $format_values = isset( $is_advanced['format'] ) ? intval( $is_advanced['format'] ) : 1;
                    $custom_values = isset( $is_advanced['custom'] ) ? trim( $is_advanced['custom'] ) : null;

                    $formats = advanced::get_fields_date_format( false );

                    $html .= input::select( array( 'class' => 'field-date-format_select', 'name' => 'field-date-format_select' ), $formats , $format_values, false );
                    $html .= input::text( array( 'name' => 'field-date-format_custom', 'class' => 'field-date-format_custom', 'value' => $custom_values ) );
                elseif ( $slug == 'time' ) :
                    $html .= __( 'Time : Format', 'label' );
                    $html .= self::_br();

                    $format_values = isset( $is_advanced['format'] ) ? intval( $is_advanced['format'] ) : 1;
                    $custom_values = isset( $is_advanced['custom'] ) ? trim( $is_advanced['custom'] ) : null;

                    $formats = advanced::get_fields_time_format( false );

                    $html .= input::select( array( 'class' => 'field-time-format_select', 'name' => 'field-time-format_select' ), $formats , $format_values, false );
                    $html .= input::text( array( 'name' => 'field-time-format_custom', 'class' => 'field-time-format_custom', 'value' => $custom_values ) );
                elseif ( $slug == 'phone' ) :
                    $html .= __( 'Phone : Format', 'label' );
                    $html .= self::_br();

                    $format_values = isset( $is_advanced['format'] ) ? intval( $is_advanced['format'] ) : 1;
                    $custom_values = isset( $is_advanced['custom'] ) ? trim( $is_advanced['custom'] ) : null;

                    $formats = advanced::get_fields_phone_format( false );

                    $html .= input::select( array( 'class' => 'field-phone-format_select', 'name' => 'field-phone-format_select' ), $formats , $format_values, false );
                    $html .= input::text( array( 'name' => 'field-phone-format_custom', 'class' => 'field-phone-format_custom', 'value' => $custom_values ) );
                elseif ( $slug == 'address' ) :
                    $html .= __( 'Address : Format', 'label' );
                    $html .= self::_br();

                    $format_values = isset( $is_advanced['format'] ) ? intval( $is_advanced['format'] ) : 1;
                    $formats = advanced::get_fields_address_format( false );

                    $html .= input::select( array( 'class' => 'field-address-format_select', 'name' => 'field-address-format_select' ), $formats , $format_values, false );
                elseif ( $slug == 'website' ) :
                    $html .= __( 'Website : Block', 'label' );
                    $html .= self::_br();

                    $block_domain = isset( $is_advanced['block_domain'] ) ? trim( $is_advanced['block_domain'] ) : '@sample.com,@test.com';
                    $html .= input::text( array( 'name' => 'field-website-input', 'class' => 'field-website-input', 'value' => $block_domain ) );
                elseif ( $slug == 'email' ) :
                    $html .= __( 'Email : Block', 'label' );
                    $html .= self::_br();

                    $block_domain = isset( $is_advanced['block_domain'] ) ? trim( $is_advanced['block_domain'] ) : '@sample.com,@test.com';
                    $html .= input::text( array( 'name' => 'field-email-input', 'class' => 'field-email-input', 'value' => $block_domain ) );
                elseif ( $slug == 'file-upload' ) :
                    $html .= __( 'File Upload : Type', 'label' );
                    $html .= self::_br();

                    $type = isset( $is_advanced['type'] ) ? trim( $is_advanced['type'] ) : 'doc,pdf,jpg.png,gif';
                    $html .= input::text( array( 'name' => 'field-file-upload', 'class' => 'field-file-upload', 'value' => $type ) );
                endif;
            endif;

            $html .= self::_span( array( 'class' => 'field-max-label' ) );
            $html .= __( 'Max', 'label' );
            $html .= self::_spanend();

            $max = isset( $results['max'] ) ? $results['max'] : null;

            $html .= input::text( array( 'name' => 'field-max-box', 'class' => 'field-max-box', 'value' => $max ) );
            $html .= self::_divend();

            $class = isset( $results['class'] ) ? $results['class'] : null;

            $html .= self::_div( array( 'class' => 'field-pad_item' ) );
            $html .= __( 'Class', 'label' );
            $html .= self::_br();
            $html .= input::text( array( 'name' => 'field-class-box', 'class' => 'field-class-box', 'value' => $class ) );
            $html .= self::_divend();

            if( $slug == 'select' ) {

                $ids = input::get_is_object_element( 'edit' );
                $rows = unserialize( db::query_rows_id( $ids )->form );

                $is_count = ( $counts ) - 1;

                $html .= self::_div( array( 'class' => 'field-pad_item select-box_pad' ) );
                $html .= self::form_get_standard_option_field_selectbox( $results['id'], $results, $is_count );
                $html .= self::_divend();

            } else if ( $slug == 'radio' ) {

                $is_count = ( $counts ) - 1;

                $html .= self::_div( array( 'class' => 'field-pad_item radiobox_pad' ) );
                $html .= self::form_get_standard_option_field_radio( $results['id'], $results, $is_count );
                $html .= self::_divend();

            } else if ( $slug == 'checkbox' ) {

                $is_count = ( $counts ) - 1;

                $html .= self::_div( array( 'class' => 'field-pad_item checkbox_pad' ) );
                $html .= self::form_get_standard_option_field_checkbox( $results['id'], $results, $is_count );
                $html .= self::_divend();
            }

            /**

            if( $slug == 'name' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Name', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'date' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Date', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'time' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Time', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'phone' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Phone', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'address' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Address', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'website' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Website', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'email' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'Email', 'label' );
                $html .= self::_divend();
            } else if ( $slug == 'file-upload' ) {
                $html .= self::_div( array( 'class' => 'field-pad_item '.$slug.'-box_pad' ) );
                $html .= __( 'File Upload', 'label' );
                $html .= self::_divend();
            } 

            **/

            endif;

            return $html;
        }

        public static function form_get_standard_option_field_selectbox ( $ids=null, $results=null, $counts=null ) 
        {
            $html = null;
            $i = 0;

            // $is_position = array_count_values( $results['id_position'] );

            $html .= self::_div( array( 'class' => 'select-box_pad-label' ) );
            $html .= self::_span( array( 'class' => 'select-box_label-value' ) );
            $html .= __( 'Value', 'label' );
            $html .= self::_spanend();
            $html .= self::_span( array( 'class' => 'select-box_label-text' ) );
            $html .= __( 'Text', 'label' );
            $html .= self::_spanend();
            $html .= self::_divend();

            $datas = $results['datas'];

            if( isset( $datas ) and !empty( $datas ) ) :

                foreach( $datas as $keys => $values ) :

                    if( $keys == $counts ) 
                    {

                        foreach( $values['value'] as $key_value => $res_value ) :

                            $default = $key_value == 0 ? 'select-box_item-default' : null;

                            $texts = $values['text'][$key_value];

                            $html .= self::_div( array( 'class' => 'select-box_pad-item' ) );

                            $html .= self::_span( array( 'class' => 'select-box_item-value' ) );
                            $html .= input::text( array( 'name' => 'select-item-value', 'class' => 'select-item-value', 'value' => $res_value ) );
                            $html .= self::_spanend();

                            $html .= self::_span( array( 'class' => 'select-box_item-text' ) );
                            $html .= input::text( array( 'name' => 'select-item-text', 'class' => 'select-item-text', 'value' => $texts ) );
                            $html .= self::_spanend();

                            $html .= self::_span( array( 'class' => 'select-box_item-action ' .  $default ) );

                            $html .= self::_a( array( 'class' => 'select-box_item-del button' ) );
                            $html .= self::_aend();

                            $html .= self::_a( array( 'class' => 'select-box_item-add button' ) );
                            $html .= self::_aend();

                            $html .= self::_spanend();

                            $html .= self::_divend();

                        endforeach;
                        
                    }
  
                endforeach; 

            else :

                $html .= self::_div( array( 'class' => 'select-box_pad-item' ) );

                $html .= self::_span( array( 'class' => 'select-box_item-value' ) );
                $html .= input::text( array( 'name' => 'select-item-value', 'class' => 'select-item-value', 'value' => '') );
                $html .= self::_spanend();

                $html .= self::_span( array( 'class' => 'select-box_item-text' ) );
                $html .= input::text( array( 'name' => 'select-item-text', 'class' => 'select-item-text', 'value' => '' ) );
                $html .= self::_spanend();

                $html .= self::_span( array( 'class' => 'select-box_item-action select-box_item-default' ) );
                $html .= self::_a( array( 'class' => 'select-box_item-del button' ) ).self::_aend();
                $html .= self::_a( array( 'class' => 'select-box_item-add button' ) ).self::_aend();
                $html .= self::_spanend();

                $html .= self::_divend();

            endif;

            return $html;
        }

        public static function form_get_standard_option_field_radio ( $ids=null, $results=null, $counts=null ) 
        {
            $html = null;

            $html .= self::_div( array( 'class' => 'radiobox_pad-label' ) );
            $html .= self::_span( array( 'class' => 'radiobox_label-value' ) );
            $html .= __( 'Value', 'label' );
            $html .= self::_spanend();
            $html .= self::_span( array( 'class' => 'radiobox_label-label' ) );
            $html .= __( 'Label', 'label' );
            $html .= self::_spanend();
            $html .= self::_divend();

            $datas = $results['datas'];

            if( isset( $datas ) and !empty( $datas ) ) :

                foreach( $datas as $keys => $values ) :

                    if( $keys == $counts ) 
                    {

                        foreach( $values['value'] as $key_value => $res_value ) :

                            $default = $key_value == 0 ? 'radiobox_item-default' : null;

                            $labels = $values['label'][$key_value];

                            $html .= self::_div( array( 'class' => 'radiobox_pad-item' ) );

                            $html .= self::_span( array( 'class' => 'radiobox_item-value' ) );
                            $html .= input::text( array( 'name' => 'radiobox-item-value', 'class' => 'radiobox-item-value', 'value' => $res_value ) );
                            $html .= self::_spanend();

                            $html .= self::_span( array( 'class' => 'radiobox_item-label' ) );
                            $html .= input::text( array( 'name' => 'radiobox-item-label', 'class' => 'radiobox-item-label', 'value' => $labels ) );
                            $html .= self::_spanend();

                            $html .= self::_span( array( 'class' => 'radiobox_item-action ' . $default ) );
                            $html .= self::_a( array( 'class' => 'radiobox_item-del button' ) ).self::_aend();
                            $html .= self::_a( array( 'class' => 'radiobox_item-add button' ) ).self::_aend();
                            $html .= self::_spanend();

                            $html .= self::_divend();

                        endforeach;

                    }

                endforeach;

            else :

                $html .= self::_div( array( 'class' => 'radiobox_pad-item' ) );

                $html .= self::_span( array( 'class' => 'radiobox_item-value' ) );
                $html .= input::text( array( 'name' => 'radiobox-item-value', 'class' => 'radiobox-item-value', 'value' => '') );
                $html .= self::_spanend();

                $html .= self::_span( array( 'class' => 'radiobox_item-label' ) );
                $html .= input::text( array( 'name' => 'radiobox-item-label', 'class' => 'radiobox-item-label', 'value' => '' ) );
                $html .= self::_spanend();

                $html .= self::_span( array( 'class' => 'radiobox_item-action radiobox_item-default' ) );
                $html .= self::_a( array( 'class' => 'radiobox_item-del button' ) ).self::_aend();
                $html .= self::_a( array( 'class' => 'radiobox_item-add button' ) ).self::_aend();
                $html .= self::_spanend();

                $html .= self::_divend();

            endif;

            return $html;

        }

        public static function form_get_standard_option_field_checkbox ( $ids=null, $results=null, $counts=null ) 
        {
            $html = null;

            $html .= self::_div( array( 'class' => 'checkbox_pad-label' ) );
            $html .= self::_span( array( 'class' => 'checkbox_label-value' ) );
            $html .= __( 'Value', 'label' );
            $html .= self::_spanend();
            $html .= self::_span( array( 'class' => 'checkbox_label-label' ) );
            $html .= __( 'Label', 'label' );
            $html .= self::_spanend();
            $html .= self::_divend();

            $datas = $results['datas'];

            if( isset( $datas ) and !empty( $datas ) ) :

                foreach( $datas as $keys => $values ) :

                    if( $keys == $counts ) 
                    {

                        foreach( $values['value'] as $key_value => $res_value ) :

                            $default = $key_value == 0 ? 'checkbox_item-default' : null;

                            $labels = $values['label'][$key_value];

                            $html .= self::_div( array( 'class' => 'checkbox_pad-item' ) );

                            $html .= self::_span( array( 'class' => 'checkbox_item-value' ) );
                            $html .= input::text( array( 'name' => 'checkbox-item-value', 'class' => 'checkbox-item-value', 'value' => $res_value ) );
                            $html .= self::_spanend();

                            $html .= self::_span( array( 'class' => 'checkbox_item-label' ) );
                            $html .= input::text( array( 'name' => 'checkbox-item-label', 'class' => 'checkbox-item-label', 'value' => $labels ) );
                            $html .= self::_spanend();

                            $html .= self::_span( array( 'class' => 'checkbox_item-action ' . $default ) );
                            $html .= self::_a( array( 'class' => 'checkbox_item-del button' ) ).self::_aend();
                            $html .= self::_a( array( 'class' => 'checkbox_item-add button' ) ).self::_aend();
                            $html .= self::_spanend();

                            $html .= self::_divend();

                        endforeach;

                    }

                endforeach;

            else :

                $html .= self::_div( array( 'class' => 'checkbox_pad-item' ) );

                $html .= self::_span( array( 'class' => 'checkbox_item-value' ) );
                $html .= input::text( array( 'name' => 'checkbox-item-value', 'class' => 'checkbox-item-value', 'value' => '') );
                $html .= self::_spanend();

                $html .= self::_span( array( 'class' => 'checkbox_item-label' ) );
                $html .= input::text( array( 'name' => 'checkbox-item-label', 'class' => 'checkbox-item-label', 'value' => '' ) );
                $html .= self::_spanend();

                $html .= self::_span( array( 'class' => 'checkbox_item-action checkbox_item-default' ) );
                $html .= self::_a( array( 'class' => 'checkbox_item-del button' ) ).self::_aend();
                $html .= self::_a( array( 'class' => 'checkbox_item-add button' ) ).self::_aend();
                $html .= self::_spanend();

                $html .= self::_divend();

            endif;

            return $html;

        }

        public static function form_get_standard_option_field_html ( $results=null ) 
        {
            $html = null;

            $datas = $results['datas']['value'];

            $html .= html::textarea( array( 'text' => $datas, 'class' => 'field-html-box', 'name' => 'field-html-box' ) );
            
            return $html;
        }

        /**
         * Form : Left
         * structure left element
         * structure left form/ui
         * - END
        **/

        /**
         * Form : Right
         * structure right element
         * structure right form/ui
        **/

        public static function form_right ( $slug='right' ) 
        {
            $i = 0;
            $html = null;
            $ids = input::get_is_object_element( 'edit' );

            $querys = db::query_settings( $ids );

            if( isset( $querys[$i]->options_settings ) ) {
                $options = unserialize( $querys[$i]->options_settings );
            } else {
                $options = null;
            }

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_wrap' ) );

            $html .= self::form_publish_option( $slug, $options );
            $html .= self::form_standard_option( $slug, false );
            $html .= self::form_advanced_option( $slug, $options );

            $html .= self::_divend();
            
            return $html;
        }

        public static function form_publish_option ( $slug='right', $options=null ) 
        {
            $html = null;
            $ids = input::get_is_object_element( 'edit' );

            $rows = db::query_rows_id( $ids );
            
            $is_edits = intval( $ids ) ?  __( ": ID - {$ids}", 'id' ) : null;

            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_publish_option' ) );

            $html .= self::_span( array( 'class' => 'publish-title' ) );
            $html .= __( 'Publish ' . $is_edits, 'title' );
            $html .= self::_spanend();

            if( !empty( $rows->date) || !is_null( $rows->date ) ) {

                if ( is_array( $rows->date ) ) {
                    $date_value = unserialize( $rows->date );
                    $date_val = explode( '-', $date_value['value'] );
                    $date_frt = isset( $date_value['format'] ) ? trim( $date_value['format'] ) : 'm-d-y';
                } else {
                    $date_val = array( date('m'), date('d'), date('Y') );
                    $date_frt = 'm-d-y';
                }
            } else {
                $date_val = array( date('m'), date('d'), date('Y') );
                $date_frt = 'm-d-y';
            }

            $html .= self::_div( array( 'class'=>'publish-date_pad', 'id'=>'publish-date_pad' ) );
            $html .= __( 'Date', 'title' );
            $html .= self::_br();
            $html .= input::text( array( 'name' => 'field-date-month', 'class' => 'field-date-month', 'value' => $date_val[0] ) );
            $html .= input::text( array( 'name' => 'field-date-day', 'class' => 'field-date-day', 'value' => $date_val[1]  ) );
            $html .= input::text( array( 'name' => 'field-date-year', 'class' => 'field-date-year', 'value' => $date_val[2]  ) );

            if( isset( $options['date_option'] ) ) {
                if( $options['date_option'] != 0 ) {
                    $date_option = null;
                } else {
                    $date_option = 'hide_form';
                }
            } else {
                $date_option = 'hide_form';
            }

            $html .= input::text( array( 'name' => 'field-date-format', 'class' => "field-date-format {$date_option}", 'value' => $date_frt  ) );

            $html .= self::_divend();

            $status = isset( $rows->status ) ? $rows->status : null;

            $html .= self::_div( array( 'class'=>'publish-status_pad', 'id'=>'publish-status_pad' ) );
            $html .= __( 'Status', 'title' );
            $html .= self::_br();
            $html .= input::select( array( 'class' => 'field-status-value', 'name' => 'field-status-value' ), array( 'draft' => 'Draft', 'trash' => 'Trash', 'publish' => 'Publish' ), $status, false );
            $html .= self::_divend();

            $html .= self::_a( array( 'href' => '#', 'class' => 'submit_insert_field-form button' ) );
            if( !is_null( $ids ) ) {
                $html .= __( 'Update', 'label' );
            } else {
                $html .= __( 'Publish', 'label' );
            }
            $html .= self::_aend();

            $html .= self::_divend();    
            
            return $html;
        }

        public static function form_standard_option ( $slug='right', $print=false ) 
        {
            $html = null;
            
            $fields = standard::fields();

            if( $print != true ) $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_standard_option' ) );

            $html .= self::_span( array( 'class' => 'standard-title' ) );
            $html .= __( 'Standard Fields', 'title' );
            $html .= self::_spanend();

            if ( $fields ) : foreach( $fields as $key => $val ) :

                $html .= self::_a( array( 'href' => '#' . __( $val['id'], 'id' ), 'class' => $val['slug'] . ' ' . $val['class'] . ' button' ) );
                $html .= __( $val['name'], 'label' );
                $html .= self::_aend();

            endforeach; endif;  

            if( $print != true ) $html .= self::_divend();

            if( $print != true ) : return $html; else :
                print_r( __( $html, 'html' ) );
            endif;
        }

        public static function form_advanced_option ( $slug='right', $options=null ) 
        {
            $html = null;

            $fields = advanced::fields();

            if( isset( $options['advanced_option'] ) ) {
                if( $options['advanced_option'] != 0 ) {
                    $advanced_option = null;
                } else {
                    $advanced_option = 'hide_form';
                }
            } else {
                $advanced_option = 'hide_form';
            }
            
            $html .= self::_div( array( 'class' => 'add_new-' . __( $slug, 'slug' ) . '_inner_advanced_option '. $advanced_option ) );

            $html .= self::_span( array( 'class' => 'advanced-title' )  );
            $html .= __( 'Advanced Fields', 'title' );
            $html .= self::_spanend();

            if ( $fields ) : foreach( $fields as $key => $val ) :

                $html .= self::_a( array( 'href' => '#' . __( $val['id'], 'id' ), 'class' => $val['slug'] . ' ' . $val['class'] . ' button' ) );
                $html .= __( $val['name'], 'label' );
                $html .= self::_aend();

            endforeach; endif;

            $html .= self::_divend();

            return $html;
        }

        /**
         * Form : Right
         * structure right element
         * structure right form/ui
         * - END
        **/

        public static function form_last () 
        {
            $html = null;
            $html .= self::_div( array( 'class' => 'clear' ) ) .  self::_divend();
            return $html;
        }

        // END
    }

endif;

?>
