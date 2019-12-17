@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.project.actions.index'))

@section('body')

    <project-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/projects') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-print-none">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.project.actions.index') }}
                        @if (userHasRole('Administrator'))
                            <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ _url('admin/projects/create', -1) }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}</a>
                        @endif
                    </div>
                    <div class="card-body" v-cloak>
                        <form class="d-print-none" @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-md-3 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col col-md-3 form-group">
                                    <multiselect v-model="selectedDepartments"
                                        :options="{{ $departments->toJson() }}"
                                        label="name"
                                        track-by="key"
                                        placeholder="{{ trans('admin.department.title') }}"
                                        :limit="2"
                                        :multiple="true">
                                    </multiselect>
                                </div>
                                <div class="col col-md-3 form-group">
                                    <multiselect v-model="selectedClients"
                                        :options="{{ $clients->toJson() }}"
                                        label="name"
                                        track-by="key"
                                        placeholder="{{ trans('admin.project-client.title') }}"
                                        :limit="2"
                                        :multiple="true">
                                    </multiselect>
                                </div>
                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">
                                        
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th class="bulk-checkbox">
                                        @if (userHasRole('Administrator'))
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        @endif
                                    </th>

                                    <th is='sortable' :column="'id'">{{ trans('admin.project.columns.id') }}</th>
                                    <th is='sortable' :column="'name'">{{ trans('admin.project.columns.name') }}</th>
                                    <th is='sortable' :column="'amount'">{{ trans('admin.project.columns.amount') }}</th>
                                    <th is='sortable' :column="'start_date'">{{ trans('admin.project.columns.start_date') }}</th>
                                    <th is='sortable' :column="'end_date'">{{ trans('admin.project.columns.end_date') }}</th>
                                    <th is='sortable' :column="'department_id'">{{ trans('admin.project.columns.department_id') }}</th>
                                    <th is='sortable' :column="'project_client_id'">{{ trans('admin.project.columns.project_client_id') }}</th>

                                    <th>
                                        <button class="btn btn-info btn-sm text-white" v-on:click="print">
                                            <i class="fa fa-print"></i> Print
                                        </button>
                                    </th>
                                </tr>
                                <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                    <td class="bg-bulk-info d-table-cell text-center" colspan="9">
                                        <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/projects')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                    href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                        <span class="pull-right pr-2">
                                            <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/projects/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                        </span>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                    <td class="bulk-checkbox">
                                        @if (userHasRole('Administrator'))
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        @endif
                                    </td>

                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>BDT. @{{ item.amount }}</td>
                                    <td>@{{ item.start_date | datetime }}</td>
                                    <td>@{{ item.end_date | datetime }}</td>
                                    <td>@{{ item | valueOrDefault('department', 'name', item.department_id) }}</td>
                                    <td>@{{ item  | valueOrDefault('project_client', 'name', item.project_client_id) }}</td>
                                    
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="_url(item.resource_url, item.id)" title="{{ trans('admin.project.actions.view') }}" role="button"><i class="fa fa-eye-slash"></i></a>
                                                @if (userHasRole('Administrator'))
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="_url(item.resource_url + '/edit', item.id)" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                    
                                                @endif
                                            </div>
                                            @if (userHasRole('Administrator'))
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                                <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>

	                    <div class="no-items-found" v-if="!collection.length > 0">
		                    <i class="icon-magnifier"></i>
		                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
		                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            @if (userHasRole('Administrator'))
                                <a class="btn btn-primary btn-spinner" href="{{ _url('admin/projects/create',-1) }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.project.actions.create') }}</a>
                            @endif
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </project-listing>

@endsection