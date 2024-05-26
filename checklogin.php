error_reporting(E_ALL); ini_set('display_errors', 1);
<?php
// Simulated database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediumflag";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// I used this particular injection code because of the formating used in the query.
// This was the injected code ' OR 1 #
// Get user input from the form
$user = $_POST['username'];
$pass = $_POST['password'];

// Simulated SQL query (vulnerable to SQL injection)
$sql = "SELECT * FROM users WHERE username='' AND password='$pass'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful! Flag: CTF{SQL1nj3ct10n}";
} else {
    echo "Login failed! " . $conn->error;
}

$conn->close();
?>





<?php
// Run a SQL query
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Fetch the result data
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "";
    }
} else {
    echo "0 results";
}

// Close the connection
mysqli_close($conn);
?>

#Access the Login Form:

Navigate to the URL of the CTF challenge or the login page provided.
Inject SQL Payload:

In the username field of the login form, input the SQL injection payload ' OR 1=1 --.
This payload exploits the SQL query to always evaluate to true, bypassing the authentication logic.
Submit the Form:

Click the "Login" or "Submit" button on the form to submit the injected SQL payload.
Capture the Flag:

If the SQL injection is successful, the application should respond with a message like "Login successful! Flag: CTF{SQL1nj3ct10n}" or similar.
This message contains the flag you're looking for, which typically follows the format CTF{...}.