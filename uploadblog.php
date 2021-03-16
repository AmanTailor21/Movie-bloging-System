<?php
session_start();
if(!isset($_SESSION['name'])){
    header("Location:login.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="blog.css">
    <script type="text/javascript" src="js.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        textarea{
            width: 100%;
            height: 100%;
        }
        .custom{
            background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);
        }

        .back{
            background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);

            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px ;
            color: white;
            margin-bottom: 30px;
        }
        .con{
            padding: 0;
        }

    </style>
    <title>Movie Blog</title>

</head>
<body>
<?php
include 'navbar.php';
?>

<form method="post" enctype="multipart/form-data">
    <div class="container  con mt-5">
        <img src="vv.jpg" class="img-fluid">
    </div>

    <div class="container mt-0 p-5 back">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Movie Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="m_name" placeholder="Movie Name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Add Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="m_title" placeholder="Title">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Your Contain</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="m_contain"  placeholder="Contain"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Upload Thumbnail</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="m_img">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="add" class="btn btn">Post</button>
            </div>
        </div>
    </div>


</form>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
require_once 'myclass.php';
$ob=new myClass();
if (isset($_REQUEST["add"]))
{
    $mg= $_FILES['m_img']['name'];
    $f=$ob->addblog($_REQUEST['m_name'],$_REQUEST['m_title'],$_REQUEST['m_contain'],$mg,$_SESSION['id'],$_SESSION['name']);
    $temp=$_FILES['m_img']['tmp_name'];
    move_uploaded_file($temp,"image/".$mg);
    if($f)
    {
        echo '<script>alert("Blog Upload Successfully")</script>';
    }
    else{
        echo '<script>alert("Upsssss")</script>';
    }
}
?>



