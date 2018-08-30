<?php
    require('Includes/config.inc.php');

    require('Includes/header.php');

    
   $q = "SELECT categories.cat_id, category, entries.*, subject, body, date_posted 
        FROM categories, entries 
        WHERE categories.cat_id = entries.cat_id 
        ORDER BY date_posted DESC 
        LIMIT 1";

    $r = mysqli_query($db,$q);

    if (mysqli_num_rows($r) > 0){
        $row = mysqli_fetch_assoc($r); 

        ?> <h2>
            <a href="view_entry.php?entry_id=<?php echo $row['entry_id']; ?>"> <?php echo $row['subject']; ?>
            </a>
           </h2> <br />
           <i>
                In <a href="view_cat.php?cat_id=<?php echo $row['cat_id']; ?>"><?php echo $row['category']; ?>
                  </a>
                  - Posted on <?php echo  date("D jS F Y g.iA",strtotime($row['date_posted'])); ?>
           </i> <br />
           <p> <?php echo nl2br($row['body']); ?> </p>

           <p>
                
        <?php
            $comment_query = "SELECT name FROM comments WHERE entry_id=". $row['entry_id'] . 
                                " ORDER BY date_posted";
            
            $result = mysqli_query($db,$comment_query);

            $num = mysqli_num_rows($result);

            if ($num == 0)
                echo '<p><strong>No comments</strong></p>';
            else{
                echo "(<strong>" . $num . "</strong>) comments : ";

               // $i = 1;

                while ($commrow = mysqli_fetch_assoc($result)){
                    echo '
                    <a href="view_entry.php?entry_id=' .  $row['entry_id'] . '">' .
                    $commrow['name'] . "</a>";
                    
                   // $i++; 
              
                }
            }
                echo '</p>';
                $previous = "SELECT entries.*, categories.category FROM entries,categories
                            WHERE categories.cat_id = entries.cat_id 
                            ORDER BY date_posted DESC 
                            LIMIT 1,5";
                $r_previous = mysqli_query($db,$previous);
                $prev_num = mysqli_num_rows($r_previous);

                if ($prev_num == 0){
                    echo '<p>No previous entries </p>';
                }
                else{
                    ?>
                    <ul>
                        <?php 
                            while ($prev_row = mysqli_fetch_assoc($r_previous)){
                                ?>
                                <li>
                                    <a href="view_entry.php?entry_id=<?php echo $prev_row['entry_id']; ?>">
                                    <?php
                                        echo $prev_row['subject']; 

                                    ?>
                                </li>
                                <?php
                            }
                    ?></ul><?php
                }
            }
        
    require('Includes/footer.php');

    
?>