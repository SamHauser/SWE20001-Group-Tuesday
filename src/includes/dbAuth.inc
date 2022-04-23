<?php
    function OpenConn()
    {
        $servername = "localhost";
        $username = "root";
        $password = "password123";
        $dbname = "GoToGroDB";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn)
        {
            die("Could not connect to database. " . mysqli_connect_error());
        }
        
        return $conn;
    }
     
    function CloseConn($conn)
    {
        mysqli_close($conn);
    }
?>