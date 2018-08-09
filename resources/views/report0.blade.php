@extends("layouts.dashboard.main0")

@section('navbar')
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ตารางการใช้รถยนต์ส่วนกลางของมหาวิทยาลัยราชภัฏเพชรบูรณ</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
				<li> <a href="dashboard"><span class="glyphicon glyphicon-calendar icon-calendar"></span> Task</a></li>
				<li class="dropdown active">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt icon-list-alt"></span> Report <b class="caret"></b></a>
						<ul class="dropdown-menu">
								<li data-toggle="modal" data-target="#filterModal"> <a href="javascript:void(0);"><span class="glyphicon glyphicon-filter icon-filter"></span> Filter</a></li>
								<!--<li class="divider"></li>-->
						</ul>
				</li>
        <li> <a href="{{ url('/manage') }}"><span class="glyphicon glyphicon-tasks icon-tasks"></span> Manage Item</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
          <li><a href="{{ url('/auth/login') }}">Login</a></li>
          <li><a href="{{ url('/auth/register') }}">Register</a></li>
        @else
          <li data-toggle="modal" data-target="#settingModal"> <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span> Config</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
@stop

@section("content")
<div id="ReportCtrl" ng-controller="ReportCtrl">
    <div id="reportDisplay1" style="display:none"></div>
    <div ng-include src="reportDisplay"></div>

    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Report Filter</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="txt_report_type" class="col-sm-4 control-label">ประเภทรายงาน</label>
                            <div class="col-sm-8">
                                <select id="txt_report_type" ng-model="filter.reportType" ng-change="changeReportType()" class="span2 form-control" required>
                                    <option value="1">สรุปรวม</option>
                                    <option value="2">รายการ</option>
                                </select>
                            </div>
                        </div>

                        <div id="displayFilter"></div>
                        <div ng-include src="displayFilter"></div>
                        <!--<div ng-include src="displayFilter" ng-init="callGenReport();"></div>-->
                        <!--
                        <div class="form-group">
                            <label for="txt_driver_picker" class="col-sm-4 control-label">เดือน</label>
                            <div class="col-sm-8">
                                <select id="txt_driver_picker" class="span2 form-control" required></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_start_date" class="col-sm-4 control-label">เดือน</label>
                            <div class="col-sm-6">
                                <div class="span5" id="sandbox-container">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" id="txt_start_date" class="input-sm form-control" name="start" />
                                        <span class="input-group-addon">ถึง</span>
                                        <input type="text" id="txt_end_date" class="input-sm form-control" name="end" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flagpoint" class="col-sm-4 control-label">จุดนัด</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="flagpoint" placeholder="จุดนัด">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reserve_by" class="col-sm-4 control-label">ผู้ประสานงานขอใช้รถ</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="reserve_by" placeholder="ผู้ประสานงานขอใช้รถ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_detail" class="col-sm-4 control-label">รายละเอียด</label>
                            <div class="col-sm-8">
                                <textarea id="txt_detail" rows="3" class="form-control" placeholder="รายละเอียด"></textarea>
                            </div>
                        </div>-->
                    </form>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnGenReport" ng-click="callGenReport()">Generate Report</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="settingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Setting</h4>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#car">Cars</a></li>
                        <li><a href="#driver">Driver</a></li>
                        <li><a href="#">Messages</a></li>
                      </ul>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="txt_car_picker" class="col-sm-4 control-label">ทะเบียนรถ</label>
                            <div class="col-sm-8">
                              <select id="txt_car_picker" class="span2 form-control" required></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_driver_picker" class="col-sm-4 control-label">คนขับรถ</label>
                            <div class="col-sm-8">
                                <select id="txt_driver_picker" class="span2 form-control" required></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="flagpoint" class="col-sm-4 control-label">จุดนัด</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="flagpoint" placeholder="จุดนัด">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reserve_by" class="col-sm-4 control-label">ผู้ประสานงานขอใช้รถ</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="reserve_by" placeholder="ผู้ประสานงานขอใช้รถ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_detail" class="col-sm-4 control-label">รายละเอียด</label>
                            <div class="col-sm-8">
                                <textarea id="txt_detail" rows="3" class="form-control" placeholder="รายละเอียด"></textarea>
                            </div>
                        </div>
                    </form>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="inviteRequest">Save Setting</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">แก้ใข</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="txt_car_picker" class="col-sm-4 control-label">ทะเบียนรถ</label>
                            <div class="col-sm-8">
                                <input type="hidden" id="txt_edit_id" value="">
                                <select id="txt_edit_car_picker" class="span2 form-control" required></select>
                                <select class="span2 form-control" ng-model="color" ng-options="c.name for c in colors" style="display:none;"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_driver_picker" class="col-sm-4 control-label">คนขับรถ</label>
                            <div class="col-sm-8">
                                <select id="txt_edit_driver_picker" class="span2 form-control" required></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_start_date" class="col-sm-4 control-label">วันที่ใช้รถ</label>
                            <div class="col-sm-6">
                                <div class="span5" id="sandbox-container">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" id="txt_edit_start_date" class="input-sm form-control" name="start" />
                                        <span class="input-group-addon">ถึง</span>
                                        <input type="text" id="txt_edit_end_date" class="input-sm form-control" name="end" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flagpoint" class="col-sm-4 control-label">จุดนัด</label>
                            <div class="col-sm-8">
                              <input id="edit_flagpoint" type="text" class="form-control" placeholder="จุดนัด">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reserve_by" class="col-sm-4 control-label">ผู้ประสานงานขอใช้รถ</label>
                            <div class="col-sm-8">
                              <input id="edit_reserve_by" type="text" class="form-control" placeholder="ผู้ประสานงานขอใช้รถ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_detail" class="col-sm-4 control-label">รายละเอียด</label>
                            <div class="col-sm-8">
                                <textarea id="edit_txt_detail" rows="3" class="form-control" placeholder="รายละเอียด"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Delete Task</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="inviteRequest">Save Setting</button>-->
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-danger" data-toggle="confirmation" id="btnDelTask">Delete Task</button>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="inviteRequest">Save Setting</button>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section("scripts")
<?php
/*
    <!--[[ HTML::script('assets/vendor/requirejs/require.js',['data-main' => URL::asset('assets/js/dashboard.js')]) ]]-->
    <!--
    [[ HTML::script('assets/vendor/yepnope/dist/yepnope-2.0.0.min.js') ]]
    <script>
        yepnope('assets/vendor/jquery/dist/jquery.js');
        yepnope('assets/vendor/underscore-amd/underscore.js');
        yepnope('assets/vendor/backbone-amd/backbone.js');

        yepnope({
            test: window._,
            nope: 'assets/vendor/underscore-amd/underscore.js',
            complete: function () {
              //var data = window.JSON.parse('{ "json" : "string" }');
            }
        });
        yepnope('assets/vendor/backbone-amd/backbone.js');
    </script>
    -->

    <!--
    [[ HTML::script('assets/vendor/labjs/LAB.js') ]]
    <script>
        $LAB
        //.script("assets/vendor/jquery/dist/jquery.js").wait()
        .script("assets/vendor/underscore-amd/underscore.js").wait()
        .script("assets/vendor/backbone-amd/backbone.js")
        .wait(function(){
        });
    </script>
    -->
*/
?>
    <script type="text/ng-template" id="filter-type1-template">
      <div class="form-group">
          <label for="txt_filter_year" class="col-sm-4 control-label">ปี</label>
          <div class="col-sm-8">
              <select id="txt_filter_year" ng-model="filter.year" class="span2 form-control" required>
                  <option ng-repeat="year in [] | years" value="{[{ year }]}">{[{ year }]}</option>
              </select>
          </div>
      </div>
      <div class="form-group">
          <label for="txt_filter_month" class="col-sm-4 control-label">เดือน</label>
          <div class="col-sm-8">
              <select id="txt_filter_month" ng-model="filter.month" class="span2 form-control" required>
                  <option value="0">ทุกเดือน</option>
                  <option value="1">มกราคม</option>
                  <option value="2">กุมภาพันธ์</option>
                  <option value="3">มีนาคม</option>
                  <option value="4">เมษายน</option>
                  <option value="5">พฤษภาคม</option>
                  <option value="6">มิถุนายน</option>
                  <option value="7">กรกฎาคม</option>
                  <option value="8">สิงหาคม</option>
                  <option value="9">กันยายน</option>
                  <option value="10">ตุลาคม</option>
                  <option value="11">พฤศจิกายน</option>
                  <option value="12">ธันวาคม</option>
              </select>
          </div>
      </div>
    </script>

    <script type="text/ng-template" id="filter-type2-template">
      <div class="form-group">
          <label for="txt_filter_driver" class="col-sm-4 control-label">คนขับรถ</label>
          <div class="col-sm-8">
              <select id="txt_filter_driver" ng-model="filter.driver" class="span2 form-control" ng-options="driver.name for driver in driverList track by driver.id" required>
                <option value="">---Please select---</option>
              </select>
          </div>
      </div>
      <div class="form-group">
          <label for="txt_filter_year" class="col-sm-4 control-label">ปี</label>
          <div class="col-sm-8">
          <select id="txt_filter_year" ng-model="filter.year" class="span2 form-control" required>
              <option ng-repeat="year in [] | years" value="{[{ year }]}">{[{ year }]}</option>
          </select>
          </div>
      </div>
      <div class="form-group">
          <label for="txt_filter_month" class="col-sm-4 control-label">เดือน</label>
          <div class="col-sm-8">
              <select id="txt_filter_month" ng-model="filter.month" class="span2 form-control" required>
                  <option value="0">ทุกเดือน</option>
                  <option value="1">มกราคม</option>
                  <option value="2">กุมภาพันธ์</option>
                  <option value="3">มีนาคม</option>
                  <option value="4">เมษายน</option>
                  <option value="5">พฤษภาคม</option>
                  <option value="6">มิถุนายน</option>
                  <option value="7">กรกฎาคม</option>
                  <option value="8">สิงหาคม</option>
                  <option value="9">กันยายน</option>
                  <option value="10">ตุลาคม</option>
                  <option value="11">พฤศจิกายน</option>
                  <option value="12">ธันวาคม</option>
              </select>
          </div>
      </div>
    </script>

    <script type="text/ng-template" id="report-waiting-template">
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1>กำลังสร้างรายงาน กรุณารอสักครู่</h1></div>
      </div>
    </script>

    <script type="text/ng-template" id="report-type1-template">
      <div class="row">
        <div ng-if="filter.month == 0" class="col-xs-12 col-sm-12 col-md-12 text-center">
          รายงานปี {[{filter.year}]}
        </div>
        <div ng-if="filter.month != 0" class="col-xs-12 col-sm-12 col-md-12 text-center">
          รายงานเดือน {[{filter.month}]} ปี {[{filter.year}]}
        </div>
      </div>
      <table id="table" class="col-xs-12 col-sm-12 col-md-12 table">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true" data-halign="center" class="col-xs-6 col-sm-4">ชื่อ-สกุล</th>
            <th data-field="count" data-sortable="true" data-halign="center" data-align="center" class="col-xs-6 col-sm-4">จำนวนวันที่ปฏิบัติหน้าที่</th>
        </tr>
        </thead>
      </table>
    </script>

    <script type="text/ng-template" id="report-type2-template">
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1>รายงานประจำเดือน </h1></div>
      </div>
      <table id="table" class="col-xs-12 col-sm-12 col-md-12 table">
          <thead>
          <tr>
              <th data-field="name" data-sortable="true" data-halign="center" class="col-xs-2 col-sm-2">ชื่อ-สกุล</th>
              <th data-field="car" data-sortable="true" data-halign="center" data-align="center" class="col-xs-2 col-sm-2">เลขทะเบียนรถ</th>
              <th data-field="start_date" data-sortable="true" data-halign="center" data-align="center" data-formatter="reportDateFormatter" class="col-xs-2 col-sm-2">วันที่ออกเดินทาง</th>
              <th data-field="end_date" data-sortable="true" data-halign="center" data-align="center" data-formatter="reportDateFormatter" class="col-xs-2 col-sm-2">วันที่เดินทางกลับ</th>
              <th data-field="num_date" data-sortable="true" data-halign="center" data-align="center" class="col-xs-2 col-sm-2">จำนวน(วัน)</th>
              <th data-field="reserve_by" data-sortable="true" data-halign="center" data-align="center" class="col-xs-2 col-sm-2">ผู้ติดต่อขอใช้รถ</th>
          </tr>
          </thead>
      </table>
    </script>


    <script type="text/javascript" src="assets/vendor/angular/angular.min.js"></script>
    <script type="text/javascript">
        head.load("assets/vendor/jquery/dist/jquery.min.js",
                  "assets/vendor/bootstrap/dist/js/bootstrap.min.js",
                  //"assets/vendor/angular/angular.min.js",
                  "assets/libs/jfunk-0.0.1.js",
                  "assets/libs/bootbox.min.js");

        //bootstrap-table
        head.load("assets/vendor/bootstrap-table/dist/bootstrap-table.min.css",
                  "assets/vendor/bootstrap-table/dist/bootstrap-table.min.js");

        //eternicode-bootstrap-datepicker
        head.load("assets/libs/eternicode-bootstrap-datepicker/css/datepicker3.css",
                  "assets/libs/eternicode-bootstrap-datepicker/js/bootstrap-datepicker.js",
                  "assets/libs/eternicode-bootstrap-datepicker/js/locales/bootstrap-datepicker.th.js");
    </script>

    <script>
      var mainApp = angular.module("mainApp", []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
      });
      /*
      myModule.config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('{[{');
        $interpolateProvider.endSymbol('}]}');
      });*/

      /*mainApp.config(['$routeProvider',
        function($routeProvider) {
          $routeProvider.
              when('/addStudent', {
                templateUrl: 'one.html',
                controller: 'AddStudentController'
              }).
              when('/viewStudents', {
                templateUrl: 'one.html',
                controller: 'ViewStudentsController'
              }).
              otherwise({
                redirectTo: '/addStudent'
              });
          }]);*/
          mainApp.filter('years', function() {
            return function(input) {
              var yearStart   = 2012;
              var yearEnd     = <?php echo date("Y");?>;
              var years       = [];
              for(; yearEnd >= yearStart; yearEnd--)
                  years.push(yearEnd);
              return years;
            };
          });

          mainApp.service('myService', function() {
              this.getOptions = function() {
                  return [{name:'entry1', value:0},
                          {name:'entry2', value:1}];
              };
          });

          mainApp.factory('reportService', function() {
            return {
              genReport : function() {

              }
            };
          });

          mainApp.controller('ReportCtrl', function($scope, $http ) {
            //$scope.message = "This page will be used to display add student form";
            $scope.filter = {
              reportType: "1",
              year: "<?php echo date("Y");?>",
              month: "0"
            };
            //$scope.filter.reportType = "1";
            $scope.displayFilter = 'filter-type1-template';

            $scope.changeReportType = function() {
              if($scope.filter.reportType === "1") $scope.displayFilter = 'filter-type1-template';
              else if($scope.filter.reportType === "2"){
                $http.get('api/report/drivers').then(function(response) {
                  $scope.driverList = response.data.datas;
                  $scope.formfilter = {
                    //driver : $scope.driverList[0]
                  }

                  $scope.displayFilter = 'filter-type2-template';

                  }, function(response) {
                    $scope.datas = response.datas || "Request failed";
                    $scope.status = response.status;
                  }
                );
                //$scope.displayFilter = 'filter-type2-template';
              }else if($scope.filter.reportType === "3"){
                $scope.displayFilter = 'filter-type3-template';
              }
            };

            $scope.getFilter = function(){
               /*var reportType  = $("#txt_report_type").val();
               var filter      = { "type": reportType ,"_token": $('meta[name="csrf-token"]').attr('content')};
               alert(reportType);
               if(reportType === "1"){
                 filter.year     = $("#txt_filter_year").val();
                 filter.month    = $("#txt_filter_month").val();

               }else if(reportType === "2"){
                 filter.year     = $("#txt_filter_year").val();
                 filter.month    = $("#txt_filter_month").val();
                 filter.driver   = $("#txt_filter_driver").val();
               }*/

               //var reportType  = $scope.filter.reportType;
               if($scope.filter.reportType === "1"){
                 var filter = {
                   "type": $scope.filter.reportType,
                   "month": $scope.filter.month,
                   "year": $scope.filter.year,
                   "_token": $('meta[name="csrf-token"]').attr('content')
                 };
               }else if($scope.filter.reportType === "2"){
                 var filter = {
                   "type": $scope.filter.reportType,
                   "driver": $scope.filter.driver.id,
                   "month": $scope.filter.month,
                   "year": $scope.filter.year,
                   "_token": $('meta[name="csrf-token"]').attr('content')
                 };
               }

               return filter;
            };

            /*$scope.$on('$viewContentLoaded', function(event) {
              $scope.callGenReport();
            });*/

            $scope.callGenReport = function(){
              if($) $("#filterModal").modal('hide');
              //waitToGenReport($scope);

              var filter = $scope.getFilter();
              //$scope.reportDisplay = "report-type1-template";
              $scope.genReport($scope, filter);
            };

            $scope.genReport = function($scope, filter){
             if(filter.type === "1"){
                 $scope.reportDisplay = "report-type1-template";

             }else if(filter.type === "2"){
                 $scope.reportDisplay = "report-type2-template";

             }

             $.post("api/report/report-result", filter)
                 .done(function( data ) {
                     if(filter.type === "1"){//console.log(filter.type+"-"+filter.month+"-"+ filter.year);
                         $scope.genReportType1(data, filter.month, filter.year);

                     }else if(filter.type === "2"){
                         $scope.genReportType2(data);

                     }
                 });
            };

            $scope.genReportType1 = function(data, month, year){
             month = ($("#txt_filter_month").val()==="0")? 0 : $("#txt_filter_month  option:selected").text();

             var datas       = data.datas;
             var cleanData   = [];


             $.each(datas.drivers, function(i1, driver) {
                 var count   = 0;
                 $.each(datas.drivercount, function(i2, drivercount) {
                     if (drivercount.driver === driver.id) { count += parseInt(drivercount.total); }
                 });
                 cleanData.push({name: driver.name, count: count});
             });

             $("#table").bootstrapTable('destroy');
             $("#table").bootstrapTable({
                 data: cleanData
             });
             //console.log(cleanData);
            };

            $scope.genReportType2 = function(data){

             var datas       = data.datas;
             var cleanData   = [];
             $.each(datas.tasks, function(i, task) {
                 var driver  = jF("> *[id="+ task.driver +"]", datas.drivers).get();
                 var car     = jF("> *[id="+ task.car +"]", datas.cars).get();

                 cleanData.push({name: driver[0].name, car: car[0].plate_number , start_date: task.start_date, end_date: task.end_date, num_date: task.num_date, reserve_by: task.reserve_by});
             });

             $("#table").bootstrapTable('destroy');
             $("#table").bootstrapTable({
                 data: cleanData
             });
            }
            //var filter = getFilter();
            //genReport($scope, filter);

          });

          mainApp.controller('ViewStudentsController', function($scope) {
             $scope.message = "This page will be used to display all the students";
          });

          /*angular.element(document).ready(function() {
            angular.bootstrap(document, ['mainApp']);
            //angular.element('#ReportCtrl').scope().callGenReport();
          });*/
          head.ready("bootstrap.min.js", function () {
            $(document).ready(function(){
              angular.element($('#ReportCtrl')).scope().callGenReport();
            });
          });
    </script>

    <script type="text/javascript">
      /*  head.ready("jquery.min.js", function () {
          function getFilter(){
              var reportType  = $("#txt_report_type").val();
              var filter      = { "type": reportType ,"_token": $('meta[name="csrf-token"]').attr('content')};

              if(reportType === "1"){
                filter.year     = $("#txt_filter_year").val();
                filter.month    = $("#txt_filter_month").val();

              }else if(reportType === "2"){
                filter.year     = $("#txt_filter_year").val();
                filter.month    = $("#txt_filter_month").val();
                filter.driver   = $("#txt_filter_driver").val();
              }
              return filter;
          }

          function waitToGenReport($scope){
            $scope.reportDisplay = "report-waiting-template";
          }

          function genReport($scope, filter){
            if(filter.type === "1"){
                $scope.reportDisplay = "report-type1-template";

            }else if(filter.type === "2"){
                $scope.reportDisplay = "report-type2-template";

            }

            $.post("api/report/report-result", filter)
                .done(function( data ) {
                    if(filter.type === "1"){//console.log(filter.type+"-"+filter.month+"-"+ filter.year);
                        genReportType1(data, filter.month, filter.year);

                    }else if(filter.type === "2"){
                        genReportType2(data);

                    }
                });
          }

          function genReportType1(data, month, year){
            month = ($("#txt_filter_month").val()==="0")? 0 : $("#txt_filter_month  option:selected").text();

            var datas       = data.datas;
            var cleanData   = [];


            $.each(datas.drivers, function(i1, driver) {
                var count   = 0;
                $.each(datas.drivercount, function(i2, drivercount) {
                    if (drivercount.driver === driver.id) { count += parseInt(drivercount.total); }
                });
                cleanData.push({name: driver.name, count: count});
            });

            $("#table").bootstrapTable('destroy');
            $("#table").bootstrapTable({
                data: cleanData
            });
            //console.log(cleanData);
          }

          function genReportType2(data){

            var datas       = data.datas;
            var cleanData   = [];
            $.each(datas.tasks, function(i, task) {
                var driver  = jF("> *[id="+ task.driver +"]", datas.drivers).get();
                var car     = jF("> *[id="+ task.car +"]", datas.cars).get();

                cleanData.push({name: driver[0].name, car: car[0].plate_number , start_date: task.start_date, end_date: task.end_date, num_date: task.num_date, reserve_by: task.reserve_by});
            });

            $("#table").bootstrapTable('destroy');
            $("#table").bootstrapTable({
                data: cleanData
            });
          }

          function reportDateFormatter(value){
            var datas   = value.split("-");
            return datas[2]+'/'+datas[1]+'/'+datas[0];
          }

          function setMainPageInfo(data){
            jdata = data;//$.parseJSON(data);

            var objDriver;
            var objTask;
            var currentDriver = 0;
            // ------------ bootstrap_calendar_monthly ----------------------
            //###############################################################################
            theMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            theData = [];
            $.each( jdata.cars, function( key, car ) {
              //console.log("defauledriver = "+car.default_driver);
              //console.log("car id = "+car.id);
              objDriver = jF("> drivers > *[id="+ car.default_driver +"]", jdata).get();
              objTask = jF("> monthlyTask > *[car="+ car.id +"]", jdata).get();

              var objCountCar     = jF("> countCars > *[car="+ car.id +"]", jdata).get();
              var objCountDriver  = jF("> countDrivers > *[driver="+ objDriver[0].id +"]", jdata).get();
              var carNum          = ((objCountCar.length !== 0)?   objCountCar[0].total : "0");
              var driverNum       = ((objCountDriver.length !== 0)?objCountDriver[0].total : "0");


              // gen class
              var classStyle = "";
              var class1 = "DRIVER_" + car.default_driver + "_COLOR";
              var color1 = jF("> *[name="+ class1 +"]", systemConfig).get();
              if(color1.length !== 0){
                  classStyle += "." + class1 + "{" + "background-color:"+ color1[0].value + ";" + "}";
              }else{
                  class1 = "label-info";
              }
              $("#globlestyle").append(classStyle);


              var tmpCarRec = {
                "name": (currentDriver !== objDriver[0].id)? objDriver[0].name : "",
                "countDriver": driverNum,
                "car" : car.plate_number,
                "countCar": carNum,
                "dates":[]
              };

              $.each(objTask, function(i, rec){
                var from = new Date(rec.start_date);
                var to   = new Date(rec.end_date);

                tmpCarRec.dates.push({
                  "start":(from.getMonth() + 1) + '/' + from.getDate() + '/' + from.getFullYear(),
                  "end":  (to.getMonth() + 1) + '/' + to.getDate() + '/' + to.getFullYear(),
                  //"start_half": true,
                  //"end_half": true,
                  "action": "javascript:openEditTask("+ rec.id +");",
                  "class": class1,
                  "tooltip": '['+ rec.id +'] '+ from.getDate() +'/'+ (from.getMonth()+1) +'/'+ from.getFullYear() + " - " + to.getDate() + '/' + (to.getMonth()+1) +'/'+ to.getFullYear()
                });
              });

              theData.push(tmpCarRec);

              if(currentDriver !== objDriver[0].id)
                  currentDriver = objDriver[0].id;

            });

            cal = $('.monthly_calendar').mcalendar({
                    onths: theMonths,
                    freedays: true,
                    data: theData,
                    busyclass: "label-info"
            });

            //set chooser
            setCarList(jdata.cars);
            setDriverList(jdata.drivers);
            setNumDate(30);
          }

          function setCarList(data){
            $('#txt_car_picker, #txt_edit_car_picker').empty();

            $.each( data, function( key, value ) {
                $('#txt_car_picker, #txt_edit_car_picker').append('<option value="'+ value.id +'">'+ value.plate_number +'</option>');
            });
          }

          function setDriverList(data){
            $('#txt_driver_picker, #txt_edit_driver_picker').empty();

            $.each( data, function( key, value ) {
                $('#txt_driver_picker, #txt_edit_driver_picker').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            });
          }

          function setNumDate(num){
            for(var i=0; i<num; i++){
              $("#num_date").append('<option value="'+ (i+1) +'">'+ (i+1) +' วัน</option>')
            }
          }

          function addTask(callBackFn){
            var car = $('#txt_car_picker').val();
            var driver = $('#txt_driver_picker').val();

            var arr1 = $('#txt_start_date').val().split("/");
            var txtStartDate = arr1[2]+"-"+arr1[1]+"-"+arr1[0];
            var startDate = new Date(txtStartDate);

            var arr2 = $('#txt_end_date').val().split("/");
            var txtEndDate = arr2[2]+"-"+arr2[1]+"-"+arr2[0];
            var endDate = new Date(txtEndDate);

            var numDate = DateDiff( endDate, startDate)+1;
            var reserve_by = $("#reserve_by").val();
            var detail = $("#txt_detail").val();
            var user = jF("> *[name=USER_NAME]", systemConfig).get()[0].value;
            //console.log("-"+user);
            //console.log("DateDiff-"+numDate);

            var sendData = { car: car, driver: driver, startDate: txtStartDate, endDate: txtEndDate, numDate: numDate, reserve_by: reserve_by, user: user, detail: detail };

            $.post("api/task/add-task", sendData)
                .done(function( data ) {
                    if(data.error == false){
                        callBackFn();
                    }else if(data.error == true){
                        alert("Add task fail, Please check date reserv date.");
                    }else{
                        alert("error : "+data);
                    }
            });
          }

          function openEditTask(taskId){
            //get task detail
            $.post("api/task/task-detail", {taskId : taskId})
                .done(function( data ) {
                    var jTaskData = data.datas;

                    //set Edit ID
                    $("#txt_edit_id").val(jTaskData.id);
                    $("#txt_edit_car_picker").val(jTaskData.car);
                    $("#txt_edit_driver_picker").val(jTaskData.driver);
                    var arr1 = jTaskData.start_date.split("-");
                    $("#txt_edit_start_date").val(arr1[2]+"/"+arr1[1]+"/"+arr1[0]);
                    var arr2 = jTaskData.end_date.split("-");
                    $("#txt_edit_end_date").val(arr2[2]+"/"+arr2[1]+"/"+arr2[0]);
                    $("#edit_flagpoint").val(jTaskData.flagpoint);
                    $("#edit_reserve_by").val(jTaskData.reserve_by);
                    $("#edit_txt_detail").val(jTaskData.detail);

                    $('#editModal').modal('show');
            });
          }

            function submitEditTask(callBackFn){

              var taskId      = $("#txt_edit_id").val();
              var car         = $('#txt_edit_car_picker').val();
              var driver      = $('#txt_edit_driver_picker').val();

              var arr1        = $('#txt_edit_start_date').val().split("/");
              var txtStartDate = arr1[2]+"-"+arr1[1]+"-"+arr1[0];
              var startDate   = new Date(txtStartDate);

              var arr2        = $('#txt_edit_end_date').val().split("/");
              var txtEndDate  = arr2[2]+"-"+arr2[1]+"-"+arr2[0];
              var endDate     = new Date(txtEndDate);

              var numDate     = DateDiff( endDate, startDate)+1;
              var reserve_by  = $("#edit_reserve_by").val();
              var detail      = $("#edit_txt_detail").val();
              var user        = jF("> *[name=USER_NAME]", systemConfig).get()[0].value;

              var sendData = { taskId : taskId, car: car, driver: driver, startDate: txtStartDate, endDate: txtEndDate, numDate: numDate, reserve_by: reserve_by, user: user, detail: detail };

              $.post("api/task/update-task", sendData)
                  .done(function( data ) {
                      if(data.error === false){
                          callBackFn();
                          alert("edit complete.");

                          $('#editModal').modal('hide');

                      }else if(data.error === true){
                          //alert("Update task fail,\n"+data.msg);
                          alert("Update task fail,\nPls check data for update.");

                      }else{
                          alert("error : "+data);

                      }
              });
            }

            function delTask(taskid, callBackFn){
              $.post("api/task/delete-task", {taskId : taskid}).done(callBackFn);
            }

            //Util
            function DateDiff(date1, date2) {
                var datediff = date1.getTime() - date2.getTime();
                //store the getTime diff - or +
                return (datediff / (24 * 60 * 60 * 1000));
                //Convert values to -/+ days and return value
            }
        });*/
    </script>
@stop
