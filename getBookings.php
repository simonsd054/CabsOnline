<?php

header('Content-Type: text/xml');

$DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
    or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

$SQLstring = "select * from booking where status='unassigned' and pickup_time between now() and DATE_ADD(now(), INTERVAL 3 HOUR)";

$queryResult = @mysqli_query($DBConnect, $SQLstring)
    or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

echo toXml($queryResult, $DBConnect);


function toXml($queryResult, $DBConnect)
{
    $row = mysqli_fetch_assoc($queryResult);

    $doc = new DomDocument('1.0');
    $bookings = $doc->createElement('bookings');
    $bookings = $doc->appendChild($bookings);

    while ($row) {
        $booking = $doc->createElement('booking');
        $booking = $bookings->appendChild($booking);

        $email = $row["email"];

        $SQLstring = "select name from user where email='$email'";

        $queryResult = @mysqli_query($DBConnect, $SQLstring)
            or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

        $queryValue = mysqli_fetch_assoc($queryResult);

        $booking_number = $doc->createElement('booking_number');
        $booking_number = $booking->appendChild($booking_number);
        $value = $doc->createTextNode($row["booking_number"]);
        $value = $booking_number->appendChild($value);

        $cname = $doc->createElement('cname');
        $cname = $booking->appendChild($cname);
        $value = $doc->createTextNode($queryValue["name"]);
        $value = $cname->appendChild($value);

        $name = $doc->createElement('name');
        $name = $booking->appendChild($name);
        $value = $doc->createTextNode($row["name"]);
        $value = $name->appendChild($value);

        $contact = $doc->createElement('contact');
        $contact = $booking->appendChild($contact);
        $value = $doc->createTextNode($row["contact"]);
        $value = $contact->appendChild($value);

        $passenger_pickup_address = "";
        if ($row["unit_number"]) {
            $passenger_pickup_address .= $row["unit_number"] . "/";
        }
        $passenger_pickup_address .= $row["street_number"] . " " . $row["street_name"] . ", " . $row["passenger_suburb"];

        $pickup_address = $doc->createElement('pickup_address');
        $pickup_address = $booking->appendChild($pickup_address);
        $value2 = $doc->createTextNode($passenger_pickup_address);
        $value2 = $pickup_address->appendChild($value2);

        $destination_suburb = $doc->createElement('destination_suburb');
        $destination_suburb = $booking->appendChild($destination_suburb);
        $value = $doc->createTextNode($row["destination_suburb"]);
        $value = $destination_suburb->appendChild($value);

        $passenger_pickup_time = date_format(date_create($row["pickup_time"]), "d M H:i");

        $pickup_time = $doc->createElement('pickup_time');
        $pickup_time = $booking->appendChild($pickup_time);
        $value = $doc->createTextNode($passenger_pickup_time);
        $value = $pickup_time->appendChild($value);

        $booking_time = $doc->createElement('booking_time');
        $booking_time = $booking->appendChild($booking_time);
        $value = $doc->createTextNode($row["booking_time"]);
        $value = $booking_time->appendChild($value);

        $row = mysqli_fetch_assoc($queryResult);
    }

    $strXml = $doc->saveXML();
    return $strXml;
}
