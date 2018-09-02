<?php
    require("Includes/config.inc.php");

    require("Includes/header.php");

    if (isset($_GET['cat_id']) AND is_numeric($_GET['cat_id'])){
        $cat_id = (int)$_GET['cat_id'];

        $sql = "SELECT * FROM categories 
                WHERE cat_id=$cat_id";

        $res = mysqli_query($db,$sql);

        if (mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)){
?>
                <h3>Category</h3>
                <strong><?php echo $row['category']; ?> </strong> <br />
<?php
                $entries_sql = "SELECT * FROM entries 
                                WHERE cat_id=$cat_id 
                                ORDER BY date_posted DESC";

                $entries_res = mysqli_query($db,$entries_sql);

                $num_rows = mysqli_num_rows($entries_res);
?>
                <ul>
<?php
                if ($num_rows == 0){
                    echo "<li>No entries</li>";
                }
                else{
                    while ($entries_row = mysqli_fetch_assoc($entries_res)){
?>
                        <li><?php echo date("D jS F Y g.iA", strtotime($entries_row['date_posted'])); ?>
                       - <a href="view_entry.php?entry_id=<?php echo $entries_row['entry_id']; ?>"> <?php echo $entries_row['subject']; ?>
                            <?php
                                if (isset($_SESSION['user_id'])){
                                    echo   '  <a href="edit_entry.php?entry_id=' .$entries_row['entry_id']. '">[ Edit ]</a>';
                                }
                                ?>
                         </a>
                        </li>
<?php
                    }
                }
                echo '</ul>';
            }
        }
        //else{
?>
          <!--          <a href="view_cat.php?cat_id=<?php// echo $cat_id; ?>"><?php// echo $row['category']; ?></a><br /> -->
<?php
        //}
    }
    else{
        $all_cat_query = "SELECT * FROM categories";

        $all_res = mysqli_query($db,$all_cat_query);

        if (mysqli_num_rows($all_res) > 0){
            echo '<h3>Categories</h3>';
            while ($all_row = mysqli_fetch_assoc($all_res)){
?>
                    <a href="view_cat.php?cat_id=<?php echo $all_row['cat_id']; ?>"><?php echo $all_row['category']; ?></a> <br /> <br />
<?php
            }
        }
    }

require("Includes/footer.php");
?>