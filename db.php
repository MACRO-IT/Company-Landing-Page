<?php
## DB Connection Credentials
$severname='localhost';
$username='root';
$password='';
$db="macro_landing";




## Connect to the database if connection failed show 'connection failed' and hide the error 
$conn=new mysqli($severname, $username, $password, $db) or die('connection failed.');
    
?>