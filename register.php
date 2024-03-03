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
            <form method="post">
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