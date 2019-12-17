import AppListing from '../app-components/Listing/AppListing';

Vue.component('document-listing', {
    mixins: [AppListing],
    data(){
        return {
            selectedDocumentCategories: [],
            filters: {
                documentCategories: [],
            }
        }
    },
    watch: {
        selectedDocumentCategories: function(new_value){
            this.filters.documentCategories = new_value.map(item => item.id);
            this.filter('documentCategories', this.filters.documentCategories);
        }
    }
});