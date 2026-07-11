Prueba Técnica — Data Analyst / Data Developer iGaming



\############ Parte 1 — Limpieza y normalización de datos ###########



Archivo users.csv

* Hay registros con el valor de status vacío,
para algunos reportes utilice todos los usuarios ya que aunque actualmente estén inactivos y/o tengan un error en el status,
en el momento de realizar: un deposito, apuesta o retiro el usuario debió estar activo.



Archivo deposits.csv

* Hay montos que están vacíos y otros que son igual a cero, los iguale a cero pero están identificados
* Hay registros con status y métodos de pago vacío los clasifique como "UNKNOWN"
* Hay fechas de confirmación vacía, están identificadas. Las use para los reportes pero están identificadas.
* 

Archivo bets.csv

* Hay bet\_amount negativos, no se que significa, si sea un error que se tiene que limpiar o tenga otro uso.
* Los bet\_amount negativos los utilice para los reportes tomando el valor absoluto
* Los bet\_amount aparecen negativos en los archivos limpios, aunque en los reportes se use el valor absoluto.
* Hay user\_id que no aparecen en el catálogo, por ejemplo USER ID Desconocido U1069, están identificados en la tabla los registros.
* Los depósitos con user\_id desconocidos se utilizaron para los reportes, pero se debe revisar si faltan registros en el catálogo de usuarios o si es un error del sistema de depósitos ya que es muy difícil que no exista a menos que el usuario escriba su id de forma manual o los CSV hayan sido alterados.



Archivo bets.csv

* Hay user\_id que no aparecen en el catálogo, por ejemplo USER ID Desconocido U1069, están identificados en la tabla los registros.





\#############  Reglas de limpieza   ##############



* Conversión a decimal
-Eliminar espacios vacíos, comas, signos de peso, "MXN" y error.
-Si el número es igual a vacío ce regresa un cero.
-Se valida que la cadena solo tenga números, puntos o signos negativos o positivo.
-Se devuelve el valor.



* Validar estatus de users
-Se convirtió el texto a mayúsculas.
-Los estatus permitidos son Active e INACTIVE.
-Estatus INACTIVO se convirtió a INACTIVE.
-Estatus ACTIVO se convirtió a ACTIVE.
-Cualquier otro valor se registro como ERROR, estatus desconocido.



* Validar estados (geográficos)
-Se convirtieron en mayúsculas.
-Se quitaron los acentos.



* Validación de catálogos status, payment\_method y users.
-Se realizó con una función php, se crearon tablas en MySQL con los catálogos normalizados.
-Se válido que existieran los valores en los catálogos.
-Para el catálogo de status se reemplazaron los valores SUCCESS y PAID por SUCCESSFUL; REJECTED por FAILED; cualquier otro valor se reemplazó por UNKNOW.
-PAra el catálogo de payment\_method se remplazó TARJETA por CARD; BITSO por CRYPTO; cualquier otro valor por ERROR, Método de pago fuera del catálogo.



* Validación de fechas
-Se normalizaron al formato ISO "AAAA-MM-DDTHH:MM:SS"
-Las fechas de no se pudieron normalizar se llenaron con el valor ERROR, no se reconoce el formato de fecha.
-Las fechas que no tenían hora se llenaron con 00:00:00

