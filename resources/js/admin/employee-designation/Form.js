import AppForm from '../app-components/Form/AppForm';

Vue.component('employee-designation-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});