<div class="form-group row align-items-center" :class="{'has-danger': errors.has('project_id'), 'has-success': this.fields.project_id && this.fields.project_id.valid }">
    <label for="project_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.expense.columns.project_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.project_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('project_id'), 'form-control-success': this.fields.project_id && this.fields.project_id.valid}" id="project_id" name="project_id" placeholder="{{ trans('admin.expense.columns.project_id') }}">
        <div v-if="errors.has('project_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('project_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('invoice_id'), 'has-success': this.fields.invoice_id && this.fields.invoice_id.valid }">
    <label for="invoice_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.expense.columns.invoice_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.invoice_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('invoice_id'), 'form-control-success': this.fields.invoice_id && this.fields.invoice_id.valid}" id="invoice_id" name="invoice_id" placeholder="{{ trans('admin.expense.columns.invoice_id') }}">
        <div v-if="errors.has('invoice_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('invoice_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount'), 'has-success': this.fields.amount && this.fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.expense.columns.amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount'), 'form-control-success': this.fields.amount && this.fields.amount.valid}" id="amount" name="amount" placeholder="{{ trans('admin.expense.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}</div>
    </div>
</div>


