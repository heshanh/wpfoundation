	<div class="row hide-for-small">
		<div class="large-12 columns">
			<br />
			<img src='<?php bloginfo('template_directory'); ?>/img/slide1.jpg' />
		</div>
	</div>
	<br />

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