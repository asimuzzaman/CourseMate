<?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  require_once("$path/includes/head.php");
  require_once("$path/includes/database.php");
  require_once("$path/includes/functions.php");
?>
<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit-CGPA-coursemate</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <!--[if lt IE 9]>
  <script src="/js/html5shiv.min.js"></script>
  <script src="/js/respond.min.js"></script>
<![endif]-->
</head>

<body id="page_survey">
<?php
  require_once("../../includes/header.php");
?>
  <div class="container">
    <h1 class="page-header"><span class="glyphicon glyphicon-edit glyphicon-pad"></span> Edit</h1>
    <div class="content-block">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
      </ol>
    </div>
    <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <nav class="navbar navbar-default visible-xs">
          <div class="container">
            <button type="button" class="btn navbar-btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Go Back</button>
            <button type="button" class="btn navbar-btn btn-primary pull-right" data-toggle="offcanvas"><span class="glyphicon glyphicon-chevron-right"></span></button>
          </div>
        </nav>
        <div class="col-lg-12"><!--content-->
          <h2 class="sm-margin-top">Add course</h2><hr>
<?php
  AddCourse(); //function for adding course
  UpdateCourse();

  if(isset($_POST['delete'])) {
    $grade_id= $_GET['id'];
    $query= "DELETE FROM grades WHERE grade_id= $grade_id";
    query($query);
?>
    <div class="alert alert-success alert-dismissible fade in">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <span class="glyphicon glyphicon-thumbs-up glyphicon-pad"></span> Course deleted.
    </div>
<?php
  }
?>
            <form action="/grade/edit/" method= "post" id="add_course">
              <div class="form-group">
                <label for="code">Course code</label>
                <input type="text" class="form-control" id="code" name = "code" placeholder="eg. CSE115">
              </div>
              <div class="form-group">
                <label for="credit">Credit</label>
                <select class="form-control" id="credit" name="credit" form="add_course">
                  <option value="0">Non Credit</option>
<?php
  for($i=1;$i<=5;$i++) {
?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="grade">Grade</label>
                <select class="form-control" id="grade" name="grade" form="add_course">
<?php
  $query= "SELECT letter, point FROM letter_grades";
  $result= query($query);
  while($row= mysqli_fetch_array($result)) {
    $point= $row['point'];
?>
                  <option value="<?php echo $point; ?>"><?php echo $row['letter']; ?></option>
<?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester" name="semester" form="add_course">
<?php
  $query= "SELECT year FROM users WHERE id= $USERID";
  $result= query($query);
  $row= mysqli_fetch_array($result);
  $year= $row['year'] % 1000;
  for($i=$year;$i<=$year+8;$i++) {
?>
                  <option value="<?php echo $i; ?>1">Spring <?php echo $i; ?></option>
                  <option value="<?php echo $i; ?>2">Summer <?php echo $i; ?></option>
                  <option value="<?php echo $i; ?>3">Fall <?php echo $i; ?></option>
<?php } ?>
                </select>
              </div>
              <div class="form-group">
                <input type="checkbox" name="retake" value="yes"> Retake
              </div>
              <button type="submit" name="add_course" class="btn btn-primary">Add</button>
            </form>
          <h2 class="sm-margin-top">All courses</h2><hr>
          <table class="table table-condensed">
            <thead>
              <tr>
                <th>#</th>
                <th>Course Code</th>
                <th>Grade</th>
                <th>Credit</th>
                <th>Semester</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
<?php
  $query= "SELECT grade_id, course, grade, credit, semester FROM grades WHERE user_id=$USERID ORDER BY grade_id DESC";
  $result= query($query);
  $i=1;
  while($row= mysqli_fetch_array($result)) {
?>
              <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo DecodeGrade($row['grade']); ?></td>
                <td><?php echo $row['credit']; ?></td>
                <td><?php echo DecodeSemester($row['semester']); ?></td>
                <td>
                  <form action="/grade/edit/?id=<?php echo $row['grade_id']; ?>" method= "post" id="delete_course">
                    <a href="/grade/edit/edit.php?id=<?php echo $row['grade_id']; ?>" class="btn btn-success btn-xs">edit</a>
                    <button type="submit" name="delete" class="btn btn-warning btn-xs">delete</button>
                  </form>
                </td>
              </tr>
<?php } ?>
            </tbody>
          </table>
          <a href="/grade/" class="btn btn-info">Grades summary</a>
        </div><!--/.col+content-->
      </div><!--/.col-->

      <!--<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 sidebar-offcanvas" id="sidebar">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h6><span class="glyphicon glyphicon-flash glyphicon-pad"></span> Go To</h6>
          </div>
          <ul class="list-group">
            <a href="#" class="list-group-item active"><span class="glyphicon glyphicon-question-sign glyphicon-pad"></span> ask</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-map-marker glyphicon-pad"></span> activites</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-apple glyphicon-pad"></span> groups</a>
            <a href="#" class="list-group-item"><span class="glyphicon glyphicon-check glyphicon-pad"></span> survey</a>
          </ul>
        </div>
      </div>--><!--/.sidebar-offcanvas-->
      <div class="col-lg-12 clearfix clear-both"></div>
    </div><!--/row-->
  </div><!--/.container-->

  <!--js scripts -->
  <!--page unspecific--><!--
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  window.jQuery || document.write('<script src="/js/jquery-1.11.3.min.js"><\/script>')
  </script>-->
  <!--testing--><script src="/js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/jquery.placeholder.min.js"></script>
  <!--Init tabs - page specific-->
  <script type="text/javascript">
    $(function() {
      $('.nav-tabs a:first').tab('show')
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
      });
    });
  </script>
  <script type="text/javascript">
    $('input, textarea').placeholder();
  </script>
</body>

</html>
