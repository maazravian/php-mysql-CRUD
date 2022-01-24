<?php
session_start();
if($_SESSION["userID"]== true)
{
    echo "You are logged in as Admin!";
    die();
}
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
    <title>Admin-Login</title>

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
                                <i class="fa fa-sign-in" style="color: white; margin-right: 10px"></i>
                                <b style="color: white">Admin Login</b>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-floating mb-3">
                                        <label for="floatingInputUsername" style="color: black;"><i class="fa fa-user" style="margin-right: 10px; color: black;" ></i> Username</label>
                                        <input type="text" class="form-control" name="username" id="floatingInputUsername" placeholder="Username" required>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <label for="floatingInputPassword" style="color: black;"><i class="fa fa-lock" style="margin-right: 10px; color: black;" ></i> Password</label>
                                        <input type="password" class="form-control" name="password" id="floatingInputPassword" placeholder="Password" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success" style="float: right">Login</button>
                                    <?php
                                     if ( isset( $_REQUEST['submit'] ) ) {
                                         $userNameAdmin = $_REQUEST['username'];
                                         $passwordAdmin = $_REQUEST['password'];
                                         ?>
                                    <?php
                                         session_start();
                                        $sql = "select AdminId,name, password from admin where name='$userNameAdmin' and password='$passwordAdmin' limit 1";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            echo"<script type='text/javascript'>console.log('Found')</script>";
                                            while ($row = $result->fetch_assoc()) {
                                                $_SESSION["userID"]=$row["AdminId"];
                                                header("location: adminHome.php");
                                                exit();
                                            }
                                        }
                                        else{
                                            header("Location: errorfile.php");
                                            exit();
                                        }

                                     }
                                     $conn->close();
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
