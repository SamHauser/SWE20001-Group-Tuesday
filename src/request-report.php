<?php include 'includes/header.inc'; ?>
<body>
    <?php include 'includes/menu.inc'; ?>
    <h2>Request Report</h2>

    <form method="post" action="show-report.php">
        <fieldset>
            <legend>Enter date range for report</legend>
            <p>
                <label for="startDate">Start date</label>
                <input type="date" name="startDate" id="startDate" required />
            </p>
            <p>
                <label for="endDate">End date</label>
                <input type="date" name="endDate" id="endDate" required />
            </p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
        </fieldset>
    </form>

    <?php include 'includes/footer.inc'; ?>
</body>
</html>