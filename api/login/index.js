/* VARIABLES CONSTANTES*/
console.log('/* VARIABLES CONSTANTES*/');
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
console.log('URL='+URL);

var proyecto = 'apirestm'; //PROYECTO
//console.log('proyecto=' + proyecto);
var path_root = (host=='localhost')?'MisSitios/' + proyecto + '/':'';
//console.log('path_root='+path_root);
var page_url = dominio+path_root;
//console.log('page_url='+page_url);
var api_login = 'api/login/';
//console.log('api_login='+api_login);
var url_login = page_url+api_login;
//console.log('url_login='+url_login);

console.log('javascript funcionando');
const formulario = document.getElementById('form_login');
formulario.addEventListener('submit', btnGuardar);

function btnGuardar(e){
    e.preventDefault();
    console.log('Validación de Datos');
    let u = document.getElementById('username').value;
    let p = document.getElementById('password').value;
    //var datos = new FormData(formulario);
    var datos = {
        username: u,
        password: p
    }
    //console.log(datos);
    const url = url_login+'index.php';
    fetch(url,{
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(datos)
    }).then(res=>res.json()).then(resp=>{
        const {data} = resp;
        if(host=='localhost' || host=='localhost:9001'){console.log(resp);}
        console.log('getToken:'+data.token);
        localStorage.setItem("Token", data.token);//localStorage.setItem("Token", JSON.stringify(data.token));
        let token = localStorage.getItem("Token"); console.log('Res-Token:'+token);
        //Redireccionar al Dashboard
        if(token!=null && token!='undefined'){
            location.href= page_url + 'admin';
        }else{
            let msj = document.getElementById('msj-error');
            msj.innerHTML = `<div class="alert alert-danger" role="alert">Usuario o Contraseña Incorrectos</div>`;
        }
    })
    .catch(err=>{
        console.log(err)
        let msj = document.getElementById('msj-error');
        msj.innerHTML = `<div class="alert alert-danger" role="alert">Error:Usuario o Contraseña Incorrectos</div>`;
    });   
}

const login = () => {
    const url = url_login+'';
    fetch(url).then(res=>res.json()).then(resp=>{
        console.log(resp);
    })
    .catch(err=>console.log(err));
}

login();