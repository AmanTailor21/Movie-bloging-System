<?php

?>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Life Blog</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<body class="body">
<div class="main">
    <div class="container m-0">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <form class="signup-content">
                    <div class="back">
                        <div class="h3">
                            <h3>Sign In</h3>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" value="<?php echo isset($_COOKIE["email"]) ? $_COOKIE["email"] : ''; ?>" name="email" aria-describedby="emailHelp"
                                   placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" value="<?php echo isset($_COOKIE["password"]) ? $_COOKIE["password"]: '';?>" name="password" aria-describedby="emailHelp"
                                   placeholder="Enter Password">
                        </div>

                        <div style="margin-left: 20px"><input class="form-check-input" type="checkbox" name="rememberme" id="agree"
                                <?php echo (isset($_COOKIE["email"])) ? "checked=checked" : ''; ?>>
                            <label for="agree">Remember me</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn btn-sucess">
                            <label> Don't have an account?<a href="register.php"> Sign Up</a></label>
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <a href="forgot_password.php">Forgot password ?</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>
<?php

require_once 'myclass.php';
$ob = new myClass();
session_start();
if (isset($_SESSION['name'])) {
    header("location:adminindex.php");
}
if (isset($_REQUEST["login"])) {

    $f = $ob->login($_REQUEST["email"], $_REQUEST["password"]);
    if ($f) {
        $_SESSION['id'] = $f['id'];
        $_SESSION['name'] = $f['name'];
        $_SESSION['email'] = $f["email"];
        header("location:adminindex.php");
    } else {
        echo "upsss";
    }
}

?>
