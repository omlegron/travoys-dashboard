<header id="header" class="app-header navbar" role="menu">
    <!-- navbar header -->
    <div class="navbar-header bg-black">
      <button class="pull-right visible-xs" ui-toggle-class="show" target=".navbar-collapse">
        <i class="glyphicon glyphicon-cog"></i>
      </button>
      <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app">
        <i class="glyphicon glyphicon-align-justify"></i>
      </button>
      <!-- brand -->
      <a href="#/" class="navbar-brand text-lt">
        <!-- <i class="fa fa-btc" class="hide"></i> -->
        <img src="" alt=".">
        <span class="hidden-folded m-l-xs">Travoys</span>
      </a>
      <!-- / brand -->
    </div>
    <!-- / navbar header -->

    <!-- navbar collapse -->
    <div class="collapse pos-rlt navbar-collapse box-shadow ">
      <!-- search form -->
     <!--  <form class="navbar-form navbar-form-sm navbar-left shift">
        <div class="form-group">
          <div class="input-group">
            <a class="input-group-addon">
              <i class="fa fa-search fa-fw" style="color: #869ba0!important"></i>
            </a>
            <input type="text" ng-model="selected" class="form-control input-sm no-border" placeholder="Search data or Graphic">
          </div>
        </div>
      </form> -->
      <!-- / search form -->

      <!-- nabar right -->
      <ul class="nav navbar-nav navbar-right">
        
       <!--  <li>
          <a href="#" class="new">
            <i class="icon-bell fa-fw"></i>
            <span class="visible-xs-inline">Notifications</span>
          </a>
        </li> -->
        <li>
          <a href="#" class="minimize">
            <i class="fa fa-chevron-up"></i>
            <span class="visible-xs-inline">Notifications</span>
            <!-- <span class="badge badge-sm up bg-danger pull-right-xs"></span> -->
          </a>
        </li>
      </ul>
      <!-- / navbar right -->
    </div>
    <!-- / navbar collapse -->
</header>