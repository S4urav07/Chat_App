<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session

// Database configuration
$server = "localhost";
$userID = "saurav";
$password = "password";
$database_name = "chatapp";

// Create a connection to the database
$conn = mysqli_connect($server, $userID, $password, $database_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Check if the form was submitted (for login or sending a message)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is trying to send a message
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $userID = $_SESSION['userid']; // Get the current logged-in user ID from the session

        // Insert the message into the messages table
        $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $userID, $message);
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo "not sent";
        }
    }
}

function outMessages($conn) {
    $sql = "SELECT * FROM messages";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $message = htmlspecialchars($row["message"]);
            $messageUserID = $row["user_id"];
            $currentUserID = $_SESSION['userid']; // Get the current logged-in user ID from the session

            // Determine alignment based on user ID
            if ($messageUserID == $currentUserID) {
                echo "<div class='message right'>{$message}</div>";
            } else {
                echo "<div class='message left'>{$message}</div>";
            }
        }
    } else {
        echo "0 results";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Friend's</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/efaae23df7.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <div class="content">
                    <div class="user">
                        <a href="login.php" class="back-icon"><i class="fa-solid fa-arrow-left"></i></a>
                        <img src="Mr_beans_holiday_ver2.webp" alt="[Friend's Name]">
                        <div class="detail">
                            <span>Friend</span>
                            <p>Active now</p>
                        </div>
                    </div>
                    <a href="logout.php" class="logout">Logout</a>
                </div>
            </header>
            <div class="chat-box">
                <!-- Messages will be loaded here -->
                <?php outMessages($conn); ?> 
            </div>
            <form action="chat.php" method="post">
                <input type="text" name="message" class = "text" placeholder="Type your message...">
                <input type="submit" class ="send-button" value="Send" name = "send">
            </form>
        </section>
    </div>
</body>
</html>

<?php
// Close the database connection at the end of the script
mysqli_close($conn);
?>
