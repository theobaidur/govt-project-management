@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.employee-designation.actions.edit', ['name' => $employeeDesignation->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <employee-designation-form
                :action="'{{ $employeeDesignation->resource_url }}'"
                :data="{{ $employeeDesignation->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.employee-designation.actions.edit', ['name' => $employeeDesignation->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.employee-designation.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </employee-designation-form>

        </div>
    
</div>

@endsection