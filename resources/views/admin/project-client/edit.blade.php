@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.project-client.actions.edit', ['name' => $projectClient->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <project-client-form
                :action="'{{ $projectClient->resource_url }}'"
                :data="{{ $projectClient->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.project-client.actions.edit', ['name' => $projectClient->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.project-client.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </project-client-form>

        </div>
    
</div>

@endsection