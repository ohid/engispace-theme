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
        $user_obj->set_role( 'edd_subscriber' );
        $user_obj->set_role( 'engispace_user_' . $membership_type );

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
}