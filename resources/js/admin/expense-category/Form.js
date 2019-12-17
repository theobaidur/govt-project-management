import AppForm from '../app-components/Form/AppForm';

Vue.component('expense-category-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                
            }
        }
    }

});