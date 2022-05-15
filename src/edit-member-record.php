<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Edit Existing Sales Record</h2>

    <form method="post" action="edit-sales-record.php" novalidate>
    <fieldset>
            <legend>Edit sales record</legend>
            <p>
                <label for="id">ID of order to edit</label>
                <input type="text" name="id" id="id" required />
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
            $c_id = mysqli_real_escape_string($conn, cleanInput($_POST["id"]));
            $c_items = mysqli_real_escape_string($conn, cleanInput($_POST["items"]));

            $ac_items = explode(' ', $c_items); // array of grocery item ids

            // update the database

            mysqli_autocommit($conn, FALSE);

            mysqli_query($conn, 
            "DELETE FROM OrderItem WHERE (order_id = $c_id)");

            foreach ($ac_items as $item)
            {
                mysqli_query($conn, 
                "INSERT INTO OrderItem (order_id, product_id)
                VALUES ('$c_id', '$item')");
            }

            // Commit transaction
            if (mysqli_commit($conn))
            {
                echo "Edited order.";
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