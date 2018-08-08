@extends('layouts.main')

@section('title', 'Car Reservation')

@section('content')
    <div id="appVue">
        <b-container fluid>
            <b-row><navbar-component></navbar-component></b-row>
            <b-row>
                <b-container fluid>
                    <b-row>
                        <b-col cols="2"><sidebar-component></sidebar-component></b-col>
                        <b-col><addtask-component></addtask-component></b-col>
                        <b-col>
                            <form >
                                <fieldset>
                                
                                <!-- Form Name -->
                                <legend>บันทึกการขอใช้รถ</legend>
                                
                                <!-- Text input http://getbootstrap.com/css/#forms -->
                                <div class="form-group">
                                  <label for="target" class="control-label">สถานที่ไปราชการ :</label>
                                  
                                    <input type="text" class="form-control" id="target" placeholder="สถานที่ไปราชการ" required="">
                                    
                                  
                                </div>
                                <!-- Button Drop Down http://getbootstrap.com/components/#input-groups-buttons-dropdowns -->
                                <div class="form-group">
                                    <label class="control-label" for="inputwithbuttondropdownInput">จังหวัดที่ไป :</label>

                                    <select class="form-control" id="inputwithbuttondropdownInput">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>

                                </div>
                                <!-- Text input http://getbootstrap.com/css/#forms -->
                                <div class="form-group">
                                  <label for="textinput" class="control-label">ผู้ร่วมเดินทาง :</label>
                                  
                                    <input type="text" class="form-control" id="textinput" placeholder="ผู้ร่วมเดินทาง ">
                                    
                                  
                                </div>
                                <!-- Text input http://getbootstrap.com/css/#forms -->
                                <div class="form-group">
                                  <label for="textinput" class="control-label">สัมภาระ/สิ่งของ :</label>
                                  
                                    <input type="datetime" class="form-control" id="textinput" placeholder="สัมภาระ/สิ่งของ">
                                    
                                  
                                </div>
                                <!-- Text input http://getbootstrap.com/css/#forms -->
                                <div class="form-group">
                                  <label for="textinput" class="control-label">วันที่เดินทางไป :</label>
                                  
                                    <input type="datetime" class="form-control" id="textinput" placeholder="วันที่เดินทางไป">
                                    
                                  
                                </div>
                                <!-- Text input http://getbootstrap.com/css/#forms -->
                                <div class="form-group">
                                  <label for="textinput" class="control-label">วันที่เดินทางกลับ :</label>
                                  
                                    <input type="text" class="form-control" id="textinput" placeholder="วันที่เดินทางกลับ">
                                    
                                  
                                </div>
                                <!-- Text input http://getbootstrap.com/css/#forms -->
                                <div class="form-group">
                                  <label for="textinput" class="control-label">จุดขึ้นรถ :</label>
                                  
                                    <input type="text" class="form-control" id="textinput" placeholder="จุดขึ้นรถ">
                                    
                                  
                                </div>
                                
                                </fieldset>
                                </form>
                                
                                                              
                        </b-col>
                    </b-row>
                    <b-row>
                        
                    </b-row>
                </b-container>
            </b-row>
        </b-container>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/addtask.js') }}" defer></script>
@endsection