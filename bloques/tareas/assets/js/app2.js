// JavaScript Document
let dbTareas = localStorage.getItem('Tareas'); //Obtener datos de localStorage
dbTareas = JSON.parse(dbTareas); // Covertir a objeto
let edit = false;
let id_e = '';
console.log('Tareas');

//GUARDAR-AGREGAR/EDITAR
document.getElementById('task-form').addEventListener('submit', btnGuardar);
function btnGuardar(e){
    let id = document.getElementById('Id').value;
    let nom = document.getElementById('nom').value;
    let des = document.getElementById('des').value;
    console.log('se enviaron los datos');

    if(edit===false){
        const tarea = {
            id,
            nom,
            des
        };
        console.log(tarea);
        if(dbTareas === null){
            tareas = [];
        }else{
            tareas = dbTareas;
        }
        tareas.push(tarea);
        localStorage.setItem('Tareas', JSON.stringify(tareas));
        mensaje(0);
    }else{
        console.log(id_e);
        dbTareas[id_e] = {
            id,
            nom,
            des
        };
        console.log(dbTareas);
        localStorage.setItem('Tareas', JSON.stringify(dbTareas));
        mensaje(1);
    }

    document.getElementById('task-form').reset();
    listar();
    edit = false;
    e.preventDefault();
}

//FORM EDITAR
function btnEditar(index){
    let reg = dbTareas[index];
    console.log(reg);
    document.getElementById('Id').value=reg.id;
    document.getElementById('nom').value=reg.nom;
    document.getElementById('des').value=reg.des;

    id_e = index;
    edit = true;
}

//BORRAR
function borrar(id){
    dbTareas.forEach(function(task,index){
        if(index==id){
            dbTareas.splice(index, 1);
        }
    });
    localStorage.setItem('Tareas', JSON.stringify(dbTareas));
    listar();
    mensaje(2);
}

//LISTAR REGISTROS
function listar(){
    let content = document.getElementById('task');
    let template=''; 
    let id=0;
    dbTareas.forEach(function(task,index){
        template += `
          <tr taskId="${index}">
          <td>${task.id}</td>
          <td>
          <a href="#" class="task-item">${task.nom}</a>
          </td>
          <td>${task.des}</td>
          <td>
            <button class="task-edit btn btn-danger" onclick="btnEditar(${index});">Editar</button>
            <button class="task-delete btn btn-primary" onclick="borrar(${index});">Borrar</button>
          </td>
          </tr>`

        id = (task.id!=null)?task.id:0;
    });
    console.log('Next: '+id);
    document.getElementById('Id').value=parseInt(id)+1;
    content.innerHTML=template;
}


//FUNCIONES ESPECIALES
function mensaje(t){
    let msj = document.getElementById('container');
    switch (t) {
        case 1: //
            msj.innerHTML = '<div class="alert alert-info" role="alert">Se edito con exito.</div>';
        break;
        case 2: //
            msj.innerHTML = '<div class="alert alert-danger" role="alert">Se borro con exito.</div>';
        break;
        default:
            msj.innerHTML = '<div class="alert alert-success" role="alert">Se agrego con exito.</div>';
        break;
    }
}

function inicio(){
    if (dbTareas !== null) {
        listar();
        document.getElementById('container').innerHTML='';
    } else {
        document.getElementById('container').innerHTML='<h3> No tienes tareas </h3>';
    }
}

inicio();