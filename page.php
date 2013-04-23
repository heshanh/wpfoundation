<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( !is_front_page() ) { ?>
		  <div class="row">
				<div class="large-12 columns">
					<h1 class="subheader"><?php the_title()  ?></h1>
				</div>
			</div>
		<?php } ?>

	<?php if ( $post->post_parent != 0 || post_have_children($post->ID) ) {	?>
	


	<div class='row'>
		<div class='large-2 columns'>
			<?php get_template_part( 'sidenav' ); ?>
		</div>
		<div class='large-10 columns'>
			<?php get_template_part( 'content' ); ?>
		</div>
	</div>

	<?php }else{ ?>
		<?php get_template_part( 'content' ); ?>
	<?php } ?>
	

		
	<?php endwhile; // end of the loop. ?>
			
<?php get_footer(); ?>


