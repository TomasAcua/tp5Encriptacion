# Proyecto de Encriptación y Desencriptación con PHP
Este proyecto implementa un sistema para encriptar y desencriptar archivos y textos utilizando la librería Defuse PHP Encryption. El proyecto sigue el patrón Modelo-Vista-Controlador (MVC) para mantener una estructura organizada y limpia del código.

## Características
Encriptación de archivos y texto utilizando claves seguras generadas al azar.
Desencriptación de archivos y texto encriptados mediante claves.
Uso de Bootstrap para darle estilo a las páginas web.
Descarga de archivos encriptados y desencriptados.
Estructura organizada utilizando MVC.
Validación de formularios con JavaScript.

## Requisitos
PHP 7.4 o superior

Composer

XAMPP (u otro servidor local)

Librería Defuse PHP Encryption instalada a través de Composer

## Instalación
1. Clonar el repositorio
git clone https://github.com/tu-usuario/tp5Encriptacion.git

3. Instalar dependencias con Composer
Ejecuta el siguiente comando en el directorio raíz del proyecto para instalar las dependencias:
composer install

4. Configurar el archivo .env
Crea un archivo .env en la raíz del proyecto con la configuración de tu base de datos y otros parámetros. Ejemplo:

DB_HOST=localhost

DB_NAME=tu_basededatos

DB_USER=root

DB_PASS=

DB_ENGINE=mysql

DB_PORT=3306


5. Configurar permisos de carpetas
Asegúrate de que la carpeta uploads tenga permisos de escritura, ya que es donde se guardarán los archivos encriptados y desencriptados.

 ### Dependencias
Este proyecto utiliza la librería Defuse PHP Encryption para la encriptación y desencriptación de archivos y textos.

Defuse PHP Encryption
