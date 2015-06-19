<div class="bs-example">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CHL</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

     
          </ul>
          <form class="navbar-form navbar-left" role="search" action="index.php" method="post">
            <div class="form-group">
              <input class="form-control" name="search"  placeholder="Search" type="text">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
          </form>
          <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sort by<b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="index.php?sort=ORDER%20BY%20price">Price(Low-High)</a></li>
                <li><a href="index.php?sort=ORDER%20BY%20price%20DESC">Price(High-Low)</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>