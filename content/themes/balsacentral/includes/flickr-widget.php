<?php
/* Display Flickr photostream. */

class balsacentral_Flickr_Widget extends WP_Widget {
	function balsacentral_Flickr_Widget() {
		$widget_ops = array( 'classname' => 'balsacentral_flickr', 'description' => __( 'A flickr widget to display your photostream from flickr.', 'balsacentral') );
		$this->WP_Widget( 'balsacentral-flickr', __( 'balsacentral Flickr Widget', 'balsacentral' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'balsacentral Flickr Widget', 'balsacentral' ) : $instance['title'], $instance, $this->id_base);
		$source = $instance['source'];
		$user_ID = $instance['user_ID'];
		$user_set_ID = $instance['user_set_ID'];
		$group_ID = $instance['group_ID'];
		$tag = $instance['tag'];
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
		$display_random = isset($instance['display_random']) ? $instance['display_random'] : false;
		if ( $display_random )
		 $display = 'random';
		 else
		 $display = 'latest';
		$text = $instance['text'];

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Start output */
		?>
        <div id="flickr_badge_wrapper">
        <?php
		echo $text;
		$default_query = 'count='.$number.'&display='.$display.'&size=s&layout=x&source='.$source;
		if ( ( $source == 'user' ) && ( $user_ID != '' ) )
			$user_query = '&user='.$user_ID;
		elseif ( ( $source == 'user_tag' ) && ( $user_ID != '' ) && ( $tag != '' ) )
			$user_query = '&user='.$user_ID.'&tag='.$tag;
		elseif ( ( $source == 'user_set' ) && ( $user_ID != '' ) && ( $user_set_ID != '' ) )
			$user_query = '&user='.$user_ID.'&set='.$user_set_ID.'&context=in%2Fset-'.$user_set_ID.'%2F';
		elseif ( ( $source == 'all_tag' ) && ( $tag != '' ) )
			$user_query = '&tag='.$tag;
		elseif ( ( $source == 'group' ) && ( $group_ID != '' ) )
			$user_query = '&group='.$group_ID;
		elseif ( ( $source == 'all' ) )
			$user_query = '';
		else
			$user_query = '';
		?>
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?<?php echo ( $default_query.$user_query ); ?>"></script>
        </div><!-- END FLICKR BADGE WRAPPER -->

	<?php	/* End output */
		echo $after_widget;
	}

	/* Update the widget settings. */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( in_array( $new_instance['source'], array( 'user', 'user_tag', 'user_set', 'all', 'all_tag', 'group' ) ) ) {
			$instance['source'] = $new_instance['source'];
		} else {
			$instance['source'] = 'user';
		}
		$instance['user_ID'] = strip_tags( $new_instance['user_ID'] );
		$instance['user_set_ID'] = strip_tags( $new_instance['user_set_ID'] );
		$instance['group_ID'] = strip_tags( $new_instance['group_ID'] );
		$instance['tag'] = strip_tags( $new_instance['tag'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['display_random'] = isset($new_instance['display_random']) ? true : false;
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( $new_instance['text'] );
		return $instance;
	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'source' => 'user', 'title' => '', 'user_ID' => '48531931%40N03', 'user_set_ID' => '72157624641855013', 'group_ID' => '', 'tag' => '', 'display_random' => false, 'text' => '' ) );
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
		$number = 9;
		$title = esc_attr( $instance['title'] );
		$user_ID = esc_attr( $instance['user_ID'] );
		$user_set_ID = esc_attr( $instance['user_set_ID'] );
		$group_ID = esc_attr( $instance['group_ID'] );
		$tag = esc_attr( $instance['tag'] );
		$text = format_to_edit($instance['text']);
		?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'balsacentral' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id('source'); ?>"><?php _e( 'Source:', 'balsacentral' ); ?></label>
            <select name="<?php echo $this->get_field_name('source'); ?>" id="<?php echo $this->get_field_id('source'); ?>" class="widefat">
            <option value="user"<?php selected( $instance['source'], 'user' ); ?>><?php _e( 'User', 'balsacentral' ); ?></option>
            <option value="user_tag"<?php selected( $instance['source'], 'user_tag' ); ?>><?php _e( 'User Tag', 'balsacentral' ); ?></option>
            <option value="user_set"<?php selected( $instance['source'], 'user_set' ); ?>><?php _e( 'User Set', 'balsacentral' ); ?></option>
            <option value="all"<?php selected( $instance['source'], 'all' ); ?>><?php _e( 'All', 'balsacentral' ); ?></option>
            <option value="all_tag"<?php selected( $instance['source'], 'all_tag' ); ?>><?php _e( 'All Tag', 'balsacentral' ); ?></option>
            <option value="group"<?php selected( $instance['source'], 'group' ); ?>><?php _e( 'Group', 'balsacentral' ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('user_ID'); ?>"><?php _e( 'User ID:', 'balsacentral' ); ?></label> <input type="text" value="<?php echo $user_ID; ?>" name="<?php echo $this->get_field_name('user_ID'); ?>" id="<?php echo $this->get_field_id('user_ID'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'This would be a Flickr photostream ID. Eg: 48531931%40N03, where %40 is replaced for @', 'balsacentral' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('user_set_ID'); ?>"><?php _e( 'User Set ID:', 'balsacentral' ); ?></label> <input type="text" value="<?php echo $user_set_ID; ?>" name="<?php echo $this->get_field_name('user_set_ID'); ?>" id="<?php echo $this->get_field_id('user_set_ID'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'If source is User Set, enter your User set Id.', 'balsacentral' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tag'); ?>"><?php _e( 'Tag:', 'balsacentral' ); ?></label> <input type="text" value="<?php echo $tag; ?>" name="<?php echo $this->get_field_name('tag'); ?>" id="<?php echo $this->get_field_id('tag'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'If source is User Tag or All Tag, enter a tag name. Eg: nature', 'balsacentral' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('group_ID'); ?>"><?php _e( 'Group ID:', 'balsacentral' ); ?></label> <input type="text" value="<?php echo $group_ID; ?>" name="<?php echo $this->get_field_name('group_ID'); ?>" id="<?php echo $this->get_field_id('group_ID'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'If source is Group, enter a Group ID. Example, 92076845@N00', 'balsacentral' ); ?>
            </small>
        </p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of photos to show:', 'balsacentral' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e( '(at most 10)', 'balsacentral' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id('display_random'); ?>"><?php _e( 'Display Random?', 'balsacentral' ); ?></label>
        <input class="checkbox" type="checkbox" <?php checked($instance['display_random'], true) ?> id="<?php echo $this->get_field_id('display_random'); ?>" name="<?php echo $this->get_field_name('display_random'); ?>" /><br />
		<small><?php _e( 'If unchecked, it will show latest photos.', 'balsacentral' ); ?></small></p>
		</p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e( 'Text to appear before gallery:', 'balsacentral' ); ?></label>
        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea><br />
		<small><?php _e( 'You can use basic HTML here.', 'balsacentral' ); ?></small></p>
		</p>
	<?php
	}
}
?>