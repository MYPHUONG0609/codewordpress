<?php
/*
Template name:contact
*/ 
?>
<?php get_header();?>
 <div class="content"> 
	<div id="main-content">
<div class="contact-info">
	<h4> Địa chỉ liên hệ </h4>
	<p> Ấp quí thạnh ,xã Tân hội ,thị xã Cai lậy,tỉnh Tiền giang</p>
	<p> 0858145551</p>

</div>
<div class="contact-form"> 
<?php echo do_shortcode('[contact-form-7 id="1545" title="Contact form 1"]');?>
</div>
</div> 
<div id="sidebar">
	<?php get_sidebar();?>
	</div> 
</div>
<?php get_footer();?>
