
<!DOCTYPE html>
<html "<?php language_attributes() ; ?>"/>
<head>
	<meta charset="<?php bloginfo('charset');?>" />
	<link rel="profile" href="http://gmgp.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
	<?php wp_head();?>

	</head>
	<body>
		<?php body_class();?>
			<div id="container">
				<div class="logo">
				<div class="site-name">
 	<?php
					if (is_home()) {
					printf('<h1><a href="%1$s" title="%2$s"> %3$s</h1>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename') );
                     }
                     else 
                     	{
					printf('<p><a href="%1$s" title="%2$s"> %3$s</p>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename') );
                     }
	?>
			      
</div> 

	</body>

