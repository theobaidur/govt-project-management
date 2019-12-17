<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Invoice\DestroyInvoice;
use App\Http\Requests\Admin\Invoice\IndexInvoice;
use App\Http\Requests\Admin\Invoice\StoreInvoice;
use App\Http\Requests\Admin\Invoice\UpdateInvoice;
use App\Models\BillingAccount;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Stock;
use App\Models\StockEntry;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class InvoicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexInvoice $request
     * @return Response|array
     */
    public function index(IndexInvoice $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Invoice::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'system_invoice_no', 'billing_invoice_no', 'cash', 'amount', 'tax', 'security_money', 'billing_account_id', 'invoice_type'],

            // set columns to searchIn
            ['id', 'billing_invoice_no', 'system_invoice_no', 'invoice_type', 'note'],
            function($query) use ($request){
                $query->with(['project']);
                if($request->has('project_id')){
                    $query->where('project_id', $request->get('project_id'));
                }
            }
        );
        $data->load(['project', 'billingAccount']);
        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.invoice.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.invoice.create');
        $accounts = BillingAccount::where(function($query){
            if(Request::has('project_id')){
                $query->where('project_id', Request::get('project_id'));
            }
        })->get();
        $stocks = Stock::where(function($query){
            if(Request::has('project_id')){
                $query->where('project_id', Request::get('project_id'));
            }
        })->get();
        return view('admin.invoice.create', \compact('accounts', 'stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoice $request
     * @return Response|array
     */
    public function store(StoreInvoice $request)
    {
        // Store Billing account
        $items = Request::input('invoiceItems', []);
        
        // Sanitize input
        $sanitized = $request->validated();
        if(empty($sanitized['billing_account_id'])){
            $billingData = [];
            $billingData['name'] = $request->input('billing_name');
            $billingData['address'] = $request->input('billing_address');
            $billingData['email'] = $request->input('billing_email');
            $billingData['phone'] = $request->input('billing_phone');
            $billingData['project_id'] = $request->input('project_id');
            $billing = BillingAccount::create($billingData);
            $sanitized['billing_account_id'] = $billing->id;
        }

        // Store the Invoice
        $invoice = Invoice::create($sanitized);
        $storeEntries = [];
        foreach($items as &$item){
            unset($item['id']);
            $item['invoice_id'] = $invoice->id;
            if(!empty($item['stock_id'])){
                $storeEntries[] = [
                    'quantity'=> $item['quantity'],
                    'unit_name'=> $item['unit_name'],
                    'unit_price'=> $item['unit_price'],
                    'stock_id'=> $item['stock_id'],
                    'invoice_id'=> $item['invoice_id'],
                ];
            }
        }
        $type = 'load';
        if(!empty($invoice->invoice_type) && $invoice->invoice_type == 'credit_voucher'){
            $type = 'unload';
        }
        if(count($storeEntries) > 0){
            foreach($storeEntries as &$entry){
                $entry['type'] = $type;
            }
            StockEntry::insert($storeEntries);    
        }
        InvoiceItem::insert($items);
        if ($request->ajax()) {
            return ['redirect' => url('admin/invoices'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @throws AuthorizationException
     * @return void
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('admin.invoice.show', $invoice);
        $invoice->load(['billingAccount', 'project', 'invoiceItems']);

        return view('admin.invoice.show', \compact('invoice'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $invoice
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Invoice $invoice)
    {
        $this->authorize('admin.invoice.edit', $invoice);
        $accounts = BillingAccount::where(function($query){
            if(Request::has('project_id')){
                $query->where('project_id', Request::get('project_id'));
            }
        })->get();
        $stocks = Stock::where(function($query){
            if(Request::has('project_id')){
                $query->where('project_id', Request::get('project_id'));
            }
        })->get();
        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();
        return view('admin.invoice.edit', \compact('accounts', 'stocks', 'items', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoice $request
     * @param Invoice $invoice
     * @return Response|array
     */
    public function update(UpdateInvoice $request, Invoice $invoice)
    {
        // Sanitize input
        $sanitized = $request->validated();
        if(empty($sanitized['billing_account_id'])){
            $billingData = [];
            $billingData['name'] = $request->input('billing_name');
            $billingData['address'] = $request->input('billing_address');
            $billingData['email'] = $request->input('billing_email');
            $billingData['phone'] = $request->input('billing_phone');
            $billing = BillingAccount::created($billingData);
            $sanitized['billing_account_id'] = $billing->id;
        }
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Invoice
        $invoice->update($sanitized);
        $type = 'load';
        if(!empty($invoice->invoice_type) && $invoice->invoice_type == 'credit_voucher'){
            $type = 'unload';
        }
        $invoice->stockEntries()->delete();
        $items = $request->input('invoiceItems', []);
        $deletedItems = $request->input('deletedItems', []);
        $storeEntries = [];
        InvoiceItem::whereIn('id', $deletedItems)->delete();
        foreach($items as &$item){
            if(!empty($item['resource_url'])){
                unset($item['resource_url']);
            }
            $item['invoice_id'] = $invoice->id;
            if(!empty($item['stock_id'])){
                $storeEntries[] = [
                    'quantity'=> $item['quantity'],
                    'unit_name'=> $item['unit_name'],
                    'unit_price'=> $item['unit_price'],
                    'stock_id'=> $item['stock_id'],
                    'invoice_id'=> $item['invoice_id'],
                ];
            }
            if(empty($item['id'])){
                InvoiceItem::insert($item);
            } else {
                InvoiceItem::where('id', $item['id'])->update($item);
            }
        }
        if(count($storeEntries) > 0){
            foreach($storeEntries as &$entry){
                $entry['type'] = $type;
            }
            StockEntry::insert($storeEntries);    
        }
        if ($request->ajax()) {
            return [
                'redirect' => url('admin/invoices'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyInvoice $request
     * @param Invoice $invoice
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyInvoice $request, Invoice $invoice)
    {
        $invoice->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyInvoice $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyInvoice $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Invoice::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
