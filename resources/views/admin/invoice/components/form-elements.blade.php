<table class="table table-condensed">
    <tr>
        <td colspan="9">
            <div class="row">
                <div class="col-6">
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('invoice_type'), 'has-success': this.fields.invoice_type && this.fields.invoice_type.valid }">
                        <label for="invoice_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice.columns.type') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                                <select :disabled="mode === 'edit'" v-model="form.invoice_type" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('invoice_type'), 'form-control-success': this.fields.invoice_type && this.fields.invoice_type.valid}" id="invoice_type" name="invoice_type">
                                    <option disabled value="">Select Type</option>
                                    <option value="debit_voucher">{{ trans('admin.invoice.options.debit_voucher') }}</option>
                                    <option value="credit_voucher">{{ trans('admin.invoice.options.credit_voucher') }}</option>
                                </select>
                            <div v-if="errors.has('invoice_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('invoice_type') }}</div>
                        </div>
                    </div>
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('system_invoice_no'), 'has-success': this.fields.system_invoice_no && this.fields.system_invoice_no.valid }">
                        <label for="system_invoice_no" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice.columns.system_invoice_no') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input disabled type="text" v-model="form.system_invoice_no" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('system_invoice_no'), 'form-control-success': this.fields.system_invoice_no && this.fields.system_invoice_no.valid}" id="system_invoice_no" name="system_invoice_no" placeholder="{{ trans('admin.invoice.columns.system_invoice_no') }}">
                            <div v-if="errors.has('system_invoice_no')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('system_invoice_no') }}</div>
                        </div>
                    </div>
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_invoice_no'), 'has-success': this.fields.billing_invoice_no && this.fields.billing_invoice_no.valid }">
                        <label for="billing_invoice_no" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice.columns.billing_invoice_no') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input type="text" v-model="form.billing_invoice_no" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_invoice_no'), 'form-control-success': this.fields.billing_invoice_no && this.fields.billing_invoice_no.valid}" id="billing_invoice_no" name="billing_invoice_no" placeholder="{{ trans('admin.invoice.columns.billing_invoice_no') }}">
                            <div v-if="errors.has('billing_invoice_no')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_invoice_no') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_account_id'), 'has-success': this.fields.billing_account_id && this.fields.billing_account_id.valid }">
                        <label for="billing_account_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice.columns.billing_account_id') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                                <multiselect @input="accountChanged" v-model="form.account" placeholder="{{ trans('admin.invoice.columns.billing_account_id') }}" label="name" track-by="id" :options="accounts" :multiple="false" open-direction="bottom"  :class="{'form-control-danger': errors.has('billing_account_id'), 'form-control-success': this.fields.billing_account_id && this.fields.billing_account_id.valid}"></multiselect>
                            <div v-if="errors.has('billing_account_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_account_id') }}</div>
                        </div>
                    </div>
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_name'), 'has-success': this.fields.billing_name && this.fields.billing_name.valid }">
                        <label for="billing_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.billing-account.columns.name') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input type="text" v-model="form.billing_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_name'), 'form-control-success': this.fields.billing_name && this.fields.billing_name.valid}" id="billing_name" name="billing_name" placeholder="{{ trans('admin.billing-account.columns.name') }}">
                            <div v-if="errors.has('billing_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_name') }}</div>
                        </div>
                    </div>
                    
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_address'), 'has-success': this.fields.billing_address && this.fields.billing_address.valid }">
                        <label for="billing_address" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.billing-account.columns.address') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input type="text" v-model="form.billing_address" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_address'), 'form-control-success': this.fields.billing_address && this.fields.billing_address.valid}" id="billing_address" name="billing_address" placeholder="{{ trans('admin.billing-account.columns.address') }}">
                            <div v-if="errors.has('billing_address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address') }}</div>
                        </div>
                    </div>
                    
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_phone'), 'has-success': this.fields.billing_phone && this.fields.billing_phone.valid }">
                        <label for="billing_phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.billing-account.columns.phone') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input type="text" v-model="form.billing_phone" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_phone'), 'form-control-success': this.fields.billing_phone && this.fields.billing_phone.valid}" id="billing_phone" name="billing_phone" placeholder="{{ trans('admin.billing-account.columns.phone') }}">
                            <div v-if="errors.has('billing_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_phone') }}</div>
                        </div>
                    </div>
                    
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_email'), 'has-success': this.fields.billing_email && this.fields.billing_email.valid }">
                        <label for="billing_email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.billing-account.columns.email') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input type="text" v-model="form.billing_email" v-validate="'email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_email'), 'form-control-success': this.fields.billing_email && this.fields.billing_email.valid}" id="billing_email" name="billing_email" placeholder="{{ trans('admin.billing-account.columns.email') }}">
                            <div v-if="errors.has('billing_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_email') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <th>#</th>
        <th style="width:150px">Stock</th>
        <th>Description</th>
        <th style="width:100px">Unit Price</th>
        <th style="width:50px">Unit Name</th>
        <th style="width:50px">Quantity</th>
        <th style="width:50px">+/-</th>
        <th style="width:100px">Amount</th>
        <th>#</th>
    </tr>
    <tr v-for="(item, index) in form.invoiceItems">
    <td>@{{ item.sl_no }}</td>    
        <td>
            <select v-model="item.stock_id" class="form-control table-input">
                <option value="">No Stock</option>
            <option v-for="stock in stocks" :value="stock.id">@{{ stock.name }}</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control table-input" v-model="item.description">
        </td>
        <td>
            <input type="number" class="form-control table-input" @change="updateAmount(item)" v-model="item.unit_price">
        </td>
        <td>
            <input type="text" class="form-control table-input" v-model="item.unit_name">
        </td>
        <td>
            <input type="number" class="form-control table-input" @change="updateAmount(item)" v-model="item.quantity">
        </td>
        <td>
            <input type="text" class="form-control table-input" @change="checkSign(item)" v-model="item.type">
        </td>
        <td>
            <input type="number" class="form-control table-input" v-model="item.amount">
        </td>
        <td>
            <span class="btn-group">
                <button class="btn btn-sm btn-info" type="button" @click="addItem()">
                    <i class="fa fa-plus"></i>
                </button>
                <button class="btn btn-sm btn-danger" type="button" @click="deleteItem(index, item)">
                    <i class="fa fa-trash"></i>
                </button>
            </span>
        </td>
    </tr>
    <tr v-if="form.invoice_type === 'credit_voucher'">
        <th colspan="7">Tax</th>
        <th colspan="2">
            <input type="number" v-model="form.tax" class="form-control">
        </th>
    </tr>
    <tr v-if="form.invoice_type === 'credit_voucher'">
        <th colspan="7">Security Money</th>
        <th colspan="2">
            <input type="number" v-model="form.security_money" class="form-control">
        </th>
    </tr>
    <tr>
        <th colspan="7">Total</th>
        <th :html="total" colspan="2">@{{ total() }}</th>
    </tr>
    <tr>
        <th colspan="7">Cash</th>
        <th colspan="2">
            <input type="number" v-model="form.cash" class="form-control">
        </th>
    </tr>
    <tr>
        <th colspan="7">Due</th>
        <th colspan="2">@{{ due() }}</th>
    </tr>
    <tr>
        <td colspan="9">
            <div class="form-group row align-items-center" :class="{'has-danger': errors.has('note'), 'has-success': this.fields.note && this.fields.note.valid }">
                <label for="note" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.invoice.columns.note') }}</label>
                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                    <div>
                        <wysiwyg v-model="form.note" v-validate="''" id="note" name="note" :config="mediaWysiwygConfig"></wysiwyg>
                    </div>
                    <div v-if="errors.has('note')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('note') }}</div>
                </div>
            </div>
        </td>
    </tr>
</table>


