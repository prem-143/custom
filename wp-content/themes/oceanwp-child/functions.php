<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


function filter_add_to_cart_text( $arg1, $product ) {

	global $product;

	if ( function_exists( 'method_exists' ) && method_exists( $product, 'get_id' ) ) {
		$prod_id = $product->get_id();
	} else {
		$prod_id = $product->id;
	}

	return sprintf(
		'<a rel="nofollow" href="%1$s" data-quantity="%2$s" data-product_id="%3$s" data-product_sku="%4$s" class="%5$s btn btn-just-icon btn-simple btn-default" title="%6$s">Buy Now</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $prod_id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_attr( $product->add_to_cart_text() )
	);
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'filter_add_to_cart_text', 10, 2 );


function sv_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() ) {
        return false;
    }

    return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );





add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
   function wcs_woo_remove_reviews_tab($tabs) {
   unset($tabs['reviews']);
   return $tabs;
}

if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_move_wishlist_button' ) ){
	function yith_wcwl_move_wishlist_button(  ){
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'yith_wcwl_move_wishlist_button' );
}




function disable_coupon_field_on_cart( $enabled ) {
	if ( is_cart() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'disable_coupon_field_on_cart' );

function disable_coupon_field_on_checkout( $enabled ) {
	if ( is_checkout() ) {
		$enabled = false;
	}
	return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'disable_coupon_field_on_checkout' );


add_filter( 'woocommerce_shipping_fields', 'misha_remove_billing_fields' );

function misha_remove_billing_fields( $fields ) {

	unset( $fields[ 'shipping_address_2' ] ); // or shipping_address_2 for woocommerce_shipping_fields hook
	return $fields;

}


add_filter( 'woocommerce_shipping_fields' , 'misha_change_fname_field' );

function misha_change_fname_field( $fields ) {

	$fields['first_name']['label'] = 'Phone';
        $fields['first_nam']['label'] = 'email;';
	$fields['first_name']['placeholder'] = 'Your Mob Number';
$fields['first_nam']['placeholder'] = 'Your Email';

        $fields[ 'first_name' ]['required'] = true;
 $fields[ 'first_nam' ]['required'] = true;

	return $fields;

}



add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="my_custom_checkout_field"><h2>' . __('My Field') . '</h2>';

    woocommerce_form_field( 'my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Delivery Note'),
        'placeholder'   => __('Notes'),
        ), $checkout->get_value( 'my_field_name' ));

    echo '</div>';

}

add_action( 'woocommerce_checkout_process', 'woo_add_custom_general_fs_save', 30, 1 );

function woo_add_custom_general_fs_save( $post_id ){

	// Number Field
	$woocommerce_ner_field = $_POST['my_field_name'];


	if( !empty( $woocommerce_number_field ) )
	{
		update_post_meta( $post_id, 'my_field_name', esc_attr( $woocommerce_ner_field ) );

	}
}




add_action('woocommerce_view_order', 'woo_add_custom_general_fild_display' );


		function woo_add_custom_general_fild_display()
		{


// You can also use
echo get_post_meta( get_the_ID(), 'my_field_name', true );

		}










add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');





add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['my_field_name'] ) ) {
        update_post_meta( $order_id, 'My Field', sanitize_text_field( $_POST['my_field_name'] ) );
    }
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('My Field').':</strong> ' . get_post_meta( $order->id, 'My Field', true ) . '</p>';
}

add_filter( 'woocommerce_get_price_suffix', 'bbloomer_add_price_suffix', 99, 4 );

function bbloomer_add_price_suffix( $html, $product, $price, $qty ){

   if ( is_product() ) {

      $html .= '<span class="price-inc-vat">';
             $html .= ' ( ';
      $html .= $priceIncVat;
      $html .= ' PRICE EXCLUDING GST)';
       return $html;
   }
};




add_action( 'woocommerce_product_options_inventory_product_data', 'woo_add_custom_general_fields' );
function woo_add_custom_general_fields() {

    echo '<div class="options_group">';

    woocommerce_wp_select( array( // Text Field type
        'id'          => '_Stan',
        'label'       => __( 'Delivery Day Type', 'woocommerce' ),
        'description' => __( 'Podaj stan plyty.', 'woocommerce' ),
        'desc_tip'    => true,
        'options'     => array(
            ''        => __( 'Select product condition', 'woocommerce' ),
            'Days'    => __('Days', 'woocommerce' ),
            'Week' => __('Week', 'woocommerce' ),
        )
    ) );

    echo '</div>';
}

add_action( 'woocommerce_product_options_inventory_product_data', 'woo_add_custom_general_field' );
function woo_add_custom_general_field() {

    echo '<div class="options_group">';

    woocommerce_wp_text_input(
	array(
		'id'                => '_number_field',
		'label'             => __( 'Delivery Days', 'woocommerce' ),
		'placeholder'       => '',
		'description'       => __( 'Enter the custom value here.', 'woocommerce' ),
		'type'              => 'number',
		'custom_attributes' => array(
				'step' 	=> 'any',
				'min'	=> '0'
			)
	)
);


    echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save', 30, 1 );

function woo_add_custom_general_fields_save( $post_id ){

	// Number Field
	$woocommerce_number_field = $_POST['_number_field'];
	$woocommerce_Stan_field = $_POST['_Stan'];

	if( !empty( $woocommerce_number_field ) )
	{
		update_post_meta( $post_id, '_number_field', esc_attr( $woocommerce_number_field ) );
	    update_post_meta( $post_id, '_Stan', esc_attr( $woocommerce_Stan_field ) );
	}
}




add_action('woocommerce_after_add_to_cart_button', 'woo_add_custom_general_field_display' );


		function woo_add_custom_general_field_display()
		{


// You can also use
echo get_post_meta( get_the_ID(), '_number_field', true );
echo get_post_meta( get_the_ID(), '_Stan', true );
		}



add_filter('woocommerce_before_add_to_cart_form','fn_add_to_user_name');

function fn_add_to_user_name()
{
    echo get_the_author_meta('nicename');
}


add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

    // Adds the new tab

    $tabs['test_tab'] = array(
        'title'     => __( 'Product Enquiry', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_new_product_tab_content'
    );

    return $tabs;

}
function woo_new_product_tab_content()  {

echo do_shortcode('[contact-form-7 id="73" title="Contact form 1"]');
echo '</div>';
}



add_action('wp_ajax_enquiry_form_submit','enquiry_form_submit');
add_action('wp_ajax_nopriv_enquiry_form_submit','enquiry_form_submit');

function enquiry_form_submit(){
    if(isset($_POST['name']))
{
    global $wpdb;
     $data_array = array(
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'phone'=>$_POST['phone'],
            'message'=>$_POST['message']
     );

     $table_name = 'form_entry';

     $rowResult = $wpdb->insert($table_name,$data_array);

     if($rowResult == 1)
     {
        echo "<h1>Form Submitted Successfully in Database !</h1>";
     }else
     {
        echo "Error Form Submission !";
     }
}
die;
}







?>
