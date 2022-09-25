/*UPLOAD FILE-MANAGER */
console.log('** javascript upload **');
/* VARIABLES CONSTANTES*/
//console.log('/* VARIABLES CONSTANTES*/');
const protocol = window.location.protocol;
//console.log('protocol='+protocol);
const host = window.location.host;
//console.log('host='+host);
const dominio = window.location.origin+'/';
//console.log('dominio='+dominio);
const dominio1 = window.location.origin;
//console.log('dominio1='+dominio1);
const path_url = window.location.pathname;
//console.log('path_url='+path_url);
const URL = window.location.href;
//console.log('URL='+URL);

var proyecto = 'apirestm'; //PROYECTO
//console.log('proyecto=' + proyecto);
var path_root = (host=='localhost')?'MisSitios/' + proyecto + '/':'';
//console.log('path_root='+path_root);
var page_url = dominio+path_root;
//console.log('page_url='+page_url);
var api_upload = 'api/upload/';
//console.log('api_upload='+api_upload);
var url_upload = page_url+api_upload;
//console.log('url_upload='+url_upload);

var email='multiportal@outlook.com';
var save = 1;
const formUpload = document.querySelector('#formUpload');//document.getElementById('formUpload');

const upLoad = (e) => {
    //console.log(e);
    const { id } = e.path[2];
    const iconUpload = document.querySelector('#' + id + ' #icon-upload');
    const urlFile = document.querySelector('#' + id + ' #urlfile');
    const nameFile = document.querySelector('#' + id + ' #namefile');
    const box = document.querySelector('#' + id + ' #mensaje');
    const img = document.querySelector('#' + id + ' #img');

    iconUpload.innerHTML = '<i class="fa-duotone fa-spinner"></i> Cargando...';//'<i class="fa-duotone fa-spinner-third"></i>';
    const file = e.target.files[0]; //console.log(file);
    const limit = 1 * 1024 * 1024;
    let { name, type, size } = file; console.log(name, type, size, limit);
    type = type.includes('image') ? 'images' : 'pdf'; //console.log(type);
    const formData = new FormData();
    formData.append("file-upload", file); //console.log(formData);
    const CLOUD_URL = url_upload+'index.php?type=' + type + '&save=' + save + '&email=' + email; //console.log(CLOUD_URL);
    const data = {
        method: "POST",
        //headers: {'Content-Type':'image/jpeg'},//headers: {'Content-Type': 'multipart/form-data','Content-Type': 'application/json'},
        body: formData
        //body: JSON.stringify(formData)
    }
    //const response = await fetch(CLOUD_URL, data);
    //const res = await response.json();console.log(res);
    fetch(CLOUD_URL, data).then(response => response.json())
        .then(res => { console.log(res);
            const { data } = res;
            console.log(data.status + ': ' + data.mensaje);
            urlFile.value = (data.status == 'Error') ? '' : data.url;
            nameFile.value = data.name;
            box.innerHTML = (data.status == 'Error') ? data.html:'';
            if (img) {img.src = data.url;}
            iconUpload.classList.remove('btn-outline-secondary');
            iconUpload.classList.remove('btn-danger');
            if (data.status == 'Error'){iconUpload.classList.add('btn-danger');}else{iconUpload.classList.add('btn-success');}
            iconUpload.innerHTML = (data.status == 'Error') ? '<i class="fa-duotone fa-circle-xmark"></i> '+data.status : '<i class="fa-duotone fa-circle-check"></i> '+data.status;
        })
        .catch(error => {
            console.error(error);
            iconUpload.classList.remove('btn-outline-secondary');
            iconUpload.classList.add('btn-danger');
            iconUpload.innerHTML = '<i class="fa-duotone fa-circle-xmark"></i> Error';
        })
}
formUpload.addEventListener('change', upLoad);
