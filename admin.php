<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="form.css" />
    <link rel="stylesheet" href="admin.css" />
    <script src="admin.js"></script>
    <title>Admin</title>
</head>

<body>
    <main>
        <h1 class="header">Admin page of CabsOnline</h1>
        <div class="request-table">
            <p class="sub-text">
                1. Click below button to search for all unassigned booking requests with a pick-up time within 3 hours.
            </p>
            <input type="button" class="form-input-button admin-button" value="List all" onclick="displayAllBookings()">
            <div id="bookings"></div>
        </div>
        <div>
            <p class="sub-text">
                2. Input a reference number below and click "Update" button to assign a taxi to that request
            </p>
            <div class="form-div">
                <form method="post">
                    <div class="form-item">
                        <label class="form-label" for="reference">Reference Number:</label>
                        <input class="form-input" id="reference" name="reference" placeholder="Reference Number">
                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $reference = $_POST["reference"];
                        if (
                            !isset($reference) ||
                            empty($reference)
                        ) {
                            $erroMessage = "<span class='error-text'>Reference field is required.</span>";
                        } else {
                            $DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
                                or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

                            $SQLstring = "update booking set status='assigned' where booking_number=$reference";

                            $queryResult = @mysqli_query($DBConnect, $SQLstring)
                                or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                            echo "<span class='sub-text'>Taxi assigned to the booking successfully. Click 'List all' to fetch the updated data.</span>";
                        }
                    }
                    ?>
                    <div class="form-input-buton-div">
                        <button class="form-input-button admin-button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>