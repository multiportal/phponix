const {host} = window.location;
/* URL-API */
export const Api = (host!='localhost:9001')?'https://apirestm.herokuapp.com/api':'http://localhost/MisSitios/apirestm/api';
//export const Api = 'https://apirestm.herokuapp.com/api';
/* URL-LINKS */
export const api_links = Api + '/v2/links/';