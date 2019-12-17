import AppListing from '../app-components/Listing/AppListing';

Vue.component('transaction-listing', {
    mixins: [AppListing],
    data(){
        return {
            selectedTypes: [],
            selectedProjects: [],
            selectedExpenseCategories: [],
            selectedIncomeCategories: [],
            filters: {
                types: [],
                projects: [],
                expenseCategories: [],
                incomeCategories: [],
            }
        }
    },
    watch: {
        selectedTypes: function(new_value){
            this.filters.types = new_value.map(type => type.id);
            this.filter('types', this.filters.types);
        },
        selectedProjects: function(new_value){
            this.filters.projects = new_value.map(item => item.id);
            this.filter('projects', this.filters.projects);
        },
        selectedExpenseCategories: function(new_value){
            this.filters.expenseCategories = new_value.map(item => item.id);
            this.filter('expenseCategories', this.filters.expenseCategories);
        },
        selectedIncomeCategories: function(new_value){
            this.filters.incomeCategories = new_value.map(item => item.id);
            this.filter('incomeCategories', this.filters.incomeCategories);
        }
    }
});