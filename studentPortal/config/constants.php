<?php

//Start Session
session_start();


//Create Constants to Store Non-Repeating Values
const SITEURL = 'http://localhost/X/';
const LOCALHOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'hostel';

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //Database Connection

$db_select = mysqli_select_db($conn, DB_NAME); //SElecting Database


?>