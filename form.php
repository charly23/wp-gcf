<?php if( ! class_exists( 'form' ) or wp_die ( 'error found.' ) ) 
{    
    class form extends input
    {
          public static $slug = 'wp_gcf';

          var $html = null;

                
          public function __construct() 
          {
               parent::__construct();
               
               new page_rounter( true );
               new html_var( true );
          }

          public static function page_title () 
          {
              $userdata = get_userdata( get_current_user_id() );
              $user_role = user_control::get_role();

              $page = self::get_is_object_element( 'page' );
              $name = wp_gcf_config::plugin_name(); 

              $label['wp_gcf'] = array( 
                  'title' => __( $name  . ' : Manager - ' . ucfirst ( $userdata->user_login ) . " ({$user_role})", 'wp-gcf' ) 
              );

              $ids = self::get_is_object_element( 'edit' );
              $add_new_titled = intval( $ids ) ? __( 'Edit Form', 'title' ) : __( 'Add New Form', 'title' );

              $label['add_new_wp_gcf'] = array( 
                  'title' => __( $name . ' : ' . $add_new_titled, 'wp-gcf' ) 
              );

              $label['entries_wp_gcf'] = array( 
                  'title' => __( 'WP GCF : Entries', 'wp-gcf' ) 
              );

              $label['smtp_wp_gcf'] = array( 
                  'title' => __( 'WP GCF : SMTP', 'wp-gcf' ) 
              );

              $label['setting_wp_gcf'] = array( 
                  'title' => __( 'WP GCF : Setting', 'wp-gcf' ) 
              );

              $label['help_wp_gcf'] = array( 
                  'title' => __( $name . ' : Help?', 'wp-gcf' ) 
              );

              return $label[$page]['title'];
          }

          public static function page_head () 
          {
              $userdata = get_userdata( get_current_user_id() );
              $user_role = user_control::get_role();
          }

          public static function page_body ( $page_class=null, $top=null, $inner=null, $bottom=null ) 
          {
              $html = null;

              if( $top != false AND ! is_null( $top ) )  
              {
                $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_inner-top ' . __( self::$slug ) . '_' . __( $page_class ) . '_inner-top' ) );
                $html .= __( $top, 'html' );
                $html .= html_var::_divend(); 
              }

              if( $inner != false AND ! is_null( $inner ) )  
              {
                $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_inner-center ' . __( self::$slug ) . '_' . __( $page_class ) . '_inner-center' ) );
                $html .= __( $inner, 'html' );
                $html .= html_var::_divend();  
              }
              
              if( $bottom != false AND ! is_null( $bottom ) ) 
              {
                $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_inner-bottom ' . __( self::$slug ) . '_' . __( $page_class ) . '_inner-bottom' ) );
                $html .= __( $bottom, 'html' );
                $html .= html_var::_divend(); 
              }

              if( $page_class == 'add_new' ) 
              {
                $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_inner-footer ' . __( self::$slug ) . '_' . __( $page_class ) . '_inner-footer' ) );
                $html .= static::page_foot();
                $html .= html_var::_divend(); 
              }

              return $html; 
          }

          public static function page_option_field ( $page_class=null ) 
          {
              $html = null;
 
              $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_top-action-option ' . __( self::$slug ) . '_' . __( $page_class ) . '_top-action-option' ) );

              $html .= html_var::_span( array( 'class' => 'option-btn') );
              $html .= __( 'Option', 'html' );
              $html .= html_var::_spanend();

              $html .= html_var::_span( array( 'class' => 'option-switch') );
              $html .= self::add_new_switch_user();
              $html .= html_var::_spanend();

              $html .= html_var::_divend(); 

              $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_top-field-option ' . __( self::$slug ) . '_' . __( $page_class ) . '_top-field-option' ) );
              $html .= self::add_new_inner_option();
              $html .= html_var::_divend(); 
              
              return $html;
          }

          public static function page_foot () 
          {
              $html = null;

              $html .= html_var::_div( array( 'class' => __( self::$slug ) . '_footer ' ) );
              $html .= __( 'Gravity Contact Form (GCF) &nbsp;', 'copy' );
              $html .= html_var::_a( array( 'class' => __( self::$slug ) . '_webiste-link', 'href' => 'https://charlycapillanes.wordpress.com/', 'target' => '_blank' ) );
              $html .= __( 'charlycapillanes.com', 'website' );
              $html .= html_var::_aend();
              $html .= html_var::_divend(); 


              return $html;
          }

          /**
           * form : manager
           * inner, html, style, ui
           * manager function handlers
          **/

          public static function manager_inner () 
          { 
              $html = null;

              $top = self::manager_inner_top();
              $inner = self::manager_inner_center();
              $bottom = self::manager_inner_bottom();

              $html .= self::page_body( 'manager', $top, $inner, $bottom );

              return $html;
          }

          public static function manager_inner_top () 
          {
              $html = null;
              load::view( 'admin/manager/option' );
              $html .= manager_option::form();
              return $html;
          }

          public static function manager_inner_center () 
          {
              $html = null;
              load::view( 'admin/manager/center' );
              $html .= manager_list::form();
              return $html;
          }

          public static function manager_inner_bottom () 
          {
              $html = null;
              $html .= self::page_foot();
              return $html;
          }

          /**
           * form : add new
           * inner, html, style, ui
           * add new function handlers
          **/

          public static function add_new_switch_user () 
          {
              $html = null;
              $html .= __( 'Switch', 'html' );
              load::view( 'admin/add_new/option' );
              $html .= add_new_option::form_switch();
              return $html;
          }

          public static function add_new_inner () 
          { 
              $html = null;
              $page = self::get_is_object_element( 'subpage' );

              $top = self::add_new_inner_top();
              $inner = self::add_new_inner_pager( $page );
              $bottom = self::add_new_inner_bottom();

              $html .= self::page_body( 'add_new', $top, $inner, $bottom );

              return $html;
          }

          public static function add_new_inner_top () 
          {
              $html = null;
              load::view( 'admin/add_new/top' );
              $html .= add_new_top::form();
              return $html;
          }

          public static function add_new_inner_center () 
          {
              $html = null;
              load::view( 'admin/add_new/center' );
              $html .= add_new_center::form();
              return $html;
          }

          /**
           * form : notification
           * inner, html, style, ui
           * add new function handlers
          **/

          public static function notification_center () 
          { 
              $html = null;

              load::view( 'admin/notification/center' );
              $html .= notification_center::form();

              return $html;
          }

          /**
           * form : confirmation
           * inner, html, style, ui
           * add new function handlers
          **/

          public static function confirmation_center () 
          { 
              $html = null;

              load::view( 'admin/confirmation/center' );
              $html .= confirmation_center::form();

              return $html;
          }

          /**
           * form : entries
           * inner, html, style, ui
           * add new function handlers
          **/

          public static function entries_top () 
          {
              $html = null;  

              load::view( 'admin/entries/top' );
              $html .= entries_top::form();
              
              return $html;
          }

          public static function entries_center () 
          { 
              $html = null;

              load::view( 'admin/entries/center' );
              $html .= entries_center::form();

              return $html;
          }

          /**
           * form : review
           * inner, html, style, ui
           * add new function handlers
          **/

          public static function review_center () 
          { 
              $html = null;

              load::view( 'admin/review/center' );
              $html .= review_center::form();

              return $html;
          }

          /**
           * form : add new - pager
           * inner, html, style, ui
           * add new function handlers
          **/

          public static function add_new_inner_pager ( $page=null ) 
          {
              $inner = null; 

              if( ! is_null( $page ) ) : switch( $page ) :
                  
                case 'notification' :
                $inner .= self::notification_center();
                break; 

                case 'confirmation' :
                $inner .= self::confirmation_center();
                break;  

                case 'entries' :
                $inner .= self::entries_center();
                break;  

                case 'review' :
                $inner .= self::review_center();
                break;   

                endswitch; else :

                $inner = self::add_new_inner_center();

              endif;

              return $inner;
          }

          public static function add_new_inner_bottom () 
          {
              $html = null;

              load::view( 'admin/add_new/bottom' );
              $html .= add_new_bottom::form();

              return $html;
          }

          public static function add_new_inner_option () 
          {
              $html = null;

              load::view( 'admin/add_new/option' );
              $html .= add_new_option::form();
              
              return $html;
          }

          /**
           * form : entries 
           * inner, html, style, ui
           * help function handlers
          **/

          public static function entries_inner () 
          {
              $html = null;

              $top = self::entries_top();
              $inner = self::entries_center();
              $bottom = self::page_foot();

              $html .= self::page_body( 'entries', $top, $inner, $bottom );

              return $html;
          }

          /**
           * form : smtp
           * inner, html, style, ui
           * help function handlers
          **/

          public static function smtp_inner () 
          { 
              $html = null;

              $top = __( 'SMTP Send : Message', 'default-message' );
              $inner = self::smtp_inner_center();
              $bottom = self::page_foot();

              $html .= self::page_body( 'smtp', $top, $inner, $bottom );

              return $html;
          }

          public static function smtp_inner_center () 
          {
              $html = null;
              load::view( 'admin/smtp/center' );
              $html .= smtp_center::form();
              return $html;
          }

          /**
           * form : setting   
           * inner, html, style, ui
           * setting function handlers
          **/

          public static function setting_inner () 
          { 
              $html = null;

              $top = __( 'Setting : Option', 'text' );;
              $inner = self::setting_inner_center();
              $bottom = self::page_foot();

              $html .= self::page_body( 'setting', $top, $inner, $bottom );

              return $html;
          }

          public static function setting_inner_center () 
          {
              $html = null;
              load::view( 'admin/setting/center' );
              $html .= setting_center::form();
              return $html;
          }

          /**
           * form : help
           * inner, html, style, ui
           * help function handlers
          **/

          public static function help_inner () 
          { 
              $html = null;

              $top = __( 'Instruction Manual', 'label' );
              $inner = self::help_center();
              $bottom = self::page_foot();

              $html .= self::page_body( 'help', $top, $inner, $bottom );

              return $html;
          }

          public static function help_center () 
          { 
              $html = null;

              load::view( 'admin/help/center' );
              $html .= help_center::form();

              return $html;
          }

          // END
    }
}
?>