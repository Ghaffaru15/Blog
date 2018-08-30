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
    }
    else{
        header('Location: index.php');
    }
?>