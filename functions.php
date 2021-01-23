<?php
/**
Khai báo hang gia tri
@THEME_URL = lay duong dan thu muc theme
@CORE= lay duong dan cua thu muc/core
**/
define('THEME_URL',get_stylesheet_directory());
define('CORE',THEME_URL ."/core") ;
/**
nhung file /core/init.php
**/
require_once(CORE . "/init.php");
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
		$language_folder= THEME_URL .'/languages';
		load_theme_textdomain('thachpham',$language_folder);
/*tu dong them link RSS len <head> */
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('post-formats', array(
			'image',
			'video',
			'gallery',
			'quote',
			'link',
		)
		);

		add_theme_support('title-tag');
		$default_background =  array('default-color' => '#e8e8e8' );
		add_theme_support('custom-background');
		/** them menu**/
		register_nav_menu('primary-menu',__('Primary Menu','thachpham'));
		$sidebar = array(
			'name' =>__('Main Sidebar' ,'thachpham' ),
			'id'=> 'main-sidebar',
			'description'=>__ ('default sidebar'),
			'class' => 'main-sidebar',
			'before_title'=> '<h3 class="widgettitle">',
			'after_title'=> '</h3>'
			); 
			register_sidebar($sidebar);
			
			 
	}	
	add_action('init','thachpham_theme_setup');

}

/* hàm phần trang */
if (!function_exists('thachpham_pagination')) {
	function thachpham_pagination() {
		if ( $GLOBALS ['wp_query'] -> max_num_pages <2 ) {
			return' '; 
		} 	?> 
<nav class="pagination" role="navigation">
<?php if(get_next_post_link() ):?>
	<div class="prev"> <?php  next_posts_link(__('Older post','thachpham')); ?> 
	</div>
<?php endif; ?>
<?php if (get_previous_post_link()):?>
	<div class="next"> <?php previous_posts_link(__('Newest Post','thachpham'));?> 
	</div>
<?php endif ;?>
</nav>
<?php 	}
}

/* Ham tao thumbnail */

if (!function_exists('thachpham_thumbnail')) {
	function thachpham_thumbnail($size){
		if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image') ): ?> 
			<figure class="post-thumbnail"> 
				<?php the_post_thumbnail($size);?> 
			</figure>
	<?php endif; ?> 

	<?php }
}
 
 /* entry_header=hiển thị tiêu đề bài viết */
 if (!function_exists('thachpham_entry_header')) {
 	function thachpham_entry_header() { ?>
 		<?php if (is_single() ):?>
 		<h1 class="entry-title"> <a href="<?php the_permalink();?>" title="<?php the_title();?>"> <?php the_title();?> </a> </h1>
 		<?php else :?>
 			<h2 class="entry-title"> <a href="<?php the_permalink();?>" title="<?php the_title();?>"> <?php the_title();?> </a> </h2>
 		<?php endif ;?> 
<?php }
 }

if (!function_exists('thachpham_entry_meta')) {
	function thachpham_entry_meta() { ?>
		<?php if (!is_page()) :?>
			<div class="entry-meta">
				<?php 
				printf( __('<span class="author"> Posted by %1$s ','thachpham'),
				get_the_author() );
				printf( __('<span class="date-published"> at by %1$s ','thachpham'),
				get_the_date() ) ;
				printf( __('<span class="category"> in %1$s ','thachpham'),
				get_the_category_list(',') );
			if (comments_open ()) :
				echo '<span class="meta-reply">';
				comments_popup_link(
					__('Leave a comment','thachpham'),
					__('one comment','thachpham'),
					__('% comments','thachpham'),
					__('read all comments','thachpham'));
					

				
					echo '</span>';
				endif;
				?>
			</div>
		<?php endif ;?>

<?php 	}
}
