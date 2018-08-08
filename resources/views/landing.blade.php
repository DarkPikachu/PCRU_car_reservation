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
                        <b-col><dashboard-component></dashboard-component></b-col>
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
@endsection