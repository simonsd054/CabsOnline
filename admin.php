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
            <form method="post">
                <input type="submit" class="form-input-button admin-button" value="List all" name="list_bookings">
            </form>
            <div id="bookings">

                <?php
                $DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
                    or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

                $SQLstring = "select * from booking where status='unassigned' and pickup_time between now() and DATE_ADD(now(), INTERVAL 3 HOUR)";

                $queryResult = @mysqli_query($DBConnect, $SQLstring)
                    or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    $list_bookings = $_POST["list_bookings"];
                    if (
                        isset($list_bookings) ||
                        !empty($list_bookings)
                    ) {

                        if (mysqli_num_rows($queryResult) > 0) {



                            $row = mysqli_fetch_assoc($queryResult);
                            $tempContent = "<table style='margin-top: 20px;'>" .
                                "<tr><th>Reference #</th><th>Customer Name</th><th>Passenger Name</th><th>Passenger Contact Number</th>" .
                                "<th>Pick-up Address</th><th>Destination Suburb</th><th>Pick-up Time</th></tr>";


                            while ($row) {

                                $email = $row["email"];

                                $SQLstringForCustomerName = "select name from user where email='$email'";

                                $queryResultForCustomerName = @mysqli_query($DBConnect, $SQLstringForCustomerName)
                                    or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                                $queryValueForCustomerName = mysqli_fetch_assoc($queryResultForCustomerName);

                                $passenger_pickup_address = "";
                                if ($row["unit_number"]) {
                                    $passenger_pickup_address .= $row["unit_number"] . "/";
                                }
                                $passenger_pickup_address .= $row["street_number"] . " " . $row["street_name"] . ", " . $row["passenger_suburb"];

                                $passenger_pickup_time = date_format(date_create($row["pickup_time"]), "d M H:i");


                                $tempContent .= "<tr><td>" . $row["booking_number"] . "</td>";


                                $tempContent .= "<td>" . $queryValueForCustomerName["name"] . "</td>";
                                $tempContent .= "<td>" . $row["name"] . "</td>";
                                $tempContent .= "<td>" . $row["contact"] . "</td>";
                                $tempContent .= "<td>" . $passenger_pickup_address . "</td>";
                                $tempContent .= "<td>" . $row["destination_suburb"] . "</td>";
                                $tempContent .= "<td>" . $passenger_pickup_time . "</td></tr>";

                                $row = mysqli_fetch_assoc($queryResult);
                            }
                            $tempContent .= "</table>";

                            echo $tempContent;
                        } else {
                            echo "<span class='sub-text'>No Data Found</span>";
                        }
                    }
                }
                ?>

            </div>
        </div>
        <div>
            <p class="sub-text">
                2. Input a reference number below and click "Update" button to assign a taxi to that request
            </p>
            <div class="form-div">
                <form class="form" method="post">
                    <div class="form-item">
                        <label class="form-label" for="reference">Reference Number:</label>
                        <input class="form-input" id="reference" name="reference" placeholder="Reference Number">
                    </div>

                    <?php
                    $refButton = $_POST["ref_button"];
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($refButton) ||
                        !empty($refButton))) {

                        $reference = $_POST["reference"];
                        if (
                            !isset($reference) ||
                            empty($reference)
                        ) {
                            echo "<span class='error-text'>Reference field is required.</span>";
                        } else {
                            $DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
                                or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";


                            $SQLstringForChecking = "select * from booking where status='unassigned'
                                and pickup_time between now() and DATE_ADD(now(), INTERVAL 3 HOUR) 
                                and booking_number='$reference'";

                            $queryResultForChecking = @mysqli_query($DBConnect, $SQLstringForChecking)
                                or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                            if (mysqli_num_rows($queryResultForChecking) > 0) {

                                $SQLstring = "update booking set status='assigned' where booking_number=$reference";

                                $queryResult = @mysqli_query($DBConnect, $SQLstring)
                                    or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                                echo "<span class='success-text'>Taxi assigned to the booking successfully. Click 'List all' to fetch the updated data.</span>";
                            } else {
                                echo "<span class='error-text'>No booking found for the given id within 3 hours. Click 'List all' to fetch the data and see it again.</span>";
                            }
                        }
                    }
                    ?>

                    <div class="form-input-buton-div">
                        <button class="form-input-button admin-button" name="ref_button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>