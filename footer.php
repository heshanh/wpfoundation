
	<div class="row">
		<div class="large-4 columns">
			<?php wp_nav_menu( array( 'theme_location' => 'bottom', 
																'container' => false,
																'menu_class' => 'side-nav'
																 ) );
			?>
		</div>
		<div class="large-8 columns">
			<div style='font-size: .7em'>
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			</div>
		</div>
	</div>
<br />
	<div class="row ">
		<div class="large-12 columns ">
				<div class='right'>
			<?php $menu = wp_nav_menu( array( 'theme_location' => 'footer', 
																'container' => false,
																'echo' => false,
																'menu_class' => 'sub-nav'
																 ) ); 
			$menu = str_replace('ul', 'dl', $menu);
			$menu = str_replace('<li', '<dd', $menu);
			$menu = str_replace('</li', '</dd', $menu);
			$menu = str_replace('</a>', '</a>&nbsp;|&nbsp;', $menu);

			echo $menu;
			?>
		</div>
		</div>
	</div>

<?php include('social.php')?>
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? '<?php echo get_template_directory_uri() ?>/js/vendor/zepto' : '<?php echo get_template_directory_uri() ?>/js/vendor/jquery') +
  '.js><\/script>');
   </script>
  <?php wp_footer(); ?>
   <script>
    $(document).foundation();
  </script>

</body>
</html>