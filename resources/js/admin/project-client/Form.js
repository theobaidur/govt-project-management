import AppForm from '../app-components/Form/AppForm';

Vue.component('project-client-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                phone:  '' ,
                description:  '' ,
                
            }
        }
    }

});