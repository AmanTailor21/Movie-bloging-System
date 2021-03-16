<?php
require_once 'myclass.php';
$ob = new myclass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
$a = $ob->showmyblog($_SESSION['id']);

?>
<html>
<body>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="js.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        textarea {
            width: 100%;
            height: 100%;
        }

        .custom {
            background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);
        }

        .card-horizontal {
            display: flex;
            flex: 1 1 auto;
        }

        .card {
            background-color: rgba(245, 245, 245, 0.8);
        }

        .card-body, .card-footer {
            opacity: 1
        }


    </style>

</head>
<nav class="navbar navbar-expand-lg navbar-light custom">
    <a class="navbar-brand text-white" href="#">Movie Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="adminindex.php">Home </a>
            </li>
            <li class="nav-item">
                <b><a class="nav-link text-white" href="uploadblog.php">Upload Blog </a></b>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="myblog.php">My Blog</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="">
            <label style="color: black"><?php echo " " . $_SESSION["name"] . " "; ?></label>&nbsp;

            <a href="http://localhost/Aman/Task/mvcframework" class="btn btn-primary" style="background-color: #ff9800;color: white" ><i class="fa fa-user"></i></a>&nbsp;

            <a href="logout.php" class="btn btn-primary my-2 my-sm-0" style="background-color: #ff9800;color: white" >LogOut</a>
        </form>
    </div>
</nav>
</body>
</html>