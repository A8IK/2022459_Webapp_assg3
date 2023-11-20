<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "contacts";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert data into the database
    $sql = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";

        $sql = "SELECT * FROM contact_form";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Contact Details</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Message</th></tr>";

             while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["message"]."</td></tr>";
            }

            echo "</table>";
        } 
        else {
            echo "No contact details available.";
        }

    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
