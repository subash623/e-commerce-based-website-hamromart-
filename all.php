<?php $title = "Home Page";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hamromart";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php include 'head.php';?>

<body>
   
    <p class="showname">
        All Product 
    </p>
    <div class="showcase">
    <?php
    $showprodd = "select * from product ORDER BY name ASC";
    $result = $conn->query($showprodd);
    if ($result->num_rows > 0) {
        
       
        while($row = $result->fetch_assoc()) {
        
        echo "<div class='productbox'>";
        echo "<img src=".$row['imgloco']." height='200px'>";
        echo "<p class='productname' >".$row["name"]."</p>";
        echo "<p class='productprice'> Rs ".$row["price"]."</p>";
        echo '<center><form action="cartpanel/addcartconf.php" method="post"><input type = "hidden" name = "topic" value = "'.$row["prodid"].'" /><input type="submit" class="cartbtn" value="Add to Cart" name="submit"></form></center>';
        echo '</div>';
        }
        
      } else {
        echo "0 results";
      }

   
    ?>

    </div>
    
    <?php 
    include("footer.php");
    ?>

</body>
</html>