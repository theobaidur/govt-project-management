<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectClient\DestroyProjectClient;
use App\Http\Requests\Admin\ProjectClient\IndexProjectClient;
use App\Http\Requests\Admin\ProjectClient\StoreProjectClient;
use App\Http\Requests\Admin\ProjectClient\UpdateProjectClient;
use App\Models\ProjectClient;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProjectClientsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexProjectClient $request
     * @return Response|array
     */
    public function index(IndexProjectClient $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ProjectClient::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'email', 'phone'],

            // set columns to searchIn
            ['id', 'name', 'email', 'phone', 'description']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.project-client.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.project-client.create');

        return view('admin.project-client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProjectClient $request
     * @return Response|array
     */
    public function store(StoreProjectClient $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the ProjectClient
        $projectClient = ProjectClient::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/project-clients'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/project-clients');
    }

    /**
     * Display the specified resource.
     *
     * @param ProjectClient $projectClient
     * @throws AuthorizationException
     * @return void
     */
    public function show(ProjectClient $projectClient)
    {
        $this->authorize('admin.project-client.show', $projectClient);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProjectClient $projectClient
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(ProjectClient $projectClient)
    {
        $this->authorize('admin.project-client.edit', $projectClient);


        return view('admin.project-client.edit', [
            'projectClient' => $projectClient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectClient $request
     * @param ProjectClient $projectClient
     * @return Response|array
     */
    public function update(UpdateProjectClient $request, ProjectClient $projectClient)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ProjectClient
        $projectClient->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/project-clients'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/project-clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProjectClient $request
     * @param ProjectClient $projectClient
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyProjectClient $request, ProjectClient $projectClient)
    {
        $projectClient->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyProjectClient $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyProjectClient $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ProjectClient::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
