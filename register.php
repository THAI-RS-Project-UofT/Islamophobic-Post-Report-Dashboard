<?php 
session_start();

	include("dbconnect.php");
	include("function.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];
        $role = $_POST['role'];

		if(!empty($name) && !empty($password) && !empty($email))
		{

			//save to database
			//$user_id = random_num(20);
			$query = "insert into users (name, email, password, gender, role) values ('$name','$email','$password', '$gender', '$role')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stop Islamophobia Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
	
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
					<img src="img/reg_logo.jpg" alt="Italian Trulli" width="500" height="500"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="post" class="user">
								
								<div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputName"
                                        placeholder="Name" name="name">
                                </div>
								
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name="email">
                                </div>
								
								<div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                        placeholder="Password" name="password">
                                </div>
								
								<div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputGender"
                                        placeholder="Gender" name="gender">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputRole"
                                        placeholder="Role" name="role">
                                </div>

								<input id="button" type="submit" class="btn btn-primary btn-user btn-block" value="Register"><br><br>

                            </form>
                            <hr>
                          
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>