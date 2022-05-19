<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Add New Product</h2>

    <form method="post" action="add-grocery.php">
        <fieldset>
            <legend>Enter new product details</legend>
            <p>
                <label for="id">Product ID</label>
                <input type="text" name="id" id="id" required />
            </p>
            <p>
                <label for="name">Product name</label>
                <input type="text" name="name" id="name" required />
            </p>
            <p>
                <label for="info">Product info</label>
                <textarea name="info" id="info" required rows="4" cols="50"></textarea>
            </p>
            <p>
                <label for="quan">Quantity</label>
                <input type="text" name="quan" id="quan" required />
            </p>
            <p>
                <label for="price">Price</label>
                <input type="text" name="price" id="price" required />
            </p>
            <p>
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
            $c_quan = mysqli_real_escape_string($conn, cleanInput($_POST["quan"]));
            $c_price = mysqli_real_escape_string($conn, cleanInput($_POST["price"]));
            // add to the database

            $sql = 
            "INSERT INTO ProductInformation (product_id, product_name, product_information, quantity, price)
            VALUES ('$c_id', '$c_name', '$c_info', '$c_quan', '$c_price')";

            if (mysqli_query($conn, $sql))
            {
                echo "Added product '$c_name' to the database.";
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