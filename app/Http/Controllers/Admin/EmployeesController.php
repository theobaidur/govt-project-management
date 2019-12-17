<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\DestroyEmployee;
use App\Http\Requests\Admin\Employee\IndexEmployee;
use App\Http\Requests\Admin\Employee\StoreEmployee;
use App\Http\Requests\Admin\Employee\UpdateEmployee;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDesignation;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEmployee $request
     * @return Response|array
     */
    public function index(IndexEmployee $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Employee::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'email', 'phone', 'department_id', 'employee_designation_id'],

            // set columns to searchIn
            ['id', 'name', 'email', 'phone'], 
            function($query) use ($request){
                $query->with(['department', 'employeeDesignation']);
                if($request->has('departments')){
                    $query->whereIn('department_id', $request->get('departments'));
                }
                if($request->has('employeeDesignations')){
                    $query->whereIn('employee_designation_id', $request->get('employeeDesignations'));
                }
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return [
                'data' => $data,
                'departments'=> Department::all(),
                'designations'=> EmployeeDesignation::all()
            ];
        }

        return view('admin.employee.index', [
            'data' => $data,
            'departments'=> Department::all(),
            'designations'=> EmployeeDesignation::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.employee.create');

        return view('admin.employee.create', [
            'departments'=> Department::all(),
            'designations'=> EmployeeDesignation::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployee $request
     * @return Response|array
     */
    public function store(StoreEmployee $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Employee
        $employee = Employee::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/employees'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @throws AuthorizationException
     * @return void
     */
    public function show(Employee $employee)
    {
        $this->authorize('admin.employee.show', $employee);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Employee $employee)
    {
        $this->authorize('admin.employee.edit', $employee);


        return view('admin.employee.edit', [
            'employee' => $employee,
            'departments'=> Department::all(),
            'designations'=> EmployeeDesignation::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployee $request
     * @param Employee $employee
     * @return Response|array
     */
    public function update(UpdateEmployee $request, Employee $employee)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Employee
        $employee->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/employees'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEmployee $request
     * @param Employee $employee
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyEmployee $request, Employee $employee)
    {
        $employee->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyEmployee $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyEmployee $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Employee::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
