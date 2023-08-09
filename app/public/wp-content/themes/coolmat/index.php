<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coolmat
 */

get_header();
?>

	<main id="primary" class="site-main">
		<!-- our hero element to: make it dynamic-->

<!-- here we write a query to grab ourselves one post from the menu
		category, and make it a random one each time -->
		<?php query_posts('posts_per_page=1&category_name=menu&orderby=rand'); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="hero">
				<div class="hero-inner container">
					<h1 class="hero-text lowercase">
						<!-- here we use the template tag to grab the site name -->
						<span class="hero-sitename"><?php bloginfo('name'); ?></span> <?php the_title(); ?>
					</h1>
					<p class="hero-description lowercase">
						<span class="magenta"><?php bloginfo('name'); ?></span> <?php bloginfo('description') ?>.
					</p>
				</div>
			</div>

		<?php	
			endwhile;
			endif;
		?>

		<!-- here we query for our new intro category post and get 
		just one single post -->
		<?php query_posts('posts_per_page=1&category_name=intro'); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- our intro element.. todo: make this dyanmic -->
		<div class="intro" id="intro">
			<div class="intro-inner">
				<h2 class="intro-title"><?php the_title(); ?></h2>
				<div class="intro-description">
						<?php the_content(); ?>
				</div>
			</div>
		</div>

		<?php	
			endwhile;
			endif;
		?>
		
		<div class="section-heading" id="food">Menu</div>
		<div class="grid">
			<?php
			// here we make sure to override ourq uery otherwise the one
			// from above will still be used in this loop
			query_posts('posts_per_page=20&orderby=category_name=menu');
			if ( have_posts() ) :
				/* Start the Loop */
				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;
				$item_number = 1;
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					?>
					<?php get_template_part( 'template-parts/content', get_post_type() );
					//this increments the item number
					$item_number++;
				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>

		<div class="section-heading" id="locations">
			Directions to cool mat
		</div>

		<div class="locations">
			<!-- each indiviudal location -->
			<div class="location grid">
				<!-- our map on the left-->
				<div class="map-inner">
					<!-- map embed goes in here-->
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6325.897835961065!2d126.85909565669634!3d37.556267272041296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9c03c38738ad%3A0x1eff909f2c04315c!2s284-10%20Yeomchang-dong%2C%20Gangseo-gu%2C%20Seoul%2C%20South%20Korea!5e0!3m2!1sen!2sca!4v1690841163606!5m2!1sen!2sca" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="location-info">
					<div class="location-description">
						<h3>Business Name</h3>
						<p>cool mat</p>

						<h3>Address</h3>
						<p>284-10 Yeomchang-dong, Gangseo-gu, Seoul<p>

						<h3>Phone Number</h3>
						<p>02-9999-9999</p>

						<h3>Direction</h3>
						<p>Get out of gate 3 and walk straight down for about
						   200 meters. You will see Cool Mat on your left.</p>
					</div>
				</div>
			</div>
		</div>

	</main> <!-- #main -->

<?php
get_footer();

