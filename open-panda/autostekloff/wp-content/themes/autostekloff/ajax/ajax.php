<?php 

add_action('wp_ajax_autoservise_home', 'autoservise_home');
add_action('wp_ajax_nopriv_autoservise_home', 'autoservise_home');

add_action('wp_ajax_more_comment', 'autoservise_more_comment');
add_action('wp_ajax_nopriv_more_comment', 'autoservise_more_comment');

add_action('wp_ajax_more_autoservise', 'autoservise_more_autoservise');
add_action('wp_ajax_nopriv_more_autoservise', 'autoservise_more_autoservise');

add_action('wp_ajax_filter_autoservise', 'autoservise_filter_autoservise');
add_action('wp_ajax_nopriv_filter_autoservise', 'autoservise_filter_autoservise');

add_action('wp_ajax_autoservise_list', 'autoservise_list');
add_action('wp_ajax_nopriv_autoservise_list', 'autoservise_list');

add_action('wp_ajax_autoservise_map', 'autoservise_map');
add_action('wp_ajax_nopriv_autoservise_map', 'autoservise_map');

add_action('wp_ajax_city_chacge', 'autoservise_city_chacge');
add_action('wp_ajax_nopriv_city_chacge', 'autoservise_city_chacge'); 

function autoservise_home(){?>
        <div class="container">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="row">
              <div class="box-service-preview">
        <?php 
          $name_city=$_POST['city'];
          $cord=$_POST['cord'];
          $city=get_terms(array('taxonomy'=>'city','name__like'=>$name_city));
          if($city){
                
                $city=reset($city);
                
                $slug_sity=$city->slug;
                $id_city=$city->term_id;                
                $coord=get_field('cord', 'city_'.$id_city);
                $name=$city->name;
                if(!$_COOKIE["city"]){
                    setcookie("city", $name, time() + 3600 * 24, '/');
                    setcookie("city_slug", $slug_sity, time() + 3600 * 24, '/');
                 }
          }else{
             $citys=get_terms(array('taxonomy'=>'city'));
             $rastoyan=999999;
             foreach ($citys as $city) { 
                 
                $id_city=$city->term_id;
                $coord_new=get_field('cord', 'city_'.$id_city);
                $distantion=($coord_new["lat"]-$cord[0][0])*($coord_new["lat"]-$cord[0][0])+($coord_new['lng']-$cord[0][1])*($coord_new['lng']-$cord[0][1]);
                if($distantion<$rastoyan){
                    $rastoyan=$distantion;
                    $coord=$coord_new;
                    $slug_sity=$city->slug;
                    $name=$city->name;
                }                
             }
             if(!$_COOKIE["city"]){
             setcookie("city", $name, time() + 3600 * 24, '/');
             setcookie("city_slug", $slug_sity, time() + 3600 * 24, '/');
             
             }
          }
          ?>
                <h4><?php _e( 'Ближайшие автосервисы', 'autostekloff' )?></h4>

                <div class="list-service-preview col-xs-12">
                    <?php $autoservice = new WP_Query();
                        $args = array(                            
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $slug_sity,                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args);
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); ?>
                    <?php $brend=get_the_terms( get_the_ID(), 'brends' );
                    $brend=reset($brend);
                            
                    $img=get_field('img_brend', 'brends_'.$brend->term_id);
                    ?>
                     <div class="list-service-preview-item">
                         <img src="<?php echo $img['url'];?>" alt="">
                        <p><a href="#"><?php the_title();?></a>
                        <span><?php echo get_field('adres')?></span></p>
                      </div>
                        <?php endwhile;
                            wp_reset_query(); ?>
                        <?php endif; ?>

                </div>

                <a href="<?php echo get_site_url();?>/avtoservisy/" class="btn btn-primary"><?php _e( 'Каталог автосервисов', 'autostekloff' )?></a>

              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="m100p">
            <div class="row">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="box-maps-preview" id="map_init">            
          
          <script type="text/javascript">
            ymaps.ready(map_init);
              function map_init() {
                var points = [
                    <?php $autoservice = new WP_Query();
                        $args = array(
                            'posts_per_page' =>-1,                            
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $slug_sity,                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args); 
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); ?>
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
                                </div>',<?php $coord=get_field( "coord" );?>
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
   <?php  die(); 
}

function autoservise_more_comment(){
    $comments_query = new WP_Comment_Query;
    global $autostekloff;
    $args=array(
        'post_id' =>$_POST['id'],
        'order' => 'DESC',
    );
    $comment = $comments_query->query( $args );
    
    $page=$_POST['page'];
    
    wp_list_comments('per_page='.$autostekloff['number-reviews'].'&page='.$page.'&type=comment&callback=autostecloff_comment',$comment); 
    die(); 
}

