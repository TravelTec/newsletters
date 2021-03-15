<?php

/**

 * Place order form.

 *

 * Responsible for creating shortcodes for place order form and mainatain it.

 *

 * @package    Wp_Travel_Engine

 * @subpackage Wp_Travel_Engine/includes

 * @author

 */

class Wp_Travel_Engine_Activities

{



	/**

	* Initialize the place order form shortcode.

	* @since 1.0.0

	*/

	function init()

	{

		add_shortcode( 'WP_TRAVEL_ENGINE_ACTIVITIES', array( $this, 'wp_travel_engine_activities_shortcodes_callback' ) );

		add_filter( 'body_class', array( $this, 'add_activities_body_class' ) );

	}



	function add_activities_body_class( $classes ) {

		global $post;

		if ( is_object( $post ) ) {

			if ( has_shortcode( $post->post_content, 'WP_TRAVEL_ENGINE_ACTIVITIES' ) ) {

				$classes[] = 'activities';

			}

		}



		return $classes;

	}



	/**

	* Place order form shortcode callback function.

	* @since 1.0

	*/

	function wp_travel_engine_activities_shortcodes_callback()

	{ 

		$retorno = '';



		$retorno .= '<div id="wte-crumbs">'; 

              $obj = new Wp_Travel_Engine_Functions();

              do_action('wp_travel_engine_breadcrumb_holder'); 



                    global $post; 

                    $termID = get_queried_object()->term_id; // Parent A ID

                    $taxonomyName = 'activities';

                    $order = apply_filters('wpte_activities_terms_order','ASC');

                    $orderby = apply_filters('wpte_activities_terms_order_by','date');

                    $termchildren = get_terms($taxonomyName, array('orderby' => $orderby, 'order' => $order));

        $retorno .= '</div>

        <section class="featured-trip" id="featured_section" style="">

    <div class="container" > 


                

        

                    <div class="grid grid-latest wow fadeInUp row" data-wow-duration="1s" data-wow-delay="0.1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">';

                         foreach ($termchildren as $child) {

                         	$term = get_term_by( 'id', $child->term_id, 'activities' ); 

                              $term_link = get_term_link( $term );

                              $child_term_description = term_description( $term, 'activities' ); 

                        $retorno .= '<div class="col col-12">

                            <div class="holder">                            

                                <div class="img-holder">

                                    <a href="http://wp01.montenegroev.com.br/?trip=olimpia-hot-beach">';

                                    $image_id = get_term_meta ( $child->term_id, 'category-image-id', true );

                                      if(isset($image_id) && $image_id !='')

                                      {

                                        $activities_thumb_size = apply_filters('wp_travel_engine_activities_img_size', 'activities-thumb-size');

                                        $image =  wp_get_attachment_image ( $image_id, $activities_thumb_size, false, array( 'itemprop' => 'image' ) );

                                        $retorno .= $image;

                                      }

                                      else{

                                        $retorno .= '<img width="400" height="250" src="'.esc_url(  WP_TRAVEL_ENGINE_IMG_URL . '/public/css/images/destination-page-fallback.jpg' ).'" class="attachment-travel-agency-blog size-travel-agency-blog wp-post-image" alt="" loading="lazy"> ';

                                      }

                                                                            $retorno .= '</a>                                                            </div>                          

                                <div class="text-holder" style="padding: 14px 0 14px;">

                                    <h3 class="title"><a href="'.esc_url( $term_link ).'">'.esc_attr( $term->name ).'</a></h3>

 

                                                                                                            <div class="btn-holder">

                                        <a href="'.esc_url( $term_link ).'" class="btn-more">Ver roteiros</a>

                                    </div>

                                                                    </div>

                            </div>

                        </div>';

                       }

                                    $retorno .= '</div> 

                    </div>

</section>';

		return $retorno;

	} 

}

