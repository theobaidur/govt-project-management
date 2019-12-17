<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BillingAccount\DestroyBillingAccount;
use App\Http\Requests\Admin\BillingAccount\IndexBillingAccount;
use App\Http\Requests\Admin\BillingAccount\StoreBillingAccount;
use App\Http\Requests\Admin\BillingAccount\UpdateBillingAccount;
use App\Models\BillingAccount;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BillingAccountsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBillingAccount $request
     * @return Response|array
     */
    public function index(IndexBillingAccount $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BillingAccount::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'address', 'phone', 'email'],

            // set columns to searchIn
            ['id', 'name', 'address', 'phone', 'email'],
            function($query) use ($request){
                if($request->has('project_id')){
                    $query->where('project_id', $request->get('project_id'));
                }
            }
        ); 

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.billing-account.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.billing-account.create');

        return view('admin.billing-account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBillingAccount $request
     * @return Response|array
     */
    public function store(StoreBillingAccount $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the BillingAccount
        $billingAccount = BillingAccount::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/billing-accounts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/billing-accounts');
    }

    /**
     * Display the specified resource.
     *
     * @param BillingAccount $billingAccount
     * @throws AuthorizationException
     * @return void
     */
    public function show(BillingAccount $billingAccount)
    {
        $this->authorize('admin.billing-account.show', $billingAccount);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BillingAccount $billingAccount
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(BillingAccount $billingAccount)
    {
        $this->authorize('admin.billing-account.edit', $billingAccount);


        return view('admin.billing-account.edit', [
            'billingAccount' => $billingAccount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBillingAccount $request
     * @param BillingAccount $billingAccount
     * @return Response|array
     */
    public function update(UpdateBillingAccount $request, BillingAccount $billingAccount)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BillingAccount
        $billingAccount->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/billing-accounts'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/billing-accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBillingAccount $request
     * @param BillingAccount $billingAccount
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyBillingAccount $request, BillingAccount $billingAccount)
    {
        $billingAccount->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyBillingAccount $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyBillingAccount $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    BillingAccount::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
