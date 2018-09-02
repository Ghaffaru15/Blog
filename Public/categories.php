<?php
    require("Includes/config.inc.php");

    require('Includes/header.php');

    $sql = "SELECT * FROM categories";

    $res = mysqli_query($db,$sql);

    if (mysqli_num_rows($res) > 0){
        while ($row = mysqli_fetch_assoc($res)){

        }
    }
?>