<?php

require_once dirname( __FILE__ ) .'/lib/ReduxCore/framework.php';

require_once dirname( __FILE__ ) .'/lib/sample/config.php';

require_once dirname( __FILE__ ) .'/ajax/ajax.php';

//require_once dirname( __FILE__ ) .'/lib/sample/sample-config.php';

add_theme_support('post-thumbnails'); 

add_action('wp_enqueue_scripts', 'my_theme_load_resources');

function my_theme_load_resources()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.css');
    wp_enqueue_style('slick', get_template_directory_uri() . '/js/slick/slick.css');
    wp_enqueue_style('scroller', get_template_directory_uri() . '/css/jquery.fs.scroller.css');
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/js/themes/base/jquery-ui.min.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('media_new', get_template_directory_uri() . '/css/media.css');      
}

add_action('wp_enqueue_scripts', 'my_theme_load_head');

function my_theme_load_head()

{   wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js');
    wp_enqueue_script('jquery-ui-min', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('touch-punch', get_template_directory_uri() . '/js/jquery.ui.touch-punch.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.6.pack.js', array('jquery'));
    wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'));
    wp_enqueue_script('maskedinput', get_template_directory_uri() . '/js/jquery.maskedinput.js', array('jquery'));
    wp_enqueue_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'));
    wp_enqueue_script('scroller', get_template_directory_uri() . '/js/jquery.fs.scroller.js', array('jquery'));
    wp_enqueue_script('cookie-auto', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'));
    wp_enqueue_script('ammi', get_template_directory_uri() . '/js/ammi.js', array('jquery'));
    $datatoBePassed = array(
        'url' => admin_url('admin-ajax.php'),
        'id_post' => get_the_ID(),          
    );
    wp_localize_script('ammi', 'php_vars', $datatoBePassed);
    if(is_front_page()){
        wp_enqueue_script('home_auto', get_template_directory_uri() . '/js/home.js', array('jquery'));     
        wp_localize_script('home_auto', 'php_vars', $datatoBePassed);
    }
    
    
}

add_action('init', 'register_nav_menus_on_init');

function register_nav_menus_on_init()
{
    register_nav_menus(array(
        'main-menu' => __('Меню в шапке'),
        'footer-menu' => __('Меню в подвале'),
        'info-menu' => __('Меню информация')
    ));
}
add_action('init', 'autoservise');

function autoservise() {
  $labels = array(
    'name' => __('Автосервисы'),
    'singular_name' => __('Автосервис'),
    'add_new' => __('Добавить'),
    'add_new_item' => __('Добавить'),
    'edit_item' => __('Редактировать'),
    'new_item' => __('Автосервис'),
    'view_item' => __('Смотреть автосервис'),
    'search_items' => __('Искать автосервис'),
    'not_found' =>  __('Автосервис не найден'),
    'not_found_in_trash' => __('Автосервис не найден в корзине'), 
    'parent_item_colon' => '',
    'menu_name' => __('Автосервис')
  );
  
  $args = array (
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array('slug' => 'autoservise'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','thumbnail','editor')
  ); 
  register_post_type('autoservise',$args);
}
register_taxonomy('brends', 'autoservise',
    array('hierarchical' => true,
            'label' => 'Бренд',
            'query_var' => true,
            'show_ui' => true,
            'rewrite' => true,
        ));
register_taxonomy('metro', 'autoservise',
    array('hierarchical' => true,
            'label' => 'Метро',
            'query_var' => true,
            'show_ui' => true,
            'rewrite' => true,
        ));
register_taxonomy('city', 'autoservise',
    array('hierarchical' => true,
            'label' => 'Город',
            'query_var' => true,
            'show_ui' => true,
            'rewrite' => true,
        ));
register_taxonomy('highway', 'autoservise',
    array('hierarchical' => true,
            'label' => 'Магистраль',
            'query_var' => true,
            'show_ui' => true,
            'rewrite' => true,
        ));

add_filter('excerpt_more', function($more) {
	return '...';
});
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_filter('navigation_markup_template','autostekloff_markup_template');

function autostekloff_markup_template($template){
    $template='<div class="box-paginate">
                <div class="container">
                    <div class="col-xs-12">%3$s
                    </div>
                </div>
              </div>
                ';
    
    return $template;
    
}

function get_the_posts_pagination_autostekloff( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
		$args = wp_parse_args( $args, array(
			'mid_size'           => 1,
			'prev_text'          => _x( '&larr; Предыдущая', 'previous post' ),
			'next_text'          => _x( 'Следущая &rarr;', 'next post' ),
			'screen_reader_text' => __( 'Posts navigation' ),
		) );

		// Make sure we get a string back. Plain is the next best thing.
		if ( isset( $args['type'] ) && 'array' == $args['type'] ) {
			$args['type'] = 'plain';
		}

		// Set up paginated links.
		$links = paginate_links_autostekloff( $args );

		if ( $links ) {
			$navigation = _navigation_markup( $links, 'pagination', $args['screen_reader_text'] );
		}
	}

	return $navigation;
}
function paginate_links_autostekloff( $args = '' ) {
	global $wp_query, $wp_rewrite;

	// Setting up default values based on the current URL.
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );

	// Get max pages and current page out of the current query, if available.
	$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

	// Append the format placeholder to the base URL.
	$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

	// URL base depends on permalink settings.
	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	$defaults = array(
		'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
		'format' => $format, // ?page=%#% : %#% is replaced by the page number
		'total' => $total,
		'current' => $current,
		'show_all' => false,
		'prev_next' => true,
		'prev_text' => __('&laquo; Previous'),
		'next_text' => __('Next &raquo;'),
		'end_size' => 1,
		'mid_size' => 2,
		'type' => 'plain',
		'add_args' => array(), // array of query args to add
		'add_fragment' => '',
		'before_page_number' => '',
		'after_page_number' => ''
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! is_array( $args['add_args'] ) ) {
		$args['add_args'] = array();
	}

	// Merge additional query vars found in the original URL into 'add_args' array.
	if ( isset( $url_parts[1] ) ) {
		// Find the format argument.
		$format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
		$format_query = isset( $format[1] ) ? $format[1] : '';
		wp_parse_str( $format_query, $format_args );

		// Find the query args of the requested URL.
		wp_parse_str( $url_parts[1], $url_query_args );

		// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
		foreach ( $format_args as $format_arg => $format_arg_value ) {
			unset( $url_query_args[ $format_arg ] );
		}

		$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
	}

	// Who knows what else people pass in $args
	$total = (int) $args['total'];
	if ( $total < 2 ) {
		return;
	}
	$current  = (int) $args['current'];
	$end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
	if ( $end_size < 1 ) {
		$end_size = 1;
	}
	$mid_size = (int) $args['mid_size'];
	if ( $mid_size < 0 ) {
		$mid_size = 2;
	}
	$add_args = $args['add_args'];
	$r = '';
	$page_links = array();
	$dots = false;

	if ( $args['prev_next'] && $current && 1 < $current ) :
		$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current - 1, $link );
		if ( $add_args )
			$link = add_query_arg( $add_args, $link );
		$link .= $args['add_fragment'];

		/**
		 * Filter the paginated links for the given archive pages.
		 *
		 * @since 3.0.0
		 *
		 * @param string $link The paginated link URL.
		 */
		
	endif;
	for ( $n = 1; $n <= $total; $n++ ) :
		if ( $n == $current ) :
			$page_links[] = "<span class='page-numbers current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</span>";
			$dots = true;
		else :
			if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
				$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
				$link = str_replace( '%#%', $n, $link );
				if ( $add_args )
					$link = add_query_arg( $add_args, $link );
				$link .= $args['add_fragment'];

				/** This filter is documented in wp-includes/general-template.php */
				$page_links[] = "<a class='page-numbers' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
				$dots = true;
			elseif ( $dots && ! $args['show_all'] ) :
				$page_links[] = '<span class="page-numbers dots">' . __( '&hellip;' ) . '</span>';
				$dots = false;
			endif;
		endif;
	endfor;
	if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
		$link = str_replace( '%_%', $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current + 1, $link );
		if ( $add_args )
			$link = add_query_arg( $add_args, $link );
		$link .= $args['add_fragment'];

		/** This filter is documented in wp-includes/general-template.php */
		
	endif;
	switch ( $args['type'] ) {
		case 'array' :
			return $page_links;

		case 'list' :
                        $r .='<a class="prev hidden-xs" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['prev_text'] . '</a>';
			$r .='<a href="#" class="prev hidden-sm hidden-md hidden-lg">&larr;</a>';
                        $r .= "<ul class='page-numbers'>\n\t<li>";
			$r .= join("</li>\n\t<li>", $page_links);
			$r .= "</li>\n</ul>\n";
                        $r .='<a href="#" class="next hidden-sm hidden-md hidden-lg">&rarr;</a>';
                        $r .='<a class="next hidden-xs" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['next_text'] . '</a>';
			break;

		default :
			$r = join("\n", $page_links);
			break;
	}
	return $r;
}

