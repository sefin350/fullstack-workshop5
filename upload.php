<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "./includes/header.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_FILES["portfolio"]) || $_FILES["portfolio"]["error"] !== 0) {
        $message = "Please select a file.";
    } else {

        $file = $_FILES["portfolio"];
        $allowed = ["pdf", "jpg", "jpeg", "png"];
        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $message = "Only PDF, JPG, PNG allowed.";
        } elseif ($file["size"] > 2 * 1024 * 1024) {
            $message = "File must be under 2MB.";
        } else {
            $newName = "portfolio_" . time() . "." . $ext;
            move_uploaded_file($file["tmp_name"], "uploads/" . $newName);
            $message = "File uploaded successfully.";
        }
    }
}
?>

<h2>Upload Portfolio File</h2>

<p><?php echo $message; ?></p>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio"><br><br>
    <button type="submit">Upload</button>
</form>

<?php require "./includes/footer.php"; ?>
