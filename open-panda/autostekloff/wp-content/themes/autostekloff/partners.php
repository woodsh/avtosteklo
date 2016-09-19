<?php
/* Template Name: Partners*/
?>
<?php get_header(); ?> 
 <main>
      
      <div class="box-partners-page">
          <div class="container">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="<?php echo get_site_url();?>"><?php _e( 'Главная', 'autostekloff' )?></a></li>
                  <li><?php _e( 'Партнерам', 'autostekloff' )?></li>
                </ul>
              </div>
                <?php while (have_posts()) : the_post(); ?>
                <?php the_content();?>
                <?php endwhile; ?>
              <a href="#box-reg" class="btn btn-primary">стать партнером</a>
            </div>
          </div>
      </div>

      <div class="box-full-slide box-partner-slide hidden-xs">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h4>Как работает партнерская программа</h4>
            </div>
          </div>
        </div>
        <div class="slide-full">
          <div class="slick-fullSlide-items sfp1">
            <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-md-6 col-lg-6 col-md-offset-6 col-lg-offset-6 content">
              <h4>Вы регистрируете свой автосервис на нашем сайте </h4>
              <p>Заполняете не сложную форму после чего с вами в течении 3-х дней связываются наши менеджеры для дальнейшего общения. Если обе стороны все устраивает то заключаем договор</p>
              <a href="#" class="btn btn-default click-next">Следующий шаг</a>
            </div>
          </div>
          <div class="slick-fullSlide-items sfp2">
            <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-md-6 col-lg-6 col-md-offset-6 col-lg-offset-6 content">
              <h4>Вы регистрируете свой автосервис на нашем сайте </h4>
              <p>Заполняете не сложную форму после чего с вами в течении 3-х дней связываются наши менеджеры для дальнейшего общения. Если обе стороны все устраивает то заключаем договор</p>
              <a href="#" class="btn btn-default click-next">Следующий шаг</a>
            </div>
          </div>
          <div class="slick-fullSlide-items sfp3">
            <div class="col-xs-12 col-sm-7 col-sm-offset-5 col-md-6 col-lg-6 col-md-offset-6 col-lg-offset-6 content">
              <h4>Вы регистрируете свой автосервис на нашем сайте </h4>
              <p>Заполняете не сложную форму после чего с вами в течении 3-х дней связываются наши менеджеры для дальнейшего общения. Если обе стороны все устраивает то заключаем договор</p>
              <a href="#box-reg" class="btn btn-primary">Зарегистрировать автосервис</a>
            </div>
          </div>
        </div>
      </div>

      <div class="box-doc">
        <div class="container">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h4>Есть сомнения?<br/>Вот наши документы</h4>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class=" pdf-link">
                <a href="<?php echo get_field('url_pdf')?>"><?php echo get_field('name_pdf')?></a>
              <span>PDF <?php echo get_field('size_pdf')?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="box-partners-programm">
        <div class="container">
          <h4 class="col-xs-12">Условия партнерской программы</h4>
          <?php foreach (get_field('partnert_text') as $partnert_text) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 pp-items">
                  <p><?php echo $partnert_text['value'];?></p>
                </div>
            <?php   } ?>
                   
        </div>
      </div>
      
     <div class="box-reg" id="box-reg">
        <div class="container">
          <div class="box-form-reg-service col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h4>Зарегистрировать<br/>автосервис</h4>
            <form action="#" method="post">
              <div class="form-group">
                <div><input type="text" class="form-control" placeholder="Название автосервиса" name="flag"></div>
              </div>
              <div class="form-group">
                <div><input type="text" class="form-control" placeholder="Контактное лицо" name="name"></div>
              </div>
              <div class="form-group">
                <div><input type="text" class="form-control" placeholder="Ваш телефон" name="phone"></div>
              </div>
              <div class="form-group">
                <div><input type="text" class="form-control" placeholder="E-mail" name="mail"></div>
              </div>
              <div class="form-group captcha">
                <div>
                  <input type="text" class="form-control" placeholder="Капча">
                  <a href="#" class="reset btn btn-default"><img src="<?php echo get_template_directory_uri(); ?>/img/content/reset.png" alt=""></a>
                  <div>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/content/captcha.jpg" alt="">
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 box-btn">
                <div class="row">
                    <input type="submit" class="btn btn-primary" value="зАРЕГиСТРИРОВАТЬся" id="partner-reg">
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>

 <?php get_sidebar('consultation'); ?>

    </main>
<?php get_footer(); ?>