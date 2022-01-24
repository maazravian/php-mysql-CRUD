<?php
session_start();
if($_SESSION["userID"]==false)
{
    header('location:adminLogin.php');
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "assignment2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$productid = mysqli_real_escape_string($conn, $_REQUEST['productid']);


$query = "update product set IsActive = '0' where ProductId='$productid'";

$sql = mysqli_query($conn, $query);
if(!$sql){

    echo "data not updated";
    echo "Error: ". mysqli_error($conn);
    die;
}
else {
    echo "Data updated successfully";
    header('location: adminProductView.php');
}
?>
