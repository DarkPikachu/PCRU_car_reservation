
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
				<li> <a href="report"><span class="glyphicon glyphicon-list-alt icon-list-alt"></span> Report </a> </li>
				<li class="active">
						<a href="javascript:void(0);"><span class="glyphicon glyphicon-tasks icon-tasks"></span> Manage Item</a>
				</li>
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
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#drivers" aria-controls="drivers" role="tab" data-toggle="tab">Drivers</a></li>
            <li role="presentation"><a href="#cars" aria-controls="cars" role="tab" data-toggle="tab">Cars</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="drivers">

            </div>
            <div role="tabpanel" class="tab-pane" id="cars">

            </div>
        </div>

    </div>

    <!-- Modal -->
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
    <script type="text/template" id="manage-driver-template">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1></h1><a href="" class="btn btn-success">add new Driver</a></div>
      </div>
      <table  class="col-xs-12 col-sm-12 col-md-12 table">
        <thead>
          <tr>
            <th class="col-xs-6 col-sm-4">ชื่อ-สกุล</th>
            <th class="col-xs-6 col-sm-4" data-halign="center">โทร</th>
            <th class="col-xs-4 col-sm-2">การแสดงสี</th>
            <th class="col-xs-2 col-sm-2">ลบ</th>
           <!--<th class="col-xs-2 col-sm-2">edit</th>-->
          </tr>
        </thead>
        <tbody>
          <% _.each(drivers, function(driver) { %>
          <%
              var obj     = jF("> *[ref="+ driver.id +"]", sys).get();
              var color   = (obj!='')? obj[0].value : '';
          %>
            <tr>
              <td><a href="#" id="drivername" data-type="text" data-pk="<%= driver.id %>" data-url="api/manageitem/update-driver" data-title="Enter name" class="editable editable-click drivername"><%= driver.name %></a></td>
              <td><a href="#" id="drivertel" data-type="text" data-pk="<%= driver.id %>" data-url="api/manageitem/update-driver" data-title="Enter phone number" class="editable editable-click drivertel"><%= driver.tel %></a></td>
              <td><a href="#" id="drivercolor" data-type="color" data-pk="<%= driver.id %>" data-url="api/manageitem/update-driver" data-title="Choose color" data-value="<%= color %>" class="editable editable-click drivercolor"><%= color %></a></td>
              <!--<td><input type="text" id="brightness-demo" class="form-control demo minicolors-input" data-control="brightness" value="<%= color %>" size="7"></td>-->
              <th><button type="button" class="btn btn-default btn-sm" title="Delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Del</button></th>
             <!--<td><button class="btn edit"><i class="glyphicon glyphicon-pencil"></i></button><button class="btn btn-primary hide">save</button></td>-->
            </tr>
          <% }); %>
        </tbody>
      </table>
    </script>

    <script type="text/template" id="manage-car-template">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center"><h1></h1><a href="" class="btn btn-success">add new Car</a></div>
      </div>
      <table class="col-xs-12 col-sm-12 col-md-12 table">
        <thead>
          <tr>
            <th class="col-xs-6 col-sm-4">ทะเบียนรถ</th>
            <th class="col-xs-6 col-sm-4">จำนวนวันที่ปฏิบัติหน้าที่</th>
            <th class="col-xs-2 col-sm-2">ลบ</th>
            <!--<th class="col-xs-6 col-sm-4">Favorite Color</th>-->
          </tr>
        </thead>
        <tbody>
          <% var pk = 1; %>
          <% _.each(cars, function(car) { %>
            <tr>
              <td><a href="#" id="carplate" data-type="text" data-pk="<%= car.id %>" data-url="api/manageitem/update-car" data-title="Enter name" class="editable editable-click carplate"><%= car.plate_number %></a></td>
              <td><a href="#" id="xx" data-type="text" data-pk="<%= car.id %>" data-url="api/manageitem/update-car" data-title="Enter phone number" class="editable editable-click drivertela"><%= car.default_driver %></a></td>
              <th><button type="button" class="btn btn-default btn-sm" title="Delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Del</button></th>
            </tr>
          <% pk++; %>
          <% }); %>
        </tbody>
      </table>
    </script>

    <script type="text/javascript" src="assets/vendor/angular/angular.min.js"></script>
    <script type="text/javascript">
        head.load("assets/vendor/jquery/dist/jquery.min.js",
                  "assets/vendor/bootstrap/dist/js/bootstrap.min.js",
                  "assets/libs/jfunk-0.0.1.js",
                  "assets/libs/bootbox.min.js");

        //eternicode-bootstrap-datepicker
        head.load("assets/libs/eternicode-bootstrap-datepicker/css/datepicker3.css",
                  "assets/libs/eternicode-bootstrap-datepicker/js/bootstrap-datepicker.js",
                  "assets/libs/eternicode-bootstrap-datepicker/js/locales/bootstrap-datepicker.th.js");

        //bootstrap-x-editable
        head.load("assets/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css",
                  "assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js");

        //wysihtml5
        head.load("assets/vendor/minicolors/jquery.minicolors.css",
                  "assets/vendor/minicolors/jquery.minicolors.min.js");

        //bootstrap-x-editable-color-chooser
        head.load("assets/libs/x-editable/dist/inputs-ext/color/color.css",
                  "assets/libs/x-editable/dist/inputs-ext/color/color.js");
    </script>
       <script>
        head.ready("color.js", function () {
            $('#comments').editable({
                url: '/post',
                title: 'Enter comments'
            });
        });
    </script>
    <script type="text/javascript">
        head.ready("jquery.min.js", function () {
        });

        head.ready("underscore-min.js", function () {
            initDatas();
        });

        head.ready("color.js", function () {
          $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
          };
        });

        function initDatas(){
            $.get("api/manageitem/drivers")
                .done(function( data ) {
                    var template = _.template($("#manage-driver-template").html(), { drivers: data.datas.drivers, sys:  data.datas.sys});
                    $("#drivers").html(template);

                    $.fn.editable.defaults.mode = 'inline';
                    $(".drivername").editable();
                    $(".drivertel").editable();
                    $(".drivercolor").editable();

                    $(".minicolors-input").minicolors({
                        control: $(this).attr('data-control') || 'brightness',
                        defaultValue: $(this).attr('data-defaultValue') || '',
                        inline: $(this).attr('data-inline') === 'true',
                        letterCase: $(this).attr('data-letterCase') || 'lowercase',
                        opacity: $(this).attr('data-opacity'),
                        position: $(this).attr('data-position') || 'bottom left',
                        change: function(hex, opacity) {
                            if( !hex ) return;
                            if( opacity ) hex += ', ' + opacity;
                            if( typeof console === 'object' ) {
                                console.log(hex);
                            }
                        },
                        theme: 'bootstrap'
                    });
                });

            $.get("api/manageitem/cars")
                .done(function( data ) {
                    var template = _.template($("#manage-car-template").html(), { cars: data.datas });
                    $("#cars").html(template);

                    $.fn.editable.defaults.mode = 'inline';
                    $(".carplate").editable();
                    $(".drivertel").editable();
                });



        }









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
            var filter      = { "type": reportType };

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
