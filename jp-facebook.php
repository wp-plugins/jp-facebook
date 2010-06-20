<?php
/*
Plugin Name: JP-Facebook
Plugin URI: http://www.jpreece.com/tutorials/wordpress/jp-facebook/
Description: Adds a Facebook 'Like' button to any page on your blog
Version: 0.1
Author: Jonathan Preece
Author URI: http://www.jpreece.com
License: GPL2
*/
?>
<?php
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
?>
<?php

//Acts as a handler for the Summary shortcode
function facebooklike_func($atts, $content = null)
{		
	//Get attributes
	extract(shortcode_atts($atts));
	
	echo '<iframe src="http://www.facebook.com/widgets/like.php?href=' . get_permalink() . '" 
        scrolling="no" frameborder="0" style="border:none; width:450px; height:80px"></iframe>';
}

//Adds shortcode [Facebook-Like]
add_shortcode('JP-Facebook-Like', 'facebooklike_func');

?>