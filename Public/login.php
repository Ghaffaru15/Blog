<?php
    //session_start();
    require('Includes/config.inc.php');

    require("Includes/header.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username =mysqli_real_escape_string($db,trim($_POST['username']));

        $password = mysqli_real_escape_string($db,trim($_POST['password']));

        $sql = "SELECT * FROM logins
                WHERE `username` = '$username' AND `password` = '$password'";
        //Run query
        $res = mysqli_query($db,$sql);
        //Prepare it
        //$stmt = mysqli_prepare($db,$sql);

        //Bind params
        //mysqli_stmt_bind_param($stmt,'ss',$username, $password);

        //mysqli_stmt_execute($stmt);

        if (mysqli_num_rows($res) == 1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['username'] = $row['username'];

            $_SESSION['user_id'] = $row['login_id'];

            header("Location: index.php");
        }else{
            echo '<p>Login credentials wrong</p>';
           echo $username;
            echo $password;
        }

    }
?>
<br />
<form method="post" action="">
    <table align="center">
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" /> </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" /> </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Login!" /> </td>
        </tr>
    </table>
</form>

<?php
    require("Includes/footer.php");
?>