<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockEntry\DestroyStockEntry;
use App\Http\Requests\Admin\StockEntry\IndexStockEntry;
use App\Http\Requests\Admin\StockEntry\StoreStockEntry;
use App\Http\Requests\Admin\StockEntry\UpdateStockEntry;
use App\Models\Stock;
use App\Models\StockEntry;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class StockEntriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexStockEntry $request
     * @return Response|array
     */
    public function index(IndexStockEntry $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(StockEntry::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'type', 'quantity', 'unit_name', 'unit_price', 'stock_id'],

            // set columns to searchIn
            ['id', 'type'], 
            function($query) use ($request){
                $query->with(['stock']);
                if($request->has('types')){
                    $query->whereIn('type', $request->get('types'));
                }
                if($request->has('stocks')){
                    $query->whereIn('stock_id', $request->get('stocks'));
                }
                if($request->has('project_id')){
                    $query->whereHas('stock', function($q) use ($request){
                        $q->where('project_id', $request->get('project_id'));
                    });
                }
                
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data, 'stocks'=> Stock::where(function($query){
                if(Request::has('project_id')){
                    $query->where('project_id', Request::get('project_id'));
                }
            })->get(), 'types'=>\collect([
                ['id'=>'load', 'label'=> trans('admin.stock-entry.options.load')],
                ['id'=>'unload', 'label'=> trans('admin.stock-entry.options.unload')],
            ])];
        }

        return view('admin.stock-entry.index', ['data' => $data, 'stocks'=> Stock::where(function($query){
            if(Request::has('project_id')){
                $query->where('project_id', Request::get('project_id'));
            }
        })->get(), 'types'=>\collect([
            ['id'=>'load', 'label'=> trans('admin.stock-entry.options.load')],
            ['id'=>'unload', 'label'=> trans('admin.stock-entry.options.unload')],
        ])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.stock-entry.create');

        return view('admin.stock-entry.create', [
            'stocks'=> Stock::where(function($query){
                if(Request::has('project_id')){
                    $query->where('project_id', Request::get('project_id'));
                }
            })->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStockEntry $request
     * @return Response|array
     */
    public function store(StoreStockEntry $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the StockEntry
        $stockEntry = StockEntry::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/stock-entries'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/stock-entries');
    }

    /**
     * Display the specified resource.
     *
     * @param StockEntry $stockEntry
     * @throws AuthorizationException
     * @return void
     */
    public function show(StockEntry $stockEntry)
    {
        $this->authorize('admin.stock-entry.show', $stockEntry);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StockEntry $stockEntry
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(StockEntry $stockEntry)
    {
        $this->authorize('admin.stock-entry.edit', $stockEntry);


        return view('admin.stock-entry.edit', [
            'stockEntry' => $stockEntry,
            'stocks'=> Stock::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStockEntry $request
     * @param StockEntry $stockEntry
     * @return Response|array
     */
    public function update(UpdateStockEntry $request, StockEntry $stockEntry)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values StockEntry
        $stockEntry->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/stock-entries'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/stock-entries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyStockEntry $request
     * @param StockEntry $stockEntry
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyStockEntry $request, StockEntry $stockEntry)
    {
        $stockEntry->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyStockEntry $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyStockEntry $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    StockEntry::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
