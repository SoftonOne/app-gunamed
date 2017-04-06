<?php

	$conexion = new mysqli("localhost", "venta", "root", "");
	
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
