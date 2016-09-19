<?php
/* Template Name:Autoservise list*/
?>
<?php get_header(); global $autostekloff;?>
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
                        data : {'action': 'autoservise_list',
                                'city': adres,
                                'cord':cord
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                      jQuery('main').html(response);
				} else {
					
				}
			}
        });   
    });
    }
 });          
    </script>
<?php }

$city=get_terms(array('taxonomy'=>'city','name__like'=>$_COOKIE["city"]));
$city=reset($city);
$name_city=get_field('title_city', 'city_'.$city->term_id);
if(!$name_city){
    $name_city=$_COOKIE["city"];
};
?>
    <?php $autoservice = new WP_Query();
                        $args = array(
                            'posts_per_page' =>-1,
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
                        <?php while ($autoservice->have_posts()) : $autoservice->the_post(); ?>
                        <?php 
                            $name_auto[]=array('title'=>get_the_title(),'id'=>get_the_ID());                            
                            $start[]=get_field('start');
                            $finish[]=get_field('finish');
                            foreach (get_the_terms( get_the_ID(), 'metro' ) as $value) {
                                    $metro[]=$value->term_id;
                            }
                            foreach (get_the_terms( get_the_ID(), 'city' ) as $value) {
                                     $district[]=$value->term_id;
                            }
                            foreach (get_the_terms( get_the_ID(), 'highway' ) as $value) {
                                    $highway[]=$value->term_id;
                            }                        
                        ?>
                        <?php endwhile;
                            wp_reset_query();
                            $metro=array_unique($metro); sort($metro);
                            $highwayo=array_unique($highway); sort($highway);
                            $district=array_unique($district); sort($district);
                            sort($name_auto);
                            $start=array_unique($start);sort($start);
                            $finish=array_unique($finish);sort($finish);
                            ?>
                        <?php endif; ?>  
 <main>
      <div class="box-serv-list_head">
        <div class="container">
          <div class="">            
            <div class="breadcrumbs">
              <ul>
                <li><a href="<?php echo get_site_url();?>"><?php _e( 'Главная', 'autostekloff' )?></a></li>
                <li><?php _e( 'Автосервисы', 'autostekloff' )?></li>
              </ul>
            </div>
            <h1><?php _e( 'Автосервисы в', 'autostekloff' )?> <?php echo $name_city;?></h1>
          </div>
        </div>
      </div>

      <div class="box-serv-list">
        <div class="container">
          <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 filter-serv">
            <form action="" autocomplete="off">
              <h4><?php _e( 'Найти автосервис', 'autostekloff' )?></h4>

              <div class="form-group">
                <div>
                  <select name="metro" id="metro" class="form-control" >
                    <option value="">Метро</option>                    
                    <?php foreach ($metro as $metro) {
                        $metro=get_term( $metro, 'metro' )?>
                       <option value="<?php echo $metro->slug?>"><?php echo $metro->name?></option>                         
                    <?php  }?>
                  </select>
                </div>
              </div>

              <div class="form-group no-mrg-sm">
                <div>
                  <select name="district" id="district" class="form-control" >
                    <option value="">Район</option>
                    <?php foreach ($district as $district) {
                        $district=get_term( $district, 'city' )?>
                    <?php if ($district->parent){?>
                       <option value="<?php echo $district->slug?>"><?php echo $district->name?></option>                         
                    <?php 
                        }                    
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div>
                  <select name="highway" id="highway" class="form-control" >
                    <option value="">Магистраль</option>
                    <?php foreach ($highway as $highway) {
                        $highway=get_term( $highway, 'highway' )?>
                       <option value="<?php echo $highway->slug?>"><?php echo $highway->name?></option>                         
                    <?php  }?>
                  </select>
                </div>
              </div>

              <div class="form-group no-mrg-sm">
                <div>
                  <select name="title" id="title" class="form-control" >
                    <option value="">Название</option>
                    <?php foreach ($name_auto as $name_auto) {?>
                    <option value="<?php echo $name_auto['id']?>"><?php echo $name_auto['title']?></option>                         
                    <?php  }?>
                  </select>
                </div>
              </div>

              <div class="form-group time-group">
                <div>
                  <span>Время работы</span>
                  <select name="start" id="start" class="form-control" >
                      <option value="">-- : --</option>
                    <?php foreach ($start as $start) {?>
                       <option value="<?php echo $start?>"><?php echo $start?>:00</option>                         
                    <?php  }?>
                  </select>
                  <select name="finish" id="finish" class="form-control" >
                      <option value="">-- : --</option>
                    <?php foreach ($finish as $finish) {?>
                       <option value="<?php echo $finish?>"><?php echo $finish?>:00</option>                         
                    <?php  }?>
                  </select>
                </div>
              </div>

              <div class="form-group no-mrg-sm">
                <div>
                  <span>Статус</span>
                  <label for="off_serv">
                    <input type="checkbox" name="status" id="off_serv">
                    <span>Официальный</span>
                  </label>
                  <label for="unoff_serv">
                    <input type="checkbox" name="no_status" id="unoff_serv">
                    <span>Неофициальный</span>
                  </label>
                </div>
              </div>

            </form>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 list-serv">
           <?php $autoservice = new WP_Query();
                        $args = array(
                            'posts_per_page'=>$autostekloff['number-autoservise'],
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $_COOKIE["city_slug"]                                                                                                     
                                            )
                                    ),                                                    
                        );
                       
                        $autoservice->query($args);
                        
                        if ($autoservice->have_posts()) : ?>
              
              <div class="header">
                  <h4><?php echo $autoservice->post_count ;?> автосервисов</h4>
              <ul class="tabs-service-choice">
                <li class="active"><a href="#" style="pointer-events: none;"><img src="<?php echo get_template_directory_uri(); ?>/img/content/list.png" alt=""><?php _e( 'Список', 'autostekloff' )?></a></li>
                <li><a href="<?php echo get_site_url();?>/avtoservisy-karta/"><img src="<?php echo get_template_directory_uri(); ?>/img/content/map.png" alt=""><?php _e( 'Карта', 'autostekloff' )?></a></li>
              </ul>
            </div>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); ?>
                    <?php $brend=get_the_terms( get_the_ID(), 'brends' );
                    $brend=reset($brend);
                            
                    $img=get_field('img_brend', 'brends_'.$brend->term_id);
                    
                    $metro=get_the_terms( get_the_ID(), 'metro' );
                    
                    ?>
                      <div class="list-serv-items">
              <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 ls-text">
                <div class="imaged">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/content/aserv1.jpg" alt="">
                </div>
                <p>
                    <a href="#"><?php the_title(); ?></a>
                    <strong><?php if(get_field('status')){ _e( 'Официальный', 'autostekloff' );}?></strong>
                </p>
                <p><?php echo get_field('adres')?> (<img src="<?php echo get_template_directory_uri(); ?>/img/content/mtr1.png" alt="">
                    <?php foreach ($metro as $metro) {
                        echo $metro->name.' ';
                     }?>
                    )</p>
                <p>Работаем c <?php echo get_field('start')?>:00 до <?php echo get_field('finish')?>:00</p>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ls-phone">
                <p></p>
                <a href="#" class="btn btn-primary">Записаться</a>
              </div>
            </div> 
                        <?php endwhile;
                            wp_reset_query(); ?>
                        <?php endif; ?>   
            
           
            
            <div class="list-serv-items list-serv-more">
                <a href="#" class="btn btn-default" id="more-autoservise"><?php _e( 'Еще автосервисы', 'autostekloff' )?></a>
            </div>
          </div>
        </div>
      </div>

    <?php get_sidebar('consultation'); ?> 

    </main>
<?php get_footer(); ?>

