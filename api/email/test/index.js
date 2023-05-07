/* VARIABLES CONSTANTES*/
/*VARIABLES SYS*/
var w = window;
var d = document;
var loc = w.location;
var dt = new Date();
var day = dt.getDate();
day = (day < 10) ? '0' + day : day;
var mon = dt.getMonth() + 1;
mon = (mon < 10) ? '0' + mon : mon;
var year = dt.getFullYear();
var fecha = year + '-' + mon + '-' + day;

console.log('/* VARIABLES CONSTANTES*/');
const {protocol, host, origin, pathname, href} = loc;
//const {protocol, pathname, href} = loc; //LOCALHOST
//console.log('protocol='+protocol);
//console.log('host='+host);
const dominio = origin + '/';
//console.log('dominio='+dominio);
const dominio1 = origin;
//console.log('dominio1='+dominio1);
const path_url = pathname;
//console.log('path_url='+path_url);
const URL = href;
console.log('URL=' + URL);

var proyecto = 'apirestm'; //PROYECTO
//console.log('proyecto=' + proyecto);
var path_root = (host == 'localhost') ? 'MisSitios/' + proyecto + '/' : '';
//console.log('path_root='+path_root);
var page_url = dominio + path_root;
//console.log('page_url='+page_url);
const apiEmail = (host != 'localhost') ? 'https://apirestm.000webhostapp.com/api/email/' : page_url+'api/email/';
console.log('apiEmail='+apiEmail);

console.log('javascript funcionando');
const formulario = document.getElementById('wpforms-form-6');
if (formulario){formulario.addEventListener('submit', btnEnviar);}

function btnEnviar(e) {
    e.preventDefault();
    console.log('Preparando envio de Datos');
    let nom = document.getElementById('wpforms-6-field_2').value;
    let ape = document.getElementById('wpforms-6-field_3').value;
    let empresa = document.getElementById('wpforms-6-field_4').value;
    let email = document.getElementById('wpforms-6-field_5').value;
    let nombre = nom + ' ' + ape;

    const datos = {
        nombre,
        empresa,
        email,
        fecha
    }
    console.log(datos);
    const url = apiEmail + 'test/index.php?email='+email+'&nombre='+nombre+'&empresa='+empresa; 
    console.log(url);
    fetch(url,{
        method: 'GET',
    }).then(res => res.json()).then(resp => {
        console.log(resp);
        const {status_send} = resp; //console.log(status_send);
        if(status_send == 'ok'){
            formulario.reset();
            let divForm = document.getElementById('wpforms-6');
            divForm.innerHTML = `<div class="wpforms-confirmation-container-full wpforms-confirmation-scroll" id="wpforms-confirmation-6"><p>¡Gracias por contactarnos! Nos pondremos en contacto pronto.</p></div>`;
        }else{
            let errMsj =`<div class="wpforms-error-container"><p>No ha sido posible enviar el formulario. Por favor, contacta al administrador del sitio.</p></div>${formulario.outerHTML}`;
            console.log(errMsj);
        }
    })
    .catch(err => {
        console.log(err);
    });
}

const email = () => {
    const url = apiEmail + 'index.php';
    fetch(url,{
        method: 'GET'
    }).then(res => res.json()).then(resp => {
            console.log(resp);
    })
    .catch(err => {
        console.log(err);
    });
}

email();