function autoservise_more_autoservise(){
    global $autostekloff;
     $page=$_POST['page'];
     $metro=$_POST['metro'];
     $highway=$_POST['highway'];
     $start=$_POST['start'];
     $finish=$_POST['finish'];
     $district=$_POST['district'];
     $status=$_POST['status'];
     $no_status=$_POST['no_status'];
     if($status!='false' && $no_status!='false'){$status='false';$no_status='false';}
     if($metro){
        $m=array(
                                                    'taxonomy' => 'metro',
                                                    'field'    => 'slug',
                                                    'terms'    => $metro                                                                                                     
                                            );
    }
    if($highway){
        $h=array(
                                                    'taxonomy' => 'highway',
                                                    'field'    => 'slug',
                                                    'terms'    => $highway                                                                                                     
                                            );
    }
     if($district){
        $d=array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $district                                                                                                     
                                            );
    }
    if($start!=''){
    $s =   array(
                                                    'key' 	=> 'start',
                                                    'value'  	=> $start,
                                                    'compare' 	=> '=',
                                    );
    }
    if($finish){
    $f =   array(
                                                    'key' 	=> 'finish',
                                                    'value'  	=> $finish,
                                                    'compare' 	=> '=',
                                    );
    }
    if($status!='false'){
        
    $stat =   array(
                                                    'key' 	=> 'status',
                                                    'value'  	=> 'a:1:{i:0;s:1:"1";}',
                                                    'compare' 	=> '=',
                                    );
    }
    if($no_status!='false'){ 
        
    $stat =   array(
                                                    'key' 	=> 'status',
                                                    'value'  	=> 'a:1:{i:0;s:1:"1";}',
                                                    'compare' 	=> '!=',
                                    );
    }
       $autoservice = new WP_Query();
                        $args = array(
                            'paged'=>$page,
                            'posts_per_page'=>$autostekloff['number-autoservise'],
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                'relation' => 'AND',
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $_COOKIE["city_slug"]                                                                                                     
                                            ),
                                    )                            
                        );
                        $args['tax_query'][]=$m;
                        $args['tax_query'][]=$h;
                        $args['tax_query'][]=$d;
                        $args['meta_query'][]=$s;
                        $args['meta_query'][]=$f;
                        $args['meta_query'][]=$stat;
                        $autoservice->query($args);                        
            if ($autoservice->have_posts()) : ?>              
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
                        <?php endif;
die(); 
}

function autoservise_filter_autoservise (){
    global $autostekloff;
     $metro=$_POST['metro'];
     $highway=$_POST['highway'];
     $start=$_POST['start'];
     $finish=$_POST['finish'];
     $district=$_POST['district'];
     $title=$_POST['title'];
     $status=$_POST['status'];
     $no_status=$_POST['no_status'];
     if($status!='false' && $no_status!='false'){$status='false';$no_status='false';}
     if($metro){
        $m=array(
                                                    'taxonomy' => 'metro',
                                                    'field'    => 'slug',
                                                    'terms'    => $metro                                                                                                     
                                            );
    }
    if($highway){
        $h=array(
                                                    'taxonomy' => 'highway',
                                                    'field'    => 'slug',
                                                    'terms'    => $highway                                                                                                     
                                            );
    }
    if($district){
        $d=array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $district                                                                                                     
                                            );
    }    
    if($start!=''){
    $s =   array(
                                                    'key' 	=> 'start',
                                                    'value'  	=> $start,
                                                    'compare' 	=> '=',
                                    );
    }
    if($finish){
    $f =   array(
                                                    'key' 	=> 'finish',
                                                    'value'  	=> $finish,
                                                    'compare' 	=> '=',
                                    );
    }
    if($status!='false'){
        
    $stat =   array(
                                                    'key' 	=> 'status',
                                                    'value'  	=> 'a:1:{i:0;s:1:"1";}',
                                                    'compare' 	=> '=',
                                    );
    }
    if($no_status!='false'){ 
        
    $stat =   array(
                                                    'key' 	=> 'status',
                                                    'value'  	=> 'a:1:{i:0;s:1:"1";}',
                                                    'compare' 	=> '!=',
                                    );
    }
    
    ?>
             
           <?php $autoservice = new WP_Query();
                        $args = array(
                            'posts_per_page'=>$autostekloff['number-autoservise'],
                            'p'=>$title,
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                'relation' => 'AND',
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $_COOKIE["city_slug"]                                                                                                     
                                            ),                                            
                                    ),
                            'meta_query'	=> array(  
                                'relation' => 'AND',
                            )
                        );
                       $args['tax_query'][]=$m;
                       $args['tax_query'][]=$h;
                       $args['tax_query'][]=$d;
                       $args['meta_query'][]=$s;
                       $args['meta_query'][]=$f;
                       $args['meta_query'][]=$stat;
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
          
