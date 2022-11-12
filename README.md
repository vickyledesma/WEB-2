# ENDPOINTS 
URL:https://localhost/WEB-2/api/series 
method: GET.
Trae la base de datos "Series".

URL:https://localhost/WEB-2/api/series/ID
method: GET.
Trae la serie que le indiques por su id.

URL:https://localhost/WEB-2/api/series/ID 
method: DELETE.
Borra la serie que le indiques por su id.

URL:https://localhost/WEB-2/api/series 
 method: POST.
 body:
{
    "titulo": "Friends",
    "descripcion": "amigos que se rien",
    "genero": 4
}
Agrega un serie a la base de datos, se hace insertando los datos en el body como se ve en el ejemplo de arriba. 

URL:https://localhost/WEB-2/api/series/ID 
 method: PUT.
 body:
{
    "titulo": "Friends",
    "descripcion": "amigos que lloran",
    "genero": 4
}
Edita una serie, trayendo la serie con GET para luego realizar la edicion deseada. 

URL:https://localhost/WEB-2/api/series&sort=columna&order=ASC/DESC
method: GET.
Sort indica la columna que deseas ordenar y order la manera en la que van a ser ordenados los datos. 
En este tp, solo se puede ordenar mediante la columna ID. 