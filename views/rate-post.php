<div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <?php
            $user = wp_get_current_user();
           
            if($user->ID != 1){
              add_action( 'admin_init', function () {
                remove_menu_page( 'edit.php' );
              });
              $args = array( 'posts_per_page' => -1,
              'author' =>  $user->ID, );
            }else{
              $args = array( 'posts_per_page' => -1);
               
            }
                $myposts = get_posts( $args );
                // echo "<pre>";
                // print_r($myposts);
                // echo "</pre>";
                foreach ( $myposts as $post ) : 
                     setup_postdata( $post ); ?>
                    <li><a href="<?php echo get_admin_url() ?>post.php?post=<?php echo $post->ID?>&action=edit"><?php echo $post->post_title; ?></a></li>
                <?php endforeach;