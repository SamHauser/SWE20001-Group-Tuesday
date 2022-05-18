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

            /// members list ///
            $sql = "SELECT * FROM CustomerDetails";

            $results = mysqli_query($conn, $sql);

            echo "<h3>Members</h3>";
            
            echo "<table>";
            echo "<table border=\"1\">\n"; 
            echo "<tr>\n " 
            ."<th scope=\"col\">ID</th>\n " 
            ."<th scope=\"col\">First Name</th>\n " 
            ."<th scope=\"col\">Last Name</th>\n "
            ."<th scope=\"col\">Phone Number</th>\n "
            ."<th scope=\"col\">Email</th>\n "
            ."<th scope=\"col\">Contact Preference</th>\n "
            ."</tr>\n "; 

            while($row = mysqli_fetch_array($results)) 
            {
                echo "<tr>";
                echo "<td>" . $row['customer_id'] . "</td>";
                echo "<td>" . $row['customer_firstname'] . "</td>";
                echo "<td>" . $row['customer_lastname'] . "</td>";
                echo "<td>" . $row['customer_phone'] . "</td>";
                echo "<td>" . $row['customer_email'] . "</td>";
                echo "<td>" . $row['customer_contactpreference'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            /// top selling (this doesn't work with the dates yet :) )  ///
            $sql = 
            "SELECT COUNT(product_id) AS sales, product_id FROM
            (SELECT product_id, order_id, order_date FROM OrderItem NATURAL JOIN OrderDetails WHERE 
            order_date BETWEEN '$c_startDate' AND '$c_endDate') AS I_LOVE_SQL
            GROUP BY product_id
            ORDER BY sales DESC";

            $results = mysqli_query($conn, $sql);

            echo "<h3>Top selling lines</h3>";

            echo "<table>";
            echo "<table border=\"1\">\n"; 
            echo "<tr>\n " 
            ."<th scope=\"col\">Sales</th>\n " 
            ."<th scope=\"col\">ID</th>\n " 
            ."</tr>\n "; 

            while($row = mysqli_fetch_array($results)) 
            {
                echo "<tr>";
                echo "<td>" . $row['sales'] . "</td>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            CloseConn($conn);
        }
    ?>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>