function autostecloff_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;
    
    $comment_name_auto = get_comment_meta($comment -> comment_ID,'name_auto',true );
    $comment_city_auto = get_comment_meta($comment -> comment_ID,'city_auto',true );
    $comment_servise_auto = get_comment_meta($comment -> comment_ID,'servise_auto',true );
    $comment_servise_name = get_comment_meta($comment -> comment_ID,'servise_name',true );
    $comment_img_auto = get_comment_meta($comment -> comment_ID,'img_auto',true );
?>
    <div class="review-item">
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 text-rev">
              <div class="imaged">
                <img src="<?php echo $comment_img_auto; ?>" alt="">
              </div>
              <p class="quot_bg"><strong><?php echo $comment_servise_name?></strong></p>
              <?php comment_text()?>
              <p><span><?php echo $comment_name_auto;?></span></p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 info-rev">
              <p><?php echo $comment_city_auto;?>, автосервис <a href="#"><?php echo $comment_servise_auto?></a></p>
            </div>
          </div>
<?php }

function add_comment_meta_values($comment_id) {
    
    
         $name_auto = wp_filter_nohtml_kses($_POST['name_auto']);
        update_comment_meta($comment_id, 'name_auto', $name_auto);
        $city_auto = wp_filter_nohtml_kses($_POST['city_auto']);
        update_comment_meta($comment_id, 'city_auto', $city_auto);
        $servise_auto = wp_filter_nohtml_kses($_POST['servise_auto']);
        update_comment_meta($comment_id, 'servise_auto', $servise_auto);
        $servise_name = wp_filter_nohtml_kses($_POST['servise_name']);
        update_comment_meta($comment_id, 'servise_name', $servise_name);
        
         if($_FILES['img_auto']['type'] == "image/gif" || $_FILES['img_auto']['type'] == "image/png"||$_FILES['img_auto']['type'] == "image/jpeg"){
            $img_auto = get_template_directory_uri().'/img/'.$_FILES["img_auto"]["name"];
            
       
        move_uploaded_file($_FILES["img_auto"]["tmp_name"], dirname( __FILE__ ).'/img/'.$_FILES["img_auto"]["name"]);
        
        update_comment_meta($comment_id, 'img_auto', $img_auto);
        
        
         }
        
    
 
}
add_action ('comment_post', 'add_comment_meta_values', 1);
function action_function_name_11( $comment_id ) {
	//var_dump($_POST['phone']); exit;
    
        $name_auto = wp_filter_nohtml_kses($_POST['name_auto']);
        update_comment_meta($comment_id, 'name_auto', $name_auto);
        $city_auto = wp_filter_nohtml_kses($_POST['city_auto']);
        update_comment_meta($comment_id, 'city_auto', $city_auto);
        $servise_auto = wp_filter_nohtml_kses($_POST['servise_auto']);
        update_comment_meta($comment_id, 'servise_auto', $servise_auto);
        $servise_name = wp_filter_nohtml_kses($_POST['servise_name']);
        update_comment_meta($comment_id, 'servise_name', $servise_name);
        $img_auto = wp_filter_nohtml_kses($_POST['img_auto']);
        update_comment_meta($comment_id, 'img_auto', $img_auto);
    
}
add_action( 'edit_comment', 'action_function_name_11' );

