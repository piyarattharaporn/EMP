<!DOCTYPE html>
<?php
session_start();
include "inc/connect.php";

?>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
            include "inc/pageConfig.php";
            echo $page_title;
            ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            function disableClick() {
            document.onclick = function (event) {
            if (event.button == 2) {
            alert('Right Click not avalible');
                    return false;
            }
            }
            }
        </script>
    </head>
    <body class="skin-black sidebar-mini" onLoad="disableClick()">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="home.php?select_year=2015" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>PJTL</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Project </b>Talent</span>
                </a>

                <!-- Header Navbar -->
                <?php include"inc/navTop.php"; ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?php
            include "inc/asideMenu.php";
            include "inc/connect.php";
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>All Data Transection.</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashdoard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header">Welcome Our employee's</div>
                                <div class="box-body">
                                        <?php $name = $_SESSION['name'];?>
                                        Employee Code :: <?php echo $_SESSION['code']; ?><br/>
                                        Employee Name :: <?php echo $_SESSION['name']; ?><br /><br />
                                        <form role="form" method="POST" action="inc/regist.php">
                                            <div class="form-group">
                                                <label>Select In or out</label>
                                                  <select name="check" class="form-control">
                                                      <option selected="in">Check in</option>
                                                      <option selected="out">Check out</option>
                                                  </select>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Submit</button>                            
                                            </div>
                                        </form>
                                        
                                </div>
                                <div class="box-footer"></div>
                            </div>                                 
                        </div>
                        <div class="col-md-6">
                            <div class="box box-warning">
                                <div class="box-header"><?php echo $name ?> Work log</div>
                                <div class="box-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                        </tr>
                                         <?php
                                            $sqlNewEntry = mysqli_query($con, "SELECT * FROM `worklog` WHERE `name` = '$name' ORDER BY `date`");
                                            while ($row_NewEntry = mysqli_fetch_array($sqlNewEntry)) {
                                            echo "<tr>
                                                <td>" . $row_NewEntry['date'] . "</td>
                                                <td>" . $row_NewEntry['inTime'] . "</td>
                                                <td>" . $row_NewEntry['outTime'] . "</td>
                                              </tr>";                                            
                                        }
                                        ?>         
                                    </table>
                                </div>
                                <div class="box-footer"></div>
                            </div>                                 
                        </div>
                    </div><!--/row-->
                    
                    
                    
                </section>
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->

            <!-- Control Sidebar -->      
            <?php
            include "inc/footer.php";
            
            ?>
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>
        <?php include 'inc/graphOccupancy.php'; ?>
        
        
        
    </body>
</html>