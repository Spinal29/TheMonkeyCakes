<?php 


class conexion
{
	public $cone; 
	public $infoCliente;

	function __construct()
	{
		$this->cone = new mysqli('localhost', 'usuario', '3112', 'monkeycake');
        $this->cone-> set_charset("utf8");
	}

	public function ObtenerUsuario($Id)
	{
		 $consulta = 'select * from clientes where IDcliente ='.$Id;
         $Resultado = $this->cone->query($consulta);
        $this -> infoCliente = mysqli_fetch_assoc($Resultado);
	}

	public function ModificarUsuario($Id, $arreglo)
	{
		$consulta = 'update clientes set Nombre = "'.$arreglo['nombre'].'", Apellido = "'.$arreglo['apellido'].'", Direccion = "'.$arreglo['direc'].'", Telefono = "'.$arreglo['tel'].'" where IDcliente ='.$Id;
        $Resultado = $this->cone->query($consulta);
     }
}


?>