
######### CONSULTAS MARIADB ############

### Hay conceptos especifícos del negocio que pueden interpretarse de una u otra manera dependiendo de las necesidades de cada empresa
### Cada consulta específica los criterios y la interpretación sin conocer las reglas del negocio, el funcionamiento de los sitemas administrativos o el flujo de información del negocio.


# 1. Depósitos exitosos por día y método de pago.
# Depositos de usuarios que no existen en el catálogo de usuarios.

select date(A.created_at) fecha,
				A.payment_method,
				sum(A.amount) total, 
				count(*) num_depositos
from m_deposits_auditado A
	where A.status="SUCCESSFUL"
group by date(A.created_at),A.payment_method






#2. FTD semanal: usuarios cuyo primer depósito exitoso ocurrió en cada semana.
# Depositos de usuarios que no existen en el catálogo de usuarios
# Entiendo que tengo que obtener la semana en que el usuario realizo su primer deposito en la plataforma y generar un reporte por semana

select B.semana_primer_deposito,count(*) num_usuarios
from (
	select A.user_id,
		min(date(A.created_at)) primer_deposito,
		week(min(date(A.created_at)))semana_primer_deposito,
		count(*) depositos_exitosos
	from m_deposits_auditado A
		where A.status="SUCCESSFUL"
	group by A.user_id
	order by primer_deposito
) B
group by B.semana_primer_deposito







#3. Conversión de usuarios registrados a usuarios con al menos un depósito exitoso.
# Depositos de usuarios que no existen en el catálogo de usuarios
# Usuarios activos, inactivos y sin estatus
# Entiendo que en este punto se entrega un indicador, una cifra, no es como tal un reporte o una tabla

select usuarios_con_deposito,
	total_usuarios,
	usuarios_con_deposito/total_usuarios*100 conversion
from (
	select count(distinct A.user_id)usuarios_con_deposito
	from m_deposits_auditado A
	where A.status="SUCCESSFUL" 
) X
inner join
(
	select count(A.user_id) total_usuarios
	from c_users A
)Y








#4. Top 10 usuarios por monto total apostado.
# Apuestas de usuarios que no existen en el catálogo de usuarios
# El monto de la apuesta se suma independientemente del signo

select 
	A.user_id,
	B.name,
	sum(abs(A.bet_amount)) monto_total_apostado
from m_bets_auditado A
	left join c_users B on A.user_id=B.user_id
group by A.user_id
order by monto_total_apostado desc limit 10













#5. Usuarios que perdieron más de $200 MXN en los últimos 7 días del dataset (2026-07-05).
# Apuestas de usuarios que no existen en el catálogo de usuarios
# El monto de la apuesta se suma independientemente del signo
# Utilice la fecha del último registro no la fecha actual para contar los 7 días
# Para este reporte filtre los estatus "LOST" y "LOSS" que son las apuestas perdidas para el usuario

select 
	A.user_id, 
	B.name,
	sum(abs(A.bet_amount))monto_perdido
from m_bets_auditado A
	left join c_users B on A.user_id=B.user_id
where datediff( date(now()),date("2026-07-05"))<=7
	and A.result in ("LOSS","LOST")
group by A.user_id
having monto_perdido>=200
order by monto_perdido desc











#6. Usuarios con más de 14 días sin depositar, pero con actividad previa.
# Depositos de usuarios que no existen en el catálogo de usuarios


	select 
		B.user_id,
		C.name,
		min(datediff( date("2026-07-05"),date(B.created_at))) dias_ultimo_deposito,
		count(*) num_depositos
	from m_deposits_auditado B
	left join c_users C on B.user_id=C.user_id
	group by B.user_id
	having dias_ultimo_deposito>14 and num_depositos>1
	order by dias_ultimo_deposito 
	












# 7. Método de depósito más frecuente por usuario.
# Depósitos de usuarios que no existen en el catálogo de usuarios
# Sin tomar en cuenta si son depositos SUCCESSFUL.
# Algunos usuarios tienen más de un método frecuente, coloqué todos los métodos y las veces que se utilizó

select X.user_id,Z.name,group_concat(concat(Y.payment_method," (",Y.num_depositos,")"))metodo_pago 
from (

		select A.user_id, max(num_depositos) mas_frecuente 
			from (
				select B.user_id,B.payment_method,count(*) num_depositos
				from m_deposits_auditado B
				group by B.user_id,B.payment_method
			) A
		group by A.user_id 
		
) X
inner join (

		select B.user_id,B.payment_method,count(*) num_depositos
		from m_deposits_auditado B
		group by B.user_id,B.payment_method 
		
) Y on Y.user_id=X.user_id and Y.num_depositos=X.mas_frecuente
left join c_users Z on Z.user_id=X.user_id
group by X.user_id













#8. Tasa de depósitos fallidos por método de pago.
# Depósitos de usuarios que no existen en el catálogo de usuarios

select B.payment_method,
sum(if(B.status="FAILED",1,0))FAILED,
sum(if(B.status="FAILED",1,0))/count(*)*100 TASA_FAILED,
sum(if(B.status="SUCCESSFUL",1,0))SUCCESSFUL,
sum(if(B.status="SUCCESSFUL",1,0))/count(*)*100 TASA_SUCCESSFUL,
sum(if(B.status="PENDING",1,0))PENDING,
sum(if(B.status="PENDING",1,0))/count(*)*100 TASA_PENDING,
sum(if(B.status="UNKNOWN",1,0))UNKNOWN,
sum(if(B.status="UNKNOWN",1,0))/count(*)*100 TASA_UNKNOWN,
count(*)TOTAL
from m_deposits_auditado B
group by B.payment_method















#9. Depósitos duplicados por `external_transaction_id`.
# Depósitos de usuarios que no existen en el catálogo de usuarios

select external_transaction_id, count(*)repetidos
	from m_deposits_auditado
group by external_transaction_id
having repetidos > 1











# 10 (Versión A). Usuarios con depósito exitoso pero sin apuestas posteriores.
# Depósitos de usuarios que no existen en el catálogo de usuarios
# Usuarios con depósitos pero que NUNCA han apostado

select A.user_id,A.status,B.user_id apuesta, C.name
	from m_deposits_auditado A
left join m_bets_auditado B on A.user_id=B.user_id
left join c_users C on C.user_id=A.user_id
where A.status="SUCCESSFUL" and B.user_id is null


# 10 (Versión B). Usuarios con depósito exitoso pero sin apuestas posteriores.
# Depósitos de usuarios que no existen en el catálogo de usuarios
# Usuarios que no han apostado desde su ultimo depósito exitoso

select X.user_id, Z.name,X.ultimo_deposito,Y.ultima_apuesta
from (
	select A.user_id, max(A.created_at) ultimo_deposito
		from m_deposits_auditado A
	where A.status="SUCCESSFUL"
	group by A.user_id
) X
inner join (
	select A.user_id, max(A.created_at) ultima_apuesta
		from m_bets_auditado A
	group by A.user_id
) Y on X.user_id=Y.user_id
left join c_users Z on Z.user_id=X.user_id
where X.ultimo_deposito>Y.ultima_apuesta





