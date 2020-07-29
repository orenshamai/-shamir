<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shamir
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
		 ?>


     <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     	<header class="entry-header">
     		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
     	</header><!-- .entry-header -->

     	<div class="entry-content">
        <div class="info-table-header-block">
            <!-- input type="text" placeholder="Search Members Here" id="member_search" onkeyup="getTableData()" -->
            <button type="button" class="btn btn-primary add-new-button" id="addRow">
                Add New
            </button>
        </div>
        <form class="tUsers" id="tUsers" method="post" action="">
          <table id="member_table" class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>User ID</th>
                      <th>
                          Site URL
                      </th>
                      <th>
                          Username
                      </th>
                      <th>
                          Password
                      </th>
                      <th>
                          Description
                      </th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody id="list-table-body">
              </tbody>
          </table>
      </form>

      <div id="output"></div>

     		<?php

        //the_content();

     		wp_link_pages(
     			array(
     				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shamir' ),
     				'after'  => '</div>',
     			)
     		);
     		?>
     	</div><!-- .entry-content -->

     	<?php if ( get_edit_post_link() ) : ?>
     		<footer class="entry-footer">
     			<?php
     			edit_post_link(
     				sprintf(
     					wp_kses(
     						/* translators: %s: Name of current post. Only visible to screen readers */
     						__( 'Edit <span class="screen-reader-text">%s</span>', 'shamir' ),
     						array(
     							'span' => array(
     								'class' => array(),
     							),
     						)
     					),
     					wp_kses_post( get_the_title() )
     				),
     				'<span class="edit-link">',
     				'</span>'
     			);
     			?>
     		</footer><!-- .entry-footer -->
     	<?php endif; ?>
     </article><!-- #post-<?php the_ID(); ?> -->


     <?php
		  endwhile; // End of the loop.
	   ?>

	</main><!-- #main -->

<?php

get_footer();
