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
        <title><?php include "inc/pageConfig.php";
echo $page_title; ?></title>
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

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black sidebar-mini" >
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
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Select Date and Employee</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Hide Button"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <label>Date :</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" name="reservationDate" class="form-control pull-left" id="reservation"/></div><!-- /.input group -->
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Employee Name</label>
                                                <select name="empName" class="empName form-control">
                                                    <option value="%">All</option>
                                                    <?php
                                                    $sql = mysqli_query($con, "select * from employee");
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        $id = $row['Name'];
                                                        $data = $row['Name'];
                                                        echo '<option value="' . $id . '">' . $data . '</option>';
                                                    }
                                                    ?>
                                                    
                                                </select> 
                                            </div> 

                                                                                      

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    Please click hide button before print
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                    
                    <?php
                    
                    if (empty($_POST['empName']))
                        $_POST['empName'] = '%';
                    
                    if (empty($_POST['reservationDate']))
                        $_POST['reservationDate'] = date('Y-m-d') . " - " . date('Y-m-d');

                    $trimmed = explode(" ", $_POST['reservationDate']);
                    $from = date('d-F-Y', strtotime($trimmed['0']));
                    $to = date('d-F-Y', strtotime($trimmed['2']));
                    ?>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header">Employee Work log of 
                                    
                                    
                                    <?php  
                                        $empName =  $_POST['empName'];
                                        if($empName == '%')
                                                echo 'All Employee';
                                        else
                                                echo $empName;
                                     ?>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Date</th><th>Name</th><th>In</th><th>Out</th>
                                        </tr>
                                        <tr>
                                            <?php 
                                            
                                               
                                                 while (strtotime($from) <= strtotime($to)) {
                                                               
                                                                
                                                                 $sqlNewEntry = mysqli_query($con, "SELECT * FROM `worklog` WHERE `date` like '".$from."'  AND  `name` like '".$_POST['empName']."'   ORDER BY `name` ASC");
                                                                    while ($row_NewEntry = mysqli_fetch_array($sqlNewEntry)) 
                                                                    {
                                                                        echo"<tr><td>".$row_NewEntry['date']."</td><td>".$row_NewEntry['name']."</td><td>".$row_NewEntry['inTime']."</td><td>".$row_NewEntry['outTime']."</td></tr>";
                                                                    }
                                                                
                                                                
                                                                $from = date ("d-F-Y", strtotime("+1 day", strtotime($from)));
                                                 }
                                               
                                            ?>
                                            
                                        </tr>
                                    </table>
                                </div>
                                <div class="box-footer"></div>
                            </div>                                 
                        </div>
                    </div>
                    
                    
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
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
        <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- iCheck 1.0.1 -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>



        <script type="text/javascript">
        $(function () {
            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker

        });
        </script>

        
        
        
    </body>
</html>