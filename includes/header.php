<?php
  if($USERNAME==NULL) { //not logged in
?>
<nav class="navbar navbar-fixed-top navbar-inverse" id="topbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topbar_menu_collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>--><!--navbar-toggle collapsed-->
      <a class="navbar-brand" href="/home"><img src="/img/logo.jpg" alt="CourseMate" style="width:165px;height:25px;"></a>
    </div><!--/.navbar-header-->
    <div id="topbar_menu_collapse" class="collapse navbar-collapse">
      <button type="button" class="btn btn-default navbar-btn navbar-right"><a class="display-block" href="/index.php">Sign in</a></button>
    </div><!--/#topbar_menu_collapse-->
  </div><!--/.container-->
</nav><!--/.navbar-->

<?php
  } else { //logged in
?>

<nav class="navbar navbar-fixed-top navbar-inverse" id="topbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topbar_menu_collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>--><!--navbar-toggle collapsed-->
      <a class="navbar-brand" href="/home"><img src="/img/logo.jpg" alt="CourseMate" style="width:165px;height:25px;"></a>
    </div><!--/.navbar-header-->
    <div id="topbar_menu_collapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img class="img-rounded avatar avatar-navbar" src="/img/avatar.jpg">
            <span class="caret"></span>
            <div class="btn-group visible-xs-inline-block navbar-right">
              <button type="button" class="btn btn-success">
                <span class="badge">245</span><!--php here for number-->
                <span class="hidden-xxxs"> views</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-eye-open"></span>
              </button>
              <button type="button" class="btn btn-warning">
                <span class="badge">457</span><!--php here for number-->
                <span class="hidden-xxxs"> posts</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-flash"></span>
              </button>
              <button type="button" class="btn btn-info">
                <span class="badge">9</span><!--php here for number-->
                <span class="hidden-xxxs"> comments</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-comment"></span>
              </button>
              <button type="button" class="btn btn-danger hidden-xxs">
                <span class="badge">23</span><!--php here for number-->
                <span class="hidden-xxxs"> likes</span><span class="hidden-xs visible-xxxs-inline-block glyphicon glyphicon-heart"></span>
              </button>
            </div>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="/profile/view/?id=<?php echo $USERID; ?>"><span class="glyphicon glyphicon-user glyphicon-pad"></span><?php echo $USERNAME; ?></a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="#"><span class="glyphicon glyphicon-globe glyphicon-pad"></span> notifications <span class="badge badge-leftpad badge-active">2</span></a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="/messages/"><span class="glyphicon glyphicon-envelope glyphicon-pad"></span> messages <span class="badge badge-leftpad badge-active">6</span></a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="/profile/"><span class="glyphicon glyphicon-wrench glyphicon-pad"></span> settings</a>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="/?f=logout"><span class="glyphicon glyphicon-off glyphicon-pad"></span> logout</a>
            </li>
          </ul><!--dropdown-menu-->
        </li><!--/.dropdown-->
      </ul><!--/.navbar-nav-->
      <form class="navbar-form navbar-search">
        <div class="form-group">
          <div class="form-group">
            <input type="text" class="form-control search-input" placeholder="type anything">
          </div>
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search hidden-xs"></span><span class="visible-xs-inline-block text-muted">Submit</span></button>
      </form>
    </div><!--/#_topbar_menu_collapse-->
  </div><!--/.container-->
</nav><!--/.navbar-->
<?php
  }
?>
