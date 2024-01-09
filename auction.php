<?php
include 'Includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Items</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        .auction-item {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }

        .auction-item img {
            width: 250px;
            max-width: 100%;
            height: auto;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Auction Items</h2>

    <div class="row">
        <?php
        include 'Includes/db-functions.php';

        // Query to retrieve all auction items
        $query = "SELECT * FROM auction_items";
        $result = $conn->query($query);

        // Close database connection
        $conn->close();
        ?>

        <?php
        // Check if there are auction items
        if ($result->num_rows > 0) {
            // Display auction items
            $counter = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-lg-4 auction-item'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p>Description: " . $row["description"] . "</p>";
                echo "<img src='" . $row["image_url"] . "' alt='" . $row["title"] . "'>";
                echo "<p>Price: $" . $row["price"] . "</p>";
                echo "</div>";

                $counter++;
                // Close the row and start a new one after every third item
                if ($counter % 3 == 0) {
                    echo '</div><div class="row">';
                }
            }
        } else {
            echo "No auction items found.";
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
