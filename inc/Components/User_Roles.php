<?php 

namespace Engispace\Components;

use Engispace\Component_Interface;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class User_Roles implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'user_roles';
	}

    public function initialize() {
        add_action( 'init', [ $this, 'engispace_user_roles' ] );
    }

    /**
     * Add new user roles 
     * 
     * @since 1.0.0
     */
    public function engispace_user_roles() {
        // Pro user role
        add_role( 'engispace_user_pro', 'Engispace Pro', array( 'read' => true, 'level_0' => true ) );

        // Creator user role
        add_role( 'engispace_user_creator', 'Engispace Creator', array( 'read' => true, 'level_0' => true ) );
    }
}