add_action('add_meta_boxes_comment', 'render_comment_meta_admin_box1', 1);

function render_comment_meta_admin_box1($comment){
if($comment->comment_post_ID==35)
	{
		
		add_meta_box('nm_comment_meta_box', __('Дополнительная информация'), 'render_comment_meta_admin', 'comment', 'normal');
	}
}      
function render_comment_meta_admin($comment) {		
    
		?>
            <table class="form-table editcomment comment_xtra" id="namediv">
	        <tbody>
	        <?php      	

	        	$comment_name_auto = get_comment_meta($comment -> comment_ID,'name_auto',true );
                        $comment_city_auto = get_comment_meta($comment -> comment_ID,'city_auto',true );
                        $comment_servise_auto = get_comment_meta($comment -> comment_ID,'servise_auto',true );
                        $comment_servise_name = get_comment_meta($comment -> comment_ID,'servise_name',true );
                        $comment_img_auto = get_comment_meta($comment -> comment_ID,'img_auto',true );
                        
	        	
	        ?>
		        <tr valign="top">
		            <td class="first"><?php _e( 'Имя', 'autostekloff' )?></td>
                            <td><input name="name_auto" type="text" value="<?php echo esc_attr($comment_name_auto); ?>"></td>
		        </tr>
                        <tr valign="top">
		            <td class="first"><?php _e( 'Город', 'autostekloff' )?></td>
                            <td><input name="city_auto" type="text" value="<?php echo esc_attr($comment_city_auto); ?>"></td>
		        </tr>
                        <tr valign="top">
		            <td class="first"><?php _e( 'Сервис', 'autostekloff' )?></td>
                            <td><input name="servise_auto" type="text" value="<?php echo esc_attr($comment_servise_auto); ?>"></td>
		        </tr>
                        <tr valign="top">
		            <td class="first"><?php _e( 'Название отзыва', 'autostekloff' )?></td>
                            <td><input name="servise_name" type="text" value="<?php echo esc_attr($comment_servise_name); ?>"></td>
		        </tr>
                        <tr valign="top">
		            <td class="first"><?php _e( 'Урл изображения', 'autostekloff' )?></td>
                            <td><input name="img_auto" type="text" value="<?php echo esc_attr($comment_img_auto); ?>"></td>
		        </tr>
	        
	        
	        
	       </tbody>
	       </table>
	    <?php
	}

