<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    if ($action == 'approve') {
        approveStudent($_POST['id']);
    } 
    elseif ($action == 'delete') {
        deleteStudent($_POST['id']);
    }
}

$students = getStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <style>
        .search-form {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 20px;
        }
        .search-input {
            width: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Admin Dashboard</h1>
        <form method="GET" action="">
            <div class="form-group">
                <label for="stud"></label>
                <input type="text" name="stud" id="stud" class="form-control" placeholder="search....">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Permanent Address</th>
                    <th>Desired Course</th>
                    <th>Desired Branch</th>
                    <th>Highest Qualification</th>
                    <th>Institution Name</th>
                    <th>Year of Passing</th>
                    <th>Grade</th>
                    <th>Photograph</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['full_name']; ?></td>
                    <td><?php echo $student['date_of_birth']; ?></td>
                    <td><?php echo $student['gender']; ?></td>
                    <td><?php echo $student['contact_number']; ?></td>
                    <td><?php echo $student['email']; ?></td>
                    <td><?php echo $student['permanent_address']; ?></td>
                    <td><?php echo $student['desired_course']; ?></td>
                    <td><?php echo $student['desired_branch']; ?></td>
                    <td><?php echo $student['highest_qualification']; ?></td>
                    <td><?php echo $student['institution_name']; ?></td>
                    <td><?php echo $student['year_of_passing']; ?></td>
                    <td><?php echo $student['grade']; ?></td>
                    <?php
                        $photoPath = 'uploads/' . $student['photograph'];
                        echo '<img src="' . $photoPath . '" alt="Photograph" width="50">';
                        ?>
                    <td><?php echo $student['status']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
