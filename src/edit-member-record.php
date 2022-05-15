<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Edit Existing Sales Record</h2>

    <form method="post" action="edit-sales-record.php" novalidate>
    <fieldset>
            <legend>Edit sales record</legend>
            <p>
                <label for="id">ID of member to edit</label>
                <input type="text" name="id" id="id" required />
            </p>
            <p>
                <label for="fname">First name</label>
                <input type="text" name="fname" id="fname" />
            </p>
            <p>
                <label for="lname">Last name</label>
                <input type="text" name="lname" id="lname" />
            </p>
            <p>
                <label for="phone">Phone number</label>
                <input type="text" name="phone" id="phone" />
            </p>
            <p>
                <label for="email">Email address</label>
                <input type="text" name="email" id="email"  />
            </p>
            <p>
                <label for="contpref">Contact preference</label><br>
                <input type="radio" id="prefemail" name="contpref" value="email" checked="checked">
                <label for="prefemail">Email</label><br>
                <input type="radio" id="prefphone" name="contpref" value="phone">
                <label for="prefphone">Phone</label><br>
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
            $c_fname = mysqli_real_escape_string($conn, cleanInput($_POST["fname"]));
            $c_lname = mysqli_real_escape_string($conn, cleanInput($_POST["lname"]));
            $c_phone = mysqli_real_escape_string($conn, cleanInput($_POST["phone"]));
            $c_email = mysqli_real_escape_string($conn, cleanInput($_POST["email"]));
            $c_contpref = mysqli_real_escape_string($conn, cleanInput($_POST["contpref"]));

            $ac_items = explode(' ', $c_items); // array of grocery item ids

            // update the database

            mysqli_autocommit($conn, FALSE);

            mysqli_query($conn, 
            "UPDATE CustomerDetails SET customer_firstname = '$c_fname', 
            customer_lastname = '$c_lname', customer_phone = '$c_phone',
            customer_email = '$c_email', customer_contactpreference = '$c_contpref'
            WHERE customer_id = '$c_id' ");

           
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