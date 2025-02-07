<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session

// Database configuration
$server = "localhost";       // Database server (usually localhost)
$userID = "saurav";            // Database username (default is root for local server)
$password = "password";              // Database password (empty for local server)
$database_name = "chatapp";  // Name of the database you want to connect to

// Create a connection to the database
$conn = mysqli_connect($server, $userID, $password, $database_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Check if the form for saving a new user was submitted
if (isset($_POST['save'])) {
    $first_name = $_POST['first_name'];   // First name entered by the user
    $last_name = $_POST['last_name'];     // Last name entered by the user
    $id = $_POST['userid'];               // User ID entered by the user
    $password = $_POST['password'];       // Password entered by the user

    // Validate the input data
    if (!preg_match('/^[a-zA-Z]+$/', $first_name) || !preg_match('/^[a-zA-Z]+$/', $last_name)) {
        echo "Invalid name format. Only letters are allowed.";
    } elseif (!preg_match('/^[0-9]+$/', $id) || strlen($id) != 6) {
        echo "Invalid ID format. Only 6-digit numbers are allowed.";
    } elseif (strlen($password) < 4) {
        echo "Password must be at least 4 characters long.";
    } else {
        // Prepare the SQL query to insert data into the database
        $sql_query = "INSERT INTO user_details (first_name, last_name, id, password) 
                      VALUES ('$first_name', '$last_name', '$id', '$password')";

        // Execute the query and check if it was successful
        if (mysqli_query($conn, $sql_query)) {
            echo "New user entry inserted successfully!";
        } else {
            echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
        }
    }
}


// Check if the form for logging in was submitted
if (isset($_POST['login'])) {
    $id = $_POST['userid'];
    $password = $_POST['password'];

    // Prepare the SQL query to select the user
    $sql_query = "SELECT * FROM user_details WHERE id = '$id' AND password = '$password'";

    // Execute the query
    $result = mysqli_query($conn, $sql_query);

    // Check if the query was successful and if a matching user was found
    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful
        $_SESSION['userid'] = $id; // Store the user's ID in a session variable
        header("Location: chat.php"); // Redirect to chat.php (or any other page)
        exit(); // Ensure the script stops after the redirection
    } else {
        // Login failed
        echo "<script>alert('Invalid ID or Password!');</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>