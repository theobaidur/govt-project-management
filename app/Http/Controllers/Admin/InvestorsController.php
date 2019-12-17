<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Investor\DestroyInvestor;
use App\Http\Requests\Admin\Investor\IndexInvestor;
use App\Http\Requests\Admin\Investor\StoreInvestor;
use App\Http\Requests\Admin\Investor\UpdateInvestor;
use App\Models\Investor;
use App\Models\Project;
use Brackets\AdminAuth\Models\AdminUser;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class InvestorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexInvestor $request
     * @return Response|array
     */
    public function index(IndexInvestor $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Investor::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'user_id', 'investment_amount'],

            // set columns to searchIn
            ['id'],
            function($query) use ($request){
                $query->with(['project']);
                if($request->has('project_id')){
                    $query->where('project_id', $request->get('project_id'));
                }
            }
        );
        $data->load(['user', 'project']);
        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.investor.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.investor.create');
        $users = AdminUser::all();
        $projects = Project::all();
        return view('admin.investor.create', \compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvestor $request
     * @return Response|array
     */
    public function store(StoreInvestor $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Investor
        $investor = Investor::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/investors'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/investors');
    }

    /**
     * Display the specified resource.
     *
     * @param Investor $investor
     * @throws AuthorizationException
     * @return void
     */
    public function show(Investor $investor)
    {
        $this->authorize('admin.investor.show', $investor);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Investor $investor
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Investor $investor)
    {
        $this->authorize('admin.investor.edit', $investor);

        $users = AdminUser::all();
        $projects = Project::all();
        $investor->load(['project','user']);
        return view('admin.investor.edit', \compact('investor', 'users', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvestor $request
     * @param Investor $investor
     * @return Response|array
     */
    public function update(UpdateInvestor $request, Investor $investor)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Investor
        $investor->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/investors'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/investors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyInvestor $request
     * @param Investor $investor
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyInvestor $request, Investor $investor)
    {
        $investor->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyInvestor $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyInvestor $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Investor::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
