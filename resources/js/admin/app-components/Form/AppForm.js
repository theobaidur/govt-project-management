import { BaseForm } from 'craftable';
import CommonMethod from '../common-method';

export default {
	mixins: [BaseForm],
	props: {
		mode: {
			type: String,
            default: ''
		}
	},
	methods: {
		onSuccess(data) {
			this.submiting = false;
			if (data.redirect) {
				let url = data.redirect;
				const project_id = this.getQueryVariable('project_id');
				if(project_id){
					url = `${url}?project_id=${project_id}`;
				}
				window.location.replace(url);
			}
		},
		beforePost(form){
			return form;
		},
		getPostData() {
			if (this.mediaCollections) {
				this.mediaCollections.forEach((collection, index, arr) => {
				if (this.form[collection]) {
					console.warn(
					"MediaUploader warning: Media input must have a unique name, '" +
						collection +
						"' is already defined in regular inputs."
					);
				}
		
				if (this.$refs[collection + '_uploader']) {
					this.form[collection] = this.$refs[
					collection + '_uploader'
					].getFiles();
				}
				});
			}
			this.form['wysiwygMedia'] = this.wysiwygMedia;
			const project_id = this.getQueryVariable('project_id');
			if(project_id){
				this.form['project_id'] = project_id;
			}
			return this.beforePost(this.form);
		},
		...CommonMethod
	}
};