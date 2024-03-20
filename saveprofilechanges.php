<?php
include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and prepare data with fallbacks for optional fields
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Using null coalescing operator to avoid undefined array key warnings
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number'] ?? '');
    $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    $dob = mysqli_real_escape_string($conn, $_POST['dob'] ?? NULL); // Make sure this is in 'YYYY-MM-DD' format or validated accordingly
    $gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');
    $bio = mysqli_real_escape_string($conn, $_POST['bio'] ?? '');
    $social_media = mysqli_real_escape_string($conn, $_POST['social_media'] ?? '');
    
    // Validate email uniqueness
    $query = "SELECT * FROM user_profile WHERE email = ? AND user_id != ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $email, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // Email exists, handle error
        echo "Email already exists. Please go back and try again.";
        exit();
    }
    
    // Date validation (simple format check, consider more robust validation)
    if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dob)) {
        echo "Invalid date format. Please go back and try again.";
        exit();
    }

    // Handle file upload
    $defaultProfilePic = 'path/to/default/profile_pic.jpg'; // Adjust this path to your default image
    $profile_picture = ''; // Initialize to an empty string or default path

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        
        // You might want to add more checks here for file type, size, etc.

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = $target_file; // Use uploaded file path if successful
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
       $profile_picture = $defaultProfilePic; // Use default if no file uploaded or if there's an error
    }

    // Modify your UPDATE query to include `profile_picture`
    // Modify your UPDATE query to include `profile_picture` and `user_id`
    $sql = "UPDATE user_profile SET full_name = ?, email = ?, phone_number = ?, address = ?, dob = ?, gender = ?, bio = ?, social_media = ?, profile_picture = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Check for statement preparation error
    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($conn);
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'sssssssssi', $full_name, $email, $phone_number, $address, $dob, $gender, $bio, $social_media, $profile_picture, $_SESSION['user_id']);

    if (!mysqli_stmt_execute($stmt)) {
        // Handle SQL execution errors
        echo "Error executing statement: " . mysqli_stmt_error($stmt);
        exit();
    }

    // Redirect user to userprofile.php after successful submission
    header("Location: userprofile.php");
    exit();
}
?>
