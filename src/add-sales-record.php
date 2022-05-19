<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Add New Sales Record</h2>

    <form method="post" action="add-sales-record.php" novalidate>
        <fieldset>
            <legend>Enter new order details</legend>
            <p>
                <label for="date">Date of order</label>
                <input type="date" name="date" id="date" required />
            </p>
            <p>
                <label for="timer">Time of order</label>
                <input type="time" name="time" id="time" required />
            </p>
            <p>
                <label for="cusid">Customer ID</label>
                <input type="text" name="cusid" id="cusid" required />
            </p>
            <p>
                <label for="items">Order item IDs (space separated)</label>
                <textarea name="items" id="items" required rows="4" cols="50"></textarea>
            </p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
        </fieldset>
    </form>

    <?php
        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // put all the stuff to be done following form submission in here
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            include 'includes/dbAuth.inc';

            $conn = OpenConn();

            // the cleaned – "safe" – inputs ready to be added to the database
            $c_date = mysqli_real_escape_string($conn, cleanInput($_POST["date"]));
            $c_time = mysqli_real_escape_string($conn, cleanInput($_POST["time"]));
            $c_cusid = mysqli_real_escape_string($conn, cleanInput($_POST["cusid"]));
            $c_items = mysqli_real_escape_string($conn, cleanInput($_POST["items"]));

            $ac_items = explode(' ', $c_items); // array of grocery item ids

            // add to the database

            // disable autocommit for transaction
            mysqli_autocommit($conn, FALSE);

            mysqli_query($conn, 
            "INSERT INTO OrderDetails (order_date, order_time, customer_id)
            VALUES ('$c_date', '$c_time', '$c_cusid')");

            $order_id = mysqli_insert_id($conn); // get the auto_incremented id of the order for use in OrderItem composite key

            foreach ($ac_items as $item)
            {
                mysqli_query($conn, 
                "INSERT INTO OrderItem (order_id, product_id)
                VALUES ('$order_id', '$item')");
            }

            // Commit transaction
            if (mysqli_commit($conn))
            {
                echo "Added order for customer '$c_cusid' to the database.";
            }
            else
            {
                echo "Commit failed. SQL error: " . mysqli_error($conn);
            }

            CloseConn($conn);
        }
    ?>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>