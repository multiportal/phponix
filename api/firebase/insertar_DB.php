<?php 
function insertar_db($data,$ramat){
$url='https://mandragorajs.firebaseio.com/'.$ramat.'.json?auth=AIzaSyBQu4aYOGHYWtT-7QcTRrOy3_H77IxYA3k';
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));//curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: text/plain'));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$response=curl_exec($ch);//echo $response[0];
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
    if($http_code!=200){
        echo '<div>Error '.$http_code.': No se creo la rama: <b>'.$ramat.'</b> </div>';
    }else{
        echo '<div>OK '.$http_code.':Se inserto la Rama: <b>'.$ramat.'</b> con exito</div>';
    }
}

$prefix = 'm_'; //PREFIJO DE TABLA

/*access */
$ramat=$prefix.'access';
$data='';
$data=array(
    '{"ID": "1","user": "admin","ip": "127.0.0.1","navegador": "CHROME","os": "WIN","code": "944950","fecha": "2021-03-20 17:22:48"}'
);
for($i=0;$i<count($data);$i++){insertar_db($data[$i],$ramat);}
echo '<div>Total de Registros: ['.$i.'] en '.$ramat.'</div>';