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

                        <b-col>
                            <b-row>
                                <b-col><dashboard-component ref="calendar"></dashboard-component></b-col>
                            </b-row>
                            <b-row>
                                <b-col><tasklist-component></tasklist-component></b-col>
                            </b-row>
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
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    <script >
        var event = [];
    </script>
@endsection