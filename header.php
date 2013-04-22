<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="http://code.jquery.com/jquery.js"></script>
<?php wp_head(); ?>
</head>


<body>
	<div class="row logo show-for-medium-up">
		<div class="large-4 columns">
			<img src='<?php bloginfo('template_directory'); ?>/img/logo.png' />
		</div>
		<div class="large-8 columns">
			<div class='right'>More info </div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<nav class="top-bar">

				<ul class="title-area">
			    <li class="name">
			    	<img class='show-for-small' src='<?php bloginfo('template_directory'); ?>/img/logo-small.png'  />
			    </li>
			    <li class="toggle-topbar menu-icon"><a href="#"><span>Navigation</span></a></li>
			  </ul>

				<section class="top-bar-section">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 
																'container' => false,
																 ) ); ?>
				</section>
			</nav>
		</div>
	</div>


