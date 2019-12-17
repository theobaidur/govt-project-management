@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.invoice.actions.index'))

@section('body')
    <div class="container-xl">
        <div class="card">
            <table class="table table-sm">
                <tr>
                    <td colspan="5" class="text-center">
                        <h3>{{ $invoice->type === 'debit_voucher' ? 'Debit Voucher' : 'Credit Voucher' }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <dl class="row">
                            <dt class="col-sm-3">
                                Date
                            </dt>
                            <dd class="col-sm-9">
                                {{ $invoice->updated_at->format('d/m/Y') }}
                            </dd>
                            <dt class="col-sm-3">
                                Invoice No
                            </dt>
                            <dd class="col-sm-9">
                                {{ $invoice->invoice_no }}
                            </dd>
                            <dt class="col-sm-3">
                                Project
                            </dt>
                            <dd class="col-sm-9">
                                {{ !empty($invoice->project) ? $invoice->project->name : 'N/A' }}
                            </dd>
                        </dl>
                    </td>
                    <td colspan="3">
                        <b>Billed To</b>
                        <dl class="row">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">
                                {{ $invoice->billingAccount->name }}
                            </dd>
                            <dt class="col-sm-3">Address</dt>
                            <dd class="col-sm-9">
                                {{ $invoice->billingAccount->address }}
                            </dd>
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9">
                                {{ $invoice->billingAccount->email }}
                            </dd>
                            <dt class="col-sm-3">Phone</dt>
                            <dd class="col-sm-9">
                                {{ $invoice->billingAccount->phone }}
                            </dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <th>SL No</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                </tr>
                @foreach ($invoice->invoiceItems as $index => $item)
                    <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}/{{ $item->unit_name }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>BDT 
                        @if ($item->type == '+')
                            {{ $item->amount }}
                        @else
                            ({{ $item->amount }})
                        @endif
                    </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <td>BDT {{ $invoice->total_amount_after_discount + $invoice->discount }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Discount</th>
                    <td>BDT ({{ $invoice->discount }})</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Grand Total</th>
                    <td>BDT {{ $invoice->total_amount_after_discount }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Cash</th>
                    <td>BDT ({{ $invoice->cash }})</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Due</th>
                    <td>BDT {{ $invoice->total_amount_after_discount - $invoice->cash }}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td colspan="4">
                        {!! $invoice->note !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <button class="btn btn-info" onclick="window.print()">
                            <i class="fa fa-print"></i>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection