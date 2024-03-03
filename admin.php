<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="form.css" />
    <link rel="stylesheet" href="admin.css" />
    <title>Admin</title>
</head>

<body>
    <main>
        <h1 class="header">Admin page of CabsOnline</h1>
        <div class="request-table">
            <p class="sub-text">
                1. Click below button to search for all unassigned booking requests with a pick-up time within 3 hours.
            </p>
            <table>
                <tr>
                    <th>Reference #</th>
                    <th>Customer Name</th>
                    <th>Passenger Name</th>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Richard</td>
                    <td>Richard</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Steve</td>
                    <td>Paul</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Adam</td>
                    <td>Bruce</td>
                </tr>
            </table>
        </div>
        <div>
            <p class="sub-text">
                2. Input a reference number below and click "Update" button to assign a taxi to that request
            </p>
            <div class="form-div">
                <form method="post">
                    <div class="form-item">
                        <label class="form-label" for="reference">Reference Number:</label>
                        <input class="form-input" name="reference" placeholder="Reference Number">
                    </div>
                    <div class="form-input-buton-div">
                        <button class="form-input-button admin-update-button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>