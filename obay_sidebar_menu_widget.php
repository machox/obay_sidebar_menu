<?php namespace obay\libs;

use obay\libs\obay_sidebar_navwalker;

class obay_sidebar_menu_widget extends \WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'obay_sidebar_menu_widget', // Base ID
			__('Menu Sidebar'), // Name
			array( 'description' => __('Menu Sidebar'), ) // Args
		);
	}

	function form($instance) {
		?>
		<div style="margin-top:20px;margin-bottom:15px;">
		Select menu : 
		<select id="<?php echo $this->get_field_id( 'sidebar_menu' ); ?>" name="<?php echo $this->get_field_name( 'sidebar_menu' ); ?>">
		<?php
		$menus = get_registered_nav_menus();
		foreach ( $menus as $location => $description ) {
			$selected = "";
			if($location == $instance['sidebar_menu']) $selected = "selected='selected'";
			echo '<option value="'.$location.'" '.$selected.'>'.$description .'</option>';
		}
		?>
		</select>
		</div>
		<?php
	}

	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['sidebar_menu'] = $new_instance['sidebar_menu'];
		return $instance;
	}

	function widget($args, $instance) {
		/* Before widget (defined by themes) */
		echo $args['before_widget'];

		if ( has_nav_menu( $instance['sidebar_menu'] ) ) :

			$sidebar = array(
				'theme_location'  	=> $instance['sidebar_menu'],
				'menu'            	=> $instance['sidebar_menu'],
				'walker' => new obay_sidebar_navwalker(),
				'container' => false,
				'items_wrap' => '<div id="obay-cssmenu"><ul>%3$s</ul></div>'
			);

			wp_nav_menu( $sidebar );
		endif;

		/* After widget (defined by themes). */
		echo $args['after_widget'];
	}
}
?>