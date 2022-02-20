# api-cuadros
Challenge api-cuadros
## INSTRUCCIONES

La aplicacion tiene las siguientes funciones a ejecutar <br>
#user:<br>
Registro :http://127.0.0.1:8000/api/register <br>
datos para registro <br>
{<br>
"name": "xxxxx",<br>
"email": "xxxxxx@gmail.com", <br>
"password": "1234"<br>

}<br>
login : http://127.0.0.1:8000/api/login <br>
retorna un token<br>
{<br>
"email": "xxxxx@gmail.com", <br>
"password": "xxxx"<br>
}<br>
logout: cierra session del usuario <br>
http://127.0.0.1:8000/api/logout <br>


#cuadro:

##create
crea un nuevo cuadro con los siguientes endpoints datos a ingresar: <br>
ejm: <br>
{<br>
"name": "Agus", <br>
"title": "Mundos", <br>
"paint": "Yumis", <br>
"year": "1974", <br>
"material": "Lienzo", <br>
"measures": "30X 25", <br>
"country": "Colombia" <br>
} <br>
Post : http://127.0.0.1:8000/api/cuadro/create <br>

##getAll <br><br>
permite obtener los datos de cuadros creado, retorna los primeros 10 cuadros <br>
Get: http://127.0.0.1:8000/api/cuadro/getAll <br>
Para pasar a la siguiente pagina <br>
Get: http://127.0.0.1:8000/api/cuadro/getAll?page=2 // ejm <br>

##get<br>
devuelve los datos del cuadro con igual $id <br>
Get : ejm http://127.0.0.1:8000/api/cuadro/get/3 id=3 <br>

#edit<br>
permite editar los datos del un cuadro <br>
Post : ejm http://127.0.0.1:8000/api/cuadro/edit/2 cuadro=2 <br>

#delete <br>
elimina un cuadro por $id <br>
Delete : http://127.0.0.1:8000/api/cuadro/delete/12 id=12 <br>

#search <br>
devuelve datos de cuadros por campos solicitados de acuerdo un campo y su dato <br>
Get : http://127.0.0.1:8000/api/cuadro/selet?name=Lom&fields=year,updated_at <br>
nombre del campo a buscar : name,<br>
dato del campo  name = Lom, <br>
filtro por fields en este ejm year,updated_at son los campos a filtrar en este ejemplo. <br>
Se puede filtrar y buscar por: <br>
name, title, paint, year, material,measures,country,created_at, updated_at <br>
ejm: <br>
{ <br>
"year": 1990, <br>
"updated_at": "2022-02-20T15:12:34.000000Z" <br>
} <br>
