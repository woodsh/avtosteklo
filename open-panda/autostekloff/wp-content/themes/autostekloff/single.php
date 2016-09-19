<?php get_header(); ?>
<?php $data_title = get_the_title();
	$data_link = get_permalink()
                ?>
 <main>
      
      <div class="box-blog-header header-state">
          <div class="container">
            <div class="col-xs-12">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="<?php echo get_site_url();?>"><?php _e( 'Главная', 'autostekloff' )?></a></li>
                  <li><a href="<?php echo get_site_url();?>/blog"><?php _e( 'Блог', 'autostekloff' )?></a></li>
                  <li><?php the_title(); ?></li>
                </ul>
              </div>
              <h1><?php the_title(); ?></h1>
            </div>
          </div>
      </div>
      
      <div class="box-single-state">
        <div class="container">
            <?php while (have_posts()) : the_post(); ?>
          <div class="col-xs-12 col-sm-1 date">
            <div class="">
              <p><?php the_time('d'); ?></p>
              <span><?php echo mb_strtolower(substr(get_the_time('F'),0, 6 ));?></span>
            </div>
          </div>
          <div class="col-xs-12 col-sm-11 body">
              <?php the_content();?>
          </div>
           <?php endwhile; ?>
        </div>
      </div>

     <div class="box-state-comment" id="box-state-comment">
        <div class="container">
          <div class="col-xs-12 bordered">
           <?php comments_template(); ?>            
            <div class="block-action-line">
              <div class="col-sm-3 col-xs-12"><a href="<?php echo get_site_url();?>/blog" class="btn btn-default" >К списку статей</a></div>
              <div class="col-sm-5 hidden-xs">
                <ul>
                  <li><a href="#" onclick="window.open('//www.facebook.com/sharer.php?m2w&s=100&p[url]=<?php echo $data_link?>&p[title]=<?php echo $data_title?>', '_blank', 'scrollbars=0, resizable=1, menubar=0, toolbar=0, status=0 height=300, width=600');return false"><img src="<?php echo get_template_directory_uri(); ?>/img/system/icon-i-fb.png" alt=""></a></li>
                  <li><a href="#" onclick="window.open('//vk.com/share.php?url=<?php echo $data_link?>&title=<?php echo $data_title?>', '_blank', 'scrollbars=0, resizable=1, menubar=0, toolbar=0, status=0, height=300, width=600');return false"><img src="<?php echo get_template_directory_uri(); ?>/img/system/icon-i-vk.png" alt=""></a></li>
                  <li><a href="#" onclick="window.open('//twitter.com/intent/tweet?text=<?php echo $data_title?>&url=<?php echo $data_link?>', '_blank', 'scrollbars=0, resizable=1, menubar=0, toolbar=0, status=0 height=300, width=600');return false"><img src="<?php echo get_template_directory_uri(); ?>/img/system/icon-i-tw.png" alt=""></a></li>
                </ul>
              </div>
              <div class="col-sm-4 col-xs-12"><a href="#" class="btn btn-primary" data-target="#reviewsModal" data-toggle="modal">Оставить комментарий</a></div>
              <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                <ul>
                  <li><a href="#" onclick="window.open('//www.facebook.com/sharer.php?m2w&s=100&p[url]=<?php echo $data_link?>&p[title]=<?php echo $data_title?>', '_blank', 'scrollbars=0, resizable=1, menubar=0, toolbar=0, status=0 height=300, width=300');return false"><img src="<?php echo get_template_directory_uri(); ?>/img/system/icon-i-fb.png" alt=""> </a></li>
                  <li><a href="#" onclick="window.open('//vk.com/share.php?url=<?php echo $data_link?>&title=<?php echo $data_title?>', '_blank', 'scrollbars=0, resizable=1, menubar=0, toolbar=0, status=0, height=300, width=300');return false"><img src="<?php echo get_template_directory_uri(); ?>/img/system/icon-i-vk.png" alt=""></a></li>
                  <li><a href="#" onclick="window.open('//twitter.com/intent/tweet?text=<?php echo $data_title?>&url=<?php echo $data_link?>', '_blank', 'scrollbars=0, resizable=1, menubar=0, toolbar=0, status=0 height=300, width=300');return false"><img src="<?php echo get_template_directory_uri(); ?>/img/system/icon-i-tw.png" alt=""></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php comment_form2( $args )?>
<?php get_sidebar('consultation'); ?>

    </main>
<?php get_footer(); ?>

