@extends('auth.admin-index')

@section('title', 'Tours')

@section('content')

<div class="clearfix">
    <h2 class="pull-left">Tours</h2>

    <a href="{{ route('admin.newTourForm') }}" class="btn btn-primary pull-right mt">
        Add new Tour
    </a>
</div>

<div class="page-header"></div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>sit</td>
            </tr>
            <tr>
                <td>1,002</td>
                <td>amet</td>
                <td>consectetur</td>
                <td>adipiscing</td>
                <td>elit</td>
            </tr>
            <tr>
                <td>1,003</td>
                <td>Integer</td>
                <td>nec</td>
                <td>odio</td>
                <td>Praesent</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection