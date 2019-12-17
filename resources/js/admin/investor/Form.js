import AppForm from '../app-components/Form/AppForm';

Vue.component('investor-form', {
    mixins: [AppForm],
    props: {
        projects: {type: Array, default: ()=>[]},
        users: {type: Array, default: ()=>[]}
    },
    data: function() {
        return {
            form: {
                user_id:  '' ,
                project_id:  '' ,
                enabled:  false ,
                user: null,
                project: null
            }
        }
    },
    watch:{
        'form.project'(val){
            this.form.project_id = val.id;
        },
        'form.user'(val){
            this.form.user_id = val.id;
        }
    }

});