@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.invoice-item.actions.edit', ['name' => $invoiceItem->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <invoice-item-form
                :action="'{{ $invoiceItem->resource_url }}'"
                :data="{{ $invoiceItem->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.invoice-item.actions.edit', ['name' => $invoiceItem->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.invoice-item.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </invoice-item-form>

        </div>
    
</div>

@endsection