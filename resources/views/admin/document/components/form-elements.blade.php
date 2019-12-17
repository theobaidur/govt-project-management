<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.document.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.document.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.document.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="''" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('document_category_id'), 'has-success': this.fields.document_category_id && this.fields.document_category_id.valid }">
    <label for="document_category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.document.columns.document_category_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select  v-model="form.document_category_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('document_category_id'), 'form-control-success': this.fields.document_category_id && this.fields.document_category_id.valid}" id="document_category_id" name="document_category_id">
            <option disabled value="">{{ trans('admin.document.columns.document_category_id') }}</option>
            @foreach ($documentCategories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>   
            @endforeach
        </select>
        <div v-if="errors.has('document_category_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('document_category_id') }}</div>
    </div>
</div>
@include('brackets/admin-ui::admin.includes.media-uploader', [
    'mediaCollection' => app(App\Models\Document::class)->getMediaCollection('related_files'),
    'label' => 'Related Files',
    'media' => !empty($document) ? $document->getThumbs200ForCollection('related_files') : null
])

