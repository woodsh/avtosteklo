<?php global $autostekloff; ?>   
<footer class="">
      <div class="container">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="row">
            <a href="#" class="footer-logo"><img src="<?php echo $autostekloff['footer-logo']['url']?>" alt=""></a>
            <div class="hidden-xs footer-copy"><?php echo $autostekloff['footer-copyright'] ?></div>
          </div>
        </div>
        <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
          <div class="row">
            <div class="footer-title"><?php _e( 'Меню', 'autostekloff' )?></div>
            <?php wp_nav_menu(array('theme_location' => 'footer-menu', 'container' => '','menu_class'=>'footer-menu' )); ?>
          </div>
        </div>
        <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
          <div class="row">
            <div class="footer-title"><?php _e( 'Информация', 'autostekloff' )?></div>
            <?php wp_nav_menu(array('theme_location' => 'info-menu', 'container' => '','menu_class'=>'footer-menu' )); ?>            
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="row">
            <div class="footer-title hidden-xs"><?php _e( 'Контакты', 'autostekloff' )?></div>
            <div class="footer-contacts hidden-xs">
              <div class="footer-contacts-item"><i class="icons-f-phone"></i><?php echo $autostekloff['footer-tel'] ?></div>
              <div class="footer-contacts-item"><i class="icons-f-address"></i><?php echo $autostekloff['footer-address'] ?></div>
              <div class="footer-contacts-item"><i class="icons-f-mail"></i><u><?php echo $autostekloff['footer-email'] ?></u></div>
            </div>
            <div class="footer-socio">
              <?php _e( 'Будьте на связи:', 'autostekloff' )?>
              <div>
                <a href="<?php echo $autostekloff['footer-vk'] ?>" class="footer-socio-vk"></a>
                <a href="<?php echo $autostekloff['footer-fb'] ?>" class="footer-socio-fb"></a>
                <a href="<?php echo $autostekloff['footer-tw'] ?>" class="footer-socio-tw"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="cleafix"></div>
      </div>
    </footer>
    <div class="modal fade" id="questModal" tabindex="-1" role="dialog" aria-hidden="true" class="bs-example-modal-sm">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" id="myModalLabel"><?php _e( 'Задать вопрос', 'autostekloff' )?></h4>
          </div>
          <div class="modal-body">
            <form action="">
              <div class="form-group">
                <div><input type="text" class="form-control" placeholder="<?php _e( 'Как вас зовут?', 'autostekloff' )?>" name="name"></div>
              </div>
              <div class="form-group">
                <div><input type="text" class="form-control" placeholder="<?php _e( 'Ваш e-mail', 'autostekloff' )?>" name="mail"></div>
              </div>
              <div class="form-group">
                <div><textarea class="form-control" placeholder="<?php _e( 'Текст вопроса:', 'autostekloff' )?>" name="text"></textarea></div>
              </div>
              <div class="form-group col-xs-12 col-sm-5 col-lg-5">
                <div>
                  <span><?php _e( '18 + 10 =', 'autostekloff' )?></span>
                </div>
              </div>
              <div class="form-group col-xs-12 col-sm-7 col-lg-7">
                <div>
                  <input type="text" class="form-control" placeholder="<?php _e( 'Ответ', 'autostekloff' )?>" name="calc">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary"><?php _e( 'Отправить вопрос', 'autostekloff' )?></button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="serviseModal" tabindex="-1" role="dialog" aria-hidden="true" class="bs-example-modal-sm">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" id="myModalLabelnew"><?php _e( 'Заполните заявку и сэкономьте до 70% при замене стекла', 'autostekloff' )?></h4>
          </div>
          <div class="modal-body">
            <form id="form-new" name="form-new">
                <div class="form-group">
                    <div>
                        <input id="name-formnew" class="form-control required" type="text" name="name" placeholder="<?php _e( 'Введите имя', 'autostekloff' )?>">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <input id="phone-formnew" class="form-control required" type="text" name="phone" placeholder="<?php _e( 'Введите телефон', 'autostekloff' )?>">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <input id="brand-formnew" class="form-control" type="text" name="brand" placeholder="<?php _e( 'Марка / модель / год выпуска', 'autostekloff' )?>">
                    </div>
                </div>
                <div class="form-group form-check">
                    <div>
                        <input id="accept-new" class="form-control" type="checkbox">
                        <label for="accept">
                            <span><?php _e( 'Я согласен единоразово получить информацию по автостеклам', 'autostekloff' )?></span>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-btn">
                    <div class="row">
                        <input id="btn-send-formnew" class="btn btn-primary" type="submit" title="<?php _e( 'найти стекло', 'autostekloff' )?>" value="<?php _e( 'найти стекло', 'autostekloff' )?>">
                    </div>
                </div>
                <div class="hidden-xs col-sm-12 col-md-12 col-lg-12 box-btn">
                    <div class="row">
                        <em><?php _e( 'Это быстро и бесплатно :-)', 'autostekloff' )?></em>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
          </div>          
        </div>
      </div>
    </div>
    <div id="callbackModal" class="modal fade bs-example-modal-sm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                    <h4 id="myModalLabelcallback" class="modal-title">
                    <?php _e( 'Заказать', 'autostekloff' )?>
                    <br>
                    <?php _e( 'обратный звонок', 'autostekloff' )?>
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="form-callback" name="form-callback">
                        <div class="form-group">
                            <div>
                                <input id="name-callback" class="form-control required" type="text" name="name-callback" placeholder="<?php _e( 'Как вас зовут?', 'autostekloff' )?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input id="phone-callback" class="form-control required" type="text" name="phone-callback" placeholder="<?php _e( 'Номер телефона', 'autostekloff' )?>">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btn-request-call-me" class="btn btn-primary" type="button"><?php _e( 'Перезвоните мне', 'autostekloff' )?></button>
                </div>
            </div>
        </div>
    </div>
    <div id="thanksModal" class="modal fade bs-example-modal-sm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                    <h4 id="myModalLabelthanks" class="modal-title"><?php _e( 'Спасибо!', 'autostekloff' )?></h4>
                </div>
                <div class="modal-body"><?php _e( 'Наши сотрудники свяжутся с Вами в самое ближайшее время!', 'autostekloff' )?>  </div>
                <div class="modal-footer">
                    <button id="btn-thanks-close" class="btn btn-primary" type="button"><?php _e( 'Жду звонка!', 'autostekloff' )?></button>
                </div>
            </div>
        </div>
    </div>
  <?php wp_footer(); ?>
  </body>
</html>

