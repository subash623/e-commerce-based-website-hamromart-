<?php
include("adminmenu.php");

?>
<br>
<br>
<center>
<form action="updateadmin.php" method="post" class="box" enctype="multipart/form-data">
    <p class="formtext"> Product ID : </p>
    <input type="text" class="adminbox" name="id">
    <input type="submit" name="submit" value="Submit"><br><br>

</form>
</center>
<?php
include("databaselogin.php");

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo '<table> <tr><th>Product Id</th> <th>Name</th> <th>Type</th> <th>Price</th> <th>Image location</th> <th>Sub Catogry</th></tr>';
  while($row = $result->fetch_assoc()) {
    echo "<tr><th>".$row['prodid']."</th> <th>".$row['name']."</th> <th>".$row['type']."</th> <th>".$row['price']."</th> <th>".$row['imgloco']."</th> <th>".$row['sub']."</th></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>