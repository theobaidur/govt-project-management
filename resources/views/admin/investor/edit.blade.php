@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.investor.actions.edit', ['name' => $investor->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <investor-form
                :action="'{{ $investor->resource_url }}'"
                :data="{{ $investor->toJson() }}"
                :users="{{ $users->toJson() }}"
                :projects="{{ $projects->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.investor.actions.edit', ['name' => $investor->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.investor.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </investor-form>

        </div>
    
</div>

@endsection