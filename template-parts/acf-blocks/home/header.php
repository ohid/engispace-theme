<?php
/**
 * Header Block
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'es-home-header-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'es-home-header es-py-10';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$heading = get_field( 'heading' );
$information_row = get_field( 'information_row' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="es-full-overlay"></div>
    <div class="es-site-container">
        <div class="es-home-header-inner es-flex es-gap-14 es-items-center">
            <div class="es-pr-18">
                <h3 class="es-text-white es-pr-10">Equipping professionals in all things <strong>automation</strong></h3>
                <p class="es-text-white es-mt-14">EngiSPACE strives to increase your productivity from community forums, training resources and code exchange. Being your best self has never been easier. The future belongs to those who begin to invest in themselves and others.</p>
            </div>
            <div class="es-min-w-96">
                <div class="es-header-signup-form es-bg-white es-p-7 es-rounded-md">
                    <form action="">
                        <div class="es-form-group">
                            <label for="header-email" class="es-text-sm es-font-medium es-block">Email</label>
                            <input type="email" name="email" id="header-email" class="es-rounded-md es-border-gray-300 es-border es-w-full es-h-12 es-p-2 es-mt-1 focus:outline-none">
                        </div>
                        <div class="es-form-group es-mt-6">
                            <label for="header-password" class="es-text-sm es-font-medium es-block">Password</label>
                            <input type="password" name="password" id="header-password" class="es-rounded-md es-border-gray-300 es-border es-w-full es-h-12 es-p-2 es-mt-1 focus:outline-none"/>
                        </div>
                        <div class="es-form-group es-mt-6">
                            <label for="header-pasword-confirm" class="es-text-sm es-font-medium es-block">Password Confirm</label>
                            <input type="password" name="password" id="header-pasword-confirm" class="es-rounded-md es-border-gray-300 es-border es-w-full es-h-12 es-p-2 es-mt-1 focus:outline-none"/>
                        </div>
                        <div class="es-submit-btn">
                            <button type="submit" class="es-h-12 es-w-full es-rounded-md es-mt-6 es-block">Sign up</button>
                        </div>
                        <div class="es-form-footer es-mt-7  es-text-center">
                            <span class="es-text-sm es-text-slate-400 es-leading-3">By clicking 'Sign up' you agree to our <a href="">terms of service</a> and <a href="">privacy statement</a> </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>