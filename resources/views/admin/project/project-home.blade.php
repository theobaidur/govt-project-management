@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.project.actions.edit', ['name' => $project->name]))

@section('body')

    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            {{ $project->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>{{ trans('admin.project.columns.name') }}</th>
                                <td>{{ $project->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.description') }}</th>
                                <td>
                                        {!! $project->description !!}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.start_date') }}</th>
                                <td>{{ $project->start_date->format('M d Y') }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.end_date') }}</th>
                                <td>{{ $project->end_date->format('M d Y') }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.department_id') }}</th>
                                <td>{{ isset($project->department) ? $project->department->name : 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.project_client_id') }}</th>
                                <td>{{ isset($project->projectClient) ? $project->projectClient->name : 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.project_director_id') }}</th>
                                <td>{{ isset($project->projectDirector) ? $project->projectDirector->first_name. ' '.$project->projectDirector->last_name : 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.amount') }}</th>
                                <td>BDT. {{ $project->amount }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('admin.project.columns.bank_guarantee_amount') }}</th>
                                <td>BDT. {{ $project->bank_guarantee_amount }}</td>
                            </tr>
                            <tr>
                                <th>Total Security Money Deposited</th>
                                <td>BDT. {{ $total_security_money }}</td>
                            </tr>
                            <tr>
                                <th>Total Tax Deducted</th>
                                <td>BDT. {{ $total_tax }}</td>
                            </tr>
                            <tr>
                                <th>Total Income</th>
                                <td>BDT. {{ $total_income }}</td>
                            </tr>
                            <tr>
                                <th>Total Receivable</th>
                                <td>BDT. {{ $total_receivable }}</td>
                            </tr>
                            
                            <tr>
                                <th>Total Expense</th>
                                <td>BDT. {{ $total_expense }}</td>
                            </tr>
                            <tr>
                                <th>Total Payable</th>
                                <td>BDT. {{ $total_payable }}</td>
                            </tr>
                            <tr>
                                <th>Profit</th>
                                <td>BDT. {{ $total_income - $total_expense }}</td>
                            </tr>
                            <tr>
                                <th>Net Profit (Profit + Payable - Receivable)</th>
                                <td>BDT. {{ $total_income + $total_receivable - $total_expense - $total_payable }}</td>
                            </tr>
                            <tr>
                                <th>Stocks</th>
                                <td>
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Stock Name</th>
                                            <th>Total Load</th>
                                            <th>Total Unload</th>
                                            <th>Balance</th>
                                        </tr>
                                        @foreach ($project->stocks as $stock)
                                            <tr>
                                                <td>
                                                    {{$stock->name}}
                                                </td>
                                                <td>
                                                    {{ $stock->balance()->total_load}}
                                                </td>
                                                <td>
                                                    {{ $stock->balance()->total_unload}}
                                                </td>
                                                <td>
                                                    {{ $stock->balance()->balance}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn-info" onclick="window.print()">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
</div>

@endsection