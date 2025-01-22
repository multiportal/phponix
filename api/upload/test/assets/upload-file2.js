/*UPLOAD FILE-MANAGER */
console.log('** javascript upload **');
/* VARIABLES CONSTANTES*/
//console.log('/* VARIABLES CONSTANTES*/');
const {protocol, host, origin, pathname} = window.location;
//console.log('protocol='+protocol);
//console.log('host='+host);
const dominio = origin + '/';
//console.log('dominio='+dominio);
//const dominio1 = origin;
//console.log('dominio1='+dominio1);
const path_url = pathname;
//console.log('path_url='+path_url);
const URL = window.location.href;
//console.log('URL='+URL);
/** CONFIG **/
const proyecto = 'phponix'; //PROYECTO
const activeApi = true;//Activar API
const activeLocal = true;//Local
const save = 0;// [0 => 'Guardar en Servidor',1 => 'Guardar en base de datos', 2 => 'Guardar en servidor y en base de datos.']; 
const email='multiportal@outlook.com';
/***********/
const api = activeApi ? 'api/':'';
const inc = activeLocal ? 'files/':'';
const apiLog = activeApi ? 'Api: Activada':'Api: Desactivada';
const saveLog = ['Guardar en Servidor','Guardar en base de datos','Guardar en servidor y en base de datos.'];
/***********/
var path_root = (host=='localhost')?'MisSitios/' + proyecto + '/':'';
//console.log('path_root='+path_root);
var page_url = dominio+path_root;
console.log('page_url='+page_url);
var api_upload = api+'upload/'+inc;
//console.log('api_upload='+api_upload);
var url_upload = page_url+api_upload;
console.log('url_upload='+url_upload);
console.log('*** CONFIGURACION '+proyecto+' ***',apiLog,'Modo: '+saveLog[save]);
if(save>0 && activeLocal){console.warn('PRECAUCION: La configuración actual no va funcionar.');}
const formUpload = document.querySelector('#formUpload');//document.getElementById('formUpload');
const upLoad = (e) => {
    console.log(e);
    const tar = e.srcElement.parentElement.parentElement; console.log(tar);
    const { id } = tar;//e.path[2];
    const iconUpload = document.querySelector('#' + id + ' #icon-upload');
    const urlFile = document.querySelector('#' + id + ' #urlfile');
    const nameFile = document.querySelector('#' + id + ' #namefile');
    const box = document.querySelector('#' + id + ' #mensaje');
    const img = document.querySelector('#' + id + ' #img');

    iconUpload.innerHTML = '<i class="fa-duotone fa-spinner"></i> Cargando...';//'<i class="fa-duotone fa-spinner-third"></i>';
    const file = e.target.files[0]; //console.log(file);
    const maxSize = 1; //MB
    const limit = maxSize * 1024 * 1024;
    let { name, type, size } = file; console.log(name, type, size, limit);
    type = type.includes('image') ? 'images' : 'pdf'; //console.log(type);
    const formData = new FormData();
    formData.append("file", file); //console.log(formData);
    const CLOUD_URL = url_upload+'index.php?type=' + type + '&blob=0' + (save>=0 ? '&save='+save:'') + (email ? '&email='+email:'') + (proyecto ? '&proyecto='+proyecto+'/'+api:''); //console.log(CLOUD_URL);
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
