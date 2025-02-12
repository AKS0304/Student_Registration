<?php
include 'db.php'; // Include your database connection and functions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $full_name = htmlspecialchars($_POST['full_name']);
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $perm_street = htmlspecialchars($_POST['perm_street']);
    $perm_city = htmlspecialchars($_POST['perm_city']);
    $perm_state = htmlspecialchars($_POST['perm_state']);
    $perm_postal_code = $_POST['perm_postal_code'];
    $desired_course = htmlspecialchars($_POST['desired_course']);
    $desired_branch = htmlspecialchars($_POST['desired_branch']);
    $highest_qualification = $_POST['highest_qualification'];
    $institution_name = htmlspecialchars($_POST['institution_name']);
    $year_of_passing = $_POST['year_of_passing'];
    $grade = $_POST['grade'];
    
     // Handle file upload
     if (isset($_FILES['photograph']) && $_FILES['photograph']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photograph"]["name"]);
        
        if (move_uploaded_file($_FILES["photograph"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["photograph"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No photograph uploaded or an error occurred.";
        // Handle this case based on your application's logic
    }

    // Construct address fields
    $permanent_address = "$perm_street, $perm_city, $perm_state, $perm_postal_code";
    // Prepare data array for database insertion
    $data = [
        'full_name' => $full_name,
        'date_of_birth' => $date_of_birth,
        'gender' => $gender,
        'contact_number' => $contact_number,
        'email' => $email,
        'permanent_address' => $permanent_address,
        'desired_course' => $desired_course,
        'desired_branch' => $desired_branch,
        'highest_qualification' => $highest_qualification,
        'institution_name' => $institution_name,
        'year_of_passing' => $year_of_passing,
        'grade' => $grade,
        'photograph' => isset($target_file) ? $target_file : null 
    ];

    // Insert data into database
    createStudent($data); // Assuming createStudent() function handles database insertion

    // Redirect to avoid resubmission
    header("Location: index.html");
    exit();
}
?>
