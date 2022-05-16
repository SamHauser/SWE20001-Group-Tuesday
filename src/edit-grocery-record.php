<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Edit Existing Grocery Record</h2>

    <form method="post" action="edit-grocery-record.php" novalidate>
    <fieldset>
            <legend>Edit grocery record</legend>
            <p>
                <label for="id">ID of product to edit</label>
                <input type="text" name="id" id="id" required />
            </p>
            <p>
                <label for="name">Updated name of the product</label>
                <input type="text" name="name" id="name"/>
            </p>
            <p>
                <label for="info">Updated product information</label>
                <textarea name="info" id="info" required rows="4" cols="50"></textarea>
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
            $c_name = mysqli_real_escape_string($conn, cleanInput($_POST["name"]));
            $c_info = mysqli_real_escape_string($conn, cleanInput($_POST["info"]));
           

            // update the database

            mysqli_autocommit($conn, FALSE);

            $sql = 
            "UPDATE ProductInformation SET product_name = '$c_name', 
            product_information = '$c_info' WHERE product_id = '$c_id' ";

            // Commit transaction
            if (mysqli_query($conn, $sql))
            {
                if (mysqli_affected_rows($conn) > 0)
                { // confirmation of change
                    echo "Edited item.";
                }
                else
                {
                    echo "Error: No database records changed. Check ID is correct.";
                }
            }
            else
            {
                echo "SQL error: " . mysqli_error($conn);
            }

            CloseConn($conn);
        }
    ?>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>