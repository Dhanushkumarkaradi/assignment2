
<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit();
}

// Clean and safely display submitted information
function clean($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, "UTF-8");
}

// PERSONAL DETAILS

$name = clean($_POST["fullname"] ?? "");
$email = clean($_POST["email"] ?? "");
$phone = clean($_POST["phone"] ?? "");
$dob = clean($_POST["dob"] ?? "");
$gender = clean($_POST["gender"] ?? "");

// ACADEMIC DETAILS

$college = clean($_POST["college"] ?? "");
$course = clean($_POST["course"] ?? "");
$branch = clean($_POST["branch"] ?? "");

$year = clean($_POST["year"] ?? "");
$admission = clean($_POST["admission"] ?? "");

// ADDRESS

$address = clean($_POST["address"] ?? "");

// CUSTOM OTHER VALUES

if ($college === "Other College") {
    $college = clean($_POST["college_other"] ?? "");
}

if ($course === "Other") {
    $course = clean($_POST["course_other"] ?? "");
}

if ($branch === "Other") {
    $branch = clean($_POST["branch_other"] ?? "");
}

// OPTIONAL COLLEGE

if ($college === "") {
    $college = "Not Specified";
}

// SERVER-SIDE VALIDATION

$valid =
    strlen($name) >= 3 &&
    filter_var($email, FILTER_VALIDATE_EMAIL) &&
    preg_match("/^[0-9]{10}$/", $phone) &&
    !empty($dob) &&
    strtotime($dob) !== false &&
    strtotime($dob) <= time() &&
    in_array($gender, [
        "Male",
        "Female",
        "Other",
        "Prefer not to say"
    ], true) &&
    !empty($course) &&
    !empty($branch) &&
    !empty($year) &&
    !empty($admission) &&
    !empty($address) &&
    isset($_POST["terms"]);

if (!$valid) {
    http_response_code(400);
    die("Invalid form submission. Please go back and check your details.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Successful</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="header">

    <div class="header-content">
        <h1>Registration Successful!</h1>
        <p>Your registration details have been received.</p>
    </div>

</header>

<main class="container">

    <div class="result-card">

        <h2>Registration Confirmation</h2>

        <p class="success-message">
            Thank you for registering. Here are your submitted details.
        </p>

        <h3>Personal Information</h3>

        <p><strong>Full Name:</strong> <?php echo $name; ?></p>

        <p><strong>Email:</strong> <?php echo $email; ?></p>

        <p><strong>Phone:</strong> <?php echo $phone; ?></p>

        <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>

        <p><strong>Gender:</strong> <?php echo $gender; ?></p>


        <h3>Academic Information</h3>

        <p><strong>College:</strong> <?php echo $college; ?></p>

        <p><strong>Course / Degree:</strong> <?php echo $course; ?></p>

        <p><strong>Branch:</strong> <?php echo $branch; ?></p>

        <p><strong>Year of Study:</strong> <?php echo $year; ?></p>

        <p><strong>Admission Type:</strong> <?php echo $admission; ?></p>


        <h3>Address Information</h3>

        <p>
            <strong>Address:</strong><br>
            <?php echo nl2br($address); ?>
        </p>


        <a href="index.html" class="back-link">
            Register Another Student
        </a>

    </div>

</main>

<footer>
    <p>© 2026 Student Registration Portal. All Rights Reserved.</p>
</footer>

</body>
</html>
