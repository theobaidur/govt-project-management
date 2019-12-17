import AppForm from '../app-components/Form/AppForm';

Vue.component('transaction-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                amount:  '' ,
                note:  '' ,
                type:  '' ,
                income_category_id:  '' ,
                expense_category_id:  '' ,
                project_id:  '' ,
            },
            mediaCollections: ['related_files']
        }
    }

});