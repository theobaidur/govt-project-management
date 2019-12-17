import AppListing from '../app-components/Listing/AppListing';

Vue.component('project-listing', {
    mixins: [AppListing],
    data(){
        return {
            selectedDepartments: [],
            selectedClients: [],
            filters: {
                departments: [],
                projectClients: []
            }
        }
    },
    watch: {
        selectedDepartments: function(new_value){
            this.filters.departments = new_value.map(department => department.id);
            this.filter('departments', this.filters.departments);
        },
        selectedClients: function(new_value){
            this.filters.projectClients = new_value.map(client => client.id);
            this.filter('projectClients', this.filters.projectClients);
        }
    }
});