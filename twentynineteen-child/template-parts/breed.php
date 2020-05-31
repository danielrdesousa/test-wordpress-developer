<article class='breeds'>

	<?php
		$url_thumb = get_the_post_thumbnail_url($page->ID,'full');
		if($url_thumb != ""){
			echo '<div class="thumbnail" style="background-image: url('.esc_url($url_thumb).')"></div>';
		}else{
			echo '<div class="thumbnail" style="background: #ccc;"></div>';
		}
	?>

	<header>
		<a href='<?= esc_url(get_permalink($page->ID)); ?>'>
			<?php the_title('<h4 class="title-breed">', '</h4>') ?>
		</a>
		<p class='temperament-breed'>
			<?php
				$tags = get_the_tags();
				if ($tags) {
					foreach($tags as $tag) {
						echo " <a href='/breeds?tag=$tag->slug'>$tag->name</a> ";
					}
				}
			?>
		</p>
	</header>

	<p class="description-breed"> <?= get_the_excerpt() ?> </p>

	<a href='<?= esc_url(get_permalink($page->ID)); ?>' class='details-breed'>
		<?php esc_html_e('SEE MORE', 'textdomain'); ?>
	</a>
</article>
