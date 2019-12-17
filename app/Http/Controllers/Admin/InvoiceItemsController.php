<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceItem\DestroyInvoiceItem;
use App\Http\Requests\Admin\InvoiceItem\IndexInvoiceItem;
use App\Http\Requests\Admin\InvoiceItem\StoreInvoiceItem;
use App\Http\Requests\Admin\InvoiceItem\UpdateInvoiceItem;
use App\Models\InvoiceItem;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class InvoiceItemsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexInvoiceItem $request
     * @return Response|array
     */
    public function index(IndexInvoiceItem $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(InvoiceItem::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'type', 'description', 'quantity', 'unit_name', 'unit_price', 'amount', 'invoice_id'],

            // set columns to searchIn
            ['id', 'type', 'description', 'unit_name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.invoice-item.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.invoice-item.create');

        return view('admin.invoice-item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoiceItem $request
     * @return Response|array
     */
    public function store(StoreInvoiceItem $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the InvoiceItem
        $invoiceItem = InvoiceItem::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/invoice-items'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/invoice-items');
    }

    /**
     * Display the specified resource.
     *
     * @param InvoiceItem $invoiceItem
     * @throws AuthorizationException
     * @return void
     */
    public function show(InvoiceItem $invoiceItem)
    {
        $this->authorize('admin.invoice-item.show', $invoiceItem);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InvoiceItem $invoiceItem
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(InvoiceItem $invoiceItem)
    {
        $this->authorize('admin.invoice-item.edit', $invoiceItem);


        return view('admin.invoice-item.edit', [
            'invoiceItem' => $invoiceItem,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoiceItem $request
     * @param InvoiceItem $invoiceItem
     * @return Response|array
     */
    public function update(UpdateInvoiceItem $request, InvoiceItem $invoiceItem)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values InvoiceItem
        $invoiceItem->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/invoice-items'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/invoice-items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyInvoiceItem $request
     * @param InvoiceItem $invoiceItem
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyInvoiceItem $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyInvoiceItem $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyInvoiceItem $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    InvoiceItem::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
