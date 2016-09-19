<?php
/* Template Name: About*/
?>
<?php get_header(); ?> 
 <main>
      
      <div class="box-partners-page box-about">
          <div class="container">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="<?php echo get_site_url();?>"><?php _e( 'Главная', 'autostekloff' )?></a></li>
                  <li><?php _e( 'О компании', 'autostekloff' )?></li>
                </ul>
              </div>
                <?php while (have_posts()) : the_post(); ?>
                <?php the_content();?>
                <?php endwhile; ?>
             </div>
          </div>
      </div>

      <div class="box-bluemap-rus">
        <div class="container">
          <h4><?php echo get_field('about_title');?></h4>
            <?php $i=0;
            foreach (get_field('about_value') as $about_value) { $i++;?>
                <div class="col-xs-12 col-sm-6 col-md-3 <?php if($i%2==1){echo 'col-md-offset-6';}?>">
                    <img src="<?php echo $about_value['img']['url']; ?>" alt="">
                <p><strong><?php echo $about_value['value'];?></strong><?php echo $about_value['desc'];?></p>
                
                </div>
            <?php   } ?>
          
        </div>
      </div>

      <div class="box-trust">
        <div class="container">
          <h4><?php echo get_field('about_title3');?></h4>
          <?php foreach (get_field('abour_block3') as $abour_block3) {?>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <img src="<?php echo $abour_block3['img']['url']; ?>" alt="">
                    
                    <p> <a href="<?php echo $abour_block3['url'];?>"><?php echo $abour_block3['title'];?></a><br/>
                    <?php echo $abour_block3['desc'];?> </p>
                  </div>
            <?php   }?>           
        </div>
      </div>

 <?php get_sidebar('consultation'); ?>

    </main>
<?php get_footer(); ?>