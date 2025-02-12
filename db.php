<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_admission";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create
function createStudent($data) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO student_data (full_name, date_of_birth, gender, contact_number, email, permanent_address, desired_course, desired_branch, highest_qualification, institution_name, year_of_passing, grade, photograph) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssssssssss", $data['full_name'], $data['date_of_birth'], $data['gender'], $data['contact_number'], $data['email'], $data['permanent_address'], $data['desired_course'], $data['desired_branch'], $data['highest_qualification'], $data['institution_name'], $data['year_of_passing'], $data['grade'], $data['photograph']);
    
    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $conn . "<br>" . $conn->error;
    }
    $stmt->execute();
    $stmt->close();
}

// Read
function getStudents($filters = []) {
    global $conn;
    $sql = "SELECT * FROM student_data WHERE 1=1";
    $params = [];
    $types = "";

    if (isset($filters['name'])) {
        $sql .= " AND full_name LIKE ?";
        $params[] = "%" . $filters['name'] . "%";
        $types .= "s";
    }
    
    if (isset($filters['mobile'])) {
        $sql .= " AND contact_number LIKE ?";
        $params[] = "%" . $filters['mobile'] . "%";
        $types .= "s";
    }

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    $stmt->close();
    return $students;
}

// Update
function updateStudent($id, $data) {
    global $conn;
    $stmt = $conn->prepare("UPDATE student_data SET full_name=?, date_of_birth=?, gender=?, contact_number=?, email=?, permanent_address=?, desired_course=?,  desired_branch=?, highest_qualification=?, institution_name=?, year_of_passing=?, grade=?, photograph=? WHERE id=?");
    $stmt->bind_param("sssssssssssssi", $data['full_name'], $data['date_of_birth'], $data['gender'], $data['contact_number'], $data['email'], $data['permanent_address'], $data['desired_course'], $data['desired_branch'], $data['highest_qualification'], $data['institution_name'], $data['year_of_passing'], $data['grade'], $data['photograph'], $id);
    $stmt->execute();
    $stmt->close();
}

// Delete
function deleteStudent($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM student_data WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Approve
function approveStudent($id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE student_data SET status='Approved' WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>

