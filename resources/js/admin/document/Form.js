import AppForm from '../app-components/Form/AppForm';

Vue.component('document-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                document_category_id:  '' ,
            },
            mediaCollections: ['related_files']
        }
    }

});