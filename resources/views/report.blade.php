@extends("layouts.dashboard.main")

@section("navbar")
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> -->
                    <a class="navbar-brand" href="#">ตารางการใช้รถยนต์ส่วนกลางของมหาวิทยาลัยราชภัฏเพชรบูรณ์</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
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
                        <li> <a href="manage"><span class="glyphicon glyphicon-tasks icon-tasks"></span> Manage Item</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li data-toggle="modal" data-target="#settingModal"> <a href="javascript:void(0);"><span class="glyphicon glyphicon-wrench"></span> Config</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
@stop

@section("content")
    <div class="page-header"></div>

    <div id="reportDisplay"></div>

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
                                <select id="txt_report_type" class="span2 form-control" required>
                                    <option value="1">สรุปรวม</option>
                                    <option value="2">รายการ</option>
                                </select>
                            </div>
                        </div>
                        <div id="displayFilter"></div>
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
                    <button type="button" class="btn btn-primary" id="btnGenReport">Generate Report</button>
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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" ng-controller="EditFormCtrl">
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

    <script type="text/template" id="report-waiting-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1>กำลังสร้างรายงาน กรุณารอสักครู่</h1></div>
    </div>
    </script>

    <script type="text/template" id="report-type1-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <% if (month=="0") { %>
            <h1>รายงานปี <%= year %></h1>
            <% }else{ %>
            <h1>รายงานเดือน<%= month %> <%= year %></h1>
            <% } %>
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

    <script type="text/template" id="report-type2-template">
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



    <script type="text/template" id="report-type1-template-v1">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1>รายงานเดือน </h1></div>
    </div>
    <table class="col-xs-12 col-sm-12 col-md-12 table">
      <thead>
        <tr>
          <th class="col-xs-6 col-sm-4">ชื่อ-สกุล</th>
          <th class="col-xs-6 col-sm-4">จำนวนวันที่ปฏิบัติหน้าที่</th>
          <!--<th class="col-xs-6 col-sm-4">Favorite Color</th>-->
        </tr>
      </thead>
      <tbody>
        <% _.each(datas.drivers, function(driver) { %>
          <tr>
            <td><%= driver.name %></td>
            <% var count = 0; %>
            <% _.each(datas.drivercount, function(drivercount) { %>
                <% if (drivercount.driver == driver.id) { count += parseInt(drivercount.total); } %>
            <% }); %>
            <td><%= count %></td>
            <!--<td><%= driver.favoriteColor %></td>-->
          </tr>
        <% }); %>
      </tbody>
    </table>
    </script>

    <script type="text/template" id="report-type2-template-v1">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1>รายงานประจำเดือน </h1></div>
    </div>
    <table  class="col-xs-12 col-sm-12 col-md-12 table">
      <thead>
        <tr>
          <th class="col-xs-6 col-sm-4">ชื่อ-สกุล</th>
          <th class="col-xs-6 col-sm-4" data-halign="center">จำนวนวันที่ปฏิบัติหน้าที่</th>
          <!--<th class="col-xs-6 col-sm-4">Favorite Color</th>-->
        </tr>
      </thead>
      <tbody>
        <% _.each(datas.drivers, function(driver) { %>
          <tr>
            <td><%= driver.name %></td>
            <% var count = 0; %>
            <% _.each(datas.drivercount, function(drivercount) { %>
                <% if (drivercount.driver == driver.id) { count += parseInt(drivercount.total); } %>
            <% }); %>
            <td><%= count %></td>
            <!--<td><%= driver.favoriteColor %></td>-->
          </tr>
        <% }); %>
      </tbody>
    </table>
    </script>

    <script type="text/javascript">
        head.load("assets/vendor/jquery/dist/jquery.min.js",
                  "assets/vendor/bootstrap/dist/js/bootstrap.min.js",
                  "assets/vendor/underscore-amd/underscore-min.js",
                  "assets/vendor/backbone-amd/backbone-min.js",
                  "assets/libs/jfunk-0.0.1.js",
                  "assets/libs/bootbox.min.js");

        //bootstrap-table
        head.load("assets/vendor/bootstrap-table/dist/bootstrap-table.min.css",
                  "assets/vendor/bootstrap-table/dist/bootstrap-table.min.js");

        //bootstrap_monthly_calendar
       /* head.load("assets/libs/bootstrap_monthly_calendar/js/bootstrap_monthly_calendar.js",
                  "assets/libs/bootstrap_monthly_calendar/css/bootstrap_monthly_calendar.css");
        */
        //eternicode-bootstrap-datepicker
        head.load("assets/libs/eternicode-bootstrap-datepicker/css/datepicker3.css",
                  "assets/libs/eternicode-bootstrap-datepicker/js/bootstrap-datepicker.js",
                  "assets/libs/eternicode-bootstrap-datepicker/js/locales/bootstrap-datepicker.th.js");
    </script>

    <script type="text/javascript">
        head.ready("jquery.min.js", function () {
            /*$('#btnAddTask').click(function(){
                console.log("add task");
                $('#addTaskModal').modal('hide');

                addTask(function(){location.reload();});
            });

            $('#saveEdit').click(function(){
                console.log("edit task");
                //$('#editModal').modal('hide');

                //addTask(function(){location.reload();});
                var taskid = $("#txt_edit_id").val();
                console.log("Update task id : " + taskid);

                submitEditTask( function(){});
            });

            $('#btnDelTask').click(function(){
                $('#editModal').modal('hide');
                bootbox.confirm("Are you sure?", function(result) {
                    if(result){
                        var taskid = $("#txt_edit_id").val();
                        console.log("del task id : " + taskid);

                        delTask(taskid, function(){location.reload();});
                    }
                });
            });

            $('#txt_car_picker').change(function() {
                var driver = jF("> cars > *[id="+ $(this).val() +"]", jdata).get();
                $('#txt_driver_picker').val(driver[0].default_driver);
            });

            //======== Start =========
            var nowDate = "<?php echo date("Y")."-".date("m")."-".date("d") ?>";


            $.post("api/dashboard/dashboard-config", { "date": nowDate })
                .done(function( data ) {
                    systemConfig = data.datas;

                    $.post("api/dashboard/dashboard-data", { "date": nowDate })
                        .done(function( data ) {
                            //alert( "Data Loaded: " + data );
                            setMainPageInfo(data.datas);
                        });
                });*/

            $('#txt_report_type').change(function() {
                var yearStart   = 2012;
                var yearEnd     = <?php echo date("Y") ?>;
                var years       = [];
                for(; yearEnd>=yearStart; yearEnd--){
                    years.push(yearEnd);
                }

                if($(this).val()==="1"){
                    var html = '\
                        <div class="form-group">\n\
                            <label for="txt_filter_year" class="col-sm-4 control-label">ปี</label>\n\
                            <div class="col-sm-8">\n\
                                <select id="txt_filter_year" class="span2 form-control" required>\n\
                                    <% _.each(years, function(year) { %>\n\
                                    <option value="<%= year %>"><%= year %></option>\n\
                                    <%});%>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group">\n\
                            <label for="txt_filter_month" class="col-sm-4 control-label">เดือน</label>\n\
                            <div class="col-sm-8">\n\
                                <select id="txt_filter_month" class="span2 form-control" required>\n\
                                    <option value="0">ทุกเดือน</option>\n\
                                    <option value="1">มกราคม</option>\n\
                                    <option value="2">กุมภาพันธ์</option>\n\
                                    <option value="3">มีนาคม</option>\n\
                                    <option value="4">เมษายน</option>\n\
                                    <option value="5">พฤษภาคม</option>\n\
                                    <option value="6">มิถุนายน</option>\n\
                                    <option value="7">กรกฎาคม</option>\n\
                                    <option value="8">สิงหาคม</option>\n\
                                    <option value="9">กันยายน</option>\n\
                                    <option value="10">ตุลาคม</option>\n\
                                    <option value="11">พฤศจิกายน</option>\n\
                                    <option value="12">ธันวาคม</option>\n\
                                </select>\n\
                            </div>\n\
                        </div>';
                    var template = _.template(html, {years:years});
                    $("#displayFilter").html(template);
                    $("#txt_filter_month").val(<?php echo date("m") ?>);

                }else if($(this).val()==="2"){

                    var drivers = [];
                    $.ajax({url: "api/report/drivers", async: false})
                    .done(function(data){
                        drivers = data.datas;
                    });

                    var html = '\
                        <div class="form-group">\n\
                            <label for="txt_filter_driver" class="col-sm-4 control-label">คนขับรถ</label>\n\
                            <div class="col-sm-8">\n\
                                <select id="txt_filter_driver" class="span2 form-control" required>\n\
                                    <option value="0">ทุกคน</option>\n\\n\
                                    <% _.each(drivers, function(driver) { %>\n\
                                    <option value="<%= driver.id %>"><%= driver.name %></option>\n\
                                    <%});%>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group">\n\
                            <label for="txt_filter_year" class="col-sm-4 control-label">ปี</label>\n\
                            <div class="col-sm-8">\n\
                                <select id="txt_filter_year" class="span2 form-control" required>\n\
                                    <% _.each(years, function(year) { %>\n\
                                    <option value="<%= year %>"><%= year %></option>\n\
                                    <%});%>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group">\n\
                            <label for="txt_filter_month" class="col-sm-4 control-label">เดือน</label>\n\
                            <div class="col-sm-8">\n\
                                <select id="txt_filter_month" class="span2 form-control" required>\n\
                                    <option value="0">ทุกเดือน</option>\n\
                                    <option value="1">มกราคม</option>\n\
                                    <option value="2">กุมภาพันธ์</option>\n\
                                    <option value="3">มีนาคม</option>\n\
                                    <option value="4">เมษายน</option>\n\
                                    <option value="5">พฤษภาคม</option>\n\
                                    <option value="6">มิถุนายน</option>\n\
                                    <option value="7">กรกฎาคม</option>\n\
                                    <option value="8">สิงหาคม</option>\n\
                                    <option value="9">กันยายน</option>\n\
                                    <option value="10">ตุลาคม</option>\n\
                                    <option value="11">พฤศจิกายน</option>\n\
                                    <option value="12">ธันวาคม</option>\n\
                                </select>\n\
                            </div>\n\
                        </div>';
                    var template = _.template(html, {years:years, drivers:drivers});
                    $("#displayFilter").html(template);
                    $("#txt_filter_month").val(<?php echo date("m") ?>);

                }else if($(this).val()==="3"){

                }
            });

            $('#btnGenReport').click(function(){
                $("#filterModal").modal('hide');
                waitToGenReport();

                var filter = getFilter();
                genReport(filter);
            });
        });

        head.ready("underscore-min.js", function () {
            $('#txt_report_type').change();

            //var nowDate = "<?php echo date("Y")."-".date("m")."-".date("d") ?>";
            var filter = getFilter();

            genReport(filter);
        });

        function waitToGenReport(){
            var template = _.template($('#report-waiting-template').html());
            $("#reportDisplay").html(template);
        }

        function genReport(filter){
            $.post("api/report/report-result", filter)
                .done(function( data ) {
                    if(filter.type === "1"){
                        genReportType1(data, filter.month, filter.year);

                    }else if(filter.type === "2"){
                        genReportType2(data);

                    }
                });
        }

        function genReportType1(data, month, year){
            //var datas    = data.datas;
            //var template = _.template($('#report-type1-template').html(), {datas: datas});
            month = ($("#txt_filter_month").val()==="0")? 0 : $("#txt_filter_month  option:selected").text();
            var template = _.template($('#report-type1-template').html(), {month: month, year: year});
            $("#reportDisplay").html(template);

            var datas       = data.datas;
            var cleanData   = [];
            _.each(datas.drivers, function(driver) {
                var count   = 0;
                _.each(datas.drivercount, function(drivercount) {
                    if (drivercount.driver === driver.id) { count += parseInt(drivercount.total); }
                });

                cleanData.push({name: driver.name, count: count});
            });

            $("#table").bootstrapTable({
                data: cleanData
            });
        }

        function genReportType2(data){
            /*var datas    = data.datas;
            var template = _.template($('#report-type2-template').html(), {datas: datas});*/
            var template = _.template($('#report-type2-template').html());
            $("#reportDisplay").html(template);

            var datas       = data.datas;
            var cleanData   = [];
            _.each(datas.tasks, function(task) {
                /*var count   = 0;
                _.each(datas.drivercount, function(drivercount) {
                    if (drivercount.driver === driver.id) { count += parseInt(drivercount.total); }
                });*/
                var driver  = jF("> *[id="+ task.driver +"]", datas.drivers).get();
                var car     = jF("> *[id="+ task.car +"]", datas.cars).get();

                cleanData.push({name: driver[0].name, car: car[0].plate_number , start_date: task.start_date, end_date: task.end_date, num_date: task.num_date, reserve_by: task.reserve_by});
            });

            $("#table").bootstrapTable({
                data: cleanData
            });
        }

        function reportDateFormatter(value){
            var datas   = value.split("-");
            return datas[2]+'/'+datas[1]+'/'+datas[0];
        }

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
                        //to.setDate(from.getDate() + (parseInt(rec.num_date)-1));
                        //alert( (from.getMonth() + 1) + '/' + from.getDate() + '/' + from.getFullYear() + " = "+ (to.getMonth() + 1) + '/' + to.getDate() + '/' + to.getFullYear() );

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
                /*if(cmd == "del"){
                    callSoap("resultTaskDetail", {taskId : taskId}, function(data){
                        var jTaskData = $.parseJSON(data);

                        $('#editModal').modal('hide');
                    });
                }else{
                    //get task detail

                    $.post("api/task/update-task", {taskId : taskId})
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
                        $("#edit_flagpoint").val(jTaskData.reserve_by);
                        $("#edit_detail").val(jTaskData.detail);

                        $('#editModal').modal('hide');
                    });
                }*/
                /*$("#txt_edit_id").val(jTaskData.id);
                $("#txt_edit_car_picker").val(jTaskData.car);
                $("#txt_edit_driver_picker").val(jTaskData.driver);
                var arr1 = jTaskData.start_date.split("-");
                $("#txt_edit_start_date").val(arr1[2]+"/"+arr1[1]+"/"+arr1[0]);
                var arr2 = jTaskData.end_date.split("-");
                $("#txt_edit_end_date").val(arr2[2]+"/"+arr2[1]+"/"+arr2[0]);
                $("#edit_flagpoint").val(jTaskData.reserve_by);
                $("#edit_detail").val(jTaskData.detail);*/

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
    </script>
@stop
