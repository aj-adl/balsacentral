<div class="<?php if ( 1 == $required ) echo 'required-product-addon'; ?> product-addon product-addon-<?php echo sanitize_title( $name ); ?>">

	<?php do_action( 'wc_product_addon_start', $addon ); ?>

    <div class="vc_toggle vc_toggle_square vc_toggle_color_default vc_toggle_color_inverted vc_toggle_size_lg">

	<?php if ( $name ) : ?>
        <div class="vc_toggle_title"><h4 class="addon-name"><?php echo wptexturize( $name ); ?> <?php if ( 1 == $required ) echo '<abbr class="required" title="required">*</abbr>'; ?></h4><i class="vc_toggle_icon"></i></div>
	<?php endif; ?>
        <div class="vc_toggle_content">
	<?php if ( $description ) : ?>
		<?php echo '<div class="addon-description">' . wpautop( wptexturize( $description ) ) . '</div>'; ?>
	<?php endif; ?>

	<?php do_action( 'wc_product_addon_options', $addon ); ?>
