<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main entry">
			<?php if ( have_posts() ) : ?>
				<header class="entry-header">
					<?php
						post_type_archive_title( '<h1 class="entry-title">', '</h1>' );
					?>
				</header>
				<div class="entry-content">
					<section id="breeds-listing">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/breed' );
						endwhile;
						?>
					</section>
				</div> <?php twentynineteen_the_posts_navigation(); ?>



				<?php else :
						get_template_part( 'template-parts/content/content', 'none' );
					endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