<?php
die(); 
}
function autoservise_list(){
          global $autostekloff;
          $name_city=$_POST['city'];
          $cord=$_POST['cord'];
          $city=get_terms(array('taxonomy'=>'city','name__like'=>$name_city));
          if($city){
                
                $city=reset($city);
                
                $slug_sity=$city->slug;
                $id_city=$city->term_id;                
                $coord=get_field('cord', 'city_'.$id_city);
                $name=$city->name;
                if(!$_COOKIE["city"]){
                    setcookie("city", $name, time() + 3600 * 24, '/');
                    setcookie("city_slug", $slug_sity, time() + 3600 * 24, '/');
                 }
          }else{
             $citys=get_terms(array('taxonomy'=>'city'));
             $rastoyan=999999;
             foreach ($citys as $city) { 
                 
                $id_city=$city->term_id;
                $coord_new=get_field('cord', 'city_'.$id_city);
                $distantion=($coord_new["lat"]-$cord[0][0])*($coord_new["lat"]-$cord[0][0])+($coord_new['lng']-$cord[0][1])*($coord_new['lng']-$cord[0][1]);
                if($distantion<$rastoyan){
                    $rastoyan=$distantion;
                    $coord=$coord_new;
                    $slug_sity=$city->slug;
                    $name=$city->name;
                }                
             }
             if(!$_COOKIE["city"]){
             setcookie("city", $name, time() + 3600 * 24, '/');
             setcookie("city_slug", $slug_sity, time() + 3600 * 24, '/');
             
             }
          }
  $city=get_terms(array('taxonomy'=>'city','name__like'=>$name));
$city=reset($city);
$name_city=get_field('title_city', 'city_'.$city->term_id);
?>
    <?php $autoservice = new WP_Query();
                        $args = array(
                            'posts_per_page' =>-1,
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $slug_sity,                                                                                                     
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
                                                    'terms'    => $slug_sity                                                                                                     
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
<?php        
  die();  
}
function autoservise_map(){
          $name_city=$_POST['city'];
          $cord=$_POST['cord'];
          $city=get_terms(array('taxonomy'=>'city','name__like'=>$name_city));
          if($city){
                
                $city=reset($city);
                
                $slug_sity=$city->slug;
                $id_city=$city->term_id;                
                $coord=get_field('cord', 'city_'.$id_city);
                $name=$city->name;
                if(!$_COOKIE["city"]){
                    setcookie("city", $name, time() + 3600 * 24, '/');
                    setcookie("city_slug", $slug_sity, time() + 3600 * 24, '/');
                 }
          }else{
             $citys=get_terms(array('taxonomy'=>'city'));
             $rastoyan=999999;
             foreach ($citys as $city) { 
                 
                $id_city=$city->term_id;
                $coord_new=get_field('cord', 'city_'.$id_city);
                $distantion=($coord_new["lat"]-$cord[0][0])*($coord_new["lat"]-$cord[0][0])+($coord_new['lng']-$cord[0][1])*($coord_new['lng']-$cord[0][1]);
                if($distantion<$rastoyan){
                    $rastoyan=$distantion;
                    $coord=$coord_new;
                    $slug_sity=$city->slug;
                    $name=$city->name;
                }                
             }
             if(!$_COOKIE["city"]){
             setcookie("city", $name, time() + 3600 * 24, '/');
             setcookie("city_slug", $slug_sity, time() + 3600 * 24, '/');
             
             }
          }
?>
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
                                                    'terms'    => $slug_sity,                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args); 
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); ?>
                    { header: '',
                      body: '<div class="map-body"><div class="map-cover"><img src="<?php echo get_template_directory_uri(); ?>/img/content/map_cover.png" alt="" /></div><div class="map-info"><img src="<?php echo get_template_directory_uri(); ?>/img/content/map_brend.png" alt="" /><strong><?php the_title()?></strong><p>График работы:<br/>ПН-СБ c 10:00 до 19:00</p><a href="#">Подробнее</a></div></div>',
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
 <?php die();  
}

function autoservise_city_chacge(){
    
    $id=$_POST['id'];

     $autoservice = new WP_Query();
                        $args = array(
                            'posts_per_page'=>-1,                            
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'term_id',
                                                    'terms'    => $id,                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args); 
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); ?>
                            
                            <option value="<?php the_title()?>"><?php the_title()?></option>
                                
                        <?php endwhile;
                            wp_reset_query(); ?>
                        <?php endif; ?>  
<?php     die();
}