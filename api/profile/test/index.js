//import {fetchProfile} from './fetch.js'
//import { Api } from './urls.js';

//INFO USER /////////
/*
const {email,username,nombre,foto,puesto,status} = await fetchProfile(Api,'InfoUser');
const u = document.querySelector('.profile_name');
if(u!=null){u.innerHTML=username;}
const job = document.querySelector('.job');
if(job!=null){job.innerHTML=puesto;}
*/
/////////////////////
const {host} = window.location;
const Api = (host=='localhost' || host=='localhost:9001')?'http://localhost/MisSitios/apirestm/api':'https://apirestm.herokuapp.com/api';

function apiRequestFetch(Api, endpoint, method, datos) {
    const url = `${Api}/${endpoint}`;
    let token = '68e820e111ca3c8e9a1b91146c23de3ba146d4ca';//localStorage.getItem("Token");
    const data = { ...datos, token };
    const config = (datos != null) ? {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    } : {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        }
    };
    //console.log(config);
    requestFetch = function () {
        // perform the action..
        console.log('** Cargando Datos de Perfil **');
        return fetch.apply(this, arguments);
    }
    requestFetch(url,config).then((response) => {
        return response.json();
    }).then((data) => {
        console.log(data);
    });
}

apiRequestFetch(Api, 'profile/index.php', 'POST', '');
