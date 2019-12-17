<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.employee.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': this.fields.email && this.fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': this.fields.email && this.fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.employee.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('phone'), 'has-success': this.fields.phone && this.fields.phone.valid }">
    <label for="phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee.columns.phone') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.phone" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('phone'), 'form-control-success': this.fields.phone && this.fields.phone.valid}" id="phone" name="phone" placeholder="{{ trans('admin.employee.columns.phone') }}">
        <div v-if="errors.has('phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('department_id'), 'has-success': this.fields.department_id && this.fields.department_id.valid }">
    <label for="department_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee.columns.department_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select  v-model="form.department_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('department_id'), 'form-control-success': this.fields.department_id && this.fields.department_id.valid}" id="department_id" name="department_id">
                <option disabled value="">{{ trans('admin.employee.columns.department_id') }}</option>
                @foreach ($departments as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>   
                @endforeach
            </select>
        <div v-if="errors.has('department_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('department_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('employee_designation_id'), 'has-success': this.fields.employee_designation_id && this.fields.employee_designation_id.valid }">
    <label for="employee_designation_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.employee.columns.employee_designation_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select  v-model="form.employee_designation_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('employee_designation_id'), 'form-control-success': this.fields.employee_designation_id && this.fields.employee_designation_id.valid}" id="employee_designation_id" name="employee_designation_id">
                <option disabled value="">{{ trans('admin.employee.columns.employee_designation_id') }}</option>
                @foreach ($designations as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>   
                @endforeach
            </select>
        <div v-if="errors.has('employee_designation_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('employee_designation_id') }}</div>
    </div>
</div>
@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\Employee::class)->getMediaCollection('related_files'),
    'label' => 'Related Files',
    'media' => !empty($employee) ? $employee->getThumbs200ForCollection('related_files') : null
])


