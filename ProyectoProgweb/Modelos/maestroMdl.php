<?php

class maestroMdl{
	public $driver;
	
	function __construct(){
		require_once('DataBase.php');
		$this -> driver = DataBase::getInstance();
	}

	function procesarResultado($r){

		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;
	}
	
	function altaCurso($ciclo, $materia, $seccion, $nrc, $codigo){
		$query =
			"INSERT INTO 
			curso(idCurso, idMateria, seccion, NRC, idCiclo, codigo)
		  	VALUES('0','$materia','$seccion','$nrc','$ciclo','$codigo')";
		return $r = $this -> driver -> query($query);
	}

	function getIdCurso(){
		$query= "SELECT MAX(idCurso) as idCurso from curso";
		$r = $this -> driver -> query($query);

		$rows = $this -> procesarResultado($r);
		$rows=$rows[0];
		return $rows['idCurso'];
	}

	function horarioCurso($idCurso, $hora1, $hora2, $dia){
		$query = "INSERT INTO
			horariocurso(idHorario, dia, horaIni, horaFin, idCurso)
			VALUES('0','$dia','$hora1','$hora2','$idCurso')";
			$this -> driver -> query($query);
	}

	function criterioCurso($idCurso, $criterio, $pts){
		$query = "INSERT INTO
			criterio(idCriterio, idCurso, nombre, porcentaje)
			VALUES('0','$idCurso','$criterio','$pts')";
			$this -> driver -> query($query);
	}

	function listaCurso($codigo){
		$query = "SELECT c.idCurso, c.seccion,c.idCiclo ,c.NRC,m.nombre  FROM curso c, materia m where c.idMateria=m.idMateria and c.codigo='$codigo'";
		$r = $this -> driver -> query($query);

		if($r->num_rows==0)
			return false;
		
		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;
	}

	function eliminarCurso($idCurso){
		$query =" DELETE FROM curso WHERE idCurso='$idCurso' ";
		return $r= $this -> driver -> query($query);
	}

	function altaAlumno($contrasena, $nombre, $apellidop, $apellidom, $carrera, $correo, $status, $celular, $github, $webpage){
		$query =
			"INSERT INTO
			alumno(codigo, contrasena, nombre, apellidoP, apellidoM, carrera, correo, status, Github, celular, WebPage)
			VALUES('0', '$contrasena', '$nombre', '$apellidop', '$apellidom', '$carrera', '$correo', '$status', '$github', '$celular', '$webpage')";
		
		$r=$this -> driver -> query($query);
		if ($r==false)
			return false;

		$r = $this -> driver -> query("SELECT MAX(codigo) as codigo from alumno");

		$rows = $this -> procesarResultado($r);
		$rows=$rows[0];
		return $rows['codigo'];
	}

	function listaAlumno(){
		//echo "<br>debug: Entro a la alta del alumno en el modelo";
		$query = 'SELECT * FROM alumno';

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;
	}

	function eliminarAlumno($codigo){
		$query="DELETE FROM alumno WHERE codigo='$codigo' ";
		return $r = $this -> driver -> query($query);
	}

	function listaCiclos(){
		$query = 'SELECT * FROM ciclo';

		$r = $this -> driver -> query($query);
		return $rows=$this->procesarResultado($r);
	}

	function listaAcademia(){
		$query = 'SELECT * FROM academia';

		$r = $this -> driver -> query($query);
		return $rows=$this->procesarResultado($r);
	}
	
	function listaMateria($idMateria){
		$query = "SELECT nombre FROM materia WHERE idMateria = '$idMateria'";
		$r = $this -> driver -> query($query);
		return $r -> fetch_assoc();
	}

	function listaMatriculados($idMateria){

		$query = "SELECT a.codigo, a.nombre, a.apellidoP, a.apellidoM FROM alumno a, matriculado m WHERE m.idCurso = '$idMateria' and a.codigo = m.codigo";
		$r = $this -> driver -> query($query);
		return $r -> fetch_assoc();
	}

}

?>