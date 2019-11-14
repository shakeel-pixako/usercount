<h1>Count Editor All Posts</h1>
<form method="post">
<input type="date" name="from_date"><input type="date" name="to_date"><input type="submit" name="submit" value="Search">
</form>
<?php
$args = array(
    'role'    => 'editor',
    'orderby' => 'nicename',
    'order'   => 'ASC'
);
$users = get_users( $args );

echo '<table class="user_count">';
echo '<tr class="role_head">';
echo '<th>Name</th><th>Total Posts</th><th>Publish</th><th>Schedule</th>';
echo '</tr>';
foreach ( $users as $user ) {
    
    $user->ID ;
   	
   	$user->display_name;
    
 	$publish= array(
 					      'post_type' => 'post',
              		'post_status' => 'publish',
              		'author' =>$user->ID
              	);
     $publish_user_posts = get_posts( $publish );

     $publish_post = count($publish_user_posts);

     $future= array(	'post_type' => 'post',
              		'post_status' => 'future',
              		'author' =>$user->ID
              	);
     $future_user_posts = get_posts( $future );

     $future_post = count($future_user_posts);
	
	
	  $allPosts= $publish_post+	$future_post;
     echo '<tr class="role_body"><td><strong><a href="'.get_site_url().'/wp-admin/edit.php?post_type=post&author='.$user->ID.'">'.$user->display_name.'</a></strong></td><td>'.$allPosts.'</td><td>'.$publish_post.'</td><td>'.$future_post.'</td>';
}
echo '</table>';

if(isset($_POST["submit"])){

  $from_date = $_POST['from_date'];
  $to_date = $_POST['to_date'];

 $args = array(
    'role'    => 'editor',
    'orderby' => 'nicename',
    'order'   => 'ASC'
);
$users = get_users( $args );

echo '<table class="user_count">';
echo '<tr class="role_head">';
echo '<th>Name</th><th>Total Posts</th><th>Publish</th><th>Schedule</th>';
echo '</tr>';
foreach ( $users as $user ) {
    
    $user->ID ;
    
    $user->display_name;
    
  $publish= array(
                'post_type' => 'post',
                  'post_status' => 'publish',
                  'author' =>$user->ID,
                    'date_query' => array(
              array(
                  'after'     => $from_date,
                  'before'    => $to_date
                
                ))
                );
            
     $publish_user_posts = get_posts( $publish );

     $publish_post = count($publish_user_posts);

     $future= array(  'post_type' => 'post',
                  'post_status' => 'future',
                  'author' =>$user->ID,
                    'date_query' => array(
              array(
                  'after'     => $from_date,
                  'before'    => $to_date
                
                )
                
                ));
               
     $future_user_posts = get_posts( $future );

     $future_post = count($future_user_posts);
  
  
    $allPosts= $publish_post+ $future_post;
     echo '<tr class="role_body"><td><strong><a href="'.get_site_url().'/wp-admin/edit.php?post_type=post&author='.$user->ID.'">'.$user->display_name.'</a></strong></td><td>'.$allPosts.'</td><td>'.$publish_post.'</td><td>'.$future_post.'</td>';
}
echo '</table>';

}
