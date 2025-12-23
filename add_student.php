<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "./includes/header.php";

/* FUNCTIONS */

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    return array_map('trim', explode(',', $string));
}

/* LOGIC */

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name   = $_POST["name"] ?? "";
    $email  = $_POST["email"] ?? "";
    $skills = $_POST["skills"] ?? "";

    if ($name === "" || $email === "" || $skills === "") {
        $message = "All fields are required.";
    } elseif (!validateEmail($email)) {
        $message = "Invalid email format.";
    } else {
        $name = formatName($name);
        $skillsArray = cleanSkills($skills);

        $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;

        file_put_contents("students.txt", $line, FILE_APPEND);
        $message = "Student saved successfully.";
    }
}
?>

<h2>Add Student Info</h2>

<p><?php echo $message; ?></p>

<form method="post">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="text" name="email" placeholder="Email"><br><br>
    <input type="text" name="skills" placeholder="Skills (comma separated)"><br><br>
    <button type="submit">Save Student</button>
</form>

<?php require "./includes/footer.php"; ?>
