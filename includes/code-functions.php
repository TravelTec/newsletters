<?php 



/*

 * Add my new menu to the Admin Control Panel

 */



// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class wpb_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'wpb_widget', 
 
// Widget name will appear in UI
__('Formulário de news', 'wpb_widget_domain'), 
 
// Widget description
array( 'description' => __( 'Widget para gerar formulário de newsletter integrado à Locaweb.', 'wpb_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );

$options = get_option('news_widget');  

if (empty($options['id_conta'])) {
	$token = '';
}else{
	$id_conta = $options['id_conta'];
	$chave = $options['chave'];
	$token = base64_encode($id_conta.';'.$chave); 
} 

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

$div_form = '<div class="sidebar-widget"> 
<div class="section-header"><h3 class="widget-title">'.$options['titulo'].'</h3><span></span></div>  
			<p style="border-bottom: none">
				<input type="text" id="name_news" class="form-control" aria-describedby="name_news" placeholder="Nome" />
					</li>
							<p style="border-bottom: none">
				<input type="text" id="email_news" class="form-control" aria-describedby="email_news" placeholder="E-mail" />
					</p>
							<p style="border-bottom: none">
				<div class="g-recaptcha" data-sitekey="6LdsV2oUAAAAAC_bGVgCScUNOQoEHNYfI7e7qCwP"></div>
					</p>
							<p style="border-bottom: none">
				<button class="btn btn-primary btn-news-widget" onclick="recaptchaCallback()">Cadastrar</button>
					</p>  
				 <input type="hidden" id="token" value="'.$token.'" name="" />
		</div>';
 
// This is where you run the code and display the output
echo __( $div_form, 'wpb_widget_domain' );
echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
}
}
// Widget admin form