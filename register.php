<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="card.css" />
    <link rel="stylesheet" href="form.css" />
    <title>Register</title>
</head>

<body>
    <main>
        <div class="card">
            <h1 class="card-header">Register</h1>
            <form class="form" method="POST">
                <div class="form-item">
                    <label class="form-label" for="name">Name:</label>
                    <input class="form-input" name="name" placeholder="Name">
                </div>
                <div class="form-item">
                    <label class="form-label" for="password">Password:</label>
                    <input type="password" class="form-input" name="password" placeholder="Password">
                </div>
                <div class="form-item">
                    <label class="form-label" for="confirm">Confirm Password:</label>
                    <input type="password" class="form-input" name="confirm" placeholder="Confirm Password">
                </div>
                <div class="form-item">
                    <label class="form-label" for="email">Email:</label>
                    <input type="email" class="form-input" name="email" placeholder="Email (user@email.com)">
                </div>
                <div class="form-item">
                    <label class="form-label" for="phone">Phone:</label>
                    <input type="number" class="form-input form-input-phone" name="phone" placeholder="Phone (0412345678)">
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    // get all fields
                    $name = $_POST["name"];
                    $password = $_POST["password"];
                    $confirm_password = $_POST["confirm"];
                    $email = $_POST["email"];
                    $phone = $_POST["phone"];
                    // check for all the required fields
                    if (
                        !isset($name) ||
                        !isset($password) ||
                        !isset($confirm_password) ||
                        !isset($email) ||
                        !isset($phone) ||
                        empty($name) ||
                        empty($password) ||
                        empty($confirm_password) ||
                        empty($email) ||
                        empty($phone)
                    ) {
                        echo "<span class='error-text'>All fields are required</span>";
                    } else {
                        // check if password and confirm password are same
                        if ($password !== $confirm_password) {
                            echo "<span class='error-text'>Password and Confirm Password must be same</span>";
                        } else {
                            // here if every input field checks out

                            $DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
                                or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

                            // check if user with the email exists

                            $SQLstring = "select * from user where email='$email'";

                            $queryResult = @mysqli_query($DBConnect, $SQLstring)
                                or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";


                            if ($queryResult->num_rows > 0) {
                                echo "<span class='error-text'>Email already exists. Please try logging in or using a different email.</span>";
                            } else {
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
                                $SQLstring = "insert into user (name, password, email, phone) values ('$name', '$hashed_password', '$email', '$phone')";
                                $queryResult = @mysqli_query($DBConnect, $SQLstring)
                                    or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";
    
                                header("Location:booking.php?Email=" . $email);
                            }
                        }
                    }
                }
                ?>

                <div class="form-input-buton-div">
                    <button class="form-input-button">Register</button>
                </div>

                <div>
                    Already have an account? <a href="login.php">Log In</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>