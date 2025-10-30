<?php
// --- Database connection ---
$host = "sql101.infinityfree.com";   // replace with your host name
$user = "if0_40228506";      // replace with your username
$pass = "SQEWZ7DUY1SOI";      // replace with your password
$dbname = "if0_40228506_registration_db"; // replace with your DB name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// --- Handle form data ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $gender = htmlspecialchars($_POST['gender']);
    $course = htmlspecialchars($_POST['course']);

    $stmt = $conn->prepare("INSERT INTO registrations (fullname, email, phone, gender, course) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $email, $phone, $gender, $course);

    if ($stmt->execute()) {
        $msg = "Registration saved successfully!";
    } else {
        $msg = "Error saving data: " . $stmt->error;
    }

    $stmt->close();
} else {
    die("<h3>No data received.</h3>");
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submission Successful</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1><?= $msg ?></h1>
    <p><strong>Full Name:</strong> <?= $fullname ?></p>
    <p><strong>Email:</strong> <?= $email ?></p>
    <p><strong>Phone:</strong> <?= $phone ?></p>
    <p><strong>Gender:</strong> <?= $gender ?></p>
    <p><strong>Course Applied For:</strong> <?= $course ?></p>
    <a href="index.html"><button>Go Back</button></a>
  </div>
</body>
</html>
