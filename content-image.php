<article id="post-<?php the_ID();?>" 
	<?php post_class() ; ?>>
	<div class="entry-thumbnail">
		<?php thachpham_thumbnail('large');?> 
		 </div>
	<div class="entry-header"> 
		<?php thachpham_entry_header();?>
		<?php

		$attachment=get_children( array('Post_parent' =>$Post ->ID ));
		$attachment_number=count ($attachment);
		printf(__('This image post content %1$s photo ','thachpham'),$attachment_number); 
		?>
			</div>
	<div class="entry-content">
		<?php thachpham_entry_content();?>
		
	</div>
	
</article>