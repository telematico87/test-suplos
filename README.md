# TEST-SUPLOS
Este proyectos ha sido modelado con un patron MVC sin usar ningun framework conocido (Codegnither, Laravel, Zend, etc), separa los Modelos, Controlladores y las vistas para que se mas rapida 
la programación y se aproveche al máximo el patrón de diseño. Este proyecto tambien contiene las librerias necesarias para su funcionamiento ya 
que la estructura parte desde cero tanto de la parte backend y la frontend que incluye vue,axios,etc.  

![Screenshot from 2023-04-07 23-57-52](https://user-images.githubusercontent.com/13879086/230703950-83eaca91-418d-4d03-a406-82e315a67b63.png)

## Requisitos
* PHP 8.2, Vue js, Bootraps5.
## Intrucciones
* En el fichero config.php  de la raiz se configura los accesos a la base de datos (servidor, usuario, contraseña, base de datos)  
![Screenshot from 2023-04-07 23-59-52](https://user-images.githubusercontent.com/13879086/230704013-9f100a45-b0ef-4939-9510-6d5444b7cd58.png)  


* http://localhost/index.php/gestion/login, ruta de inicio
* usuario:test@gmail.com     
* password:123456
## Flujo de trabajo  

#### Acceso o login  
 Introducir credenciales

![Screenshot from 2023-04-07 22-55-05](https://user-images.githubusercontent.com/13879086/230703118-b02eeede-d4ef-432c-ac57-fde5b50ee39c.png)
![Screenshot from 2023-04-07 22-55-32](https://user-images.githubusercontent.com/13879086/230703119-3320b5be-6696-4075-8374-43779507ccec.png)  

#### Dashboard  
Menu principal

![Screenshot from 2023-04-07 22-31-14](https://user-images.githubusercontent.com/13879086/230703115-128e134b-1cb4-46d8-9400-315794a037a8.png)  

#### Crear Proceso/Evento
Se crea una proceso rellando el formulario (las 3 pestañas)

![Screenshot from 2023-04-07 22-23-00](https://user-images.githubusercontent.com/13879086/230703108-8967567c-c8de-44e9-8f1c-a76e867645ee.png)  

Pestaña cronograma  

![Screenshot from 2023-04-07 22-23-55](https://user-images.githubusercontent.com/13879086/230703109-23fffbea-e4d5-4408-a030-4292a1ca048d.png)  

Añadir documentos  

![Screenshot from 2023-04-07 22-24-35](https://user-images.githubusercontent.com/13879086/230703111-a5f1613e-0df9-4a06-aeac-a6ae8f1eb81c.png)  

Crear Proceso  

![Screenshot from 2023-04-07 22-25-13](https://user-images.githubusercontent.com/13879086/230703113-e5ba5b8d-57cb-4838-b55a-f15a9678d30e.png)  

#### Listado Proceso/Evento 
Se puede filtrar, generar excel de las lista procesos, evaluar y publicar

![Screenshot from 2023-04-07 22-31-40](https://user-images.githubusercontent.com/13879086/230703116-9f7c572d-bf33-46ea-8e62-05ce8ac86c46.png)  

#### Descarga Excel  
formato de excel de salida

![Screenshot from 2023-04-07 22-54-34](https://user-images.githubusercontent.com/13879086/230703117-208e5373-b670-4ef8-9307-a1da12bef673.png)

