<?php
    require('../mysql_connect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php
                if (isset($blogname))
                    echo $blogname;
                else    
                    echo 'Blog title';    
            ?>
        </title>
        <link rel="stylesheet" href="Includes/style.css" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1> <?php echo $blogname ?> </h1>
            [<a href="index.php">Home</a> <a href="categories.php">Categories</a> <a href="login.php">Login</a>]
        </div>

        <div id="main">

