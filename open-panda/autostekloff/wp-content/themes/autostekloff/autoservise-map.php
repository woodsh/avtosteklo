<?php
/* Template Name: Autoservise map*/
?>
<?php get_header(); ?> 
<?php if(!$_COOKIE["city_slug"]){?>
    <script type="text/javascript">
 jQuery(document).ready(function() {
    var    adres; 
    var    cord;    
    
    ymaps.ready(init);
        function init() {
        ymaps.geolocation.get({
                // Выставляем опцию для определения положения по ip
                provider: 'yandex',               
               
            }).then(function (result) {
                // Выведем в консоль данные, полученные в результате геокодирования объекта.
                    cord=result.geoObjects.get(0).properties.get('boundedBy');
                    adres=result.geoObjects.get(0).properties.get('metaDataProperty').GeocoderMetaData.AddressDetails.Country.AddressLine;
                  
                jQuery.ajax({   
                        
			url:'<?php echo admin_url('admin-ajax.php')?>', // обработчик
                        data : {'action': 'autoservise_map',
                                'city': adres,
                                'cord':cord
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                      jQuery('#map_init').html(response);
				} else {
					
				}
			}
        });   
    });
    }
 });          
    </script>
<?php }?>
 <main>
      
      <div class="box-serv-map">
          <div class="box-absolute-serv">
            <div class="container">
              <div class="">
                <a href="#" class="btn btn-primary btn-blue"><img src="<?php echo get_template_directory_uri(); ?>/img/content/search.png" alt=""><?php _e( 'Уточнить локацию', 'autostekloff' )?></a>
                <ul class="tabs-service-choice">
                  <li><a href="<?php echo get_site_url();?>/avtoservisy/"><img src="<?php echo get_template_directory_uri(); ?>/img/content/list.png" alt=""><?php _e( 'Список', 'autostekloff' )?></a></li>
                  <li class="active"><a href="#" style="pointer-events: none;"><img src="<?php echo get_template_directory_uri(); ?>/img/content/map.png" alt=""><?php _e( 'Карта', 'autostekloff' )?></a></li>
                </ul>
              </div>
            </div>
          </div>
<div class="box-maps" id="map_init">            
          
          <script type="text/javascript">
            ymaps.ready(map_init);
              function map_init() {
                var points = [
                    <?php $autoservice = new WP_Query();
                        $args = array(                            
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $_COOKIE["city_slug"],                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args); 
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); $brend=get_the_terms( get_the_ID(), 'brends' );
                                if($brend){
                                $brend=reset($brend);

                                $img=get_field('img_brend', 'brends_'.$brend->term_id);
                                }
                    ?>
                                
                    { header: '',
                      body: '<div class="map-body">\n\
                                    <div class="map-cover">\n\
                                        <img src="<?php the_post_thumbnail_url();?>" alt="" />\n\
                                    </div>\n\
                                    <div class="map-info">\n\
                                    <img src="<?php echo $img['url'];?>" alt="" />\n\
                                    <strong><?php the_title()?></strong>\n\
                                        <p>График работы:<br/>ПН-СБ c <?php echo get_field('start')?>:00 до <?php echo get_field('finish')?>:00</p><a href="#">Подробнее</a>\n\
                                    </div>\n\
                                </div>',
                      <?php $coord=get_field( "coord" );?>
            coords: [<?php echo $coord["lat"]?>,<?php echo $coord["lng"]?>]
                    }, 
                        <?php endwhile;
                            wp_reset_query(); ?>
                        <?php endif; ?>                    
                  ],
                  map = new ymaps.Map('map_init', {
                    center: [<?php echo $coord['lat']?>, <?php echo $coord['lng']?>],
                    zoom: 10,
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
          </script>
    </div>   
</div>

<?php get_sidebar('consultation'); ?>

    </main>
<?php get_footer(); ?>
