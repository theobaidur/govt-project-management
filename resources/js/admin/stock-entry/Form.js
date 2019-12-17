import AppForm from '../app-components/Form/AppForm';

Vue.component('stock-entry-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                type:  '' ,
                unit:  '' ,
                unit_price:  '' ,
                stock_id:  '' ,
                
            }
        }
    }

});