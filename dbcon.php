<?php

$con = mysqli_connect("localhost","root","","doctors");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>