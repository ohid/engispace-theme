<form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">
    <div class="es-form-control">
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search engispace', 'engispace' ); ?>">
    </div>
</form>