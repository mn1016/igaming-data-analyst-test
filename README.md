Prueba Técnica — Data Analyst / Data Developer iGaming


#### Instrucciones para ejecutar la solución

#### Requisitos

* PHP
* MariaDB



#### Instalación

Copiar la carpeta `prueba_tecnica` localizada en la carpeta `codigo_fuente`.

Cargar a MariaDB la base de datos `prueba_tecnica.sql` localizada en la carpeta `sql`

Por default el proyecto tiene configuradas las credenciales para MariaDB

* server=localhost

* usuario: root

* contraseña: 

* puerto:3306



Si el MariaDB tiene credenciales diferentes para la base de datos de `prueba_tecnica.sql`

se pueden modificar en el código fuente en la carpeta `codigo_fuente/prueba_tecnica/conexion/conexion.php`

en la función getDatos()



###### Ejecución



 * Limpieza y normalización de datos

 	

 	- Dentro de la carpeta `prueba_tecnica/datos` ejecutar la instrucción `php procesar_archivo.php <tipo> <direccion_archivo>`



 		<tipo> es un parámetro valores permitidos users, deposits, bets, psp_report, withdrawals 



 		<direccion_archivo> es un parámetro que debe llevar la dirección del archivo a procesar



 	- Los archivos procesados se guardan en la carpeta `prueba_tecnica/data/processed`



        - Ejemplo `php procesar_archivo.php users ./archivos_originales/users.csv`





 * Pruebas unitarias	



 	- Dentro de la carpeta `prueba_tecnica/datos` ejecutar la instrucción `php test.php <funcion> <valor>`



 		<funcion> es un parámetro valores permitidos:

 			fecha_iso : Convierte el formato a fecha ISO (AAAA-MM-DDTHH:MM:SS), regresa ERROR si el valor no se reconoce como fecha.

    			decimal: Convierte el valor den decimal, regresa ERROR si no se puede convertir a número.

    			payment_method: Valida que el método de pago este en el catálogo, regresa el valor del catálogo o ERROR si no se encuentra.

    			status: Valida que el status este en el catálogo, regresa el valor del catálogo o ERROR si no se encuentra.

    			user_id: Valida que el user_id este en el catálogo, regresa el valor del catálogo o ERROR si no se encuentra.



		<valor> valor que se desea probar.



	- Ejemplo `php test.php decimal 1,234.45`

	- Ejemplo `php test.php decimal "$1, 234.45 MXN"`

	- Ejemplo `php test.php fecha\_iso "23-05-2025 04:05:03"`

	- Nota: si el valor a probar lleva espacios debe ponerse entre comillas








