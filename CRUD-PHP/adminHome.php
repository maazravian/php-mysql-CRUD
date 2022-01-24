
<?php
session_start();
if($_SESSION["userID"]==false)
{
    header('location:adminLogin.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin-Home</title>

</head>
<body>
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
?>

                <?php
                $sessionId = $_SESSION["userID"];
                $sql = "SELECT Name from admin where AdminId='$sessionId' limit 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
<div class='container mt-5'>
    <div class='row'>
        <div class='col'>
            <div class='row'>
            <div class='col-12'>
            <div class='d-flex justify-content-center'>
            <div class='card' style='width: 18rem'>
                <h4 class='card-header' style='background-color: #5cb85c; color: white'>Welcome ".$row["Name"]."</h4>
                <div class='card-body' style='background-color: lightgray'>
                  <button type='button' class='btn btn-primary btn-lg'><a href='AddNewProductPage.php' style='text-decoration: none; color: white'>Add New Product</a></button>
                  <br>
                  <br>
                  <button type='button' class='btn btn-primary btn-lg'><a href='AdminProductView.php' style='text-decoration: none; color: white'>View All Products</a></button>
                  <br>
                  <br>
                  <button type='button' class='btn btn-danger'style='float: right'><a href='logout.php' style='text-decoration: none; color: white'>Logout!</a></button>

                </div>
              </div>
        </div>
        </div>
                    </div>
        </div>
    </div>
</div>

        ";

                    }
                }


                $conn->close();
                ?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

