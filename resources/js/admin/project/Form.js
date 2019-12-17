import AppForm from '../app-components/Form/AppForm';

Vue.component('project-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                amount:  '' ,
                start_date:  '' ,
                end_date:  '' ,
                department_id:  '' ,
                project_client_id:  '' ,
            },
            mediaCollections: ['related_files']
        }
    },
    methods: {
        onSuccess(data) {
			this.submiting = false;
			if (data.redirect) {
				let url = data.redirect;
				const project_id = +this.getQueryVariable('project_id');
				if(project_id !== -1){
					url = `${url}/${project_id}?project_id=${project_id}`;
				}
				window.location.replace(url);
			}
		},
    }

});