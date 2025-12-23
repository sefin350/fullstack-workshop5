<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "./includes/header.php";

echo "<h2>Student List</h2>";

if (file_exists("students.txt")) {

    $lines = file("students.txt", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        if (trim($line) === "") continue;

        list($name, $email, $skills) = explode("|", $line);
        $skillsArray = explode(",", $skills);

        echo "<p>";
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong> ";
        print_r($skillsArray);
        echo "</p><hr>";
    }

} else {
    echo "No students found.";
}

require "./includes/footer.php";
