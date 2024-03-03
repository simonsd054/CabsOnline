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
            <p class="sub-text">Please fill the fields below to book a cab</p>
            <form method="post">
                <div class="form-item">
                    <label class="form-label" for="name">Passenger Name:</label>
                    <input class="form-input" name="name" placeholder="Name" />
                </div>
                <div class="form-item">
                    <label class="form-label" for="contact">Passenger Contact:</label>
                    <input type="number" class="form-input form-input-phone" name="contact" placeholder="Contact (0412345678)" />
                </div>

                <div class="form-item">
                    <div class="form-label">Pickup Address (Fill four fields below for pickup address):</div>
                </div>

                <div class="form-item-address">
                    <div class="form-item">
                        <label class="form-label" for="unit">Unit Number:</label>
                        <input class="form-input" name="unit" placeholder="Unit Number" />
                    </div>
                    <div class="form-item">
                        <label class="form-label" for="street_number">Street Number:</label>
                        <input class="form-input" name="street_number" placeholder="Street Number" />
                    </div>
                    <div class="form-item">
                        <label class="form-label" for="street_name">Street Name:</label>
                        <input class="form-input" name="street_name" placeholder="Street Name" />
                    </div>
                    <div class="form-item">
                        <label class="form-label" for="suburb">Suburb:</label>
                        <input class="form-input" name="suburb" placeholder="Suburb" />
                    </div>
                </div>

                <div class="form-item">
                    <label class="form-label" for="destination">Destination Suburb:</label>
                    <input class="form-input" name="destination" placeholder="Destination Suburb" />
                </div>
                <div class="form-item">
                    <label class="form-label" for="date">Pickup Date:</label>
                    <input class="form-input" name="date" placeholder="Pickup Date" />
                </div>
                <div class="form-item">
                    <label class="form-label" for="time">Pickup Time:</label>
                    <input class="form-input" name="time" placeholder="Pickup Time" />
                </div>

                <div class="form-input-buton-div">
                    <button class="form-input-button">Book</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>