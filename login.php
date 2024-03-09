<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="card.css" />
    <link rel="stylesheet" href="form.css" />
    <title>Login</title>
</head>

<body>
    <main>
        <div class="card">
            <h1 class="header">Login</h1>
            <form class="form" method="post">
                <div class="form-item">
                    <label class="form-label" for="email">Email:</label>
                    <input type="email" class="form-input" name="email" placeholder="Email (user@email.com)">
                </div>
                <div class="form-item">
                    <label class="form-label" for="password">Password:</label>
                    <input type="password" class="form-input" name="password" placeholder="Password">
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    // get all fields
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    // check for all the required fields
                    if (
                        !isset($email) ||
                        !isset($password) ||
                        empty($email) ||
                        empty($password)
                    ) {
                        echo "<span class='error-text'>All fields are required</span>";
                    } else {
                        // here if every input field checks out

                        $DBConnect = @mysqli_connect("localhost", "root", "", "taxi_db")
                            or die("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

                        // check if user with the email exists

                        $SQLstring = "select * from user where email='$email'";

                        $queryResult = @mysqli_query($DBConnect, $SQLstring)
                            or die("<p>Unable to query the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";


                        if ($queryResult->num_rows === 0) {
                            echo "<span class='error-text'>User does not exist. Please try registering first.</span>";
                        } else {
                            $db_password = mysqli_fetch_assoc($queryResult)['password'];

                            // verify if password matches
                            if (password_verify($password, $db_password)) {

                                header("Location:booking.php?Email=" . $email);
                            } else {
                                echo "<span class='error-text'>Wrong password.</span>";
                            }
                        }
                    }
                }
                ?>

                <div class="form-input-buton-div">
                    <button class="form-input-button">Login</button>
                </div>
                <div>
                    Do not have an account? <a href="register.php">Register</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>