<?php
/*
Plugin Name: JP-Facebook
Plugin URI: http://www.jpreece.com/tutorials/wordpress/jp-facebook/
Description: Adds a Facebook 'Like' button to any page on your blog
Version: 0.4
Author: Jonathan Preece
Author URI: http://www.jpreece.com
License: GPL2
*/

/*  Copyright 2010 Jonathan Preece  (email : info@jpreece.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'jpfb_load_widgets' );

/* Function that registers our widget. */
function jpfb_load_widgets()
{
	register_widget( 'JPFB_Widget' );
}

class JPFB_Widget extends WP_Widget
{
	function JPFB_Widget()
	{
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jpfb', 'description' => 'Adds a Facebook "Like" button to your theme.');

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jpfb-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jpfb-widget', 'JP-Facebook', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		echo '<div style="text-align:center; width:200px; border: none"><iframe src="http://www.facebook.com/plugins/like.php?href=' . get_permalink() . '&amp;layout=button_count&amp;show_faces=true&amp;width=50&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border: none; width:70px; height:21px; padding:10px"></iframe></div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}
	
	function form( $instance )
	{
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

        <?php
	}        
}

function facebooklike_func()
{			
	echo '<iframe src="http://www.facebook.com/widgets/like.php?href=' . get_permalink() . '" 
        scrolling="no" frameborder="0" style="border:none; width:450px; height:25px; "></iframe>';
}

function get_fb_like_button()
{
	echo '<div id="fb-like-div" style="float:right; width:255px; border:none"><iframe src="http://www.facebook.com/widgets/like.php?href=' . get_permalink() . '" scrolling="no" frameborder="0" style="border:none; width:300px; height:25px; text-align:right"></iframe></div>';
}

add_shortcode('JP-Facebook-Like', 'facebooklike_func');

?>