import AppListing from '../app-components/Listing/AppListing';

Vue.component('employee-listing', {
    mixins: [AppListing],
    data(){
        return {
            selectedDepartments: [],
            selectedEmployeeDesignations: [],
            filters: {
                departments: [],
                employeeDesignations: []
            }
        }
    },
    watch: {
        selectedDepartments: function(new_value){
            this.filters.departments = new_value.map(department => department.id);
            this.filter('departments', this.filters.departments);
        },
        selectedEmployeeDesignations: function(new_value){
            this.filters.employeeDesignations = new_value.map(item => item.id);
            this.filter('employeeDesignations', this.filters.employeeDesignations);
        }
    }
});