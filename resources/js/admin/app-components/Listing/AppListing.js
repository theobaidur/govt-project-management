import { BaseListing } from 'craftable';
import CommonMethod from '../common-method';
export default {
	mixins: [BaseListing],
	filters: {
		valueOrDefault: function(obj, relation, prop, default_prop){
			if(obj && obj[relation] && obj[relation][prop]){
				return obj[relation][prop];
			}
			return default_prop;
		}
	},
	methods: {
		print(){
			window.print();
		},
		loadData (resetCurrentPage) {
            let options = {
                params: {
                    per_page: this.pagination.state.per_page,
                    page: this.pagination.state.current_page,
                    orderBy: this.orderBy.column,
                    orderDirection: this.orderBy.direction,
                }
			};
			
			const project_id = this.getQueryVariable('project_id');
			if(project_id){
				options.params.project_id = project_id;
			}

            if (resetCurrentPage === true) {
                options.params.page = 1;
            }

            Object.assign(options.params, this.filters);

            axios.get(this.url, options).then(response => this.populateCurrentStateAndData(response.data.data), error => {
                // TODO handle error
            });
		},
		...CommonMethod
	},
	created(){
		console.log(this);
	}
};