<?php
	function connectMaBase()
	{
		try
		{
			$base = new PDO('mysql:host=localhost;dbname=gest_incident;charset=utf8', 'root', '');
			return $base;
		}
		catch (Exception $e)
		{
			die('Erreur de connexion a la BD : ' . $e->getMessage());
		}
	}
?>