<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect to login page if not logged in
    header("location: login.php");
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "user information";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        /* Basic CSS for styling */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Dashboard</h2>
    
    <!-- Display username and logout link -->
    <p>Welcome, <?php echo $_SESSION["username"]; ?>! <a href="logout.php">Logout</a></p>
    
    <!-- Display table of user data -->
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Favorite Food</th>
            <th>Favorite Quote</th>
            <th>Education Level</th>
            <th>Favorite Time</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["first_name"]. "</td>";
                echo "<td>" . $row["last_name"]. "</td>";
                echo "<td>" . $row["gender"]. "</td>";
                echo "<td>" . $row["favorite_food"]. "</td>";
                echo "<td>" . $row["favorite_quote"]. "</td>";
                echo "<td>" . $row["education_level"]. "</td>";
                echo "<td>" . $row["favorite_time"]. "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }
        ?>
    </table>
    
    <!-- Login form (hidden when logged in) -->
    <div id="loginForm" style="<?php echo isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ? 'display: none;' : ''; ?>">
        <h3>Login to Access Data</h3>
        <form action="login_process.php" method="post">
            Username:<br>
            <input type="text" name="username" required><br><br>
            Password:<br>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</div>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
