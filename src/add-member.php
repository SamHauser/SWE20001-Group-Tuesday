<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Add New Member</h2>

    <form method="post" action="add-member.php" novalidate>
        <fieldset>
            <legend>Enter new member details</legend>
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
                <input type="text" name="email" id="email" />
            </p>
            <p>
                <label for="contpref">Contact preference</label><br>
                <input type="radio" id="prefemail" name="contpref" value="email" checked="checked">
                <label for="prefemail">Email</label><br>
                <input type="radio" id="prefphone" name="contpref" value="phone">
                <label for="prefphone">Phone</label><br>
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
            // the cleaned – "safe" – inputs ready to be added to the database
            $c_fname = cleanInput($_POST["fname"]);
            $c_lname = cleanInput($_POST["lname"]);
            $c_phone = cleanInput($_POST["phone"]);
            $c_email = cleanInput($_POST["email"]);
            $c_contpref = cleanInput($_POST["contpref"]);

            // add to customers database
            // ...
        }
    ?>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>