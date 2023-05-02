@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="title-table-admin">
            <h2>
                Dashboard
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6" id="piechart_3d" style="height: 370px;"></div>
        <div class="col-md-6">
            <div id="top_x_div" style="height: 370px;"></div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12" id="barchart_values" style="height: 950px ;width: 1000px"></div>
    </div>
</div>
@endsection
