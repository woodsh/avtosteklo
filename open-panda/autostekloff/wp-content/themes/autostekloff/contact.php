<?php
/* Template Name: Contact*/
?>
<?php get_header(); ?> 
  <main>

      <div class="box-contact-header">
        <div class="container">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box-contact">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="<?php echo get_site_url();?>"><?php _e( 'Главная', 'autostekloff' )?></a></li>
                  <li><?php the_title();?></li>
                </ul>
              </div>
              <h4><?php the_title();?></h4>
              <div class="contacts-list">
                <div class="contacts-list-item"><img src="<?php echo get_template_directory_uri(); ?>/img/content/cont1.png" alt=""><span><?php _e( 'Адрес:', 'autostekloff' )?></span><p><?php echo get_field('contact_adres');?></p></div>
                <div class="contacts-list-item"><img src="<?php echo get_template_directory_uri(); ?>/img/content/cont2.png" alt=""><span><?php _e( 'Телефон:', 'autostekloff' )?></span><p><?php echo get_field('contact_tel');?>+7 (499) 686-08-45</p></div>
                <div class="contacts-list-item"><img src="<?php echo get_template_directory_uri(); ?>/img/content/cont3.png" alt=""><span><?php _e( 'Электронная почта:', 'autostekloff' )?></span><a href="mailto:<?php echo get_field('contact_email');?>"><?php echo get_field('contact_email');?></a></div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1">
            
              <div class="box-props">
                <h4><?php echo get_field('name_requisites');?></h4>
                <ul>
                    <?php foreach (get_field('requisites') as $requisites) {?>
                        <li><span><?php echo $requisites['name']?>:</span><p><?php echo $requisites['decs']?></p></li>
                  <?php   }?>                  
                </ul>
              </div>
          </div>
        </div>
      </div> 
      
      <div class="box-contacts-map" id="map_init">
        <div class="box-float hidden-xs hidden-sm">
          <div><img src="<?php the_post_thumbnail_url( 'full' );?>" alt=""></div>
        </div>
                <script type="text/javascript">
            ymaps.ready(map_init);
              function map_init() {
                var points = [                   
                    { header: '',
                      <?php $coord=get_field( "contact_map" ); ?>
            coords: [<?php echo $coord["lat"]?>,<?php echo $coord["lng"]?>]
                    },
                                  
                  ],
                  map = new ymaps.Map('map_init', {
                    center: [<?php echo $coord['lat']?>, <?php echo $coord['lng']?>],
                    zoom: 15,
                    type: 'yandex#map',
                    controls: ['zoomControl', 'fullscreenControl', 'rulerControl']
                  }),
                  collection = new ymaps.GeoObjectCollection();
          
                map.behaviors.disable('scrollZoom');
          
                map.container.events.add('fullscreenenter', function() {
                  map.behaviors.enable('scrollZoom');
                }).add('fullscreenexit', function() {
                  map.behaviors.enable('scrollZoom');
                });
                
                for (i in points) {
                  collection.add(
                    new ymaps.Placemark(points[i]['coords'],
                      {
                        balloonContentHeader: points[i]['header'],
                        balloonContentBody: points[i]['body'],
                        balloonContentFooter: points[i]['footer'],
                        hintContent: "подробнее..."
                      },
                      {
                        iconLayout: 'default#image',
                        iconImageHref: '<?php echo get_template_directory_uri(); ?>/img/content/point.png',
                        iconImageSize : [42, 44],
                        iconImageOffset : [-21, -22]
                      }
                    )
                  );
                }
                map.geoObjects.add(collection);
              }
          </script></div>

    </main>
<?php get_footer(); ?>
