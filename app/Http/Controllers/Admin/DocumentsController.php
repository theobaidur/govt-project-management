<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Document\DestroyDocument;
use App\Http\Requests\Admin\Document\IndexDocument;
use App\Http\Requests\Admin\Document\StoreDocument;
use App\Http\Requests\Admin\Document\UpdateDocument;
use App\Models\Document;
use App\Models\DocumentCategory;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDocument $request
     * @return Response|array
     */
    public function index(IndexDocument $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Document::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'document_category_id'],

            // set columns to searchIn
            ['id', 'name', 'description'], 
            function($query) use($request){
                $query->with(['documentCategory']);
                if($request->has('documentCategories')){
                    $query->whereIn('document_category_id', $request->get('documentCategories'));
                }
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
            return ['data' => $data, 'documentCategories'=> DocumentCategory::all()];
        }

        return view('admin.document.index', ['data' => $data, 'documentCategories'=> DocumentCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.document.create');

        return view('admin.document.create', ['documentCategories'=> DocumentCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDocument $request
     * @return Response|array
     */
    public function store(StoreDocument $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Document
        $document = Document::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/documents'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/documents');
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @throws AuthorizationException
     * @return void
     */
    public function show(Document $document)
    {
        $this->authorize('admin.document.show', $document);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Document $document)
    {
        $this->authorize('admin.document.edit', $document);


        return view('admin.document.edit', [
            'document' => $document,
            'documentCategories'=> DocumentCategory::all(),
            'relatedFiles'=> $document->getMedia()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDocument $request
     * @param Document $document
     * @return Response|array
     */
    public function update(UpdateDocument $request, Document $document)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Document
        $document->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/documents'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/documents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDocument $request
     * @param Document $document
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyDocument $request, Document $document)
    {
        $document->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyDocument $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyDocument $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Document::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
