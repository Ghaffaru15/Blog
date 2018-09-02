<?php
    session_start();
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
            [<a href="index.php">Home</a> <a href="view_cat.php">Categories</a>
            <?php
                if (isset($_SESSION['user_id'])){
            ?>      <a href="logout.php">Logout</a>
                    <a href="new_cat.php">Add category</a>
                    <a href="add_entry.php">Add Entry</a>
                <?php
                }
                else{
                    ?><a href="login.php">Login</a><?php
                    }

            ?>
            ]
        </div>

        <div id="main">

