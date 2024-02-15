<?php
add_action('acf/init', 'mah_acf_blocks_init');

function mah_acf_blocks_init() {
        // Register product UI block.
            register_block_type( get_stylesheet_directory() . '/blocks/product-ui' );
}
