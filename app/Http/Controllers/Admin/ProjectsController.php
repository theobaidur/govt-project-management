<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\DestroyProject;
use App\Http\Requests\Admin\Project\IndexProject;
use App\Http\Requests\Admin\Project\StoreProject;
use App\Http\Requests\Admin\Project\UpdateProject;
use App\Models\Department;
use App\Models\Investor;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\ProjectClient;
use Brackets\AdminAuth\Models\AdminUser;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ProjectsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexProject $request
     * @return Response|array
     */
    protected function getListingView(IndexProject $request, string $view){
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Project::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'amount', 'bank_guarantee_amount', 'start_date', 'end_date', 'department_id', 'project_client_id', 'project_director_id'],

            // set columns to searchIn
            ['id', 'name', 'description'], 
            function($query) use ($request){
                if(Auth::check() && Auth::user()->hasRole('Investor')){
                    $userProjects = Investor::where('user_id', Auth::id())->pluck('project_id');
                    $query->whereIn('id', $userProjects);
                }
                $query->with(['department', 'projectClient']);
                if($request->has('departments')){
                    $query->whereIn('department_id', $request->get('departments'));
                }
                if($request->has('projectClients')){
                    $query->whereIn('project_client_id', $request->get('projectClients'));
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
                'clients' => ProjectClient::all(),
                'departments'=> Department::all()
            ];
        }

        return view($view, [
            'data' => $data,
            'clients' => ProjectClient::all(),
            'departments'=> Department::all()
            ]);
    }
    public function index(IndexProject $request)
    {
        return $this->getListingView($request, 'admin.project.index');
    }

    public function home(IndexProject $request){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.project.create');

        return view('admin.project.create', [
            'clients' => ProjectClient::all(),
            'departments'=> Department::all(),
            'project_directors'=> AdminUser::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProject $request
     * @return Response|array
     */
    public function store(StoreProject $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Project
        $project = Project::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/projects'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @throws AuthorizationException
     * @return void
     */
    public function show(Project $project)
    {
        $this->authorize('admin.project.show', $project);
        if(userHasRole('Investor')){
            Investor::where(['user_id'=> Auth::id(), 'project_id'=>$project->id])->firstOrFail();
        }
        $total_bill = 0;
        $total_expense = 0;
        $total_security_money = 0;
        $total_tax = 0;
        $total_income = 0;
        $total_receivable = 0;
        $total_payable = 0;
        $invoices = Invoice::where('project_id', $project->id)->with('billingAccount')->get();
        foreach($invoices as $invoice){
            if($invoice->invoice_type =='credit_voucher'){
                $total_income += $invoice->cash;
                $total_receivable += ($invoice->amount - $invoice->cash);
                if($invoice->tax){
                    $total_tax += $invoice->tax;
                }
                if($invoice->security_money){
                    $total_security_money += $invoice->security_money;
                }
            }
            if($invoice->invoice_type =='debit_voucher'){
                $total_expense += $invoice->cash;
                $total_payable += ($invoice->amount - $invoice->cash);
            }
            if(
                $invoice->invoice_type =='credit_voucher' && 
                $invoice->billing_account && 
                $invoice->billing_account->account_type == 'project-client'){
                $total_bill += $invoice->cash;
            }

        }
        // TODO your code goes here
        return view('admin.project.project-home', \compact(['project', 'invoices', 'total_bill', 'total_expense', 'total_security_money', 'total_tax', 'total_income', 'total_receivable', 'total_payable']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Project $project)
    {
        $this->authorize('admin.project.edit', $project);
        return view('admin.project.edit', [
            'project' => $project,
            'clients' => ProjectClient::all(),
            'departments'=> Department::all(),
            'project_directors'=> AdminUser::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProject $request
     * @param Project $project
     * @return Response|array
     */
    public function update(UpdateProject $request, Project $project)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Project
        $project->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/projects'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProject $request
     * @param Project $project
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyProject $request, Project $project)
    {
        $project->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyProject $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyProject $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Project::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
