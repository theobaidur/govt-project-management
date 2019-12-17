@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.stock-entry.actions.edit', ['name' => $stockEntry->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <stock-entry-form
                :action="'{{ $stockEntry->resource_url }}'"
                :data="{{ $stockEntry->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.stock-entry.actions.edit', ['name' => $stockEntry->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.stock-entry.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </stock-entry-form>

        </div>
    
</div>

@endsection