<?php
    function OpenConn()
    {
        $servername = "database-gotogro-instance-1.caqrq45q3xiq.us-west-1.rds.amazonaws.com";
        $username = "admin";
        $password = "lobster123";
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