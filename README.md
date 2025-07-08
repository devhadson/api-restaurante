
# Restaurant API

Restaurant API está desarrollado en *PHP* navito con base de datos *MySQL*, fácil de de integrarse con sitios y páginas webs. Desarrollado siguiendo el paradigma de programación orientada a objetos (POO).

## Documentación
- [Stack tecnológico](#stack-tecnológico)
- [Crear los objetos de base de datos](#crear-los-objetos-de-base-de-datos)
- [Configurar la conexión a la base de datos](#configurar-la-conexión-a-la-base-de-datos)
- [Referencia a los verbos de la API Usuario](#referencia-a-los-verbos-de-la-api-usuario)
- [Referencia a los verbos de la API Iniciar sesión](#referencia-a-los-verbos-de-la-api-iniciar-sesión)
- [Ejecución Local](#ejecución-local)
- [Preguntas Frecuentes](#preguntas-frecuentes)

## Stack tecnológico

**Lenguaje de Programacipon:** PHP

**Base de datos:** MySQL

**Validación de APIs:** Postman

## Crear los objetos de base de datos

#### ⚡️ Crea la base de datos ralacional de nombre *dbrestaurant*
#### 📖 La base de datos nos pemritirá crear las tablas para el almacenamiento y recuperación de datos regisrados.
#### 🛠️ Script para crear la base de datos
```sql
CREATE SCHEMA IF NOT EXISTS `dbrestaurant` DEFAULT CHARACTER SET utf16 COLLATE utf16_spanish_ci;
```

##

#### ⚡️ Crea la tabla *users*
#### 📖 La tabla almerá los registros necesarios del usuario.
#### 🛠️ Script para crear la tabla
```sql
CREATE TABLE `users` (
  id int AUTO_INCREMENT PRIMARY KEY, 
  user varchar(50) not null, 
  firstname varchar(100) not null, 
  lastname varchar(100) not null, 
  address varchar(200) not null, 
  email varchar(100) not null, 
  mobile varchar(30) not null, 
  password varchar(100) not null, 
  confirmpass varchar(100) not null,
  status char(1) not null default 'A' 
);
```

##

#### ⚡️ Crea la tabla *dishes*
#### 📖 La tabla almerá los registros necesrios de los platos que ofrece el restaurant.
#### 🛠️ Script para crear la tabla
```sql
CREATE TABLE dishes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  dishes_name varchar(100) not null,
  dishes_image varchar(300) null,
  dishes_cost decimal(10, 2) not null,
  dishes_quantity int not null default 0,
  id_restaurant int not null,
  status char(1) not null default 'A' 
);
```
## Configurar la conexión a la base de datos

1. Crear el archivo **Constants.php** en la ruta *../api-restaurante/includes*

#### 🛠️ Script PHP para Definir las siguientes variables

```php
<?php  
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'test_bd_2025_microservice');
?>
```
2. Crear el archivo **DbConnect.php** en la ruta *../api-restaurante/includes*

#### 🛠️ Script PHP para definir la conexión la base de datos MySQLi orientado a objetos.

```php
<?php  
 //Class DbConnect
 class DbConnect
 {
	 //Variable to store database link
	 private $con;
	 
	 //Class constructor
	 function __construct()
	 {
	 
	 }
	 
	 //This method will connect to the database
	 function connect()
	 {
	 	//Including the constants.php file to get the database constants
	 	include_once dirname(__FILE__) . '/Constants.php';
	 
	 	//connecting to mysql database
	 	$this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	 
	 	//Checking if any error occured while connecting
	 	if (mysqli_connect_errno()) {
	 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	 	}	 
	 	//finally returning the connection link 
	 	return $this->con;
	 }
 }
?>
```

##

## Referencia a los verbos de la API Usuario

#### ⚡️ POST: Insertar Usuario

```http
  ../api-restaurante/v1/api.php?apicall=createuser
```
#### 📖 Al ejecutar el verbo POST se registrar un nuevo registro y retornar la lista de registros ingresados.
#### 🛠️ Configuración de parámetros

| Parameter | Type     | Value                |
| :-------- | :------- | :------------------------- |
| `apicall` | `string` | **createuser** |

| Body | Type     | Values                |
| :-------- | :------- | :------------------------- |
| `user` | `string` | **Required** |
| `firstname` | `string` | **Required** |
| `lastname` | `string` | **Required** |
| `address` | `string` | **Required** |
| `email` | `string` | **Required** |
| `mobile` | `string` | **Required** |
| `password` | `string` | **Required** |
| `confirmpass` | `string` | **Required** |

[imagen del resultado](#registro-ingresado)

##

#### ⚡️ GET: Listar Usuario

```http
  ../api-restaurante/v1/api.php?apicall=getuser
```

#### 📖 Al ejecutar el verbo GET retornará la lista de registro ingresados.
#### 🛠️ Configuración de parámetro

| Parameter | Type     | Value                |
| :-------- | :------- | :------------------------- |
| `apicall` | `string` | **getuser** |


[imagen del resultado](#registros-listados)

##

#### ⚡️ POST: Actualizar Usuario
```http
  ../api-restaurante/v1/api.php?apicall=updateuser
```
#### 📖 Al ejecutar el verbo POST se actualizará el registro según el filtro ID usuario.
#### 🛠️ Configuración de parámetros

| Parameter | Type     | Value                |
| :-------- | :------- | :------------------------- |
| `apicall` | `string` | **updateuser** |

| Body | Type     | Values                |
| :-------- | :------- | :------------------------- |
| `id`      | `string` | **Required**. Id para filtrar |
| `user` | `string` | **Required** |
| `firstname` | `string` | **Required** |
| `lastname` | `string` | **Required** |
| `address` | `string` | **Required** |
| `email` | `string` | **Required** |
| `mobile` | `string` | **Required** |
| `password` | `string` | **Required** |
| `confirmpass` | `string` | **Required** |

[imagen del resultado](#registro-actualizado)

##

#### ⚡️ DELETE: Eliminar usuario

```http
  ../api-restaurante/v1/api.php?apicall=deleteuser&id={id}
```
#### 📖 Al ejecutar el verbo DELETE se eliminará el registro de acuerdo al filtro ID usuario.
#### 🛠️ Configuración de parámetros

| Parameter | Type     | Value                       |
| :-------- | :------- | :-------------------------------- |
| `apicall` | `string` | **deleteuser** |
| `id`      | `string` | **Required**. Id para filtrar |

[imagen del resultado](#registro-eliminado)

## Referencia a los verbos de la API Iniciar sesión

#### ⚡️ POST: Validar acceso

```http
  ../api-restaurante/v1/login.php
```
#### 📖 Al ejecutar el verbo POST retornará el usuario y correo electrónico del usuairo.
#### 🛠️ Configuración de parámetros

| Body | Type     | Value                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. E-mail a validar |
| `password`      | `string` | **Required**. Password a validar |

[imagen del resultado](#usuario-con-autenticación)

## Ejecución Local

1. Stack tecnológico
- XAMPP Control Panel v3.3.0
- Servidor Apache
- Servidor MySQL

2. Clonar el proyecto api-restaurante

```bash
  git clone https://github.com/devhadson/api-restaurante.git
```
3. Crea la base de datos ralacional de nombre *dbrestaurant*
4. Crea las tablas *users* y *dishes*
5. Crear el archivo **Constants.php** en la ruta *../api-restaurante/includes*
6. Crear el archivo **DbConnect.php** en la ruta *../api-restaurante/includes*

## Captura de resultados

### Registro ingresado
![App Screenshot](/includes/img/createuser.png "Optional title")

### Registros listados
![App Screenshot](/includes/img/getuser.png "Optional title")

### Registro actualizado
![App Screenshot](/includes/img/updateuser.png "Optional title")

### Registro eliminado
![App Screenshot](/includes/img/deleteuser.png "Optional title")

### Usuario con autenticación
1. Validar cuenta de acceso con datos incorrectos

![App Screenshot](/includes/img/login-inval.png "Optional title")

2. Validar acceso con datos válidos

![App Screenshot](/includes/img/login.png "Optional title")


## Preguntas Frecuentes

#### Pregunta 1

Respuesta 1

#### Pregunta 2

Respuesta 2

## 🚀 Acerca de
😀 Hola, Soy Hadson Paredes 👋

Mis inicios fueron de *programador full stack* y actualmente soy Arquitecto de Soluciones encargo de diseñar e implementar soluciones tecnológicas basado en *Cloud Computing*, *IA* y *Data Science*. Actualmente en mis tiempos libres aún sigo programado aplicaciones relacionados soluciones *Web*, *IA* y *Data Science*. **lifelong learner**
