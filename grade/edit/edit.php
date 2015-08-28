<?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  require_once("$path/includes/head.php");
  require_once("$path/includes/database.php");
?>
<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Grades - Edit - CourseMate</title>
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
<?php require_once("$path/includes/header.php"); ?>
  <div class="container">
    <h1 class="page-header"><span class="glyphicon glyphicon glyphicon-pencil glyphicon-pad"></span> Edit course</h1>
    <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
<?php
  $CID= $_GET['id'];
  $query= "SELECT * FROM grades WHERE grade_id= $CID";
  $result= query($query);
  $course= mysqli_fetch_array($result);
?>
        <form action="/grade/edit/?id=<?php echo $CID; ?>" method= "post" id="update_course">
          <div class="form-group">
            <label for="code">Course code</label>
            <input type="text" class="form-control" id="code" name = "code" value="<?php echo $course['COURSE']; ?>">
          </div>
          <div class="form-group">
            <label for="credit">Credit</label>
            <select class="form-control" id="credit" name="credit" form="update_course">
              <!--<option value="0">Non Credit</option>-->
<?php
  for($i=0;$i<=5;$i++) {
    if($i==$course['CREDIT']) {
?>
              <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
<?php } else {
?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
    }
  }
?>
            </select>
          </div>
          <div class="form-group">
            <label for="grade">Grade</label>
            <select class="form-control" id="grade" name="grade" form="update_course">
<?php
  $query= "SELECT letter, point FROM letter_grades";
  $result= query($query);
  while($row= mysqli_fetch_array($result)) {
    $point= $row['point'];
    if($point==$course['GRADE']) {
?>
              <option value="<?php echo $point; ?>" selected="selected"><?php echo $row['letter']; ?></option>
<?php } else { ?>
              <option value="<?php echo $point; ?>"><?php echo $row['letter']; ?></option>
<?php
    }
  }
?>
            </select>
          </div>
          <div class="form-group">
            <label for="semester">Semester</label>
            <select class="form-control" id="semester" name="semester" form="update_course">
<?php
  $all_semester= array('Spring','Summer','Fall');

  $query= "SELECT year FROM users WHERE id= $USERID";
  $result= query($query);
  $row= mysqli_fetch_array($result);
  $year= $row['year'] % 1000;
  for($i=$year;$i<=$year+8;$i++) {
    foreach ($all_semester as $key => $val) {
      $sem= $i.($key+1);
      if($sem==$course['SEMESTER']) {
?>
              <option value="<?php echo $sem; ?>" selected="selected"><?php echo $val ." ". $i; ?></option>
<?php
    } else {
?>
              <option value="<?php echo $sem; ?>"><?php echo $val ." ". $i; ?></option>
<?php
      }
    }
  }
?>
            </select>
          </div>
          <div class="form-group">
            <input type="checkbox" name="retake" value="yes"> Retake
          </div>
          <button type="submit" name="update_course" class="btn btn-primary">Update</button>
        </form>
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
