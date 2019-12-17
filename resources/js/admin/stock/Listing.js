import AppListing from '../app-components/Listing/AppListing';

Vue.component('stock-listing', {
    mixins: [AppListing],
    data(){
        return {
            selectedProjects: [],
            filters: {
                projects: []
            }
        }
    },
    watch: {
        selectedProjects: function(new_value){
            this.filters.projects = new_value.map(item => item.id);
            this.filter('projects', this.filters.projects);
        }
    }
});