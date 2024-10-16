# Sistema de Encriptación y Desencriptación de Archivos
## Descripción General del Proyecto
Este proyecto implementa un sistema de encriptación y desencriptación de archivos siguiendo la arquitectura MVC (Modelo-Vista-Controlador). El objetivo es encriptar y desencriptar archivos de manera segura, utilizando una base de datos para almacenar y recuperar archivos encriptados. El proyecto incluye funcionalidades tanto para encriptar como para desencriptar archivos, además de la posibilidad de encriptar texto.

### Tecnologías clave utilizadas:

PHP para el procesamiento del lado del servidor.
Defuse PHP Encryption Library para encriptación y desencriptación seguras.
PDO para la interacción con la base de datos.
Bootstrap para el diseño visual.
Arquitectura MVC para mantener el código modular y con una clara separación de responsabilidades.
## Funcionalidades Principales
### Encriptación de Archivos:

Los usuarios pueden subir archivos, los cuales son encriptados usando una clave generada aleatoriamente.
El archivo encriptado se guarda en una base de datos MySQL como un BLOB.
El sistema almacena el nombre original del archivo y la clave de encriptación.
### Desencriptación de Archivos:

Los usuarios pueden solicitar un archivo por su ID y proporcionar la clave de encriptación.
El sistema desencripta el archivo y lo descarga con su nombre original.
### Encriptación de Texto:

Los usuarios pueden ingresar texto, el cual se encripta y devuelve junto con la clave para su posterior desencriptación.
## Estructura del Proyecto
modelo/: Contiene el archivo EncryptionModel.php, que gestiona toda la lógica de encriptación, desencriptación y operaciones con la base de datos. 

control/: Contiene el archivo EncryptionController.php, responsable de procesar las solicitudes y pasar los datos entre la vista y el modelo.

vista/: Contiene las vistas, que incluyen los formularios para subir archivos y texto, y acciones como accionEncriptar.php y accionDesencriptar.php.

uploads/: Directorio donde se almacenan temporalmente los archivos durante el proceso de encriptación.

keys/: Almacena las claves generadas para la encriptación, aunque no son directamente accesibles por razones de seguridad.

## Dependencias
Defuse PHP Encryption Library: Asegúrate de haber instalado la biblioteca Defuse mediante Composer:

composer require defuse/php-encryption

Bootstrap: El proyecto utiliza Bootstrap para el diseño de la interfaz de usuario. Asegúrate de que Bootstrap esté vinculado en tus vistas para una correcta presentación del UI.


## Configuración de la Base de Datos
Crea una base de datos MySQL con la siguiente estructura:

CREATE TABLE encrypted_files (

    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255),
    encrypted_file LONGBLOB,
    key_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Asegúrate de que la conexión a la base de datos esté correctamente configurada en tu archivo EncryptionModel.php.

## Cómo Usar el Sistema
### Encriptar Archivos:

Sube un archivo a través del formulario proporcionado.
El sistema generará una versión encriptada y la guardará en la base de datos junto con su clave.
### Desencriptar Archivos:

Ingresa el ID del archivo y proporciona la clave.
El sistema recuperará el archivo encriptado de la base de datos, lo desencriptará y lo descargará con su nombre original.
### Encriptar Texto:

Ingresa un texto para encriptar.
El sistema devolverá el texto encriptado junto con una clave para su desencriptación.
## Instrucciones de Uso
Clona el repositorio en tu entorno local.

Asegúrate de que la base de datos esté configurada y conectada correctamente al proyecto.

Sirve el proyecto utilizando un servidor local como XAMPP o LAMP.

Usa los formularios proporcionados para probar la encriptación y desencriptación de archivos y textos.

