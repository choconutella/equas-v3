@extends('main')

@section('title','Sysmex')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Urin</strong>
                </div>
                <div class="pull-right">
                    <a href="" class="btn btn-success btn-sm">
                        <i class="fa fa-plus">Add</i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table-bordered table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No</th>
                            <th>No</th>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>tes</td>
                            <td>tes</td>
                            <td>tes</td>
                            <td>tes</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- .Animate -->
</div> <!-- .content -->
@endsection
