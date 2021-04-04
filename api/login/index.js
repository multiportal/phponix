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
    const url = 'http://localhost/MisSitios/mandragora/api/login/index.php';
    fetch(url,{
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(datos)
    }).then(res=>res.json()).then(data=>{
        console.log(data);
        localStorage.setItem("Token", JSON.stringify(data.token));
    })
    .catch(err=>console.log(err));    
}

const getInfo = () => {
    const url = 'http://localhost/MisSitios/mandragora/api/login';
    fetch(url).then(res=>res.json()).then(data=>{
        console.log(data);
    })
    .catch(err=>console.log(err));
}

getInfo();