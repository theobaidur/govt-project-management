@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <div class="container-xl">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h1>{{ $total_department }}</h1>
                    <h4>Departments</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h1>{{ $total_projects }}</h1>
                    <h4>Projects</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h1>{{ $total_employees }}</h1>
                    <h4>Employees</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h1>{{ $total_clients }}</h1>
                    <h4>Clients</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                        <h1>{{ $total_stocks }}</h1>
                        <h4>Stocks</h4>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection