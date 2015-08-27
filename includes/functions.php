<?php
  function AddCourse() {
    if(isset($_POST['add_course'])) {
      $code= escape($_POST['code']);
      $credit= $_POST['credit'];
      $semester= $_POST['semester'];
      $point= $_POST['grade'];
      global $USERID;
      if(isset($_POST['retake'])) $is_retake= true;
      else $is_retake= 'NULL';

      $query= "INSERT INTO grades VALUES (NULL, '$code', $point, $credit, $USERID, $semester, $is_retake)";
      query($query);
?>
    <div class="alert alert-success alert-dismissible fade in">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <span class="glyphicon glyphicon-thumbs-up glyphicon-pad"></span> Course successfully added!
    </div>
  <?php
    }
  }

  function DecodeSemester($semester) { //takes '152' and gives 'Summer 15'
    $letter= $semester%10;
    $year= intval($semester/10);

    switch ($letter) {
      case '1':
        $letter= 'Spring';
        break;

      case '2':
        $letter= 'Summer';
        break;

      case '3':
        $letter= 'Fall';
        break;
    }
    return $letter . ' ' . $year;
  }

  function DecodeGrade($point) { //takes '4.00' and gives 'A'
    $query= "SELECT letter FROM letter_grades WHERE point= $point";
    $result= query($query);
    $row= mysqli_fetch_array($result);

    return $row['letter'];
  }

?>
