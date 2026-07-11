Prueba Técnica — Data Analyst / Data Developer iGaming


############ Parte 4 — Segmentación de usuarios ############

Para la segmentación de usaron 3 dimensiones recencia, frecuencia y monto; se definió una escala de puntos del 1 al 4 de la siguiente manera:

* Recencia
	- Última apuesta hace menos de 10 días- 4 puntos
	- Última apuesta hace menos de 90 días- 3 puntos
	- Última apuesta hace menos de 180 días- 2 puntos
	- Última apuesta hace más de 180 días - 1 puntos
	- Sin apuestas - 0 puntos

* Frecuencia 
	- 8 o más apuestas en los últimos 90 días - 4 puntos
	- De 5 a 7 apuestas en los últimos 90 días - 3 puntos
	- De 2 a 4 apuestas en los últimos 90 días - 2 puntos
	- Menos de 2  apuesta en los últimos 90 días - 1 puntos
	- Sin apuestas en los últimos 90 días - 0 puntos

* Monto 
	- Más $2,000 apostado en los últimos 90 días - 4 puntos
	- De $500 a $2,000 apostado en los últimos 90 días - 3 puntos
	- De $100 a $500 apostado en los últimos 90 días - 2 puntos
	- Menos de $100 apostado en los últimos 90 días - 1 puntos
	- Sin apuestas en los últimos 90 días - 0 puntos

Se sumaron los puntos obtenidos en cada dimensión y se clasificaron los clientes en:

	- Más de 10 - VIP
   	- De 7 a 9 - ACTIVE
   	- De 4 a 8 - AT_RISK
	- De 0 a 3 - DORMANT
	- NEW si se registro en los últimos 30 días sin importar el puntaje obtenido






















	
