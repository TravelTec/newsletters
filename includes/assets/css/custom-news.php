<?php 
	define( 'ABSPATH', 'http://'.$_SERVER['HTTP_HOST'] );
    include( ABSPATH . '/wp-includes/theme.php' );
	echo get_background_color();
	 
	?> 