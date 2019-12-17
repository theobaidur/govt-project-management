<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': this.fields.user_id && this.fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.investor.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.user" placeholder="{{ trans('admin.investor.columns.user_id') }}" label="email" track-by="id" :options="users" :multiple="false" open-direction="bottom"  :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': this.fields.user_id && this.fields.user_id.valid}"></multiselect>
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('investment_amount'), 'has-success': this.fields.investment_amount && this.fields.investment_amount.valid }">
    <label for="investment_amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.investor.columns.investment_amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.investment_amount" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('investment_amount'), 'form-control-success': this.fields.investment_amount && this.fields.investment_amount.valid}" id="investment_amount" name="investment_amount" placeholder="{{ trans('admin.investor.columns.investment_amount') }}">
        <div v-if="errors.has('investment_amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('investment_amount') }}</div>
    </div>
</div>


