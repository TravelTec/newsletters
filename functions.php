<?php  



/*



Plugin Name: Voucher Tec - Newsletters



Plugin URI: https://github.com/TravelTec/newsletters



GitHub Plugin URI: https://github.com/TravelTec/newsletters



Description: Voucher Tec - Newsletters é um plugin de geração de formulário de newsletter integrado ao painel de revenda do e-mail marketing do fornecedor Locaweb.


  
Version: 1.0.1 



Author: Travel Tec



Author URI: https://traveltec.com.br



License: GPLv2



*/



      


    require_once 'plugin-update-checker-4.10/plugin-update-checker.php'; 

     
    require_once plugin_dir_path(__FILE__) . 'includes/code-functions.php';
    require_once plugin_dir_path(__FILE__) . 'includes/options-functions.php'; 


class Newsletters {

    function __construct() {
    $this->options = get_option( 'news_widget' );
    $this->plugin_file = __FILE__;
    $this->plugin_basename = plugin_basename( $this->plugin_file ); 


    add_action( 'admin_init', array( &$this, 'newsletters_update_checker_setting') ); 

    add_action('wp_head' , array( &$this, 'newsletters_recom_css') ); 
  }

/**
       * Get specific option from the options table
       *
       * @param string $option Name of option to be used as array key for retrieving the specific value
       * @return mixed
       * @since 0.1
       */
      function get_option( $option, $options = null ) {
        if ( is_null( $options ) )
          $options = &$this->options;
        if ( isset( $options[$option] ) )
          return $options[$option];
        else
          return false;
      }






    function newsletters_update_checker_setting() {



        if ( ! is_admin() || ! class_exists( 'Puc_v4_Factory' ) ) { 

            return; 

        } 



        $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker( 

            'https://github.com/TravelTec/newsletters', 

            __FILE__, 

            'newsletters' 

        ); 



        // (Opcional) Set the branch that contains the stable release. 

        $myUpdateChecker->setBranch('vouchertec-newsletters');



    }



    function newsletters_recom_css(){
        wp_enqueue_style('newsletters-css', plugin_dir_url(__FILE__).'includes/assets/css/style.css'); 
        wp_enqueue_style('newsletters-custom-css', plugin_dir_url(__FILE__).'includes/assets/css/style.css'); 

        wp_enqueue_script('newsletters-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
        wp_enqueue_script('newsletters-sweetalert', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js');
        wp_enqueue_script('newsletters-google', 'https://www.google.com/recaptcha/api.js?hl=pt-BR'); 
        wp_enqueue_script('newsletters-submit', plugin_dir_url(__FILE__).'includes/assets/js/scripts.js'); 
    }


}
    new NewslettersAdmin();