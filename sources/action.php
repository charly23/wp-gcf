<?php if( ! class_exists( 'action' ) or wp_die ( 'error found.' ) ) 
{
    
     class action extends db_action
     {
          
          public static $tbls = array( 'gcf'=>'gcf', 'gcf-entries'=>'gcf_entries', 'gcf-settings'=>'gcf_settings' );

          public function __construct () 
          {
                parent::__construct();
          }

          public static function get_standard_fields () 
          {
                global $wpdb;

                $results = array();
                $inputs = input::post_is_object();
                
                $ids = intval( str_replace( array( '#' ), '', $inputs->value['id'] ) );
                $fields = $inputs->value['field']['standard'];

                if ( $fields ) : 
                foreach( $fields as $key => $val ) :

                    if( in_array( $ids, $val ) ) $results[] = ( $val ); 

                endforeach; 
                endif; 

                if( isset( $inputs->action ) ) :

                    load::view( 'admin/add_new/center' );
                    add_new_center::form_get_standard_option_result( 'left', $results );

                endif;

          }

          public static function get_advanced_fields () 
          {
                global $wpdb;

                $results = array();
                $inputs = input::post_is_object();

                $ids = intval( str_replace( array( '#' ), '', $inputs->value['id'] ) );
                $fields = $inputs->value['field']['advanced'];

                if ( $fields ) : 
                foreach( $fields as $key => $val ) :

                    if( in_array( $ids, $val ) ) $results[] = ( $val ); 

                endforeach; 
                endif; 

                if( isset( $inputs->action ) ) :

                    load::view( 'admin/add_new/center' );
                    add_new_center::form_get_standard_option_result( 'left', $results );

                endif;
          }

          public static function get_fields_standard_default () 
          {
                load::view( 'admin/add_new/center' );
                add_new_center::form_standard_option( 'right', true );
          }

          /**
           * INSERT : wp-gcf
          **/

          public static function insert_fields_form () 
          {
                global $wpdb;

                $user_id = user_control::get_id();
                $inputs = input::post_is_object();

                $values = $inputs->value['values'];
                $datevl = serialize( $inputs->value['date'] );
                $status = $inputs->value['status'];

                $fields = serialize( $inputs->value );

                $ids = intval( $values['id'] );

                if( empty( $values['id'] ) ) :

                    self::inserts( self::$tbls['gcf'],

                        array( 
                            'author_id' => $user_id,
                            'name' => $values['name'],
                            'content' => $values['content'],
                            'excerpt' => $values['excerpt'],
                            'date' => $datevl,
                            'status' => $status,
                            'form' => $fields,
                            'parent' => 0
                        ), 

                        array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d' )
                    );

                else :

                    self::updates( self::$tbls['gcf'],

                        array( 
                            'author_id' => $user_id,
                            'name' => $values['name'],
                            'content' => $values['content'],
                            'excerpt' => $values['excerpt'],
                            'date' => $datevl,
                            'status' => $status,
                            'form' => $fields,
                            'parent' => 0
                        ), 

                        array( 'id' => $ids ) ,

                        array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d' ),

                        array( '%d' )
                    );

                endif;
          }

          public static function insert_fields_clear ( $fields=null ) 
          {
              $values = $fields;

              $values .= $values['field'];

              foreach( $values as $keys => $results ) :
                  $value .= $results['datas'];
              endforeach;
          }

          public static function add_new_option () 
          {
              $inputs = input::post_is_object();
              $values = $inputs->value;
              $ids = intval( $values['form_id'] );

              $options = serialize( $values );

              self::updates( self::$tbls['gcf-settings'],

                  array( 
                      'options_settings' => $options,
                  ), 

                  array( 'form_id' => $ids ) ,

                  array( '%s' ),

                  array( '%d' )
              );

          }

          /**
           * INSERT : wp-gcf : confirmation
          **/

          public static function insert_confirmation () 
          {
              $inputs = input::post_is_object();

              $values = $inputs->value['values'];
              $ids = intval( $values['id'] );

              $confirmation = serialize( $inputs->value['confirmation'] );

              self::updates( self::$tbls['gcf'],

                  array( 
                      'confirmation' => $confirmation,
                  ), 

                  array( 'id' => $ids ) ,

                  array( '%s' ),

                  array( '%d' )
              );
          }

          /**
           * INSERT : wp-gcf : notification
          **/

          public static function insert_notification () 
          {
              $inputs = input::post_is_object();

              $values = $inputs->value['values'];
              $ids = intval( $values['id'] );

              $notification = serialize( $inputs->value['notification'] );

              self::updates( self::$tbls['gcf'],

                  array( 
                      'notification' => $notification,
                  ), 

                  array( 'id' => $ids ),

                  array( '%s' ),

                  array( '%d' )
              );
          }

          public static function submit_notification_email () 
          {
              $vals = array();
              $inputs = input::post_is_object();

              $ids = intval( $inputs->value['form_id'] );
              $emails = $inputs->value['emails'];

              $rows = db::query_rows_id( $ids );
              $notification = unserialize( $rows->notification );

              if( !empty( $notification['to'] ) ) {
                  $to_value = $notification['to'];
              } else {
                  $to_value = null;
              }

              if( !empty( $notification['cc'] ) ) {
                  $cc_value = $notification['cc'];
              } else {
                  $cc_value = null;
              }

              if( !empty( $notification['bcc'] ) ) {
                  $bcc_value = $notification['bcc'];
              } else {
                  $bcc_value = null;
              }

              if( is_array( $emails ) ) :
                  foreach( $emails as $keys => $values ) :

                      $to_emails = array_merge( $to_value, $cc_value, $bcc_value, array( trim( $values ) ) ); ;
                      $headers = array( 'Content-Type: text/html; charset=UTF-8' );

                      $datas = array (
                          'to' => $to_emails,
                          'subject' => isset( $notification['subject'] ) ? trim( $notification['subject'] ) : 'WP-GCF : Send All Notification',
                          'body' => isset( $notification['message'] ) ? trim( $notification['message'] ) : 'Send all notification email from wp-gcf form',
                          'headers' => $headers
                      );

                      send_email::data( $datas );

                  endforeach; 
              endif;
          }

          /**
           * INSERT OPTION : wp-gcf : SMTP

            add_action( 'phpmailer_init', 'my_phpmailer_example' );
            function my_phpmailer_example( $phpmailer ) {
                $phpmailer->isSMTP();     
                $phpmailer->Host = 'smtp.example.com';
                $phpmailer->SMTPAuth = true; // Force it to use Username and Password to authenticate
                $phpmailer->Port = 25;
                $phpmailer->Username = 'yourusername';
                $phpmailer->Password = 'yourpassword';

                // Additional settings…
                //$phpmailer->SMTPSecure = "tls"; // Choose SSL or TLS, if necessary for your server
                //$phpmailer->From = "you@yourdomail.com";
                //$phpmailer->FromName = "Your Name";
            }
          **/

          public static function insert_smtp_option () 
          {
              $inputs = input::post_is_object();

              $smtp_host = $inputs->value['wp-gcf-host'] !== false ? trim( $inputs->value['wp-gcf-host'] ) : 'smtp.example.com';
              $options[] = array( 'wp-gcf-host' => array( 'value' => $smtp_host ) );

              $smtp_auth = $inputs->value['wp-gcf-smtp-auth'] == 1 ? 1 : 2;
              $options[] = array( 'wp-gcf-smtp-auth' => array( 'value' => $smtp_auth ) );

              $smtp_port = $inputs->value['wp-gcf-port'] !== false ? intval( $inputs->value['wp-gcf-port'] ) : 25;
              $options[] = array( 'wp-gcf-port' => array( 'value' => $smtp_port ) );

              $smtp_user = $inputs->value['wp-gcf-user'] !== false ? trim( $inputs->value['wp-gcf-user'] ) : 'yourusername';
              $options[] = array( 'wp-gcf-user' => array( 'value' => $smtp_user ) );

              $smtp_pass = $inputs->value['wp-gcf-pass'] !== false  ? trim( $inputs->value['wp-gcf-pass'] ) : 'yourpassword';
              $options[] = array( 'wp-gcf-pass' => array( 'value' => $smtp_pass ) );

              $smtp_secure = $inputs->value['wp-gcf-smtp-secure'] == 1 ? 'ssl' : 'tls';
              $options[] = array( 'wp-gcf-smtp-secure' => array( 'value' => $smtp_secure ) );

              $smtp_from = $inputs->value['wp-gcf-from'] !== false  ? trim( $inputs->value['wp-gcf-from'] ) : 'you@yourdomail.com';
              $options[] = array( 'wp-gcf-from' => array( 'value' => $smtp_from ) );

              $smtp_from_name = $inputs->value['wp-gcf-from-name'] !== false  ? trim( $inputs->value['wp-gcf-from-name'] ) : 'Your Name';
              $options[] = array( 'wp-gcf-from-name' => array( 'value' => $smtp_from_name ) );

              self::insert_options( $options );
          }

          // https://developer.wordpress.org/reference/functions/wp_mail/

          public static function smtp_action_send () 
          {
              $html = null;
              $inputs = input::post_is_object();

              if( isset( $inputs->action ) ) 
              {
                  $from = get_option( 'wp-gcf-from' ) !== false ? get_option( 'wp-gcf-from' ) : 'you@yourdomail.com';

                  $to = $from;  
                  $subject = 'SMTP Test Subject';
                  $body = 'STMP Email body content';
                  $headers = array('Content-Type: text/html; charset=UTF-8');

                  if( wp_mail( $to, $subject, $body, $headers ) == true ) 
                  {
                      $html .= __( 'SMTP Send : Success', 'title' );
                  } else {
                      $html .= __( 'SMTP Send : Failed', 'title' );
                  }
              }

              _e( $html, 'print' );
          }

          // QUICK EDIT : inline update

          public static function quick_update_fields_form () 
          {
              $inputs = input::post_is_object();

              var_dump( $inputs );
          }

          // ACTION : SETUP 

          public static function option_action_setup () 
          {
              $inputs = input::post_is_object(); 
              $action_id = intval( $inputs->value['action_id'] );
              $action_setup = $inputs->value['action_setup'];

              if ( $action_id == 0 ) { 
                self::option_action_setup_action( $inputs );
              } else if ( $action_id == 1 ) {
                self::option_action_setup_delete( $action_setup );
              } else if ( $action_id == 2 ) {
                self::option_action_setup_move( $action_setup );
              }
          }

          public static function option_action_setup_action ( $inputs=null ) 
          {
                $action_setup = $inputs->value['action_setup'];
                if( $action_setup == 0 ) 
                {
                    $value = $inputs->value['value'];

                    load::view( 'admin/manager/center' );
                    _e( manager_list::form( $value ), 'manager-list' );
                }     
          }

          public static function option_action_setup_delete ( $actions=null ) 
          {
              if( is_array( $actions ) ) 
              {
                  foreach( $actions as $keys => $values ) :
                      self::deletes( self::$tbls['gcf'], array( 'id' => intval( $values ) ), array( '%d' ) );
                  endforeach;
              }
          }

          public static function option_action_setup_move ( $actions=null ) 
          {
              $status = 'trash';

              if( is_array( $actions ) ) 
              {
                  foreach( $actions as $keys => $values ) :

                      self::updates( self::$tbls['gcf'],

                          array( 'status' => $status ), 

                          array( 'id' => $ids ) ,

                          array( '%s' ),

                          array( '%d' )
                      );  

                  endforeach;
              }
          }

          // ENTRIES : SETTING FIELDS

          public static function entries_setting_form () 
          {
              $inputs = input::post_is_object();

              $fields = serialize( $inputs->value['fields'] );
              $ids = intval( $inputs->value['form_id'] );

              if( $ids !=0 ) 
              {

                  $rows = db::query_settings( $ids );
                  $form_id = isset( $rows[0]->form_id ) ? intval( $rows[0]->form_id ) : null;

                  if( is_null( $form_id ) ) :

                      self::inserts( self::$tbls['gcf-settings'],

                          array( 'form_id' => $ids, 'entries_settings' => $fields ), 

                          array( '%d', '%s' )
                      );

                  else :

                      $tbl_id = isset( $rows[0]->id ) ? intval( $rows[0]->id ) : null;

                      self::updates( self::$tbls['gcf-settings'],

                          array( 'entries_settings' => $fields ), 

                          array( 'id' => $tbl_id ) ,

                          array( '%s' ),

                          array( '%d' )
                      ); 

                  endif;

              }
          }

          public static function entries_delete_data () 
          {
              $inputs = input::post_is_object();
              $action = $inputs->action;

              if( $action ) 
              {
                  $value = $inputs->value;

                  foreach( $value as $keys => $results ) :
                      self::deletes( self::$tbls['gcf-entries'], array( 'id' => intval( $results ) ), array( '%d' ) );
                  endforeach;
              }
          }

          // FRONTEND : get field data insert : entries

          public static function get_field_data () 
          {
              $inputs = input::post_is_object();
              $values = $inputs->value;

              $form_id = intval( $values['form_id'] );
              $form_data = serialize( $values['data'] );

              // insert entries
              self::inserts( self::$tbls['gcf-entries'],

                  array( 'entries' => $form_data, 'form_id' => $form_id ), 

                  array( '%s', '%d' )
              );


              // email data entries
              load::view( 'front/front-email' );
              $body = front_email::template( $values );

              $rows = db::query_rows_id( $form_id );
              $notification = unserialize( $rows->notification );

              if( !empty( $notification['to'] ) ) {
                  $to_value = $notification['to'];
              } else {
                  $to_value = null;
              }

              if( !empty( $notification['cc'] ) ) {
                  $cc_value = $notification['cc'];
              } else {
                  $cc_value = null;
              }

              if( !empty( $notification['bcc'] ) ) {
                  $bcc_value = $notification['bcc'];
              } else {
                  $bcc_value = null;
              }

              $to_emails = array_merge( $to_value, $cc_value, $bcc_value );
              $headers = array( 'Content-Type: text/html; charset=UTF-8' );

              $datas = array (
                  'to' => $to_emails,
                  'subject' => isset( $notification['subject'] ) ? trim( $notification['subject'] ) : 'WP-GCF : Send Notification',
                  'body' => isset( $notification['message'] ) ? trim( $notification['message'] ) . __( $body, 'body-form' ) : 'Send notification email from wp-gcf form', 
                  'headers' => $headers
              );

              send_email::data( $datas );

          }
          
          // END
     }
}
?>