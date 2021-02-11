<?php
/*
*TO CHANGE THIS LICENSE HEADER, CHOOSE LICENSE HEDERS IN PROYECT PROPERTIES
*/

class Crud {
	protected $tabla;
	protected $conexion;
	protected $wheres = "";
	protected $sql = null;

	public function __construct($tabla = null){
		$this->conexion = (new Conexion())->conectar();
		$this->tabla = $tabla;
	}

	public function get(){
		try{
			$this->sql = "SELECT * FROM {$this->tabla} {$this->wheres}";
			$sth = $this->conexion->prepare($this->sql);
			$sth->execute();
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}catch (Exception $exc){
			echo $exc->getTraceAsString();
		}
	}

	public function insert($obj){
		try {
			$campos = implode("`, `", array_keys($obj));
			$valores = ":" . implode(", :", array_keys($obj));
			$this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})";
			$this->ejecutar($obj);
			$id = $this->conexion->lastInsertId();
			return $id;
		}catch (Exception $exc){
			echo $exc->getTraceAsString();
		}
	}

	public function update($obj){
		try{
			$campos = "";
			foreach($obj as $llave => $valor){
				$campos .= "`$llave=:$llave,";
			}
			$campos = rtrim($campos, ",");
			$this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";
			$filesAfectadas = $this->ejecutar();
			return $filesAfectadas;
		}catch(Exception $exc){
			echo $exc->getTraceAsString();
		}
	}

	public function delete(){
		try{
			$this->sql = "DELETE FROM {$this->tabla} {$this->wheres}";
			$filesAfectadas = $this->ejecutar();
		}catch(Exception $exc){
			echo $exc->getTraceAsString();
		}	
	}

	public function where($llave, $condicion, $valor){
		$this->wheres .= (strpos($this>wheres, "WHERE"))?" AND ":" WHERE ";
	}

	public function ejecutar($obj = null){
		$sth = $this->conexion->prepare($this->sql);
		if($obj!=null){
			foreach($obj as $llave => $valor){
				if(empty($valor)){
					$valor = NULL;
				}
				$sth->bindValue(":$llave", $valor);
			}
		}
		$sth->execute();
		$this->reiniciarValores();
		return $sth->rowCount();
	}

	private function reiniciarValores(){
		$this->wheres = "";
		$this->sql = null;
	}
}