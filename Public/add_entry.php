<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/31/2018
 * Time: 12:39 PM
 */
    require("Includes/config.inc.php");
    require("Includes/header.php");

    if (isset($_SESSION['user_id'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cat = $_POST['cat'];
            $subject = strip_tags(trim($_POST['subject']));
            $body = strip_tags(trim($_POST['body']));

            $q = "INSERT INTO entries(cat_id,subject,body,date_posted) 
                  VALUES (?,?,?,NOW())";

            $stmt = mysqli_prepare($db,$q);

            mysqli_stmt_bind_param($stmt,'iss',$cat,$subject,$body);

            mysqli_stmt_execute($stmt);

            if (mysqli_affected_rows($db) == 1){
                echo "<p>Entry added</p>";
            }else{
                echo "<p>Could not add entry</p>";
            }
        }
?>          <h1>Add New Entry</h1>
            <form action="" method="post">
                <table align="center">
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="cat">
                                <?php
                                    $catsql = "SELECT * FROM categories";
                                    $catres = mysqli_query($db,$catsql);

                                    while ($cat_row = mysqli_fetch_assoc($catres)){
                                        ?>
                                        <option value="<?php echo $cat_row['cat_id']; ?>"><?php echo $cat_row['category']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td><input type="text" name="subject" /> </td>
                    </tr>
                    <tr>
                        <td>Body</td>
                        <td><textarea name="body" rows="10" cols="50"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Add Entry!"></td>
                    </tr>
                </table>
            </form><?php
    require("Includes/footer.php");


?>