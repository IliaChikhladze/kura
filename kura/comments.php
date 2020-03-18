<?php 
//prevent the direct loading of this file

	if( !empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php' ) {
		die(esc_html__('You cannot access this file directory', 'inf_lang' ) );
	}

?>

<?php if( post_password_required()) : ?>
	<p>
		<?php esc_html_e( 'This post is password protected. Enter the password to view the comments.' ,'inf_lang' ) ; ?>
		<?php return; ?>
	</p>
<?php endif; ?>

<?php if ( have_comments() ) : ?>

	<div class="comment-title">
	<h2><?php comments_number( esc_html__( 'No Comments', 'inf_lang' ) , esc_html__( 'One Comment', 'inf_lang' ) , esc_html__( '% Comments', 'inf_lang' ) ); ?></h2>
	</div>
	<ul class="commentslist" >
		<?php wp_list_comments('callback=infinity_comments'); ?>
	</ul>

	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
	<div class="comments-nav-section">					
		<p class="fl"></p>
		<p class="fr"></p>
		<div class="infinity-pagination">				

			<div class="default-previous">
			<?php  previous_comments_link( '<i class="fa fa-long-arrow-left" ></i>&nbsp;'. esc_html__('Older Comments', 'inf_lang' )   ); ?>
			</div>		
			<div class="default-next">
				<?php  next_comments_link( esc_html__('Newer Comments', 'inf_lang' )  . '&nbsp;<i class="fa fa-long-arrow-right" ></i>'  ); ?>
			</div>
			
			<div class="clear"></div>
		</div>

	</div> <!-- end comments-nav-section -->
	<?php endif; ?>
<?php endif; ?>
<?php comment_form(); ?>
