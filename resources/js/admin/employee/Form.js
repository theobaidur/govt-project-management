import AppForm from '../app-components/Form/AppForm';

Vue.component('employee-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                phone:  '' ,
                department_id:  '' ,
                employee_designation_id:  '' ,
                
            },
            mediaCollections: ['related_files']
        }
    }

});