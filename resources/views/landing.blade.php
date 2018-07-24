@extends('layouts.main')

@section('title', 'กองนโยบายและแผน')

@section('content')
    <div id="appVue">
        <b-container fluid>
            <navbar-component></navbar-component>
        </b-container>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection