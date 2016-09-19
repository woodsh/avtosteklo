<?php if (comments_open()) { ?>   
  
  <?php
  global $autostekloff;
  $comments_query = new WP_Comment_Query();
  $args_com = array(          
                 'post_id' => get_the_ID(),
                 'order' => 'DESC',
        );
  $comment = $comments_query->query( $args_com );
  wp_list_comments('per_page='.$autostekloff['number-reviews'].'&type=comment&callback=autostecloff_comment',$comment); ?>

 <?php
 
comment_form1( $args );

?>
<?php }
