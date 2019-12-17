export default {
    getQueryVariable(variable) {
        const query = window.location.search.substring(1);
        const vars = query.split('&');
        for (let i = 0; i < vars.length; i++) {
            const pair = vars[i].split('=');
            if (decodeURIComponent(pair[0]) == variable) {
                return decodeURIComponent(pair[1]);
            }
        }
        console.log('Query variable %s not found', variable);
    },
    _url(url, id = null){
        const project_id = id || this.getQueryVariable('project_id');
        if(project_id){
            return `${url}?project_id=${project_id}`;
        }
        return url;
    }
}