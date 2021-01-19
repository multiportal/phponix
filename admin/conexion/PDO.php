<?php
//use PDO;
class Conexion {
    private $_driver;
    private $_host;
    private $_user;
    private $_pass;
    private $_dbname;
    private $_port;
    private $_charset;
    private $_conexion; /* private $conexion */

    public function __construct(){
		
	}
	
	public function conectar(){
        $archivo = __DIR__ . "/../.env";
        $env = parse_ini_file($archivo, true);
        $sys = $env['Sistema'];
        $conf = $env['Conexion'];
        $mail = $env['Email'];

        $this->_driver = $conf['driver'];
        $this->_host = $conf['host'];
        $this->_user = $conf['username'];
        $this->_pass = $conf['password'];
        $this->_dbname = $conf['database'];
        $this->_port = $conf['port'];
        $this->_charset = $conf['charset'];

        if($this->_driver=='mssql'){//"odbc:Driver={SQL Server};Server=$hostname;Database=$dbname"
            $con = "odbc:Driver={SQL Server};Server=$this->_host, $this->_port;Database=$this->_dbname";
        }
        if($this->_driver=='mysql'){
            $con = "$this->_driver:host=$this->_host:$this->_port;dbname=$this->_dbname;charset=$this->_charset";
        }
        try {
            $this->_conexion = new PDO($con, $this->_user, $this->_pass);
            $this->_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo '<div class="alert alert-success">CONECTADO</div>';
			return $this->_conexion; 
        }catch(PDOException $e){
            $er = "Conexion Fallida: " . $e->getMessage();
            echo '<div class="alert alert-danger">ERROR: NO SE PUDO CONECTAR ['.$er.']</div>';            
        }
    }
}

//Variables de Conexion
$conexion = new Conexion();
$conec = $conexion->conectar();
$DBprefix = 'man_';
