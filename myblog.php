<?php
session_start();
require_once 'myclass.php';
$ob = new myclass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
$a = $ob->showmyblog($_SESSION['id']);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="blog.css">
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
<body>
<?php
    include 'navbar.php';
?>
<?php foreach ($a as $rs) { ?>
    <div class="container-fluid" onmouseover="bigcard(this)" onmouseout="normalcard(this)">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="<?php echo "image/" . $rs[4]; ?>" style="border-top-left-radius: 5px"
                                 width="200px" height="200px" alt="Card image cap">

                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $rs[1]; ?></h4>
                            <p class="card-text"><?php echo $rs[2]; ?></p>
                            <p class="card-text"><?php echo $rs[3]; ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-1">
                                <i class="fa fa-thumbs-o-up text-danger" style="font-size: 25px"></i>
                                <i><?php $r = $ob->likecounter($rs[0]); echo $r[0]; ?></i>
                            </div>
                            <div class="col-lg-9"></div>
                            <div class="col-lg-2">
                                <a class="btn btn-primary" style=" background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);" href="editblog.php?id=<?php echo $rs[0];?>"><i class="fa fa-pencil"></i> Edit</a>
                                <a class="btn btn-danger" href="delete_blog.php?did=<?php echo $rs[0];?>"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#unlike").click(function () {
            $("#unlike").html("<i class='fa fa-thumbs-up'></i>");
        });
    });

    function bigcard(x) {
        x.style.marginTop = "20px";
        x.style.marginBottom = "20px";
        x.style.height = "254px";
        x.style.marginLeft = "20px";
        x.style.marginRight = "20px";
        x.style.width = "98%";
    }

    function normalcard(x) {
        x.style.height = "254px";
        x.style.marginLeft = "0px";
        x.style.width = "100%";
    }

</script>
</body>
</html>
