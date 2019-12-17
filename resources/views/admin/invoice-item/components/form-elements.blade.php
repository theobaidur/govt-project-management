<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid }">
    <label for="type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.type" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('type'), 'form-control-success': this.fields.type && this.fields.type.valid}" id="type" name="type" placeholder="{{ trans('admin.invoice-item.columns.type') }}">
        <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.description" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('description'), 'form-control-success': this.fields.description && this.fields.description.valid}" id="description" name="description" placeholder="{{ trans('admin.invoice-item.columns.description') }}">
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
    <label for="quantity" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.quantity') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.quantity" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid}" id="quantity" name="quantity" placeholder="{{ trans('admin.invoice-item.columns.quantity') }}">
        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('unit_name'), 'has-success': this.fields.unit_name && this.fields.unit_name.valid }">
    <label for="unit_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.unit_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.unit_name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('unit_name'), 'form-control-success': this.fields.unit_name && this.fields.unit_name.valid}" id="unit_name" name="unit_name" placeholder="{{ trans('admin.invoice-item.columns.unit_name') }}">
        <div v-if="errors.has('unit_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('unit_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('unit_price'), 'has-success': this.fields.unit_price && this.fields.unit_price.valid }">
    <label for="unit_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.unit_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.unit_price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('unit_price'), 'form-control-success': this.fields.unit_price && this.fields.unit_price.valid}" id="unit_price" name="unit_price" placeholder="{{ trans('admin.invoice-item.columns.unit_price') }}">
        <div v-if="errors.has('unit_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('unit_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount'), 'has-success': this.fields.amount && this.fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount'), 'form-control-success': this.fields.amount && this.fields.amount.valid}" id="amount" name="amount" placeholder="{{ trans('admin.invoice-item.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('invoice_id'), 'has-success': this.fields.invoice_id && this.fields.invoice_id.valid }">
    <label for="invoice_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice-item.columns.invoice_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.invoice_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('invoice_id'), 'form-control-success': this.fields.invoice_id && this.fields.invoice_id.valid}" id="invoice_id" name="invoice_id" placeholder="{{ trans('admin.invoice-item.columns.invoice_id') }}">
        <div v-if="errors.has('invoice_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('invoice_id') }}</div>
    </div>
</div>


