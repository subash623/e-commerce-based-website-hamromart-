<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hamromart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
session_start();

$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
print_r($_POST);
$temp = "<html><body>";

if ($result->num_rows > 0) {
 
  $temp .= '<table> <tr><th>Product Name</th> <th>Per item</th> <th>Quantity</th> <th>Total</th> </tr>'; 
  while($row = $result->fetch_assoc()) {
    $temp = $temp . "<tr><th>".$row['name']."</th> <th>".$row['per']."</th> <th>".$row['num']."</th> <th>".$row['total']."</th></tr>";
  }
  $temp = $temp . "</table>";
  $temp .= "<br>Total = Rs".$_POST["finalmoney"] ."<br> Location :".$_POST["location"]." <br> Contact :".$_POST["phone"]."<br>

  <h3>Note : Product will be deliver within a week </h3>
   <h3>Thank you for choosing HamroMart</h3>";


} else {
  echo "0 results";
}
$temp .= "</body></html> ";
$to_email = $_SESSION["email"].", lamichhanesubash1@gmail.com";
$subject = "Order Confirmation Message";
$from = "subash.lamichhane623@gmail.com";
$body = $temp;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

$sql = "DROP TABLE cart;";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
echo '<script> window.location.replace("http://localhost/hamromart/index.php"); </script>';
$conn->close();

?>