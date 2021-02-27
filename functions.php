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
/**
@ Thiết lập hàm hiển thị logo
@ thachpham_logo()
**/
if ( ! function_exists( 'thachpham_header' ) ) {
  function thachpham_header() {?>
    <div class="logo">
 
      <div class="site-name">
        <?php if ( is_home() ) {
          printf(
            '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
            get_bloginfo( 'url' ),
            get_bloginfo( 'description' ),
            get_bloginfo( 'sitename' )
          );
        } else {
          printf(
            '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
            get_bloginfo( 'url' ),
            get_bloginfo( 'description' ),
            get_bloginfo( 'sitename' )
          );
        } // endif ?>
      </div>
      <div class="site-description"><?php bloginfo( 'description' ); ?></div>
 
    </div>
  <?php }
}
/**
@ Thiết lập hàm hiển thị menu
@ thachpham_menu( $slug )
**/
if ( ! function_exists( 'thachpham_menu' ) ) {
  function thachpham_menu( $menu) {
    $menu = array(
      'theme_location' => $menu,
      'container' => 'nav',
      'container_class' => $menu,
      'items_wrap'      => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>',
    );
    wp_nav_menu( $menu );
  }
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
				printf( __('<span class="date-published"> at  %1$s ','thachpham'),
				get_the_date() ) ;
				printf( __('<span class="category"> in %1$s ','thachpham'),
				get_the_category_list(',') );
			if (comments_open ()) :
				echo '<span class="meta-reply">';
				comments_popup_link(
					__('Leave a comment','thachpham'),
					__('One comment','thachpham'),
					__('% comments','thachpham'),
					__('Read all comments','thachpham'));
					

				
					echo '</span>';
				endif;
				?>
			</div>
		<?php endif ;?>

<?php 	}
}
/* entry_content=hiển thị nội dung bài viết */
if (!function_exists('thachpham_entry_content')) {
	function thachpham_entry_content() {
		if (!is_single() && !is_page()) {
			the_excerpt();
		} 
		else {
			the_content();
			/* phân trang trong single */
			$links_pages= array(
				'before' => __('<p>Page','thachpham'),
				'after' => ('</p'),
				'nextpagelink' => __('Next page','thachpham'),
				'previouspage' => __('Previous Page','thachpham'));
			wp_link_pages($link_pages);
		}

	}
}
function thachpham_readmore() {
	return '<a class="read-more" href="	'.get_permalink(get_the_ID() ).' ">' .__('...[Read More]','thachpham').'</a>';
}
add_filter('excerpt_more','thachpham_readmore');
if (!function_exists('thachpham_entry_tag') ){
	function thachpham_entry_tag() {
		if (has_tag()):
			echo'<div class="entry-tag">';
			printf(__('Tagged in %1$s','thachpham'),get_the_tag_list('',','));
			echo '</div>';
		endif;
	}
}
/* hàm nhúng file style css*/
function thachpham_styles() {
  /*
   * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
   * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
   */
  wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', 'all' );
  wp_enqueue_style( 'main-style' );
  wp_register_style( 'reset-style', get_template_directory_uri() . '/reset.css', 'all' );
  wp_enqueue_style( 'reset-style' );
  //superfish menu 
  wp_register_style( 'superfish-style', get_template_directory_uri() . '/superfish.css', 'all' );
 wp_enqueue_style( 'superfish-style' );
 wp_register_style( 'superfish-script', get_template_directory_uri() . '/superfish.js', array('jquery'));
  wp_enqueue_style( 'superfish-script' );
  //custom script 
 wp_register_script( 'custom-js', get_template_directory_uri() . "/custom.js", array('jquery') );
  wp_enqueue_script( 'custom-js' );
}
add_action( 'wp_enqueue_scripts', 'thachpham_styles' );
// remove wp version param from any enqueued scripts

function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

