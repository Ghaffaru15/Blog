<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/31/2018
 * Time: 12:18 PM
 */
    require("Includes/config.inc.php");

    require("Includes/header.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cat = trim($_POST['cat']);

        $sql = "INSERT INTO categories(category)
                VALUES (?)";

        $stmt = mysqli_prepare($db,$sql);

        mysqli_stmt_bind_param($stmt,'s',$cat);

        mysqli_stmt_execute($stmt);

        if (mysqli_affected_rows($db) == 1){
            echo "<p>Category added</p>";
        }
        else{
            echo "<p>Could not add category</p>";
        }
    }
    if (isset($_SESSION['user_id'])) {
        ?>
        <form action="" method="post">
            <table align="center">
                <tr>
                    <td>Category</td>
                    <td><input type="text" name="cat"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Add Category!"/></td>
                </tr>
            </table>
        </form>
        <?php
    }
    else{
        header("Location: index.php");
    }

    require("Includes/footer.php");
        ?>