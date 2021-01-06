<?php
/**
Khai báo hang gia tri
@THEME_URL = lay duong dan thu muc theme
@CORE= lay duong dan cua thu muc/core
**/
define('THEME_URL',get_stylesheet_directory());
define('CORE',THEME_URL."/core") ;
/**
nhung file /core/init.php
**/
require_once(CORE. "/init.php");
/**
@thiet lap chieu rong noi dung
**/
if( !isset($content_width)) {
	$content_width=620;
}
/** khai bao chuc nang cua them
**/
if ( !function_exists('thachpham_theme_setup')){
	function  thachpham_theme_setup() {
		/* thiet lap textdomain*/
		$language_folder= THEME_URL.'/languages';
		load_theme_textdomain('thachpham',$language_folder)
		/*tu dong them link RSS len <head> */
		add_theme_support('automatic-feed-links');
		add_theme_support('post_thumbnails');
		/* post format */
		
		add_theme_support('post-formats', array(
			'image'
			'video'
			'gallery'
			'quote'
			'link'
		)
		);
		
		
		
		add_theme_support('title-tag');

		$default_background =  array('default-color' => '#e8e8e8' );
		add_theme_support('custom-background');
		/** them menu**/
		register_nav_menu('primary-menu'__('Primary Menu','thachpham'));
	
		$sidebar = array('name' =>__('Main Sidebar' ,'thachpham' );
			'id'=> 'main-sidebar',
			'description'=>__ ('default sidebar'),
			'class' => 'main-sidebar',
			'before_title'=> '<h3 class="widgettitle">,
			'after_title'=> '</h3>'
			);
			register_sidebar($sidebar);
			
			 );
		}
	add action('init','thachpham_theme_setup');
}

 

if (!function_exists('thachpham_pagination')) {
	function thachpham_pagination() {
		if ($GLOBALS('wp_query') -> max_num_page <2 ) {
			return ''; } 
<nav class="pagination" role="navigation">
<?php if(get_next_post_link())
	<div class="prev"> <?php get_next_post_link(__('Older_post','thachpham'));?> 
	</div>
<?php endif; ?>
<?php if (get_previous_post_link());?>
	<div class="next"> <?php previous_post_link(__('Newest Post','thachpham'));?> 
	</div>
<?php endif ;?>
</nav>
	}
}

