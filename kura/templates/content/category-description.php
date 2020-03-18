<?php

$categories = get_category( get_query_var( 'cat' ) );
$category_name = $categories->name;
$category_desc = $categories->category_description;

if ( !empty( $category_desc ) ) : ?>
<div class="category-page-desc">  

	<h4><?php echo esc_html( $category_name ); ?></h4>
	<p><?php echo esc_html( $category_desc ); ?></p>

</div>
<?php endif; ?>