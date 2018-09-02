<?php
    require('Includes/config.inc.php');


    if (isset($_GET['entry_id']) AND is_numeric($_GET['entry_id'])){
        $entry_id = (int)$_GET['entry_id'];

        require('Includes/header.php');

        $sql = "SELECT entries.*, categories.category 
                FROM entries,categories 
                WHERE entries.cat_id=categories.cat_id 
                AND entry_id =" . $entry_id . "
                ORDER BY date_posted DESC LIMIT 1";

        $result = mysqli_query($db,$sql);

        $row = mysqli_fetch_assoc($result);
        ?>
        <h2><?php echo $row['subject']; ?></h2> <br />
        <i>In <a href="view_cat.php?id=<?php echo $row['cat_id']; ?>"><?php echo $row['category']; ?></a>
            - Posted on <?php echo date('D jS F Y g.iA', strtotime($row['date_posted'])); ?>
        </i>
        <p>
            <?php echo nl2br($row['body']); ?>
        </p>
        <?php

        $comm_sql = "SELECT * FROM comments 
                     WHERE entry_id=" . $entry_id . "
                     ORDER BY date_posted DESC";
        $comm_result = mysqli_query($db,$comm_sql);

        if (mysqli_num_rows($comm_result) == 0){
            echo '<p>No comments</p>';
        }
        else{
            while ($comm_row = mysqli_fetch_assoc($comm_result)){
                ?>
                <h3>Comment by: <?php echo $comm_row['name']; ?> On <?php echo date('D jS F Y g.iA',strtotime($comm_row['date_posted'])); ?></h3>
                <?php
                echo $comm_row['comment'];
            }
        }
        ?>
        <h3>Leave a comment</h3>
        <form action="" method="post">
            <table align="center">
                <tr>
                    <td>Your name</td>
                    <td><input type="text" name="name" /></td>
                </tr>
                <tr>
                    <td>Comments</td>
                    <td><textarea name="comment" cols="50" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="submit" /> </td>
                </tr>
            </table>
        </form>
    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = trim($_POST['name']);
            $comment = trim($_POST['comment']);

            $q = "INSERT into comments(entry_id,name,comment,date_posted)
                  VALUES(?,?,?,NOW())";

            //Prepare the statement
            $stmt = mysqli_prepare($db,$q);

            //Bind to the post values
            mysqli_stmt_bind_param($stmt,'iss',$entry_id,$name,$comment);

            mysqli_stmt_execute($stmt);

            if (mysqli_affected_rows($db) == 1){
                header("Location: view_entry.php?entry_id=$entry_id");
            }
            else{
                echo 'Could not add your comment';
            }
        }
    }

    else{
        header('Location: index.php');
    }
?>