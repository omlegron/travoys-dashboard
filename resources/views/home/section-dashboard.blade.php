<div class="app-content ng-scope h-full" ng-class="{'m-n': app.hideAside, 'h-full': app.hideFooter }">
    <!-- uiView:  --><div class="app-content-body app-content-full fade-in ng-scope h-full" ng-class="{'h-full': app.hideFooter }" ui-view="" style=""><!-- hbox layout -->
<div class="hbox hbox-auto-xs hbox-auto-sm bg-light  ng-scope" ng-init="
  app.settings.asideFixed = true;
  app.settings.asideDock = false;
  app.settings.container = false;
  app.hideAside = false;
  app.hideFooter = true;
  " ng-controller="ContactCtrl">

  <!-- column -->
  <div class="col w b-r">
    <div class="vbox">
      <div class="row-row">
        <div class="cell scrollable hover">
          <div class="cell-inner">
            <div class="list-group no-radius no-border no-bg m-b-none">
              <a class="list-group-item b-b focus" ng-class="{'focus': (filter == '')}" ng-click="selectGroup({name:''})">ALL Contacts</a>
              <!-- ngRepeat: item in groups --><a ng-repeat="item in groups" ng-dblclick="editItem(item)" class="list-group-item m-l hover-anchor b-a no-select ng-scope" ng-class="{'focus m-l-none': item.selected}" ng-click="selectGroup(item)">
                <span ng-click="deleteGroup(item)" class="pull-right text-muted hover-action" role="button" tabindex="0"><i class="fa fa-times"></i></span>
                <span class="block m-l-n ng-binding" ng-class="{'m-n': item.selected }">Coworkers</span>
                <input type="text" class="form-control pos-abt ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-blur="doneEditing(item)" ng-model="item.name" style="top:3px;left:2px;width:98%" ui-focus="item.editing" aria-hidden="true" aria-invalid="false">
              </a><!-- end ngRepeat: item in groups --><a ng-repeat="item in groups" ng-dblclick="editItem(item)" class="list-group-item m-l hover-anchor b-a no-select ng-scope" ng-class="{'focus m-l-none': item.selected}" ng-click="selectGroup(item)">
                <span ng-click="deleteGroup(item)" class="pull-right text-muted hover-action" role="button" tabindex="0"><i class="fa fa-times"></i></span>
                <span class="block m-l-n ng-binding" ng-class="{'m-n': item.selected }">Family</span>
                <input type="text" class="form-control pos-abt ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-blur="doneEditing(item)" ng-model="item.name" style="top:3px;left:2px;width:98%" ui-focus="item.editing" aria-hidden="true" aria-invalid="false">
              </a><!-- end ngRepeat: item in groups --><a ng-repeat="item in groups" ng-dblclick="editItem(item)" class="list-group-item m-l hover-anchor b-a no-select ng-scope" ng-class="{'focus m-l-none': item.selected}" ng-click="selectGroup(item)">
                <span ng-click="deleteGroup(item)" class="pull-right text-muted hover-action" role="button" tabindex="0"><i class="fa fa-times"></i></span>
                <span class="block m-l-n ng-binding" ng-class="{'m-n': item.selected }">Friends</span>
                <input type="text" class="form-control pos-abt ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-blur="doneEditing(item)" ng-model="item.name" style="top:3px;left:2px;width:98%" ui-focus="item.editing" aria-hidden="true" aria-invalid="false">
              </a><!-- end ngRepeat: item in groups --><a ng-repeat="item in groups" ng-dblclick="editItem(item)" class="list-group-item m-l hover-anchor b-a no-select ng-scope" ng-class="{'focus m-l-none': item.selected}" ng-click="selectGroup(item)">
                <span ng-click="deleteGroup(item)" class="pull-right text-muted hover-action" role="button" tabindex="0"><i class="fa fa-times"></i></span>
                <span class="block m-l-n ng-binding" ng-class="{'m-n': item.selected }">Partners</span>
                <input type="text" class="form-control pos-abt ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-blur="doneEditing(item)" ng-model="item.name" style="top:3px;left:2px;width:98%" ui-focus="item.editing" aria-hidden="true" aria-invalid="false">
              </a><!-- end ngRepeat: item in groups --><a ng-repeat="item in groups" ng-dblclick="editItem(item)" class="list-group-item m-l hover-anchor b-a no-select ng-scope" ng-class="{'focus m-l-none': item.selected}" ng-click="selectGroup(item)">
                <span ng-click="deleteGroup(item)" class="pull-right text-muted hover-action" role="button" tabindex="0"><i class="fa fa-times"></i></span>
                <span class="block m-l-n ng-binding" ng-class="{'m-n': item.selected }">Group</span>
                <input type="text" class="form-control pos-abt ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-blur="doneEditing(item)" ng-model="item.name" style="top:3px;left:2px;width:98%" ui-focus="item.editing" aria-hidden="true" aria-invalid="false">
              </a><!-- end ngRepeat: item in groups -->
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper b-t">
        <span tooltip="Double click to Edit" class="pull-right text-muted inline wrapper-xs m-r-sm"><i class="fa fa-question"></i></span>
        <a href="" class="btn btn-sm btn-default" ng-click="createGroup()"><i class="fa fa-plus fa-fw m-r-xs"></i> New Group</a>
      </div>
    </div>
  </div>
  <!-- /column -->
  <!-- column -->
  <div class="col w-lg lter b-r">
    <div class="vbox">
      <div class="wrapper-xs b-b">
        <div class="input-group m-b-xxs">
          <span class="input-group-addon input-sm no-border no-bg"><i class="icon-magnifier text-md m-t-xxs"></i></span>
          <input type="text" class="form-control input-sm no-border no-bg text-md ng-pristine ng-untouched ng-valid" placeholder="Search All Contacts" ng-model="query" aria-invalid="false">
        </div>
      </div>
      <div class="row-row">
        <div class="cell scrollable hover">
          <div class="cell-inner">
            <div class="m-t-n-xxs">
              <div class="list-group list-group-lg no-radius no-border no-bg m-b-none">
                <!-- ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope select m-l-none" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding m-l-none" ng-class="{'m-l-none': item.selected }">
                    ABC <strong class="ng-binding">Swaine</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Alexandra <strong class="ng-binding">Galton</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Angela <strong class="ng-binding">Oscar</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Annabelle <strong class="ng-binding"></strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Bertina <strong class="ng-binding">Robert</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Blanche <strong class="ng-binding">Julian</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Brenda <strong class="ng-binding">Lanny</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Britney <strong class="ng-binding">Patricia</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Deborah <strong class="ng-binding">Darryl</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Elizabeth <strong class="ng-binding"></strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Emily <strong class="ng-binding">Jolyon</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Gertrude <strong class="ng-binding"></strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Gwynne <strong class="ng-binding">Rufus</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' --><a ng-repeat="item in items | filter:{group:filter} | filter:query | orderBy:'first'" class="list-group-item m-l ng-scope" ng-class="{'select m-l-none': item.selected }" ng-click="selectItem(item)">
                  <span class="block text-ellipsis m-l-n text-md ng-binding" ng-class="{'m-l-none': item.selected }">
                    Octavia <strong class="ng-binding">Swaine</strong>
                    <span ng-hide="item.first || item.last" aria-hidden="true" class="ng-hide">No Name</span>
                  </span>
                </a><!-- end ngRepeat: item in items | filter:{group:filter} | filter:query | orderBy:'first' -->
              </div>
            </div>
            <div class="text-center pos-abt w-full ng-hide" style="top:50%;" ng-hide="(items | filter:{group:filter} | filter:query).length" aria-hidden="true">No Contacts</div>
          </div>
        </div>
      </div>
      <div class="wrapper b-t text-center">
        <a href="" class="btn btn-sm btn-default btn-addon" ng-click="createItem()"><i class="fa fa-plus fa-fw m-r-xs"></i> New Contact</a>
      </div>
    </div>
  </div>
  <!-- /column -->

  <!-- column -->
  <div class="col bg-white-only">
    <div class="vbox">
      <div class="wrapper-sm b-b">
        <div class="m-t-n-xxs m-b-n-xxs m-l-xs">
          <a class="btn btn-xs btn-default pull-right" ng-hide="!item" ng-click="deleteItem(item)" aria-hidden="false"><i class="fa fa-times"></i></a>
          <a class="btn btn-xs btn-default" ng-hide="item.editing" ng-click="editItem(item)" aria-hidden="false">Edit</a>
          <a class="btn btn-xs btn-default ng-hide" ng-show="item.editing" ng-click="doneEditing(item)" aria-hidden="true">Done</a>
        </div>
      </div>
      <div class="row-row">
        <div class="cell">
          <div class="cell-inner">
            <div class="wrapper-lg">
              <div class="hbox h-auto m-b-lg">
                <div class="col text-center w-sm">
                  <div class="thumb-lg avatar inline">
                    <img ng-show="item.avatar" aria-hidden="false" class="" ng-src="img/a8.jpg" src="img/a8.jpg">
                  </div>
                </div>
                <div class="col v-middle h1 font-thin">
                  <div ng-hide="item.editing" class="ng-binding" aria-hidden="false">ABC Swaine</div>
                  <div ng-show="item.editing" aria-hidden="true" class="ng-hide">
                    <input type="text" placeholder="First" class="form-control w-auto input-lg m-b-n-xxs font-bold ng-pristine ng-untouched ng-valid" ng-model="item.first" aria-invalid="false">
                    <input type="text" placeholder="Last" class="form-control w-auto input-lg font-bold ng-pristine ng-untouched ng-valid" ng-model="item.last" aria-invalid="false">
                  </div>
                </div>
              </div>
              <!-- fields -->
              <div class="form-horizontal">
                <div class="form-group m-b-sm" ng-hide="!item.mobile &amp;&amp; !item.editing" aria-hidden="false">
                  <label class="col-sm-3 control-label">Mobile</label>
                  <div class="col-sm-9">
                    <p class="form-control-static ng-binding" ng-hide="item.editing" aria-hidden="false">854 656 879</p>
                    <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-model="item.mobile" aria-hidden="true" aria-invalid="false">
                  </div>
                </div>
                <div class="form-group m-b-sm" ng-hide="!item.home &amp;&amp; !item.editing" aria-hidden="false">
                  <label class="col-sm-3 control-label">Home</label>
                  <div class="col-sm-9">
                    <p class="form-control-static ng-binding" ng-hide="item.editing" aria-hidden="false">(021) 1234 8755</p>
                    <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-model="item.home" aria-hidden="true" aria-invalid="false">
                  </div>
                </div>
                <div class="form-group m-b-sm" ng-hide="!item.work &amp;&amp; !item.editing" aria-hidden="false">
                  <label class="col-sm-3 control-label">Work</label>
                  <div class="col-sm-9">
                    <p class="form-control-static ng-binding" ng-hide="item.editing" aria-hidden="false">(021) 9000 9877</p>
                    <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-model="item.work" aria-hidden="true" aria-invalid="false">
                  </div>
                </div>
                <div class="form-group m-b-sm ng-hide" ng-hide="!item.company &amp;&amp; !item.editing" aria-hidden="true">
                  <label class="col-sm-3 control-label">Company</label>
                  <div class="col-sm-9">
                    <p class="form-control-static ng-binding" ng-hide="item.editing" aria-hidden="false"></p>
                    <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-model="item.company" aria-hidden="true" aria-invalid="false">
                  </div>
                </div>
                <div class="form-group m-b-sm ng-hide" ng-hide="!item.note &amp;&amp; !item.editing" aria-hidden="true">
                  <label class="col-sm-3 control-label">Note</label>
                  <div class="col-sm-9">
                    <p class="form-control-static ng-binding" ng-hide="item.editing" aria-hidden="false"></p>
                    <textarea class="form-control ng-pristine ng-untouched ng-valid ng-hide" ng-show="item.editing" ng-model="item.note" rows="5" aria-multiline="true" aria-hidden="true" aria-invalid="false"></textarea>
                  </div>
                </div>
              </div>
              <!-- / fields -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /column -->
</div>
<!-- /hbox layout --></div>
  </div>