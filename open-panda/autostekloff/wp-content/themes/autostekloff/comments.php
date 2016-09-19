<?php if (comments_open()) { ?>
    <h4>комментарии <i><?php echo $post->comment_count;?></i></h4> <a href="#" class="add_comm" data-target="#reviewsModal" data-toggle="modal">Оставить комментарий</a>  
  
  <?php wp_list_comments('type=comment&callback=autostecloff_comment_single'); ?>
 
<?php } else { ?>
  <h3>Обсуждения закрыты для данной страницы</h3>
<?php } ?>