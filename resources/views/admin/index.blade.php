@extends('admin.admin')

@section('pageTitle', 'Панель управления')

@section('sidebar')
@include('admin.sidebar.main')
@endsection

@section('content')
<table class="table">
        <caption>
            <div class="table__flex table__flex--caption">
                <h2 class="h2">Панель управления</h2>
        </caption>
    </table>
    @endsection