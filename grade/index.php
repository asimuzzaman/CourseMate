<?php
  require_once("../includes/head.php");
  require_once("../includes/database.php");
?>
<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Summary - CourseMate</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <!--[if lt IE 9]>
  <script src="/js/html5shiv.min.js"></script>
  <script src="/js/respond.min.js"></script>
<![endif]-->
</head>

<body id="page_survey_format">
<?php require_once("../includes/header.php"); ?>
  <div class="container">
    <h1 class="page-header"><span class="glyphicon glyphicon glyphicon-education glyphicon-pad"></span> Grades summary</h1>
    <div class="content-block">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
      </ol>
    </div>
    <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
<?php
  $query= "SELECT SUM(credit), SUM(grade*credit) FROM grades";
  $result= query($query);
  $row= mysqli_fetch_array($result);

  $totalcredit= $row[0]; //total credits passed
  $cgpa= $row[1]/$row[0]; //CGPA

  $query= "SELECT first_name, last_name FROM users WHERE id= $USERID";
  $result= query($query);
  $row= mysqli_fetch_array($result);
  $name= $row[0] . ' ' . $row[1]; //full name of user
?>
        <h3><?php echo $name; ?></h3><hr/>
        <div class="span2 well">
           <font size="4">Current CGPA: <?php echo $cgpa; ?></font>
        </div>
      </div><!--/.column-->
    </div><!--/.row-->
  </div><!--/.container-->

  <!--js scripts -->
  <!--page unspecific-->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  window.jQuery || document.write('<script src="/js/jquery-1.11.3.min.js"><\/script>')
  </script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <!--Init tabs - page specific-->
  <script>
    $(function() {
      $('.nav-tabs a:first').tab('show')
    });
  </script>
</body>

</html>
