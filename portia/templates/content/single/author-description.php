<?php 
$authordesc = get_the_author_meta( 'description' );
if ( !empty($authordesc) ): ?>

  <div class="author-description">  

    <!-- Author Avatar -->
    <div class="author-avatar">
    <?php echo get_avatar( get_the_author_meta( 'ID' ), 110 ); ?>
    </div>

    <!-- Author Content -->
    <div class="author-content">
      <h4><?php the_author_posts_link(); ?></h4>
      <p><?php the_author_meta( 'description' ); ?></p>
    </div> 
  </div> 
<?php endif; ?>