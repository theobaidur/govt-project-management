<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.project.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="'required'" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount'), 'has-success': this.fields.amount && this.fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount'), 'form-control-success': this.fields.amount && this.fields.amount.valid}" id="amount" name="amount" placeholder="{{ trans('admin.project.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('bank_guarantee_amount'), 'has-success': this.fields.bank_guarantee_amount && this.fields.bank_guarantee_amount.valid }">
    <label for="bank_guarantee_amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.bank_guarantee_amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.bank_guarantee_amount" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('bank_guarantee_amount'), 'form-control-success': this.fields.bank_guarantee_amount && this.fields.bank_guarantee_amount.valid}" id="bank_guarantee_amount" name="bank_guarantee_amount" placeholder="{{ trans('admin.project.columns.bank_guarantee_amount') }}">
        <div v-if="errors.has('bank_guarantee_amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('bank_guarantee_amount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('start_date'), 'has-success': this.fields.start_date && this.fields.start_date.valid }">
    <label for="start_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.start_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.start_date" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('start_date'), 'form-control-success': this.fields.start_date && this.fields.start_date.valid}" id="start_date" name="start_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('start_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('start_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('end_date'), 'has-success': this.fields.end_date && this.fields.end_date.valid }">
    <label for="end_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.end_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.end_date" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('end_date'), 'form-control-success': this.fields.end_date && this.fields.end_date.valid}" id="end_date" name="end_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('end_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('end_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('department_id'), 'has-success': this.fields.department_id && this.fields.department_id.valid }">
    <label for="department_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.department_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select  v-model="form.department_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('department_id'), 'form-control-success': this.fields.department_id && this.fields.department_id.valid}" id="department_id" name="department_id">
                <option disabled value="">{{ trans('admin.project.columns.department_id') }}</option>
                @foreach ($departments as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>   
                @endforeach
            </select>
        <div v-if="errors.has('department_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('department_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_director_id'), 'has-success': this.fields.project_director_id && this.fields.project_director_id.valid }">
    <label for="project_director_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.project_director_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select  v-model="form.project_director_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('project_director_id'), 'form-control-success': this.fields.project_director_id && this.fields.project_director_id.valid}" id="project_director_id" name="project_director_id">
                <option disabled value="">{{ trans('admin.project.columns.project_director_id') }}</option>
                @foreach ($project_directors as $item)
                    <option value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</option>   
                @endforeach
            </select>
        <div v-if="errors.has('project_director_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_director_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_client_id'), 'has-success': this.fields.project_client_id && this.fields.project_client_id.valid }">
    <label for="project_client_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.project.columns.project_client_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select  v-model="form.project_client_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('project_client_id'), 'form-control-success': this.fields.project_client_id && this.fields.project_client_id.valid}" id="project_client_id" name="project_client_id">
                <option disabled value="">{{ trans('admin.project.columns.project_client_id') }}</option>
                @foreach ($clients as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>   
                @endforeach
            </select>
        <div v-if="errors.has('project_client_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_client_id') }}</div>
    </div>
</div>
@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\Project::class)->getMediaCollection('related_files'),
    'label' => 'Related Files',
    'media' => !empty($project) ? $project->getThumbs200ForCollection('related_files') : null
])


