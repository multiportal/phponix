<?php 
function insertar_db($data,$ramat){
$url='https://mandragorajs.firebaseio.com/'.$ramat.'.json';
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: text/plain'));

$response=curl_exec($ch);
//echo $response[0];
    if(curl_errno($ch)){
        echo 'Error:'.curl_errno($ch);
    }else{
        echo '<div>Se inserto con exito</div>';
    }
}
/*
$ramat='m_config';
$data='{"ID":"1","logo":"logo.min.png","page_name":"MANDRAGORA","title":"Mandragora CMS - El mejor CMS para crear y administrar tu sitio web. Gestor de contenido web.","dominio":"http:\/\/localhost\/","path_root":"\/MisSitios\/phponix.dev","page_url":"http:\/\/localhost\/MisSitios\/phponix.dev\/","keyword":"cms,contenido,web,landingpage,página web","description":"PHP Onix es un CMS gestor de contenidos para tu web.","metas":"\r\n\r\n\r\n\r\n\r\n\r\n\r\n","g_analytics":"","tel":"(01)4426002842","phone":"","wapp":"4426002842","webMail":"multiportal@outlook.com","contactMail":"multiportal@outlook.com","mode":"page","chartset":"iso-8859-1","dboard":"dashboard","dboard2":"AdminLTE","direc":"Centro, Santiago de Querétaro, México","CoR":"multiportal@outlook.com","CoE":"phponix@webcindario.com","BCC":"","CoP":"memojl08@gmail.com","fb":"https:\/\/facebook.com\/","tw":"https:\/\/twitter.com\/","gp":"","lk":"","yt":"","ins":"","wv":"","licencia":"cms-px31q2hponix31q2x.admx31q2in458x31q2x.202x31q24.05.x31q212.01x31q2.2.6.x31q26x31q2","version":"01.2.8.0"}';
insertar_db($data,$ramat);

$ramat='m_temas';
$data='{"ID":"1","tema":"default","subtema":"","selec":"1","nivel":"0"}';
insertar_db($data,$ramat);
$data='{"ID":"2","tema":"man","subtema":"","selec":"0","nivel":"0"}';
insertar_db($data,$ramat);

$ramat='m_modulos';
$data='{"ID":"1","nombre":"admin","modulo":"admin","description":"","dashboard":"0","nivel":"0","home":"0","visible":"0","activo":"0","sname":"false","icono":"","link":""}';
insertar_db($data,$ramat);
$data='{"ID":"2","nombre":"Dashboard","modulo":"dashboard","description":"","dashboard":"1","nivel":"-1","home":"0","visible":"0","activo":"1","sname":"false","icono":"","link":"index.php?mod=dashboard"}';
insertar_db($data,$ramat);
$data='{"ID":"3","nombre":"Home","modulo":"Home","description":"Administración y gestión del Home.","dashboard":"0","nivel":"0","home":"1","visible":"1","activo":"1","sname":"false","icono":"fa-home","link":"index.php?mod=Home"}';
insertar_db($data,$ramat);
*/

/*
$ramat='m_menu_web';
$data='{"ID":"1","menu":"Inicio","url":"index.php","modulo":"Home/","ext":"","ord":"1","subm":"","ima_top":"gris.png","tit_sec":"","des_sec":"","visible":"1"}';
insertar_db($data,$ramat);
$data='{"ID":"2","menu":"Nosotros","url":"#","modulo":"nosotros/","ext":"","ord":"2","subm":"","ima_top":"gris.png","tit_sec":"","des_sec":"","visible":"0"}';
insertar_db($data,$ramat);
$data='{"ID":"3","menu":"Productos","url":"productos/","modulo":"productos","ext":"","ord":"3","subm":"","ima_top":"","tit_sec":"","des_sec":"","visible":"0"}';
insertar_db($data,$ramat);
$data='{"ID":"4","menu":"Blog","url":"blog/","modulo":"blog","ext":"","ord":"4","subm":"","ima_top":"gris.png","tit_sec":"","des_sec":"","visible":"1"}';
insertar_db($data,$ramat);
$data='{"ID":"5","menu":"Contacto","url":"contacto/","modulo":"contacto","ext":"","ord":"5","subm":"","ima_top":"","tit_sec":"","des_sec":"","visible":"1"}';
insertar_db($data,$ramat);
*/

$ramat='m_access';
$data='{"ID":"1","user":"admin","ip":"127.0.0.1","navegador":"CHROME","os":"WIN","code":"944950","fecha":"2019-06-06 03:35:27"}';
insertar_db($data,$ramat);