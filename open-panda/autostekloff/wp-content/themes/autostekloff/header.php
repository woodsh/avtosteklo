<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <title><?php wp_title('|'); ?></title>
    <?php
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();    
    ?>
  <script type="text/javascript" src="http://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
  </head>
<body>
    <?php global $autostekloff; ?>
    <header>
      <div class="container">
          <a href="<?php echo get_site_url();?>" class="header-logo"><img src="<?php echo $autostekloff['header-logo']['url']?>" alt=""></a>
        <div class="bov">
          <a href="#" class="btn-menu"></a>
          <div class="flex flex-justify-space-between flex-align-center hidden-xs">
            <!--div class="header-city hidden-xs hidden-sm">
              <i class="icons-f-address"></i>Где вы: 
              <div class="box-select-cc">
                <select name="" id="" class="form-control">
                  <option value="">м. Автозоводская</option>
                  <option value="">м. Южная</option>
                  <option value="">м. Отрадное</option>
                  <option value="">м. Цветной бульвар</option>
                </select>
              </div>
            </div-->
            <div class="header-phone"><?php echo $autostekloff['header-tel']?></div>
            <div class="header-btn">
                     <a class="btn btn-default" data-target="#questModal" data-toggle="modal" href="#"><?php _e( 'Задать вопрос', 'autostekloff' )?></a>
            </div>
          </div>
          <div class="clerfix"></div>
             <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '','menu_class'=>'header-menu flex flex-justify-space-between hidden-xs' )); ?>
          <a href="#" class="mobile-menu_open hidden-sm hidden-md hidden-lg"><span class="glyphicon glyphicon-align-justify"> </span></a>

          <div class="mobile-menu hidden-sm hidden-md hidden-lg">
            <a href="#" class="cls">&#215;</a>
            <div class="cover">
              <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '',)); ?>
          
              <div class="header-phone"><?php echo $autostekloff['header-tel']?></div>
              <!--div class="header-city">
                <i class="icons-f-address"></i>Где вы: 
                <div class="box-select-cc">
                  <select name="" id="" class="form-control">
                    <option value="">м. Автозоводская</option>
                    <option value="">м. Южная</option>
                    <option value="">м. Отрадное</option>
                    <option value="">м. Цветной бульвар</option>
                  </select>
                </div>
              </div-->
              <div class="header-btn">
                     <a class="btn btn-default" data-target="#questModal" data-toggle="modal" href="#"><?php _e( 'Задать вопрос', 'autostekloff' )?></a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </header>
