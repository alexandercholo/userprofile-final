<?php

include 'user-profile-data.php';
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: userprofile.php");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "252003september", "ipt101");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user ID from session variable (and sanitize it)
$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

// Retrieve user's information from database using prepared statement
$sql = "SELECT * FROM user_profile WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters and execute query
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

// Get result
$result = mysqli_stmt_get_result($stmt);

// Check if query was successful
if (!$result) {
    die("Error fetching user data: " . mysqli_error($conn));
}

// Check if user exists
if (mysqli_num_rows($result) == 0) {
    die("User not found.");
}

// Fetch user data
$user = mysqli_fetch_assoc($result);

// Extract user details
$full_name = $user['full_name'];
$email = $user['email'];
$phone_number = $user['phone_number'];
$address = $user['address'];
$dob = $user['dob'];
$gender = $user['gender'];
$bio = $user['bio'];
$social_media = $user['social_media'];

// Close database connection
mysqli_close($conn);
?>
