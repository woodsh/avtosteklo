<?php
/* Template Name: Blog*/
?>
<?php get_header(); ?> 
 <main>
      
      <div class="box-blog-header">
          <div class="container">
            <div class="col-xs-12">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="<?php echo get_site_url();?>"><?php _e( 'Главная', 'autostekloff' )?></a></li>
                  <li><?php the_title();?></li>
                </ul>
              </div>
              <h1><?php the_title();?></h1>
              <ul class="theme">
                <li class="active"><a href="#"><span><?php _e( 'Все статьи', 'autostekloff' )?></span><i><?php echo wp_count_posts()->publish;?></i></a></li>
                <li><a href="<?php echo get_category_link(5);?>"><span><?php _e( 'Последние новости', 'autostekloff' )?></span><i><?php echo get_category(5)->category_count; ?></i></a></li>
                <li><a href="<?php echo get_category_link(7);?>"><span><?php _e( 'Безопасность', 'autostekloff' )?></span><i><?php echo get_category(7)->category_count; ?></i></a></li>
                <li><a href="<?php echo get_category_link(8);?>"><span><?php _e( 'Советы', 'autostekloff' )?></span><i><?php echo get_category(8)->category_count; ?></i></a></li>
                <li><a href="<?php echo get_category_link(9);?>"><span><?php _e( 'Популярное', 'autostekloff' )?></span><i><?php echo get_category(9)->category_count; ?></i></a></li>
              </ul>
            </div>
          </div>
      </div>
      <?php $blog = new WP_Query();
                        $args = array(                            
                            'posts_per_page' =>4,
                            'paged'=> get_query_var('paged'),
                        );
                        $blog->query($args);
                        $temp_query = $wp_query;
                        $wp_query   = NULL;
                        $wp_query   = $blog;
                        $i=0;                    
                        if ($blog->have_posts()) : ?>
                        <?php while ($blog->have_posts()) : $blog->the_post(); $i++; ?>
                        <?php if($i%2==1) {?>
                            <div class="box-blog-state">
                               <div class="container">
                                 <div class="col-xs-12 col-sm-8 col-lg-6">
                                   <div class="date">
                                     <p><?php the_time('d'); ?></p>
                                     <span><?php echo mb_strtolower(substr(get_the_time('F'),0, 6 ));?></span>
                                   </div>
                                   <div class="single">
                                     <a href="<?php the_permalink(); ?>" class="title"><?php the_title();?></a>
                                     <p><?php the_excerpt(); ?></p>
                                     <a href="<?php the_permalink(); ?>" class="more btn btn-primary"><?php _e( 'Подробнее', 'autostekloff' )?></a>
                                     <a href="<?php the_permalink(); ?>#box-state-comment" class="comment"><?php comments_number(); ?></a>
                                   </div>
                                 </div>
                                 <div class="hidden-xs col-sm-4 col-lg-6 imaged" style="background: url(<?php the_post_thumbnail_url( 'full' );?>) center no-repeat"></div>
                               </div>
                             </div>
                         <?php }else{?>
                                <div class="box-blog-state">
                                 <div class="container">
                                   <div class="hidden-xs col-sm-4 col-lg-6 imaged" style="background: url(<?php the_post_thumbnail_url( 'full' );?>) center no-repeat"></div>
                                   <div class="col-xs-12 col-sm-8 col-lg-6 w-pd">
                                     <div class="date">
                                       <p><?php the_time('d'); ?></p>
                                       <span><?php echo mb_strtolower(substr(get_the_time('F'),0, 6 ));?></span>
                                     </div>
                                     <div class="single">
                                       <a href="<?php the_permalink(); ?>" class="title"><?php the_title();?></a>
                                       <p><?php the_excerpt(); ?></p>
                                       <a href="<?php the_permalink(); ?>" class="more btn btn-primary"><?php _e( 'Подробнее', 'autostekloff' )?></a>
                                       <a href="<?php the_permalink(); ?>#box-state-comment" class="comment"><?php comments_number(); ?></a>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                        <?php }?>
                        <?php endwhile; ?>
                        <?php echo get_the_posts_pagination_autostekloff(array('type' => 'list',));?>
                        <?php endif; ?> 
                <?php $wp_query = NULL;
                $wp_query = $temp_query;?>

      

 <?php get_sidebar('consultation'); ?>

    </main>
<?php get_footer(); ?>