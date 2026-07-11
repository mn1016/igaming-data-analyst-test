# Prueba Técnica — Data Analyst / Data Developer iGaming



## Parte 5 — Reporte ejecutivo



##### **1. ¿Qué métodos de pago tienen mejor desempeño?**



###### El método de pago más efectivo es OXXO, con $27,801.11 que representa 28.97% del monto total de depósitos. 

###### Y el segundo más utilizado con 32 depósitos que representan el 24.24%



**Método de pago	Monto total	%	Número de depósitos	%**

OXXO		$27,801.11	28.97%		32		24.24%

CARD		$23,993.25	25.00%		38		28.79%

CRYPTO		$14,748.58	15.37%		25		18.94%

WALLET		$13,866.03	14.45%		14		10.61%

SPEI		$11,657.48	12.15%		10		7.58%

UNKNOWN		$3,891.38	4.06%		13		9.85%





##### **2. ¿Dónde hay problemas de conciliación?**



###### El principal problema de conciliación de depositos es la diferencia en el status "STATUS\_MISMATCH" con 172 registros que representa el 46.74% del total de registros.

###### El segundo problema es "MISSING\_IN\_PSP", "no se encuentran los registros en el reporte externo", con 112 registros, es decir el 30.43%.



**Tipo de diferencia	Registros	%**

OK 			60		16.30%

STATUS\_MISMATCH		172		46.74%

MISSING\_IN\_PSP		112		30.43%

MISSING\_INTERNAL	15		4.08%

AMOUNT\_MISMATCH		9		2.45%





##### **3. ¿Qué usuarios o segmentos atenderías primero?**

###### Todos los segmentos son importantes, atendería primero a los que están en riesgo "AT\_RISK" enviándoles campañas de recuperación personalizadas.



**Categoría	%		Usuarios**

VIP		11.11%		16

ACTIVE		52.78%		76

AT\_RISK		10.42%		15

NEW		25.69%		37





##### **4. ¿Qué métrica revisarías diariamente como CTO/CEO?**



###### **Para el negocio**

&#x20;  \*El estado de pérdidas y ganancias ya que es el indicador donde se refleja el resultado final de la actividad de la empresa.

&#x20;  \*La tasa de conversión de usuarios registrados con al menos un depósito es muy útil para conocer que tan atractiva es la plataforma y los servicios que ofrece.

&#x20;  \*Tasa de abandono de usuarios.

&#x20;  \*Usuarios nuevos registrados por mes. 



###### **Para la operación**

&#x20;  \*La tasa de depósitos fallidos y exitosos en general y por método de pago, para detectar fallas en los sistemas.

&#x20;  \*La tasa de retiros fallidos y exitosos

&#x20;  \*La tasa de apuestas perdidas y ganadas.

&#x20;  \*Disponibilidad de la plataforma al mes.









##### **5. ¿Qué mejorarías del dataset o del proceso?**



###### Deberían crearse procesos automáticos para la extracción y transformación de la información de las diferentes fuentes de datos.



###### A la par trabajar una plataforma para la visualización en tiempo real de los reportes e indicadores, que sea accesible desde cualquier dispositivo en cualquier momento y que proporcione información útil para la toma de decisiones.





























