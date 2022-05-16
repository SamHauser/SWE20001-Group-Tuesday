<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Report</h2>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            include 'includes/dbAuth.inc';

            $conn = OpenConn();

            $c_startDate = mysqli_real_escape_string($conn, cleanInput($_POST["startDate"]));
            $c_endDate = mysqli_real_escape_string($conn, cleanInput($_POST["endDate"]));
        }

    ?>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>