function comment_form1( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();

        $citys=get_terms(array('taxonomy'=>'city','parent'=>0));
        foreach ($citys as $city) {
            $html.='<option value="'.$city->term_id.'">'.$city->name.'</option>';
        }
        $autoservice = new WP_Query();
                        $args = array(                            
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $citys[0]->slug,                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args); 
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); 
                            
                            $html_servise.='<option value="'.get_the_title().'">'.get_the_title().'</option>'
                            
                            
                            ?>
                    
                                
                        <?php endwhile;
                            wp_reset_query(); ?>
                        <?php endif; ?>  
        
        
        <?php
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'name'  =>'<div class="form-group">
                            <div>
                                <input id="name-callback" class="form-control required" type="text" name="name_auto" placeholder="'. __( 'Имя', 'autostekloff' ).'">
                            </div>
                        </div>',
                'city_auto'  =>'<div class="form-group">
                                <div>
                                    <select id="city_chacge"  class="form-control required"  name="city_auto" placeholder="'. __( 'Город автосервиса', 'autostekloff' ).'">
                                      '.$html.'   
                                    </select>
                                </div>
                            </div>',
                'servise_auto'  =>'<div class="form-group">
                                <div>
                                    <select id="servise_n"  class="form-control required"  name="servise_auto" placeholder="'. __( 'Город автосервиса', 'autostekloff' ).'">
                                      '.$html_servise.'   
                                    </select></div>
                            </div>',
                'servise_name'  =>'<div class="form-group">
                                <div>
                                    <input  class="form-control required" type="text" name="servise_name" placeholder="'. __( 'Заглавие отзыва', 'autostekloff' ).'">
                                </div>
                            </div>',
                'img_auto'  =>'<div class="">
                                <div>
                                    <input  type="file" name="img_auto">
                                </div>
                            </div>'
            );

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<div class="form-group"><div> <textarea id="comment" required="required" class="form-control" name="comment" maxlength="65525" aria-required="true" placeholder="'. __( 'Отзыв', 'autostekloff' ).'"></textarea></div></div>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf(
		                              /* translators: %s: login URL */
		                              __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		                              wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
		                          ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
		                              /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
		                              __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
		                              get_edit_user_link(),
		                              /* translators: %s: user name */
		                              esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
		                              $user_identity,
		                              wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
		                          ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_form'           => 'comment-form',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h3>',
		'cancel_reply_before'  => ' <small>',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
		'submit_button'        => '<button class="btn btn-primary " type="submit">'. __( 'Отправить отзыв', 'autostekloff' ).'</button>',
		'submit_field'         => '<div class="modal-footer">%1$s %2$s</div>',
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	// Ensure that the filtered args contain all required default values.
	$args = array_merge( $defaults, $args );

	if ( comments_open( $post_id ) ) : ?>
		<?php
		/**
		 * Fires before the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_before' );
		?> 

    <div id="reviewsModal" class="modal fade bs-example-modal-sm" aria-hidden="true" role="dialog" tabindex="-1" style="clear: both">   <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                    <h4 id="myModalLabelcallback" class="modal-title">
                        <?php _e( 'Оставить отзыв', 'autostekloff' )?>                   
                    
                    </h4>
                </div>
                <div class="modal-body">
			<?php			

			if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
				echo $args['must_log_in'];
				/**
				 * Fires after the HTML-formatted 'must log in after' message in the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_must_log_in_after' );
			else : ?>
				<form autocomplete="off" enctype="multipart/form-data" action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
					<?php
					

					// Prepare an array of all fields, including the textarea
					$comment_fields =  (array) $args['fields'] + array( 'comment' => $args['comment_field'] );

					/**
					 * Filter the comment form fields, including the textarea.
					 *
					 * @since 4.4.0
					 *
					 * @param array $comment_fields The comment fields.
					 */
					$comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

					// Get an array of field names, excluding the textarea
					$comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

					// Get the first and the last field name, excluding the textarea
					$first_field = reset( $comment_field_keys );
					$last_field  = end( $comment_field_keys );

					foreach ( $comment_fields as $name => $field ) {

						
							

							
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

							
						
					}

					$submit_button = sprintf(
						$args['submit_button'],
						esc_attr( $args['name_submit'] ),
						esc_attr( $args['id_submit'] ),
						esc_attr( $args['class_submit'] ),
						esc_attr( $args['label_submit'] )
					);

					/**
					 * Filter the submit button for the comment form to display.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_button HTML markup for the submit button.
					 * @param array  $args          Arguments passed to `comment_form()`.
					 */
					$submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

					$submit_field = sprintf(
						$args['submit_field'],
						$submit_button,
						get_comment_id_fields( $post_id )
					);

					/**
					 * Filter the submit field for the comment form to display.
					 *
					 * The submit field includes the submit button, hidden fields for the
					 * comment form, and any wrapper markup.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_field HTML markup for the submit field.
					 * @param array  $args         Arguments passed to comment_form().
					 */
					echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

					/**
					 * Fires at the bottom of the comment form, inside the closing </form> tag.
					 *
					 * @since 1.5.0
					 *
					 * @param int $post_id The post ID.
					 */
					do_action( 'comment_form', $post_id );
					?>
				</form>
			<?php endif; ?>
		  </div>
                 </div>
        </div>
    </div><!-- #respond -->
		<?php
		/**
		 * Fires after the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_after' );
	else :
		/**
		 * Fires after the comment form if comments are closed.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_comments_closed' );
	endif;
}
function autostecloff_comment_single($comment, $args, $depth){     
    
    $comment_name_user = get_comment_meta($comment -> comment_ID,'name_user',true );
    $comment_img_user = get_comment_meta($comment -> comment_ID,'img_user',true );
    
?>
    <div class="block-comment">
              <img src="<?php echo $comment_img_user; ?>" alt="">
              <p><?php echo $comment->comment_content?><br/><strong><?php echo $comment_name_user; ?> / <?php echo get_comment_date('d.m.Y')?></strong></p>
            </div>
<?php

}
add_action('add_meta_boxes_comment', 'render_comment_meta_admin_box_single', 1);

function render_comment_meta_admin_box_single($comment){
if($comment->comment_post_ID!=35)
	{
		
		add_meta_box('nm_comment_meta_box', __('Дополнительная информация'), 'render_comment_meta_admin_single', 'comment', 'normal');
	}
}      
function render_comment_meta_admin_single($comment) {		
    
		?>
            <table class="form-table editcomment comment_xtra" id="namediv">
	        <tbody>
	        <?php   
	        	$comment_name_user = get_comment_meta($comment -> comment_ID,'name_user',true );                        
                        $comment_img_user = get_comment_meta($comment -> comment_ID,'img_user',true );
	        ?>
		        <tr valign="top">
		            <td class="first"><?php _e( 'Имя', 'autostekloff' )?></td>
                            <td><input name="name_user" type="text" value="<?php echo esc_attr($comment_name_user); ?>"></td>
		        </tr>                        
                        <tr valign="top">
		            <td class="first"><?php _e( 'Урл изображения', 'autostekloff' )?></td>
                            <td><input name="img_user" type="text" value="<?php echo esc_attr($comment_img_user); ?>"></td>
		        </tr>
	        
	       </tbody>
	       </table>
	    <?php
	}
function add_comment_meta_values_single($comment_id) {
    
    
         $name_auto = wp_filter_nohtml_kses($_POST['name_auto']);
        update_comment_meta($comment_id, 'name_user', $name_auto);        
        
         if($_FILES['img_auto']['type'] == "image/gif" || $_FILES['img_auto']['type'] == "image/png"||$_FILES['img_auto']['type'] == "image/jpeg"){
            $img_auto = get_template_directory_uri().'/img/'.$_FILES["img_auto"]["name"];            
       
        move_uploaded_file($_FILES["img_auto"]["tmp_name"], dirname( __FILE__ ).'/img/'.$_FILES["img_auto"]["name"]);
        
        update_comment_meta($comment_id, 'img_user', $img_auto);
        
         }
    
 
}
add_action ('comment_post', 'add_comment_meta_values_single', 1);
function action_single( $comment_id ) {	
    
        $name_user = wp_filter_nohtml_kses($_POST['name_user']);
        update_comment_meta($comment_id, 'name_user', $name_user);        
        $img_user = wp_filter_nohtml_kses($_POST['img_user']);
        update_comment_meta($comment_id, 'img_user', $img_user);
    
}
add_action( 'edit_comment', 'action_single' );

function comment_form2( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();

        $citys=get_terms(array('taxonomy'=>'city','parent'=>0));
        foreach ($citys as $city) {
            $html.='<option value="'.$city->term_id.'">'.$city->name.'</option>';
        }
        $autoservice = new WP_Query();
                        $args = array(                            
                            'post_type' =>array('autoservise'),
                            'tax_query' => array(
                                            array(
                                                    'taxonomy' => 'city',
                                                    'field'    => 'slug',
                                                    'terms'    => $citys[0]->slug,                                                                                                     
                                            )
                                    )                            
                        );
                       
                        $autoservice->query($args); 
                        
                        if ($autoservice->have_posts()) : ?>
                            <?php while ($autoservice->have_posts()) : $autoservice->the_post(); 
                            
                            $html_servise.='<option value="'.get_the_title().'">'.get_the_title().'</option>'
                            
                            
                            ?>
                    
                                
                        <?php endwhile;
                            wp_reset_query(); ?>
                        <?php endif; ?>  
        
        
        <?php
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'name'  =>'<div class="form-group">
                            <div>
                                <input id="name-callback" class="form-control required" type="text" name="name_auto" placeholder="'. __( 'Имя', 'autostekloff' ).'">
                            </div>
                        </div>',                
                'img_auto'  =>'<div class="">
                                <div>
                                    <input  type="file" name="img_auto">
                                </div>
                            </div>'
            );

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<div class="form-group"><div> <textarea id="comment" required="required" class="form-control" name="comment" maxlength="65525" aria-required="true" placeholder="'. __( 'Комментарий', 'autostekloff' ).'"></textarea></div></div>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf(
		                              /* translators: %s: login URL */
		                              __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		                              wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
		                          ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
		                              /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
		                              __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
		                              get_edit_user_link(),
		                              /* translators: %s: user name */
		                              esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
		                              $user_identity,
		                              wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
		                          ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_form'           => 'comment-form',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h3>',
		'cancel_reply_before'  => ' <small>',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
		'submit_button'        => '<button class="btn btn-primary " type="submit">'. __( 'Отправить отзыв', 'autostekloff' ).'</button>',
		'submit_field'         => '<div class="modal-footer">%1$s %2$s</div>',
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	// Ensure that the filtered args contain all required default values.
	$args = array_merge( $defaults, $args );

	if ( comments_open( $post_id ) ) : ?>
		<?php
		/**
		 * Fires before the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_before' );
		?> 

    <div id="reviewsModal" class="modal fade bs-example-modal-sm" aria-hidden="true" role="dialog" tabindex="-1" style="clear: both">   <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                    <h4 id="myModalLabelcallback" class="modal-title">
                        <?php _e( 'Оставить отзыв', 'autostekloff' )?>                   
                    
                    </h4>
                </div>
                <div class="modal-body">
			<?php			

			if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
				echo $args['must_log_in'];
				/**
				 * Fires after the HTML-formatted 'must log in after' message in the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_must_log_in_after' );
			else : ?>
				<form autocomplete="off" enctype="multipart/form-data" action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
					<?php
					

					// Prepare an array of all fields, including the textarea
					$comment_fields =  (array) $args['fields'] + array( 'comment' => $args['comment_field'] );

					/**
					 * Filter the comment form fields, including the textarea.
					 *
					 * @since 4.4.0
					 *
					 * @param array $comment_fields The comment fields.
					 */
					$comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

					// Get an array of field names, excluding the textarea
					$comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

					// Get the first and the last field name, excluding the textarea
					$first_field = reset( $comment_field_keys );
					$last_field  = end( $comment_field_keys );

					foreach ( $comment_fields as $name => $field ) {

						
							

							
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

							
						
					}

					$submit_button = sprintf(
						$args['submit_button'],
						esc_attr( $args['name_submit'] ),
						esc_attr( $args['id_submit'] ),
						esc_attr( $args['class_submit'] ),
						esc_attr( $args['label_submit'] )
					);

					/**
					 * Filter the submit button for the comment form to display.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_button HTML markup for the submit button.
					 * @param array  $args          Arguments passed to `comment_form()`.
					 */
					$submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

					$submit_field = sprintf(
						$args['submit_field'],
						$submit_button,
						get_comment_id_fields( $post_id )
					);

					/**
					 * Filter the submit field for the comment form to display.
					 *
					 * The submit field includes the submit button, hidden fields for the
					 * comment form, and any wrapper markup.
					 *
					 * @since 4.2.0
					 *
					 * @param string $submit_field HTML markup for the submit field.
					 * @param array  $args         Arguments passed to comment_form().
					 */
					echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

					/**
					 * Fires at the bottom of the comment form, inside the closing </form> tag.
					 *
					 * @since 1.5.0
					 *
					 * @param int $post_id The post ID.
					 */
					do_action( 'comment_form', $post_id );
					?>
				</form>
			<?php endif; ?>
		  </div>
                 </div>
        </div>
    </div><!-- #respond -->
		<?php
		/**
		 * Fires after the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_after' );
	else :
		/**
		 * Fires after the comment form if comments are closed.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_comments_closed' );
	endif;
}