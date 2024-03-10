<!--
Student Name: Simon Dahal
Student ID: 103158504

Function of the file: This file allows the user to make a booking for a cab
by providing details such as passenger name, passenger contact number,
passenger address, destination suburb, pickup date and pickup time.
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="card.css" />
    <link rel="stylesheet" href="form.css" />
    <link rel="stylesheet" href="booking.css" />
    <title>Booking</title>
</head>

<body>
    <main>
        <div class="card">
            <h1 class="card-header">Booking a cab</h1>
            <?php
            // get email from get superglobal from url
            $email = $_GET["Email"];
            if (empty($email)) {
                header("Location:login.php");
            }
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                // get all fields
                $name = $_POST["name"];
                $contact = $_POST["contact"];
                $unit_number = $_POST["unit_number"];
                $street_number = $_POST["street_number"];
                $street_name = $_POST["street_name"];
                $passenger_suburb = $_POST["passenger_suburb"];
                $destination_suburb = $_POST["destination_suburb"];
                $pickup_date = $_POST["pickup_date"];
                $pickup_time = $_POST["pickup_time"];
                // check for all the required fields
                if (
                    !isset($name) ||
                    !isset($contact) ||
                    !isset($street_number) ||
                    !isset($street_name) ||
                    !isset($passenger_suburb) ||
                    !isset($destination_suburb) ||
                    !isset($pickup_date) ||
                    !isset($pickup_time) ||
                    empty($name) ||
                    empty($contact) ||
                    empty($street_number) ||
                    empty($street_name) ||
                    empty($passenger_suburb) ||
                    empty($destination_suburb) ||
                    empty($pickup_date) ||
                    empty($pickup_time)
                ) {
                    $erroMessage = "<span class='error-text'>All fields except unit number are required</span>";
                } else {
                    // here if every input field checks out

                    date_default_timezone_set('Australia/Sydney');
                    $booking_time = date("Y-m-d H:i:s");
                    $booking_time_str = strtotime($booking_time);
                    $pickup_full_time = $pickup_date . " " . $pickup_time;
                    $pickup_time_str = strtotime($pickup_full_time);


                    $diff = $pickup_time_str - $booking_time_str;

                    if ($diff >= 2400) {

                        $DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
                            or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

                        $SQLstring = "
                            insert into booking
                            (email, name, contact, unit_number, street_number, street_name, passenger_suburb, destination_suburb, pickup_time, booking_time) values
                            ('$email', '$name', '$contact', '$unit_number', '$street_number', '$street_name', '$passenger_suburb', '$destination_suburb', '$pickup_full_time', '$booking_time')";

                        $queryResult = @mysqli_query($DBConnect, $SQLstring)
                            or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                        $recently_inserted_id = mysqli_insert_id($DBConnect);
                        $SQLstring = "select * from booking where booking_number='$recently_inserted_id'";

                        $queryResult = @mysqli_query($DBConnect, $SQLstring)
                            or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                        $queryValue = mysqli_fetch_assoc($queryResult);

                        $booking_number = $queryValue["booking_number"];
                        echo "<span class='success-text'>Thank you!
                            Your booking reference number is $booking_number. We will pick up the
                            passengers in front of your provided address at $pickup_time on $pickup_date.
                            You can fill up the form again for another booking.</span>";

                        $SQLstringForCustomerName = "select name from user where email='$email'";

                        $queryResultForCustomerName = @mysqli_query($DBConnect, $SQLstringForCustomerName)
                            or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

                        $queryValueForCustomerName = mysqli_fetch_assoc($queryResultForCustomerName);

                        $customer_name = $queryValueForCustomerName["name"];
                        

                        $to = $email;
                        $subject = "Your booking request with CabsOnline!";
                        $message = "Dear $customer_name, Thanks for booking with CabsOnline! Your booking reference number is $booking_number. We will pick up the passengers in front of your provided address at $pickup_time on $pickup_date.";
                        $headers = "From: booking@cabsonline.com.au";
                        mail($to, $subject, $message, $headers, "-r 103158504@student.swin.edu.au");
                    } else {
                        $erroMessage = "<span class='error-text'>Pickup time must be at least 40 minutes from now.</span>";
                    }
                }
            }
            ?>
            <p class="sub-text">Please fill the fields below to book a cab</p>
            <form class="form" method="post">
                <div class="form-item">
                    <label class="form-label" for="name">Passenger Name:</label>
                    <input class="form-input" id="name" name="name" placeholder="Name" />
                </div>
                <div class="form-item">
                    <label class="form-label" for="contact">Passenger Contact:</label>
                    <input type="number" class="form-input form-input-phone" id="contact" name="contact" placeholder="Contact (0412345678)" />
                </div>

                <div class="form-item">
                    <div class="form-label">Pickup Address (Fill four fields below for pickup address):</div>
                </div>

                <div class="form-item-address">
                    <div class="form-item">
                        <label class="form-label" for="unit_number">Unit Number:</label>
                        <input class="form-input" id="unit_number" name="unit_number" placeholder="Unit Number" />
                    </div>
                    <div class="form-item">
                        <label class="form-label" for="street_number">Street Number:</label>
                        <input class="form-input" id="street_number" name="street_number" placeholder="Street Number" />
                    </div>
                    <div class="form-item">
                        <label class="form-label" for="street_name">Street Name:</label>
                        <input class="form-input" id="street_name" name="street_name" placeholder="Street Name" />
                    </div>
                    <div class="form-item">
                        <label class="form-label" for="passenger_suburb">Suburb:</label>
                        <input class="form-input" id="passenger_suburb" name="passenger_suburb" placeholder="Passenger Suburb" />
                    </div>
                </div>

                <div class="form-item">
                    <label class="form-label" for="destination_suburb">Destination Suburb:</label>
                    <input class="form-input" id="destination_suburb" name="destination_suburb" placeholder="Destination Suburb" />
                </div>
                <div class="form-item">
                    <label class="form-label" for="pickup_date">Pickup Date:</label>
                    <input type="date" id="pickup_date" class="form-input" name="pickup_date" placeholder="Pickup Date" />
                </div>
                <div class="form-item">
                    <label class="form-label" for="pickup_time">Pickup Time:</label>
                    <input type="time" id="pickup_time" class="form-input" name="pickup_time" placeholder="Pickup Time" />
                </div>

                <?php
                echo $erroMessage;
                ?>

                <div class="form-input-buton-div">
                    <button class="form-input-button">Book</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>