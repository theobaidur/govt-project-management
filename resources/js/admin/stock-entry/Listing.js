import AppListing from '../app-components/Listing/AppListing';

Vue.component('stock-entry-listing', {
    mixins: [AppListing],
    data(){
        return {
            selectedTypes: [],
            selectedStocks: [],
            filters: {
                types: [],
                stocks: []
            }
        }
    },
    watch: {
        selectedTypes: function(new_value){
            this.filters.types = new_value.map(type => type.id);
            this.filter('types', this.filters.types);
        },
        selectedStocks: function(new_value){
            this.filters.stocks = new_value.map(item => item.id);
            this.filter('stocks', this.filters.stocks);
        }
    }
});