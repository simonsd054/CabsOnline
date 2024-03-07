xhr = new XMLHttpRequest()

function displayAllBookings() {
    xhr.open("GET", "getBookings.php?" + "&value=" + Number(new Date()), true)
    xhr.onreadystatechange = showAllBookings
    xhr.send(null)
}

function showAllBookings() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        var serverResponse = xhr.responseXML
        var bookings = serverResponse.getElementsByTagName("booking")

        var bookingsDiv = document.getElementById("bookings")

        if (bookings.length > 0) {
            var tempContent = "<table style='margin-top: 20px;'>" +
            "<tr><th>Reference #</th><th>Customer Name</th><th>Passenger Name</th><th>Passenger Contact Number</th>" +
            "<th>Pick-up Address</th><th>Destination Suburb</th><th>Pick-up Time</th></tr>"
            for (i = 0; i < bookings.length; i++) {
                var booking_number = bookings[i].getElementsByTagName("booking_number")[0].textContent
                var cname = bookings[i].getElementsByTagName("cname")[0].textContent
                var name = bookings[i].getElementsByTagName("name")[0].textContent
                var contact = bookings[i].getElementsByTagName("contact")[0].textContent
                var pickup_address = bookings[i].getElementsByTagName("pickup_address")[0].textContent
                var destination_suburb = bookings[i].getElementsByTagName("destination_suburb")[0].textContent
                var pickup_time = bookings[i].getElementsByTagName("pickup_time")[0].textContent

                tempContent += "<tr><td>" + booking_number + "</td>"
                tempContent += "<td>" + cname + "</td>"
                tempContent += "<td>" + name + "</td>"
                tempContent += "<td>" + contact + "</td>"
                tempContent += "<td>" + pickup_address + "</td>"
                tempContent += "<td>" + destination_suburb + "</td>"
                tempContent += "<td>" + pickup_time + "</td></tr>"

            }
            tempContent += "</table>"
            bookingsDiv.innerHTML = tempContent
        } else {
            bookingsDiv.innerHTML = "<span class='sub-text'>No Data Found</span>"
        }
    }
}
