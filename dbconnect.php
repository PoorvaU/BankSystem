<?php
        $con = new mysqli('localhost','root','','banksystem');

        if(!$con) {
        die("Connection Unsuccesful: " .mysqli_connect_error());
        }
?>