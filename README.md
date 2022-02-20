# api-cuadros
Challenge api-cuadros
## INSTRUCCIONES 

LA aplicacion tiene las siguientes funciones a ejecutar

##create: 
crea un nuevo cuadro con los siguientes endpoints datos a ingresar:<br>
ejm:
{
"name": "Agus",
"title": "Mundos",
"paint": "Yumis",
"year": "1974",
"material": "Lienzo",
"measures": "30X 25",
"country": "Colombia"
}
Post : http://127.0.0.1:8000/api/cuadro/create 

##getAll 
permite obtener los datos de cuadros creado, retorna los primeros 10 cuadros
Get: http://127.0.0.1:8000/api/cuadro/getAll
Para pasar a la siguiente pagina
Get: http://127.0.0.1:8000/api/cuadro/getAll?page=2 // ejm 

##get
devuelve los datos del cuadro con igual $id
Get : ejm http://127.0.0.1:8000/api/cuadro/get/3 id=3

#edit
permite editar los datos del un cuadro
Post : ejm http://127.0.0.1:8000/api/cuadro/edit/2 cuadro=2

#delete
elimina un cuadro por $id 
Delete : http://127.0.0.1:8000/api/cuadro/delete/12 id=12

#search
devuelve datos de cuadros por campos solicitados de acuerdo un campo y su dato
Get : http://127.0.0.1:8000/api/cuadro/selet?name=Lom&fields=year,updated_at 
nombre del campo a buscar : name,
dato del campo  name = Lom,
filtro por fields en este ejm year,updated_at son los campos a filtrar en este ejemplo.
Se puede filtrar y buscar por:
name, title, paint, year, material,measures,country,created_at, updated_at
        {
            "year": 1990,
            "updated_at": "2022-02-20T15:12:34.000000Z"
        }
