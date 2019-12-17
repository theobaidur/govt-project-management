<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentCategory\DestroyDocumentCategory;
use App\Http\Requests\Admin\DocumentCategory\IndexDocumentCategory;
use App\Http\Requests\Admin\DocumentCategory\StoreDocumentCategory;
use App\Http\Requests\Admin\DocumentCategory\UpdateDocumentCategory;
use App\Models\DocumentCategory;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DocumentCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDocumentCategory $request
     * @return Response|array
     */
    public function index(IndexDocumentCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DocumentCategory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name', 'description']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.document-category.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.document-category.create');

        return view('admin.document-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDocumentCategory $request
     * @return Response|array
     */
    public function store(StoreDocumentCategory $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the DocumentCategory
        $documentCategory = DocumentCategory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/document-categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/document-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param DocumentCategory $documentCategory
     * @throws AuthorizationException
     * @return void
     */
    public function show(DocumentCategory $documentCategory)
    {
        $this->authorize('admin.document-category.show', $documentCategory);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DocumentCategory $documentCategory
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(DocumentCategory $documentCategory)
    {
        $this->authorize('admin.document-category.edit', $documentCategory);


        return view('admin.document-category.edit', [
            'documentCategory' => $documentCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDocumentCategory $request
     * @param DocumentCategory $documentCategory
     * @return Response|array
     */
    public function update(UpdateDocumentCategory $request, DocumentCategory $documentCategory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values DocumentCategory
        $documentCategory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/document-categories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/document-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDocumentCategory $request
     * @param DocumentCategory $documentCategory
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyDocumentCategory $request, DocumentCategory $documentCategory)
    {
        $documentCategory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyDocumentCategory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyDocumentCategory $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    DocumentCategory::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
