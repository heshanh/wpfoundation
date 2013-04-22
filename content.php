<?php if ( has_post_thumbnail() ) {  ?>
  	<div class="row hide-for-small">
		<div class="large-12 columns">
			<br />
				<?php the_post_thumbnail() ?>
		</div>
	</div>
	
<?php } ?>




	<?php if ( !is_front_page() ) { ?>
	  <div class="row">
			<div class="large-12 columns">
				<h1 class="subheader"><?php the_title()  ?></h1>
			</div>
		</div>
	<?php } ?>

	<div class="row">
		<div class="large-12 columns">
			<?php the_content(); ?>
	<hr />
		</div>
	</div>