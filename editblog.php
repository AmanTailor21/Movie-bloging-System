<?php
session_start();
require_once 'myclass.php';
$ob = new myclass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="js.js"></script>
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

        .back {
            background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px ;
            color: white;
            margin-bottom: 30px;
        }

        .con {
            padding: 0;
        }

    </style>
    <script type="text/javascript">


    </script>
    <title>Movie Blog</title>

</head>
<body>
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
            <label><?php echo " " . $_SESSION["name"] . " "; ?></label>&nbsp;
            <a href="logout.php" class="btn btn-primary my-2 my-sm-0" style="background-color: #ff9800;color: white" >LogOut</a>
        </form>
    </div>
</nav>
<?Php
$i = $_REQUEST['id'];
$rs = $ob->fetch($i);
foreach ($rs as $va) {
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="container  con mt-5">
            <img src="vv.jpg" class="img-fluid">
        </div>

        <div class="container mt-0 p-5 back">
            <div class="row">
                <div class="col-lg-9">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Movie Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $va[1] ?>" name="m_name"
                                   placeholder="Movie Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $va[2] ?>" name="m_title"
                                   placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Your Contain</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="m_contain"
                                      placeholder="Contain"><?php echo $va[3] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Upload Thumbnail</label>
                        <div class="col-sm-10 ">
                            <input type="file" class="form-control" name="m_img">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10"><br>
                                <button type="submit" name="update" class="btn btn" style="background-color: #ff9800;color: white" >Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <img src="<?php echo "image/" . $va[4]; ?>" width="100%" height="100%">
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
if (isset($_REQUEST["update"])) {
    $mg= $_FILES['m_img']['name'];
    $rs = $ob->update($_REQUEST['id'], $_REQUEST['m_name'], $_REQUEST['m_title'], $_REQUEST['m_contain'],$mg);
    $temp=$_FILES['m_img']['tmp_name'];
    move_uploaded_file($temp,"image/".$mg);
    if ($rs) {
        echo '<script type="text/javascript"> alert("Blog Updated Successfully");
             window.location.href="adminindex.php";</script>';
    } else {
        echo "upssss!!!";
    }

}
?>






