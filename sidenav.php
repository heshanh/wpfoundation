		<ul class='side-nav'>
		  	<?php 

		  	if($post->post_parent != 0)
		  	{
		  		$list_id = $post->post_parent;
		  	}
		  	else
		  	{
		  		$list_id = $post->ID;
		  	}
		  	wp_list_pages('title_li=&child_of='.$list_id); 

		  	?>
		  </ul>

