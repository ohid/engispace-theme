<?php

namespace Engispace;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;


class Theme {
    
    /**
	 * Instance Control
	 *
	 * @var null
	 */
    private static $instance = null;

	/**
	 * Associative array of theme components, keyed by their slug.
	 *
	 * @var array
	 */
	public $components = array();

    public static function instance() {
		// Return if already instantiated.
		if ( self::is_instantiated() ) {
			return self::$instance;
		}

		// Setup the singleton.
		self::setup_instance();

		self::$instance->initialize();

		// Return the instance.
		return self::$instance;
    }

	/**
	 * Setup the singleton instance
	 *
	 * @access private
	 */
	private static function setup_instance() {
		self::$instance = new self();
	}

	/**
	 * Return whether the main loading class has been instantiated or not.
	 *
	 * @access private
	 * @return boolean True if instantiated. False if not.
	 */
	private static function is_instantiated() {
		// Return true if instance is correct class.
		if ( ! empty( self::$instance ) && ( self::$instance instanceof Theme ) ) {
			return true;
		}

		// Return false if not instantiated correctly.
		return false;
	}

    public function __construct() {
		$components = $this->get_default_components();

        foreach( $components as $component ) {
            if ( ! $component instanceof Component_Interface ) {
                throw new InvalidArgumentException(
					sprintf(
						/* translators: 1: classname/type of the variable, 2: interface name */
						__( 'The theme component %1$s does not implement the %2$s interface.', 'engispace' ),
						gettype( $component ),
						Component_Interface::class
					)
				);
            }
            
            $this->components[ $component->get_slug() ] = $component;
        }
    }

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 *
	 * This method must only be called once in the request lifecycle.
	 */
	public function initialize() {
		array_walk(
			$this->components,
			function( Component_Interface $component ) {
				$component->initialize();
			}
		);
	}


	/**
	 * Gets the default theme components.
	 *
	 * This method is called if no components are passed to the constructor, which is the common scenario.
	 *
	 * @return array List of theme components to use by default.
	 */
	protected function get_default_components() : array {
        $components = array(
            new Components\Styles(),
            new Components\Scripts()
        );
        
        return $components;
    }
}