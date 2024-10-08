<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Membership implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'membership';
	}

    public function initialize() {
        add_action( 'edd_after_payment_actions', [ $this, 'member_subscription' ], 10, 3 );
        add_action( 'edd_after_payment_actions_delay', [ $this, 'edd_payment_action_delay' ], 20, 1 );
        add_action( 'template_redirect', [ $this, 'membership_cart_empty' ], 10 );
    }

    /**
     * The $payment variable contains the EDD_Payment object that has been completed.
     * The $customer variable contains the EDD_Customer object that the payment belongs to.
    */
    public function member_subscription( $payment_id = 0, $payment = false, $customer = false ) {
        $cart_details = !empty( $payment->cart_details ) ? $payment->cart_details[0] : [];
        $membership_name = !empty( $cart_details['name'] );
        $membership_type = $this->get_membership_type( $membership_name );
        $user_id = !empty( $payment->user_id ) ? $payment->user_id : 0;

        // Update user role
        $this->update_user_role( $membership_type, $user_id );
    }

    public function edd_payment_action_delay( $payment_id ) {
        return 0;
    }

    /**
     * Update user role to the membership type they subscribed
     * 
     * @since 1.0.0
     * @param string $membership_type
     * @param integer $user_id
     * 
     * return null
     */
    public function update_user_role( $membership_type, $user_id ) {
        $user_obj = get_user_by( 'id', $user_id );
        if ( $membership_type === 'creator' ) {
            $user_obj->set_role( 'wdm_instructor' );
        }
        if ( $membership_type === 'pro' ) {
            $user_obj->set_role( 'engispace_user_' . $membership_type );
        }

        return;
    }

    /**
     * Get the membership type user subscribed to
     * 
     * @since 1.0.0
     * @param string $name
     * 
     * @return string $membership_type
     */
    public function get_membership_type( $name ) {
        $membership_type = 'creator';

        if ( strpos($name, 'Pro') !== false ){
            $membership_type = 'pro';
        }

        return $membership_type;
    }

    /**
     * Redirect to the pricing pages if the EDD checkout page is empty
     * 
     * @since 1.0.0
     */
    public function membership_cart_empty() {
        $cart       = function_exists( 'edd_get_cart_contents' ) ? edd_get_cart_contents() : false;
        $redirect   = site_url( 'pricing' ); // could be the URL to your shop
    
        if ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() && ! $cart ) {
            wp_redirect( $redirect, 301 ); 
            exit;
        }
    }
}