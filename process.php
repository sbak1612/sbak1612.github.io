<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userinformation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $favorite_foods = implode(", ", $_POST['favorite_foods']);
    $favorite_quote = $_POST['favorite_quote'];
    $education_level = $_POST['education_level'];
    $favorite_time_of_day = $_POST['favorite_time_of_day'];

    $sql = "INSERT INTO users (first_name, last_name, gender, favorite_foods, favorite_quote, education_level, favorite_time_of_day)
            VALUES ('$first_name', '$last_name', '$gender', '$favorite_foods', '$favorite_quote', '$education_level', '$favorite_time_of_day')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
