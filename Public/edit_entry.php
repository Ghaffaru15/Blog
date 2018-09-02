<?php
    require("Includes/config.inc.php");
    require("Includes/header.php");

    if (isset($_SESSION['user_id'])){
        if (isset($_GET['entry_id']) AND is_numeric($_GET['entry_id'])){
            $entry_id = $_GET['entry_id'];
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cat_id = $_POST['cat'];
                $subject = trim($_POST['subject']);
                $body = trim($_POST['body']);

                $sql = "UPDATE entries 
                        SET cat_id=?, subject = ?, body = ?
                        WHERE entry_id=$entry_id";

                $stmt = mysqli_prepare($db,$sql);

                mysqli_stmt_bind_param($stmt,'iss',$cat_id,$subject,$body);

                mysqli_stmt_execute($stmt);

                if (mysqli_affected_rows($db) == 1){
                    echo '<p>Entry Updated</p>';
                }


            }


            $update_sql = "SELECT * FROM entries 
                           WHERE entry_id=$entry_id";
            $update_res = mysqli_query($db,$update_sql);

            if (mysqli_num_rows($update_res) == 1){
                $row = mysqli_fetch_assoc($update_res);

                }
            ?>
            <h3>Update Entry</h3>
            <form action="" method="post">
                <table align="center"
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="cat">
                                <?php
                                $cat_sql = "SELECT * FROM categories";


                                $cat_res = mysqli_query($db,$cat_sql);

                                if (mysqli_num_rows($cat_res) > 0) {
                                    while ($cat_row = mysqli_fetch_assoc($cat_res)) {
                                        ?><option value="<?php echo $cat_row['cat_id']; ?>"
                                        <?php
                                            if ($cat_row['cat_id'] == $row['cat_id']){
                                                echo ' selected';
                                            }
                                        ?>
                                        ><?php echo $cat_row['category']; ?>
                                        </option><?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td><input type="text" name="subject" value="<?php echo $row['subject']; ?>" /> </td>
                    </tr>
                    <tr>
                        <td>Body</td>
                        <td><textarea name="body" rows="10" cols="50"><?php echo $row['body']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Update Entry!" /> </td>
                    </tr>
                </table>
            </form>
<?php
        }else
            echo '<p>No entry id</p>';
}
else
    echo '<p>You are not logged in </p>';

    require("Includes/footer.php");
?>