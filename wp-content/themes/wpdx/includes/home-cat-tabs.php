<?php
function get_home_tabs($cat_data){
	// $home_tabs_active = cmp_get_option('home_tabs_box');
	// $home_tabs = cmp_get_option('home_tabs');
	// $thumb = cmp_get_option('home_tabs_thumb');
	// $Posts = cmp_get_option('home_tabs_number');

	global $count1, $count2, $count3, $count4;

	$home_tabs = $cat_data['id'];
	$Posts = $cat_data['number'];
	$order = $cat_data['order'];
	$thumb = $cat_data['thumb'];

	$cat_title = $cat_data['title'] ? $cat_data['title'] : get_the_category_by_ID($cat_data['id'][0]);

	$home_layout = $cat_data['style'];
	$icon = $cat_data['icon'] ? $cat_data['icon']:'fa-list';
	$more_text = $cat_data['more_text'] ? $cat_data['more_text']:'More';
	$more_url = $cat_data['more_url'];
	$who = $cat_data['who'];

if( ($who == 'logged' && !is_user_logged_in())  || $who == 'anonymous' && is_user_logged_in()){
	// return none;
}else{

	if( $home_tabs ): ?>
	
			<?php if( $home_layout == '3c'): ?>
			<?php $count3++; ?>
			<section class="span4 column2 home-tabs">
				<div class="widget-box">
					<div class="widget-title">
						<?php if($more_url): ?>
							<span class="more"><a target="_blank" href="<?php echo $more_url; ?>"><?php echo $more_text; ?></a></span>
						<?php endif; ?>
						<span class="icon"> <i class="fa fa <?php echo $icon; ?> fa-fw fa-fw"></i> </span>
						<ul class="nav nav-tabs">
				<?php $i = 1;
				foreach ($home_tabs as $cat ) {
					?>
					<li <?php if($i == 1) echo 'class="active"'; ?>><a data-toggle="tab" href="#tab<?php echo $count3.'-3c-'.$i; ?>" title="<?php echo get_the_category_by_ID($cat) ?>"><?php echo get_the_category_by_ID($cat) ?></a></li>
					<?php $i++; } ?>
					<div class="clear"></div>
				</ul>
					</div>
					<div class="widget-content tab-content">
				<?php $a = 1;
				foreach ($home_tabs as $cat ) {
					$count = 0;
					if( $order == 'rand') {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'orderby' => 'rand', 'cat' => $cat,'no_found_rows' => 1);
					} else {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'cat' => $cat,'no_found_rows' => 1);
					}
					$cat_query = new WP_Query($args);
					?>
					<div id="tab<?php echo $count3.'-3c-'.$a; ?>" class="tab-pane <?php if($a == 1) echo 'active'; ?>">
						<?php if($cat_query->have_posts()): ?>
							<ul>
								<?php while ( $cat_query->have_posts() ) : $cat_query->the_post();?>
									<?php if ( $thumb == '' || $thumb == 'n') : ?>
										<li class="other-news">
											<span><?php the_time('m-d'); ?></span>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><i class="fa fa-angle-right"></i><?php the_title(); ?></a>
										</li>
									<?php else: ?>
										<li class="other-posts">
											<?php if ( $thumb == 'a') : ?>
												<a class="post-thumbnail avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'wpdx' ), get_the_author() ) ?>" <?php echo cmp_target_blank();?>><?php echo get_avatar( get_the_author_meta('user_email'), 45 )?>
												</a>
											<?php elseif($thumb == 't'): ?>
												<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php cmp_post_thumbnail(75,45) ?>
												</a>
											<?php endif; ?>
											<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php the_title(); ?></a></h3>
											<p class="post-meta">
												<span><i class="fa fa-clock-o fa-fw"></i><?php if (function_exists('cmp_get_time')) cmp_get_time();?></span>
												<?php if(function_exists('the_views')): ?>
													<span><i class="fa fa-eye fa-fw"></i><?php the_views(); ?></span>
												<?php elseif(function_exists('cmp_the_views')) : ?>
													<span><i class="fa fa-eye fa-fw"></i><?php cmp_the_views(); ?></span>
												<?php endif; ?>
												<?php if (comments_open()): ?>
													<span><i class="fa fa-comment-o fa-fw"></i><?php comments_popup_link('0','1','%' ); ?></span>
												<?php endif; ?>
											</p>
											<div class="clear"></div>
										</li>
									<?php endif; ?>
								<?php endwhile;?>
							</ul>
							<div class="clear"></div>
						<?php endif; wp_reset_query();?>
						</div>
					<?php $a++; } ?>
					</div><!-- .cat-box-content /-->
				</div>
			</section> <!-- Three Columns -->
		<?php elseif( $home_layout == '2c' || $home_layout == '2c1'): ?>
			<?php $count2++; ?>
			<section class="span6 column2 <?php if($count2 == 1 || $count2 == 3 ) { echo 'first-column'; $count2=1; } ?> home-tabs">
				<div class="widget-box">
					<div class="widget-title">
						<?php if($more_url): ?>
							<span class="more"><a target="_blank" href="<?php echo $more_url; ?>"><?php echo $more_text; ?></a></span>
						<?php endif; ?>
						<span class="icon"> <i class="fa <?php echo $icon; ?> fa-fw"></i> </span>
						<ul class="nav nav-tabs">
				<?php $i = 1;
				foreach ($home_tabs as $cat ) {
					?>
					<li <?php if($i == 1) echo 'class="active"'; ?>><a data-toggle="tab" href="#tab<?php echo $count2.'-2c-'.$i; ?>" title="<?php echo get_the_category_by_ID($cat) ?>"><?php echo get_the_category_by_ID($cat) ?></a></li>
					<?php $i++; } ?>
					<div class="clear"></div>
				</ul>
					</div>
					<div class="widget-content tab-content">
				<?php $a = 1;
				foreach ($home_tabs as $cat ) {
					$count = 0;
					if( $order == 'rand') {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'orderby' => 'rand', 'cat' => $cat,'no_found_rows' => 1);
					} else {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'cat' => $cat,'no_found_rows' => 1);
					}
					$cat_query = new WP_Query($args);
					?>
					<div id="tab<?php echo $count2.'-2c-'.$a; ?>" class="tab-pane <?php if($a == 1) echo 'active'; ?>">
						<?php if($cat_query->have_posts()): ?>
							<ul>
								<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
									<?php if($home_layout == '2c' && $count < 3) : ?>
										<li class="span6 first-posts <?php echo 'post-'.$count; ?>">
											<div class="inner-content">
												<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>>
													<?php cmp_post_thumbnail(330,200) ?>
													<h3><?php the_title(); ?></h3>
												</a>
											</div>
										</li>
										<?php if( $home_layout == '2c' && $count == 2) echo '<div class="clearfix"></div>';?>
									<?php else: ?>
										<?php if ( $thumb == '' || $thumb == 'n') : ?>
											<li class="other-news">
												<span><?php the_time('m-d'); ?></span>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><i class="fa fa-angle-right"></i><?php the_title(); ?></a>
											</li>
										<?php else: ?>
											<li class="other-posts">
												<?php if ( $thumb == 'a') : ?>
													<a class="post-thumbnail avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'wpdx' ), get_the_author() ) ?>" <?php echo cmp_target_blank();?>><?php echo get_avatar( get_the_author_meta('user_email'), 45 )?>
													</a>
												<?php elseif($thumb == 't'): ?>
													<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php cmp_post_thumbnail(75,45) ?>
													</a>
												<?php endif; ?>
												<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php the_title(); ?></a></h3>
												<p class="post-meta">
													<span><i class="fa fa-clock-o fa-fw"></i><?php if (function_exists('cmp_get_time')) cmp_get_time();?></span>
													<?php if(function_exists('the_views')): ?>
														<span><i class="fa fa-eye fa-fw"></i><?php the_views(); ?></span>
													<?php elseif(function_exists('cmp_the_views')) : ?>
														<span><i class="fa fa-eye fa-fw"></i><?php cmp_the_views(); ?></span>
													<?php endif; ?>
													<?php if (comments_open()): ?>
														<span><i class="fa fa-comment-o fa-fw"></i><?php comments_popup_link('0','1','%' ); ?></span>
													<?php endif; ?>
												</p>
												<div class="clear"></div>
											</li>
										<?php endif; ?>
									<?php endif; ?>
								<?php endwhile;?>
							</ul>
							<div class="clear"></div>
						<?php endif; wp_reset_query();?>
						</div>
					<?php $a++; } ?>
					</div><!-- .cat-box-content /-->
				</div>
			</section> <!-- Two Columns -->
		<?php elseif( $home_layout == '1c' || $home_layout == '1c1' ):   ?>
			<?php $count1++; ?>
			<section class="span12 two-row home-tabs <?php if($home_layout == '1c1') echo 'two-row-1' ?>">
				<div class="widget-box">
					<div class="widget-title">
						<?php if($more_url): ?>
							<span class="more"><a target="_blank" href="<?php echo $more_url; ?>"><?php echo $more_text; ?></a></span>
						<?php endif; ?>
						<span class="icon"> <i class="fa <?php echo $icon; ?> fa-fw"></i> </span>
						<ul class="nav nav-tabs">
				<?php $i = 1;
				foreach ($home_tabs as $cat ) {
					?>
					<li <?php if($i == 1) echo 'class="active"'; ?>><a data-toggle="tab" href="#tab<?php echo $count1.'-1c2-'.$i; ?>" title="<?php echo get_the_category_by_ID($cat) ?>"><?php echo get_the_category_by_ID($cat) ?></a></li>
					<?php $i++; } ?>
					<div class="clear"></div>
				</ul>
					</div>
					<div class="widget-content tab-content">
				<?php $a = 1;
				foreach ($home_tabs as $cat ) {
					$count = 0;
					if( $order == 'rand') {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'orderby' => 'rand', 'cat' => $cat,'no_found_rows' => 1);
					} else {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'cat' => $cat,'no_found_rows' => 1);
					}
					$cat_query = new WP_Query($args);
					?>
					<div id="tab<?php echo $count1.'-1c2-'.$a; ?>" class="tab-pane <?php if($a == 1) echo 'active'; ?>">
						<?php if($cat_query->have_posts()): ?>
							<ul>
								<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
									<?php if( $home_layout == '1c' && $count < 5) : ?>
										<li class="span3 first-posts <?php echo 'post-'.$count; ?>">
											<div class="inner-content">
												<a href="<?php the_permalink(); ?>" class="post-thumbnail" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>>
													<?php cmp_post_thumbnail(330,200) ?>
													<h3><?php the_title(); ?></h3>
												</a>
												<div class="clear"></div>
											</div>
										</li><!-- .first-posts -->
									<?php else: ?>
										<?php if( $home_layout == '1c' && $count == 5) echo '<div class="clear"></div>' ;?>
										<?php if ( $thumb == '' || $thumb == 'n') : ?>
											<li class="span6 other-news">
												<span><?php the_time('m-d'); ?></span>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><i class="fa fa-angle-right"></i><?php the_title(); ?></a>
											</li>
										<?php else: ?>
											<li class="span6 other-posts">
												<?php if ( $thumb == 'a') : ?>
													<a class="post-thumbnail avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'wpdx' ), get_the_author() ) ?>" <?php echo cmp_target_blank();?>><?php echo get_avatar( get_the_author_meta('user_email'), 45 )?>
													</a>
												<?php elseif($thumb == 't'): ?>
													<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php cmp_post_thumbnail(75,45) ?>
													</a>
												<?php endif; ?>
												<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php the_title(); ?></a></h3>
												<p class="post-meta">
													<span><i class="fa fa-clock-o fa-fw"></i><?php if (function_exists('cmp_get_time')) cmp_get_time();?></span>
													<?php if(function_exists('the_views')): ?>
														<span><i class="fa fa-eye fa-fw"></i><?php the_views(); ?></span>
													<?php elseif(function_exists('cmp_the_views')) : ?>
														<span><i class="fa fa-eye fa-fw"></i><?php cmp_the_views(); ?></span>
													<?php endif; ?>
													<?php if (comments_open()): ?>
														<span><i class="fa fa-comment-o fa-fw"></i><?php comments_popup_link('0','1','%' ); ?></span>
													<?php endif; ?>
												</p>
												<div class="clear"></div>
											</li>
										<?php endif; ?>
									<?php endif; ?>
								<?php endwhile;?>
							</ul>
							<div class="clear"></div>
						<?php endif; wp_reset_query();?>
						</div>
					<?php $a++; } ?>
					</div>
				</div><!-- .cat-box-content /-->
			</section><!-- Wide Box -->
		<?php else :   //************** list **********************************************************************************  ?>
			<?php $count4++; ?>
			<section class="span12 three-row home-tabs <?php if($home_layout == 'li1') echo 'three-row-1' ?>">
				<div class="widget-box">
					<div class="widget-title">
						<?php if($more_url): ?>
							<span class="more"><a target="_blank" href="<?php echo $more_url; ?>"><?php echo $more_text; ?></a></span>
						<?php endif; ?>
						<span class="icon"> <i class="fa <?php echo $icon; ?> fa-fw"></i> </span>
						<ul class="nav nav-tabs">
				<?php $i = 1;
				foreach ($home_tabs as $cat ) {
					?>
					<li <?php if($i == 1) echo 'class="active"'; ?>><a data-toggle="tab" href="#tab<?php echo $count4.'-1c3-'.$i; ?>" title="<?php echo get_the_category_by_ID($cat) ?>"><?php echo get_the_category_by_ID($cat) ?></a></li>
					<?php $i++; } ?>
					<div class="clear"></div>
				</ul>

					</div>
					<div class="widget-content tab-content">
				<?php $a = 1;
				foreach ($home_tabs as $cat ) {
					$count = 0;
					if( $order == 'rand') {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'orderby' => 'rand', 'cat' => $cat,'no_found_rows' => 1);
					} else {
						$args = array ( 'ignore_sticky_posts' => 1, 'posts_per_page' => $Posts , 'cat' => $cat,'no_found_rows' => 1);
					}
					$cat_query = new WP_Query($args);
					?>
					<div id="tab<?php echo $count4.'-1c3-'.$a; ?>" class="tab-pane <?php if($a == 1) echo 'active'; ?>">
						<?php if($cat_query->have_posts()): ?>
							<ul>
								<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
									<?php if($home_layout == 'li' && $count < 5) : ?>
										<li class="span3 first-posts <?php echo 'post-'.$count; ?>">
											<div class="inner-content">
												<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>>
													<?php cmp_post_thumbnail(330,200) ?>
													<h3><?php the_title(); ?></h3>
												</a>
											</div>
										</li><!-- .first-posts -->
										<?php if($home_layout == 'li' && $count == 4) echo '<div class="clear"></div>' ;?>
									<?php else: ?>
										<?php if ( $thumb == '' || $thumb == 'n') : ?>
											<li class="span4 other-news">
												<span><?php the_time('m-d'); ?></span>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><i class="fa fa-angle-right"></i><?php the_title(); ?></a>
											</li>
										<?php else: ?>
											<li class="span4 other-posts">
												<?php if ( $thumb == 'a') : ?>
													<a class="post-thumbnail avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'wpdx' ), get_the_author() ) ?>" <?php echo cmp_target_blank();?>><?php echo get_avatar( get_the_author_meta('user_email'), 45 )?>
													</a>
												<?php elseif($thumb == 't'): ?>
													<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php cmp_post_thumbnail(75,45) ?>
													</a>
												<?php endif; ?>
												<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdx' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" <?php echo cmp_target_blank();?>><?php the_title(); ?></a></h3>
												<p class="post-meta">
													<span><i class="fa fa-clock-o fa-fw"></i><?php if (function_exists('cmp_get_time')) cmp_get_time();?></span>
													<?php if(function_exists('the_views')): ?>
														<span><i class="fa fa-eye fa-fw"></i><?php the_views(); ?></span>
													<?php elseif(function_exists('cmp_the_views')) : ?>
														<span><i class="fa fa-eye fa-fw"></i><?php cmp_the_views(); ?></span>
													<?php endif; ?>
													<?php if (comments_open()): ?>
														<span><i class="fa fa-comment-o fa-fw"></i><?php comments_popup_link('0','1','%' ); ?></span>
													<?php endif; ?>
												</p>
											</li>
										<?php endif; ?>
									<?php endif; ?>
								<?php endwhile;?>
							</ul>
							<div class="clear"></div>
						<?php endif; wp_reset_query();?>
						</div>
					<?php $a++; } ?>
					</div>
				</div><!-- .cat-box-content /-->
			</section><!-- List Box -->
		<?php endif; ?>
		<?php endif;
		} //$who
	}
	?>