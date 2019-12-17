<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid }">
    <label for="type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.stock-entry.columns.type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select  v-model="form.type" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('type'), 'form-control-success': this.fields.type && this.fields.type.valid}" id="type" name="type">
            <option disabled value="">{{ trans('admin.stock-entry.columns.type') }}</option>
            <option value="load">{{ trans('admin.stock-entry.options.load') }}</option>
            <option value="unload">{{ trans('admin.stock-entry.options.unload') }}</option>
        </select>
        <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
    <label for="quantity" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.stock-entry.columns.quantity') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.quantity" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid}" id="quantity" name="quantity" placeholder="{{ trans('admin.stock-entry.columns.quantity') }}">
        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
    </div>
</div>
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('unit_name'), 'has-success': this.fields.unit_name && this.fields.unit_name.valid }">
    <label for="unit_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.stock-entry.columns.unit_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.unit_name" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('unit_name'), 'form-control-success': this.fields.unit_name && this.fields.unit_name.valid}" id="unit_name" name="unit_name" placeholder="{{ trans('admin.stock-entry.columns.unit_name') }}">
        <div v-if="errors.has('unit_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('unit_name') }}</div>
    </div>
</div>
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('unit_price'), 'has-success': this.fields.unit_price && this.fields.unit_price.valid }">
    <label for="unit_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.stock-entry.columns.unit_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.unit_price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('unit_price'), 'form-control-success': this.fields.unit_price && this.fields.unit_price.valid}" id="unit_price" name="unit_price" placeholder="{{ trans('admin.stock-entry.columns.unit_price') }}">
        <div v-if="errors.has('unit_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('unit_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('stock_id'), 'has-success': this.fields.stock_id && this.fields.stock_id.valid }">
    <label for="stock_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.stock-entry.columns.stock_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select  v-model="form.stock_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('stock_id'), 'form-control-success': this.fields.stock_id && this.fields.stock_id.valid}" id="stock_id" name="stock_id">
                <option disabled value="">{{ trans('admin.stock-entry.columns.stock_id') }}</option>
                @foreach ($stocks as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>   
                @endforeach
            </select>
        <div v-if="errors.has('stock_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('stock_id') }}</div>
    </div>
</div>


