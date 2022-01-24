<?php
session_start();
if($_SESSION["userID"]==false)
{
    header('location:adminLogin.php');
}
$sessionUser = $_SESSION["userID"];
 ?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Add New Product</title>

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
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <div class="card">
                            <div class="card-header" style="background-color: orange">
                                <i class="fa fa-inventory" style="color: white; margin-right: 10px"></i>
                                <b style="color: white">Add Product</b>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-floating mb-3">
                                        <label for="floatingInputProductName" style="color: black;"><i class="fa fa-dice-d6" style="margin-right: 10px; color: black;" ></i> Name</label>
                                        <input type="text" class="form-control" name="productName" id="floatingInputProductName" placeholder="Name" required>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <label for="floatingInputPrice" style="color: black;"><i class="fa fa-dollar-sign" style="margin-right: 10px; color: black;" ></i> Price</label>
                                        <input type="number" class="form-control" name="price" id="floatingInputPrice" placeholder="Price" required>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <label for="floatingInputType" style="color: black;"><i class="fa fa-filter" style="margin-right: 10px; color: black;" ></i> Select Type</label>
                                        <select class="form-control" id="floatingInputType" name="productType">
                                            <?php
                                            $sql = "SELECT TypeId from type";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            echo "
                                            <option>".$row["TypeId"]."</option>
                                            ";}} ?>
                                        </select>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <label for="floatingInputProductDescription" style="color: black;"><i class="fa fa-info-circle" style="margin-right: 10px; color: black;" ></i> Description</label>
                                        <textarea type="text" class="form-control" name="productDescription" id="floatingInputProductDescription" placeholder="Description" required></textarea>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="file" id="userpic" name="userpic"/>
                                    </div>

                                    <button type="submit" name="submit" id="submit" class="btn btn-success" style="float: left">Add Product</button>
                                    <button type='button' class='btn btn-danger'style='float: right'><a href='logout.php' style='text-decoration: none; color: white'>Logout!</a></button>

                                    <?php
                                    if ( isset( $_REQUEST['submit'] ) ) {
                                        //Here 'userpic' is name of your 'file control'
                                        //explore will break the name by using '.' delimeter.
                                        $path = $_FILES["userpic"]["name"];
                                        $temp = explode(".", $path);
                                        $extension = $temp[1];

                                        //Create a unique name by using time and append the actual extension
                                        $new_name = round(microtime(true)) . '.' . $extension;

                                        //save file into "img" folder with the name stored '$new_name' variable
                                        move_uploaded_file($_FILES["userpic"]["tmp_name"], "img//".$new_name);

                                        $productName = $_REQUEST['productName'];
                                        $productPrice = $_REQUEST['price'];
                                        $productType = $_REQUEST['productType'];
                                        $productDescription = $_REQUEST['productDescription'];

                                        $query = "INSERT INTO product (Name, Price, TypeId, Description,PicURL, upDatedOn, updatedBy) VALUES ('$productName', '$productPrice', '$productType', '$productDescription', '$new_name', SYSDATE(),'$sessionUser')";

                                        $sql = mysqli_query($conn, $query);
                                        if(!$sql){

                                            echo "data not updated";
                                            echo "Error: ". mysqli_error($conn);
                                            die;
                                        }
                                        else {
                                            echo "Data uploaded successfully";
                                            header('location: adminHome.php');
                                        }
                                    }
                                    ?>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
