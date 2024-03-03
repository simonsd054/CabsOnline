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
            <form method="post">
              <div class="form-item">
                  <label class="form-label" for="email">Email:</label>
                  <input type="email" class="form-input" name="email" placeholder="Email (user@email.com)">
              </div>
                <div class="form-item">
                    <label class="form-label" for="password">Password:</label>
                    <input type="password" class="form-input" name="password" placeholder="Password">
                </div>
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