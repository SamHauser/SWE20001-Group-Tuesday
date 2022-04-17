<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Edit Existing Sales Record</h2>

    <form method="post" action="edit-sales-record.php" novalidate>
    <fieldset>
            <legend>Edit sales record</legend>

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


            // add to customers database
            // ...
        }
    ?>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>