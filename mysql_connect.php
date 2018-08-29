<?php

$db = mysqli_connect('localhost','root','iambad0245389652','blog');

if (mysqli_errno($db))
    echo 'could not connect to db';
?>