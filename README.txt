Para relizar las pruebas correspondientes realizar lo siguiente:

1.- Clonar este repositorio en su direccion local.
2.- Cambiar los parametros de la conexion a la BD en /Escuelas/app/config/parameters.yml
3.- Con postman ejecutar las siguientes pruebas:
	
	GET http://localhost:8080/Escuelas/web/app_dev.php/calificacion/1  --donde "1" es el id del alumno

	POST http://localhost:8080/Escuelas/web/app_dev.php/calificacion/1?materia=1&calificacion=8.5
	
	PUT http://localhost:8080/Escuelas/web/app_dev.php/calificacion/1?materia=1&calificacion=8.5
	
	DELETE http://localhost:8080/Escuelas/web/app_dev.php/calificacion/1?materia=1
