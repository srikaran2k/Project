<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('connection/config.php');
    
    //Connect to mysqli server
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
   
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        global $conn;
        $str = trim($str); // Removed @ operator since suppressing errors isn't a good practice
        // Removed get_magic_quotes_gpc() since it's deprecated and removed in newer versions of PHP
        return mysqli_real_escape_string($conn, $str);
    }
    
    
    //Sanitize the POST values
    $name = clean($_POST['name']);
    
    //define a default value for flag
    $flag_0 = 0;

    //Create INSERT query
    $qry = "INSERT INTO timezones(timezone_reference,flag) VALUES('$name','$flag_0')";
    $result = @mysqli_query($conn,$qry);
    
    //Check whether the query was successful or not
    if($result) {
        header("location: options.php");
        exit();
    }else {
        die("Query failed " . mysqli_error());
    }
 ?>