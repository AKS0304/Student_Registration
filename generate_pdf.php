<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $students = getStudents(['id' => $id]);
    if (count($students) > 0) {
        $student = $students[0];
        
        $mpdf = new \Mpdf\Mpdf();
        $html = '<h1>Application Details</h1>';
        $html .= '<p>Full Name: ' . $student['full_name'] . '</p>';
        $html .= '<p>Date of Birth: ' . $student['date_of_birth'] . '</p>';
        $html .= '<p>Gender: ' . $student['gender'] . '</p>';
        $html .= '<p>Contact Number: ' . $student['contact_number'] . '</p>';
        $html .= '<p>Email: ' . $student['email'] . '</p>';
        $html .= '<p>Permanent Address: ' . $student['permanent_address'] . '</p>';
        $html .= '<p>Current Address: ' . $student['current_address'] . '</p>';
        $html .= '<p>Desired Course: ' . $student['desired_course'] . '</p>';
        $html .= '<p>Start Date: ' . $student['start_date'] . '</p>';
        $html .= '<p>Highest Qualification: ' . $student['highest_qualification'] . '</p>';
        $html .= '<p>Institution Name: ' . $student['institution_name'] . '</p>';
        $html .= '<p>Year of Passing: ' . $student['year_of_passing'] . '</p>';
        $html .= '<p>Grade: ' . $student['grade'] . '</p>';
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
?>
