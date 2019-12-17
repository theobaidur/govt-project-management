import AppForm from '../app-components/Form/AppForm';

Vue.component('billing-account-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                address:  '' ,
                phone:  '' ,
                email:  '' ,
                
            }
        }
    }

});