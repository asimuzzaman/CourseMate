<?php
  require_once("../includes/head.php");
  require_once("../includes/database.php");
  require_once("../includes/functions.php");
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
    <!--<div class="content-block">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
      </ol>
    </div>-->
    <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
<?php
  $query= "SELECT SUM(credit), SUM(grade*credit) FROM GRADES WHERE user_id=$USERID";
  $result= query($query);
  $row= mysqli_fetch_array($result);

  $totalcredit= $row[0]; //total credits passed
  $cgpa= $row[1]/$row[0]; //CGPA

  $query= "SELECT first_name, last_name FROM USERS WHERE id= $USERID";
  $result= query($query);
  $row= mysqli_fetch_array($result);
  $name= $row[0] . ' ' . $row[1]; //full name of user
?>
        <h3><?php echo $name; ?></h3><hr/>
        <div class="span2 well">
           <font size="4">Current CGPA: <b><?php echo round($cgpa,2); ?></b></font><br/><br/>
           <font size="3"><ul>
            <li>Total credits completed: <?php echo $totalcredit; ?><br/>
<?php
  $query= "SELECT MAX(grade), MIN(grade) FROM GRADES";
  $result= query($query);
  $row= mysqli_fetch_array($result);
?>
            <li>Highest grade earned: <?php echo $row[0].' or '.DecodeGrade($row[0]); ?><br/>
            <li>Lowest grade earned: <?php echo $row[1].' or '.DecodeGrade($row[1]); ?></ul>
           </font>
        </div>
<?php
  $query= "SELECT DISTINCT semester FROM GRADES ORDER BY semester ASC";
  $result= query($query);
  while($row= mysqli_fetch_array($result)) {
    $sem= $row['semester'];
?>
        <h4 align="center"><?php echo DecodeSemester($sem); ?></h4>
<?php
    $query= "SELECT SUM(credit), SUM(credit*grade) FROM GRADES WHERE semester= $sem ";
    $query.= "AND user_id=$USERID GROUP BY semester";
    $res= query($query);

    $per_semester= mysqli_fetch_array($res);
    $per_credit= $per_semester[0];
    $tgpa= $per_semester[1]/$per_semester[0];
?>
          <p align="center"><?php echo "TGPA: <b>$tgpa</b> Total credit: <b>$per_credit</b>"; ?></p><hr/>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Course Code</th>
              <th>Grade</th>
              <th>Point</th>
              <th>Credit</th>
            </tr>
          </thead>
          <tbody>
<?php
      $i=1;
      $query= "SELECT * FROM GRADES WHERE semester=$sem AND user_id=$USERID";
      $out= query($query);
      while($course= mysqli_fetch_array($out)) {
?>
            <tr>
              <th scope="row"><?php echo $i++; ?></th>
              <td><?php echo $course['COURSE']; ?></td>
              <td><?php echo DecodeGrade($course['GRADE']); ?></td>
              <td><?php echo $course['GRADE']; ?></td>
              <td><?php echo $course['CREDIT']; ?></td>
            </tr>
<?php   } ?>
          </tbody>
        </table>
<?php } ?>
        <h4 align="center"><b>Grade wise course list</b></h4><hr/>
<?php
  $query= "SELECT DISTINCT l.letter, l.point FROM LETTER_GRADES l JOIN GRADES g ON (l.point=g.grade) ORDER BY l.g_id";
  $result= query($query);
  while($row= mysqli_fetch_array($result)) {

?>
        <div class="col-xs-5 col-sm-5 col-md-3 col-lg-3">
          <h5 align="center"><b><?php echo $row[0]; ?></b></h5>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Course Code</th>
              </tr>
            </thead>
            <tbody>
<?php
    $i=1;
    $query= "SELECT course FROM GRADES WHERE user_id=$USERID AND grade=".$row[1];
    $res= query($query);
    while($course= mysqli_fetch_array($res)) {
?>
              <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $course['course']; ?></td>
              </tr>
<?php   } ?>
            </tbody>
          </table>
        </div>
<?php } ?>
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
