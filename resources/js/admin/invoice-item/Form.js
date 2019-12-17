import AppForm from '../app-components/Form/AppForm';

Vue.component('invoice-item-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                type:  '' ,
                description:  '' ,
                quantity:  '' ,
                unit_name:  '' ,
                unit_price:  '' ,
                amount:  '' ,
                invoice_id:  '' ,
                
            }
        }
    }

});