<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeDesignation\DestroyEmployeeDesignation;
use App\Http\Requests\Admin\EmployeeDesignation\IndexEmployeeDesignation;
use App\Http\Requests\Admin\EmployeeDesignation\StoreEmployeeDesignation;
use App\Http\Requests\Admin\EmployeeDesignation\UpdateEmployeeDesignation;
use App\Models\EmployeeDesignation;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeDesignationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEmployeeDesignation $request
     * @return Response|array
     */
    public function index(IndexEmployeeDesignation $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(EmployeeDesignation::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.employee-designation.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.employee-designation.create');

        return view('admin.employee-designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeDesignation $request
     * @return Response|array
     */
    public function store(StoreEmployeeDesignation $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the EmployeeDesignation
        $employeeDesignation = EmployeeDesignation::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/employee-designations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/employee-designations');
    }

    /**
     * Display the specified resource.
     *
     * @param EmployeeDesignation $employeeDesignation
     * @throws AuthorizationException
     * @return void
     */
    public function show(EmployeeDesignation $employeeDesignation)
    {
        $this->authorize('admin.employee-designation.show', $employeeDesignation);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EmployeeDesignation $employeeDesignation
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(EmployeeDesignation $employeeDesignation)
    {
        $this->authorize('admin.employee-designation.edit', $employeeDesignation);


        return view('admin.employee-designation.edit', [
            'employeeDesignation' => $employeeDesignation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeDesignation $request
     * @param EmployeeDesignation $employeeDesignation
     * @return Response|array
     */
    public function update(UpdateEmployeeDesignation $request, EmployeeDesignation $employeeDesignation)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values EmployeeDesignation
        $employeeDesignation->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/employee-designations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/employee-designations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEmployeeDesignation $request
     * @param EmployeeDesignation $employeeDesignation
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyEmployeeDesignation $request, EmployeeDesignation $employeeDesignation)
    {
        $employeeDesignation->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyEmployeeDesignation $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyEmployeeDesignation $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    EmployeeDesignation::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
