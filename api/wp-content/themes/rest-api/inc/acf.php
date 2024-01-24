<?php
// function keen_scripts_styles() {
// 	if(is_admin()) :
//         echo WP_CONTENT_DIR;
//     wp_enqueue_style( 'acf-custom.css',  WP_CONTENT_DIR  . '/plugins/advanced-custom-fields-pro/assets/css/acf-custom.css', array(), '1.0.0');
//     endif;
// }
// add_action( 'admin_enqueue_scripts', 'keen_scripts_styles' );

function my_acf_admin_head() {
    ?>
    <style type="text/css">
    /* .col-group > div.acf-input > .acf-fields {
  display: flex !important;
}
.col-group > div.acf-input > .acf-fields .dyn-col {
  flex: auto !important;
}

.col-group > div.acf-input > .acf-fields > .dyn-col {
  flex: auto !important;
} */
div[data-name="col_container"] .values.ui-sortable {
  display:flex;
  background: pink;
}
div[data-name="col_container"] .values.ui-sortable .layout {
  flex:auto;
  margin-top: 0 !important;
}

#col-1,
.dyn-col {
  flex: auto !important;
}
    </style>
    <?php
    //wp_enqueue_style( 'acf-custom.css',  WP_CONTENT_DIR  . '/plugins/advanced-custom-fields-pro/assets/css/acf-custom.css', array(), '1.0.0');
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

//Add Custom JS for ACF

function custom_acf_enqueue_scripts() {

	wp_enqueue_script( 'acf-custom', get_template_directory_uri() . '/assets/js/acf-custom.js', array(), '1.0.0', true );

}

add_action('acf/input/admin_enqueue_scripts', 'custom_acf_enqueue_scripts');


 /**
 * Register Blocks
 * @link https://www.billerickson.net/building-gutenberg-block-acf/#register-block
 *
 */
function be_register_blocks() {

	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'product-ui',
		'title'			=> __( 'Product UI', 'clientname' ),
		'render_template'	=> 'partials/block-prod-ui.php',
		'category'		=> 'formatting',
		'icon'			=> 'admin-users',
		'mode'			=> 'auto',
		'keywords'		=> array( 'profile', 'user', 'author' )
	));

}
add_action('acf/init', 'be_register_blocks' );

/**
 * Custom JS for WP ACF Admin
 *
 */

 function mah_acf_enqueue_scripts() {

  wp_enqueue_script( 'acf-custom-js', get_template_directory_uri() . '/assets/js/acf-custom.js', array(), '1.0.0', true );

}
/**
 * Custom CSS for WP ACF Admin
 *
 */
function mah_acf_admin_head() {
	wp_enqueue_style( 'acf-custom-css', get_template_directory_uri() . '/assets/css/acf-custom.css', array(), '1.0.0', '' );
}

add_action('acf/input/admin_head', 'mah_acf_admin_head');

// add_action( 'acf/init', "rm_content_editor");

// function rm_content_editor () {
//   //remove_post_type_support( 'post', 'editor' );
//   //remove_post_type_support( 'page', 'editor' );
// };