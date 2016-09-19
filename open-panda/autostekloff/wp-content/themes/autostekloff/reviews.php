<?php
/* Template Name: Reviews*/
?>
<?php get_header(); ?> 
<main>
      
      <div class="box-review-top">
          <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="/index.html">Главная</a></li>
                  <li>Отзывы</li>
                </ul>
              </div>
                <?php while (have_posts()) : the_post(); ?>
            <?php the_content();?>
         
           <?php endwhile; ?></div>
          </div>
      </div>

      <div class="box-review-items">
          <div class="container" id="comment-list">
            <?php comments_template( '/comment-review.php' ); ?> 
              
          <div class="review-item action_line">
              <a id="more_comment" href="#" class="btn btn-default">Еще отзывы</a>
            <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#reviewsModal">Добавить отзыв</a>
          </div>
        </div>
      </div>

<?php get_sidebar('consultation'); ?>

    </main>

<?php get_footer(); ?>
