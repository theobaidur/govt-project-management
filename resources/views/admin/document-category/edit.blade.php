@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.document-category.actions.edit', ['name' => $documentCategory->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <document-category-form
                :action="'{{ $documentCategory->resource_url }}'"
                :data="{{ $documentCategory->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.document-category.actions.edit', ['name' => $documentCategory->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.document-category.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </document-category-form>

        </div>
    
</div>

@endsection