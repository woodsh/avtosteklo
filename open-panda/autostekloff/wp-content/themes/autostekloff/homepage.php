<?php
/* Template Name: Home */
?>
<?php get_header(); ?> 
    <main>
      
      <div class="flex">
        <div class="slider-index">
            <?php foreach (get_field( "slider" ) as $slider) {?>
                <div class="slider-index-item" style="background: url('<?php echo $slider['img']['url']?>') 75% 0 no-repeat; -webkit-background-size: cover; background-size: cover;color:<?php echo $slider['color']?>;">
            <div class="slider-index-text"><?php echo $slider['text']?></div>
          </div> 
            <?php }?>         
        </div>

        <div class="box-form-search-service col-sm-6 col-md-6 col-lg-6 col-xs-12">
            <div class="row">
                <div>
                    <h4><?php _e( 'Заполните заявку и сэкономьте до 70% при замене стекла', 'autostekloff' )?></h4>
                    <div class="mini-tabs">
                        <div class="mini-tabs-block">
                            <div id="form1" class="tab-pane fade in active">
                                <form id="form-1" name="form-1">
                                    <div class="form-group">
                                        <div>
                                            <input id="name-form1" class="form-control required" type="text" name="name" placeholder="<?php _e( 'Введите имя', 'autostekloff' )?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input id="phone-form1" class="form-control required" type="text" name="phone" placeholder="<?php _e( 'Введите телефон', 'autostekloff' )?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input id="brand-form1" class="form-control" type="text" name="brand" placeholder="<?php _e( 'Марка / модель / год выпуска', 'autostekloff' )?>">
                                        </div>
                                    </div>
                                    <div class="form-group form-check">
                                        <div>
                                            <input id="accept" class="form-control" type="checkbox">
                                            <label for="accept">
                                                <span><?php _e( 'Я согласен единоразово получить информацию по автостеклам', 'autostekloff' )?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 box-btn">
                                        <div class="row">
                                            <input id="btn-send-form1" class="btn btn-primary" type="submit" title="<?php _e( 'найти стекло', 'autostekloff' )?>" value="<?php _e( 'найти стекло', 'autostekloff' )?>">
                                        </div>
                                    </div>
                                    <div class="hidden-xs col-sm-6 col-md-6 col-lg-6 box-btn">
                                        <div class="row">
                                            <em><?php _e( 'Это быстро и бесплатно :-)', 'autostekloff' )?></em>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                                <div class="marka-list flex">
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz1.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz16.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz3.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz4.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz5.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz6.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz7.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz8.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz9.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz10.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz11.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz12.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz13.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz14.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz15.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz17.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz18.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz19.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz20.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz21.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz22.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz23.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz24.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz25.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz26.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz27.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz28.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz29.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz31.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz32.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz33.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz34.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz35.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz36.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz42.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz38.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz39.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz40.png" alt=""></div>
                                    <div><img src="<?php echo get_template_directory_uri(); ?>/img/content/marka/chinaz41.png" alt=""></div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
      <div class="service">
        <div class="container">
            <?php foreach (get_field( "service" ) as $service) {?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 mmb-20">
                    <div class="row">
                      <img src="<?php echo $service['img']['url']?>" alt="">
                      <span><?php echo $service['title']?></span>
                      <?php echo $service['desc']?>
                    </div>
                </div>
            <?php }?> 
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="box-white-video">
        <div class="container">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
              <div class="box-video">
                <h4><?php echo get_field( "partner_text_left" )?></h4>
                <!-- <a href="#" data-toggle="modal" data-target="#videoModal">3 минуты и мы завоюем <br>ваше доверие</a> -->

                  <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true" class="bs-example-modal-lg">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-body">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <iframe width="100%" src="" frameborder="0" allowfullscreen></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
              <div class="box-partners">
                <h4><?php echo get_field( "partner_text_left" )?></h4>
                
                <div class="partners-list">
                    <?php foreach (get_field( "partner" ) as $partner) {?>
                    <div class="partners-list-item"><span><?php echo $partner['value']?></span><br><?php echo $partner['desc']?></div>
                    <?php }?>                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="box-grey" id="maps">

      </div>

      <div class="box-full-slide hidden-xs">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h4>Как работает наш сервис</h4>
            </div>
          </div>
        </div>
        <div class="slide-full">
            <?php 
            $work_servises=get_field( "work_servise" );
            $work_last=end($work_servises);
            array_pop($work_servises);
            $i=0;
            foreach ($work_servises as $work_servise) {$i++?>
                <div class="slick-fullSlide-items sfs<?php echo $i;?>">
                   <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-md-6 col-lg-6 col-md-offset-6 col-lg-offset-6 content">
                     <h4><?php echo $work_servise['title']?></h4>
                     <?php echo $work_servise['desc']?>
                     <a href="#" class="btn btn-default click-next">Следующий шаг</a>
                   </div>
                </div>       
            <?php }?>
          <div class="slick-fullSlide-items sfs4">
            <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-md-6 col-lg-6 col-md-offset-6 col-lg-offset-6 content">
              <h4><?php echo $work_last['title']?></h4>
              <?php echo $work_last['desc']?>
              <a href="#" data-target="#serviseModal" data-toggle="modal" class="btn btn-primary">Воспользоваться сервисом</a>
            </div>
          </div>
        </div>
      </div>

      <div class="box-map">
        <div class="container">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4>Благодарные автомобилисты</h4>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">                
              <div class="slick slick-review">
               <?php foreach (get_field( "thanks" ) as $thanks) {?>
                    <div class="slick-items">
                      <img src="<?php echo $thanks['img']['url']?>" alt="">
                      <p><strong><?php echo $thanks['strong']?></strong></p>
                      <p><?php echo $thanks['text']?></p>
                      <p><span><?php echo $thanks['adres']?></span></p>
                    </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="box-grey">
        <div class="container">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
              <div class="box-brends-preview">
                <h4><?php _e( 'Автостекла', 'autostekloff' )?><br><?php _e( 'на любой бюджет!', 'autostekloff' )?></h4>
                <p><?php _e( 'Стоимость автостекла зависит от производителя', 'autostekloff' )?></p>
                <div class="list-brends-preview">

                  <!-- th -->
                  <div class="list-brends-preview-item">
                    <div>
                      <div><span>от <?php the_field( "price1" )?> Р</span></div>
                    </div>
                    <i class="flags-00"></i><?php _e( 'США и ', 'autostekloff' )?><i class="flags-01"></i><?php _e( 'Европа', 'autostekloff' )?>
                  </div>
                  
                  <!-- th -->
                  <div class="list-brends-preview-item">
                    <div>
                      <div><span>от <?php the_field( "price2" )?> Р</span></div>
                    </div>
                    <?php _e( 'Оригинальное стекло', 'autostekloff' )?>
                  </div>
                  
                  <!-- th -->
                  <div class="list-brends-preview-item">
                    <div>
                      <div><span>от <?php the_field( "price3" )?> Р</span></div>
                    </div>
                    <i class="flags-02"></i><?php _e( 'Китай и ', 'autostekloff' )?><i class="flags-03"></i><?php _e( 'Россия', 'autostekloff' )?>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
              <div class="box-news-preview">
                <h4><?php _e( 'Новости и полезная информация', 'autostekloff' )?></h4>
                <div class="list-news-preview">
                  <?php $news = new WP_Query();                   
                    $news->query('&cat=5&posts_per_page=2');
                    if ($news->have_posts()) :
                    while ( $news->have_posts() ) : $news->the_post() ?>
                    
                    <div class="list-news-preview-item">
                        <div class="list-news-preview-data"><span><?php the_time('d'); ?></span><?php echo mb_strtolower(substr(get_the_time('F'),0, 6 ));?></div>
                        <div class="bov">
                          <a href="<?php the_permalink(); ?>" class="list-news-preview-name"><?php the_title(); ?></a>
                          <p><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                      <?php endwhile; wp_reset_query();?>
                    
                    <?php endif;?> 
                  

                </div>
                <a href="<?php echo get_category_link(5);?>" class="btn btn-primary">Архив новостей</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

<?php get_sidebar('consultation'); ?>

    </main>

<?php get_footer(); ?>


