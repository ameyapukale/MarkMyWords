<div class="wrap">
<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<?php
global $post;
$user = wp_get_current_user();
if($user->ID != 1){
  remove_menu_page( 'edit.php' );
  $args = array( 'posts_per_page' => -1,
               'author' =>  $user->ID, );
}else{
  $args = array( 'posts_per_page' => -1);
}
 $myposts = get_posts( $args );?>
 <table style="width:50%">
  <tr>
    <th>Blog Title</th>
    <th>Author</th>
    <th>Score</th>
  </tr>
 <?php
  foreach ( $myposts as $post ) : 
      setup_postdata( $post ); ?>
      <tr>
        <td>
          <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li></td>
        <td> <?php the_author(); ?></td>
        <td>
          <?php 
              $param= array();
              $param[] = get_post_meta( $post->ID, "story_box_id_select", true );
              $param[] =  get_post_meta( $post->ID, "flow_box_id_select", true );
              $param[] =  get_post_meta( $post->ID, "message_box_id_select", true );
              $param[] =  get_post_meta( $post->ID, "word_count_box_id_select", true );
              $param[] =  get_post_meta( $post->ID, "vision_motive_box_id_select", true );
              $points = array_sum($param);
              if($points <= 20){
                $grade = "Terrible";
              }elseif($points >= 21 && $points <= 40 ){
                $grade = "Poor";
              }elseif($points >= 41 && $points <= 60 ){
                $grade = "Average";
              }elseif($points >= 61 && $points <= 80 ){
                $grade = "Very Good";
              }elseif($points >= 81 && $points <= 100 ){
                $grade = "Excellent";
              }
              if($points == 0){
                $grade = "";
                echo $points;
              }else{
                echo $grade ."-". $points;
              }
          ?>
        </td>
      </tr>
  <?php endforeach;
 ?>
</table>


    