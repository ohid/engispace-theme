<?php 

namespace Engispace\Components;

use Stripe\StripeClient;
use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Course_Purchase implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'course_purchase';
	}

    public function initialize() {
        add_action( 'wp_ajax_es_course_purchase_url', array( $this, 'course_purchase_url' ) );
        add_action( 'wp_ajax_nopriv_es_course_purchase_url', array( $this, 'course_purchase_url' ) );
       
        add_action( 'wp_ajax_es_free_course_purchase', array( $this, 'free_course_purchase' ) );
        add_action( 'wp_ajax_nopriv_es_free_course_purchase', array( $this, 'free_course_purchase' ) );
    }

    /**
     * Create Stripe session and get checkout page URL
     * 
     * @since 1.0.0
     * 
     */
    public function course_purchase_url() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer( 'es_nonce', 'nonce' ); // Check nonce

        $course_id = (int) $_POST['course_id'];
        // create the session arguments
        $session_args = $this->stripe_payment_session_args( $course_id );
        $api_key = 'sk_test_PpmKa2L8wZC7T2ihabo5Ex0W';

        try {
            $stripe = new StripeClient( $api_key );
            $session = $stripe->checkout->sessions->create( $session_args );
        } catch ( Exception $e ) {

        }
        
        if ( empty( $session['url'] ) ) {
            wp_send_json_error();
            die;
        }

        wp_send_json_success( $session['url'] );
        die;
    }

    /**
     * Prepare the session arguments for Stripe to create session
     * 
     * @since 1.0
     * 
     * @return array $session_args
     */
    public function stripe_payment_session_args( $course_id ) {
        // Get the product data
        $course = get_post( $course_id );
        if ( !$course ) {
            return;
        }
        $product_title = $course->post_title;
        $product_description = get_post_meta( $course->ID, 'es_course_short_description', true );
        $price_args = learndash_get_course_price( $course->ID );
        if ( isset( $price_args['type'] ) && $price_args['type'] === 'paynow' ) {
            $product_price = esc_html( $price_args['price'] );
        }
        $success_page_url = get_site_url() . '/course-payment-success?session_id={CHECKOUT_SESSION_ID}&course_id=' . es_custom_encrypt_value($course->ID);
        $error_page_url = get_site_url() . '/course-payment-error?session_id={CHECKOUT_SESSION_ID}&course_id=' . es_custom_encrypt_value($course->ID);

        $product_price = (int) $product_price * 100;

        $session_args = [
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => [
                            'name' => esc_html( $product_title ),
                            'description' => esc_html( $product_description )
                        ],
                        'tax_behavior' => 'exclusive',
                        'unit_amount' => $product_price
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment',
            'success_url' => $success_page_url,
            'cancel_url' => $error_page_url,
        ];

        // get the course creator user ID
        $creator_user_id = get_post_meta( $course->ID, '_es_course_creator_id', true );
        // if the course doesn't have an ID then return the current session arguments
        if ( !$creator_user_id ) {
            return $session_args;
        }
        $creator_user_stripe_connect_id = get_user_meta( $creator_user_id, '_es_creator_stripe_connect_id', true );
        if ( $creator_user_stripe_connect_id ) {
            $session_args['payment_intent_data'] = [
                'application_fee_amount' => $this->es_get_course_fee_marketplace_amount( $product_price ),
                'transfer_data' => [
                    'destination' => $creator_user_stripe_connect_id,
                    'amount' => $this->es_get_course_fee_creator_amount( $product_price )
                ]
            ];
        }

        return $session_args;
    }

    public function es_get_course_fee_marketplace_amount( $price ) {
        $marketplace_fee_percentage = get_field( 'course_items_marketplace_fees', 'option' );
        $marketplace_fee_percentage = (int) $marketplace_fee_percentage['marketplace_fee_percentage'];

        return $price * $marketplace_fee_percentage / 100;
    }

    public function es_get_course_fee_creator_amount( $price ) {
        $creator_fee_percentage = get_field( 'course_items_marketplace_fees', 'option' );
        $creator_fee_percentage = (int) $creator_fee_percentage['creator_fee_percentage'];

        return $price * $creator_fee_percentage / 100;
    }

    /**
     * Process next things after a course is purchased by an user
     * 
     * @since 1.0.0
     */
    public static function process_course_after_purchase() {
        $course_id = isset( $_GET['course_id'] ) ? $_GET['course_id'] : false;
        $course_id = es_custom_decrypt_value( $course_id );
        $course_post = get_post( $course_id );

        if ( !is_user_logged_in() || !$course_post ) {
            return;
        }

        // Enable access to the course for the user
        self::enable_course_access( $course_post->ID );

        self::record_course_purchase_data( $course_post );
    }

    /**
     * Enable course access to the logged in user
     * 
     * @since 1.0.0
     */
    public static function enable_course_access( $course_id ) {
        ld_update_course_access( get_current_user_id(), $course_id );
    }

    public static function record_course_purchase_data( $course ) {
        $api_key = 'sk_test_PpmKa2L8wZC7T2ihabo5Ex0W';
        $session_id = isset( $_GET['session_id'] ) ? sanitize_text_field( $_GET['session_id'] ) : '';
        if ( !$session_id ) {
            return;
        }
        try {
            $stripe = new StripeClient( $api_key );
            $stripe->checkout->sessions->retrieve( $session_id );
        } catch ( Exception $e ) {

        }
    }

    /**
     * Ability to purchase free course
     * 
     * @since 1.0.0
     */
    public function free_course_purchase() {
        if ( !wp_doing_ajax() ) {
            return;
        }
        check_ajax_referer( 'es_nonce', 'nonce' ); // Check nonce
        $course_id = (int) $_POST['course_id'];
        $course = get_post( $course_id );
        if ( !$course ) {
            return;
        }

        $success_page_url = get_site_url() . '/course-payment-success?course_id=' . es_custom_encrypt_value($course->ID);

        wp_send_json_success( $success_page_url );
    }

}