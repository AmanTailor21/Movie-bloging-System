<?php
session_start();
require_once 'myclass.php';
$ob = new myclass();
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
                <form class="signup-content" method="get">
                    <div class="back">
                        <div class="h3">
                            <h3>Forgot Password</h3>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                                   placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-sucess">
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
if (isset($_REQUEST['submit']))
{
    $f = $ob->email($_REQUEST["email"]);
    foreach ($f as $rs)
    {
        $name=$rs[1];
        $fetch_user_id=$rs[2];
        $password=$rs[3];
        if($_REQUEST['email']==$fetch_user_id) {
            $to = $fetch_user_id;
            $subject = "Your Password";
            $txt = "Hello $name"." "."Your password is : $password.";
            $headers = "From: Movie Blog";
            mail($to,$subject,$txt,$headers);
        }
        else{
            echo 'invalid userid';
        }
    }
    if ($f) {
        echo '<script>alert("Check your Email address");
        window.location.href="login.php";</script>';
    } else {
        echo '<script>alert("Email address does not exist")</script>';
    }
}



