<?php
  require_once("/includes/head.php");
  $incorrect= false;

  if(isset($_GET['f']) && $_GET['f']=="logout") $_SESSION['user']= NULL;
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query= "SELECT password FROM users WHERE username = '$username'";
    $result= query($query);
    $row= mysqli_fetch_array($result);
    $pass= $row[0]; //password from Db

    if($password == $pass) {
      $_SESSION['user'] = $username; //logging in
      header("Location: /home/");
    } else {
      $incorrect= true;
    }
  }
?>

<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CourseMate</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <!--[if lt IE 9]>
	<script src="/js/html5shiv.min.js"></script>
	<script src="/js/respond.min.js"></script>
<![endif]-->
</head>

<body id="page_login">
  <nav class="navbar navbar-fixed-top navbar-inverse" id="topbar">
    <div class="container">
      <div class="navbar-header"><!--
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topbar_menu_collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>--><!--navbar-toggle collapsed-->
        <a class="navbar-brand" href="/home"><img src="/img/logo.jpg" alt="CourseMate" style="width:165px;height:25px;"></a>
      </div><!--/.navbar-header--><!--
      <div id="topbar_menu_collapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img class="img-rounded avatar avatar-navbar" src="http://placehold.it/40x36.gif">
              <span class="caret"></span>
              <div class="btn-group visible-xs-inline-block navbar-right">
                <button type="button" class="btn btn-success">
                  <span class="badge">245</span>--><!--php here for number--><!--
                  <span class="hidden-xxxs"> views</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-eye-open"></span>
                </button>
                <button type="button" class="btn btn-warning">
                  <span class="badge">457</span>--><!--php here for number--><!--
                  <span class="hidden-xxxs"> posts</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-flash"></span>
                </button>
                <button type="button" class="btn btn-info">
                  <span class="badge">9</span>--><!--php here for number--><!--
                  <span class="hidden-xxxs"> comments</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-comment"></span>
                </button>
                <button type="button" class="btn btn-danger hidden-xxs">
                  <span class="badge">23</span>--><!--php here for number--><!--
                  <span class="hidden-xxxs"> likes</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-heart"></span>
                </button>
              </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="#"><span class="glyphicon glyphicon-user glyphicon-pad"></span> username</a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-globe glyphicon-pad"></span> notifications <span class="badge badge-leftpad badge-active">2</span></a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-envelope glyphicon-pad"></span> messages <span class="badge badge-leftpad badge-active">6</span></a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-wrench glyphicon-pad"></span> settings</a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-off glyphicon-pad"></span> logout</a>
              </li>
            </ul>--><!--dropdown-menu--><!--
          </li>--><!--/.dropdown--><!--
        </ul>--><!--/.navbar-nav--><!--
        <form class="navbar-form navbar-search">
        	<div class="form-group">
          	<div class="form-group">
            	<input type="text" class="form-control search-input" placeholder="type anything">
            </div>
          </div>
          <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search hidden-xs"></span><span class="visible-xs-inline-block text-muted">Submit</span></button>
        </form>
      </div>--><!--/#_topbar_menu_collapse-->
    </div><!--/.container-->
  </nav><!--/.navbar-->
  <div class="container">
  	<div class="rows clearfix">
  		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
  			<!--login/signup tabs-->
  			<ul class="nav nav-tabs">
  				<li class="active"><a href="#sign_in" data-toggle="tab">Sign in</a></li>
  				<li><a href="#sign_up" data-toggle="tab">Sign up</a></li>
  			</ul><!--/.nav-tabs-->
  			<!--tab data-->
  			<div class="tab-content tab-bordered">
  				<div class="tab-pane fade active in" id="sign_in">
<?php
  if(isset($_GET['id']))
    if($_GET['id']==1) {
?>
            <p class="errata alert-danger"><span class="glyphicon glyphicon-info-sign glyphicon-pad"></span> You must log in first.</p>
<?php }
  if($incorrect) {
?>
            <p class="errata alert-danger"><span class="glyphicon glyphicon-info-sign glyphicon-pad"></span> Incorrect username or password</p>
<?php } ?>
            <form action="/" method= "post">
  						<div class="form-group">
    						<label for="username">Username</label>
    						<input type="text" class="form-control" id="username" name = "username" placeholder="username">
  						</div>
  						<div class="form-group">
    						<label for="password">Password</label>
    						<input type="password" class="form-control" id="password" name = "password" placeholder="password">
  						</div>
  						<button type="submit" name="submit" class="btn btn-primary">Sign in</button>
  					</form>
  					<p class="bg-info errata sm-margin-top"><span class="glyphicon glyphicon-question-sign glyphicon-pad text-danger"></span> <a href="/checkpoint/<?php echo rawurlencode("account recovery.php"); ?>">Forgot your password?</a> </p>
  				</div><!--#sign_in-->
  				<div class="tab-pane fade" id="sign_up">
  					<form>
  						<div class="form-group">
    						<label for="first_name">First Name</label>
    						<input type="text" class="form-control" id="first_name" placeholder="First Name">
  						</div>
  						<div class="form-group">
    						<label for="last_name">Last Name</label>
    						<input type="text" class="form-control" id="last_name" placeholder="Last Name"><br/>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="email address">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
              </div>
              <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input type="password" class="form-control" id="confirm_password">
              </div>
              <div class="form-group">
                <label for="school">School/Institution</label>
                <input type="text" class="form-control" id="school" placeholder="Name of your institution">
              </div>
  						</div>
  						<button type="submit" class="btn btn-primary">Sign up</button>
  					</form>
  				</div><!--#sign_up-->
  			</div><!--/.tab-content ends-->
  		</div><!--/.tab-->
  	</div><!--/.row-->
  </div><!--/.container-->

<?php //require_once("includes/footer.php"); ?>

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
<?php CloseDb(); ?>
