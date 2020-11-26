<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

<?php
session_start();
$statusMsg = '';

if(!isset($_SESSION['Username']))
{
header("location:page-login.php");
}

if (isset($_POST['Logout']))
{
session_destroy();
unset($_SESSION['Username']);
header("location:page-login.php");
}

if(isset($_POST["btn-sub"]) && !empty($_FILES["file"]["name"]))
{

$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$con = mysqli_connect("localhost", "root", "", "bookstore");

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes))
    {
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath))
        {

            $B_Name = $_POST['bookname'];
            $B_Category = $_POST['bookcategory'];
            $B_Author = $_POST['bookauthor'];
            $B_Price = $_POST['bookprice'];
            $B_Img = $fileName;
            $B_Decs = $_POST['bookdescription'];
            $B_Isbn = $_POST['bookisbn'];
            $B_Qty = $_POST['bookquantity'];
            $sql = "INSERT INTO books(B_Name, B_Category, B_Author, B_Price, B_Img, B_Decs, B_Isbn, B_Qty) VALUES('$B_Name', '$B_Category', '$B_Author', '$B_Price', '$B_Img', '$B_Decs', '$B_Isbn', '$B_Qty')";
            $result = mysqli_query($con, $sql);

            if($result)
            {
                $statusMsg = "<p class='text-success'>Data has been uploaded successfully.</p>";
            }
            else
            {
                $statusMsg = "<p class='text-danger'>Data upload failed, please try again.</p>";
            } 
        }
        else{
            $statusMsg = "<p class='text-danger'>Sorry, there was an error uploading your file.</p>";
        }
    }
    else
    {
        $statusMsg = "<p class='text-danger'>Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.</p>";
    }
}

    // if (isset($_POST['btn-sub']))
    // {

    //     $directory = 'images/';
    //     $directory = $directory.basename($_FILES['B_Img']['name']);

    //     if (move_uploaded_file($_FILES['bookimage']['tmp_name)'], $directory))
    //     {
    //         $B_Name = $_POST['bookname'];
    //         $B_Category = $_POST['bookcategory'];
    //         $B_Author = $_POST['bookauthor'];
    //         $B_Price = $_POST['bookprice'];
    //         $B_Img = basename($_FILES['bookimage']['name']);
    //         $B_Desc = $_POST['bookdescription'];
    //         $B_Isbn = $_POST['bookisbn'];
    //         $B_Qty = $_POST['bookquantity'];
    //         $sql = "INSERT INTO books(B_Name, B_Category, B_Author, B_Price, B_Img, B_Desc, B_Isbn, B_Qty) VALUES('$B_Name', 'B_Category', 'B_Author', 'B_Price', 'B_Img', 'B_Desc', 'B_Isbn', 'B_Qty')";
    //         $result = mysqli_query($con, $sql);
    //         if ($result)
    //         {
    //             echo "<script>alert('Work');</script>";
    //         }
    //     }
    // }

?>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href=""> Dost </a>
                <a class="navbar-brand hidden" href=""> </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                    </li>

                    <li class="menu-item-has-children dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i><font style="color: white !important;">Products</font></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="ui-addbooks.php"><font style="color: white !important;">Books</font></a></li>
                            <li><a href="ui-buttons.html">Stationary & Utilities</a></li>
                            <li><a href="ui-buttons.html">CDs & DVDs</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Customer Details</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Order Details</a>
                    </li>

                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-phone"></i>Contact Us</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-envelope"></i>Users Feedback</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <form action="" method="post">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>
                            <div  class="nav-link">
                            <input type="submit" class="btn btn-sm btn-outline-secondary" value="Logout" name="Logout">
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="content mt-3">

            <?php 
            if (!empty($statusMsg))
            { echo $statusMsg;  }
            ?>

    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Book Name</label>
        <input type="text" class="form-control" name="bookname" placeholder="Enter Book name" />
    </div>
    <div class="form-group">
        <label>Book Category</label>
        <input type="text" class="form-control" name="bookcategory" placeholder="Enter Book Category" />
    </div>
    <div class="form-group">
        <label>Book Author</label>
        <input type="text" class="form-control" name="bookauthor" placeholder="Enter Book Author" />
    </div>
    <div class="form-group">
        <label>Book Price</label>
        <input type="text" class="form-control" name="bookprice" placeholder="Enter Book Price" />
    </div>
    <div class="form-group">
        <label>Book Image</label>
        <input type="file" class="form-control" name="file" />
    </div>
    <div class="form-group">
        <label>Book Description</label>
        <input type="text" class="form-control" name="bookdescription" placeholder="Enter Book Description" />
    </div>
    <div class="form-group">
        <label>Book ISBN</label>
        <input type="text" class="form-control" name="bookisbn" placeholder="Enter Book ISBN" />
    </div>
    <div class="form-group">
        <label>Book Quantity</label>
        <input type="number" class="form-control" name="bookquantity" />
    </div>
  <input type="submit" name="btn-sub" class="btn btn-primary" value="Submit" />
</form>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>
