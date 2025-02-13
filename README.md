# CrudMongoPhp
Sistema para registrar, actualizar, eliminar, consultar Estudiantes.

**Arquitectura:** MVC, POO, Singleton.  
**Tecnología:** MongoDB, Faker, Composer, Bootstrap, Datatable de Bootstrap.

## Estructura del Proyecto

### 📂 Carpeta `db`
Contiene los archivos:
- **`conexion.php`:** Realiza una conexión simple.
- **`conexion_singleton.php`:** Realiza una conexión con el patrón: singleton, este ayuda a controlar el número de conexiones permitidas,


Ambos realizan la conexión con el servidor: **MongoDB**, de momento se está realizando la conexión del proyecto, en el archivo: **conexion_singleton.php**.

### 📂 Carpeta `modelo`
Contiene los archivos:
- **`estudiante.php`:** Es la clase encargada de cargar, u obtener los atributos que se van a enviar al modelo.
- **`estudianteModel.php`:** Es el modelo encargado de realizar las peticiones de la aplicación, aquí realizamos el CRUD del proyecto, además de otras operaciones directas con la base de datos.

### 📂 Carpeta `controlador`
Contiene el archivo: **`modeloController.php`** Se encargada de Controlar una o más peticiones que realicemos en la clase modelo: **`estudianteModel.php`**, dependiendo de la petición se almacena en una variable y se muestra en una vista, cada método está asociado a un botón, se cargan al momento de ejecutar la acción, que se captura por **[GET]** entre estas:
- **Index:** Muestra la vista principal del proyecto.
- **Editar:** Se encarga de cargar un registro de la tabla: Tabla de Estudiantes almacenados, en el formulario, una vez se ejecute el botón: Modificar, El usuario puede realizar un cambio en el formulario y ejecutado el botón: guardar, para actualizar el registro en la base de datos.
- **Actualizar:** Se encarga de recibir los datos del formulario por **[POST]**, estos se asocian a la clase: Estudiante, una vez se conste que corresponden al número de atributos de la clase, estos se asocian al constructor: **UPDATE**, y se modifican en la base de datos, cabe aclarar que el id de cada estudiante se carga desde el método: Editar se carga en un input de tipo: HIDDEN, luego se invoca en el método: Actualizar, se ejecuta el constructor: **UPDATE**  y se actualiza el registro en la base de datos.
- **Registrar:** Se encarga de recibir los datos del formulario por **[POST]**, estos se asocian a la clase: Estudiante, una vez se conste que corresponden al número de atributos de la clase, estos se asocian al constructor: **INSERT**, y se realiza el registro en la base de datos.
- **Eliminar:** Se encarga de eliminar el registro asociado, desde la tabla: Tabla de Estudiantes almacenados, en el icono: Eliminar, aquí se asocia el id a eliminar, se carga en el método: Eliminar y posteriormente se elimina el registro con el método: **DELETE**.
- **Faker:** Se encarga de generar datos falsos, inicialmente indicamos en la variable: limiteDeRegistro el límite en 120, y en el método: **`faker`**, de a cuantos registros se van a registrar en la base de datos en este caso de a: 50, una vez se conste que corresponde al número de atributos de la clase: **`Estudiante`**, estos se asocian al constructor: **INSERT**, y se realiza el registro en la base de datos, para instalar este componente y cuales faker se pueden generar, se recomienda la página: https://codersfree.com/blog/documentacion-de-la-libreria-faker-php-traducida-al-espanol.
- **Vaciar:** Se encarga de eliminar todos los registros de la base de datos, mediante el método: **DELETE**.

### 📂 Carpeta `vista`
Contiene los archivos: **`formulario.php, head.php, nav.php, tabla.php`**, encargado de mostrar las páginas de la aplicación, estos archivos se encargan:
- **index:** Muestra la vista principal del proyecto.
- **tabla:** Muestra los registros de la base de datos.
- **nav:** Muestra la barra de navegación del proyecto.
- **head:** Carga en la cabecera de la página, el css, el frameword: bootstrap, las librerías, y demás componentes necesarios para el funcionamiento del datatable de bootstrap, y javascript.

### 📂 Carpeta `public`
Contiene las carpetas: **bootstrap, datatables, fonts, y popper,** recursos estáticos del proyecto, necesarios para la presentación del archivo: **`tabla.php`**, se muestra en estilo: datatable de **Bootstrap 4**, el formulario, la barra de navegación, y los botones, se muestra con estilos de Bootstrap, la carpeta: fonts, corresponde a los iconos de la aplicación.

### 📄 Carpeta `index.php`
Contiene una validación la cual verifica si existe el controlador y su asociado método, si el método no se carga por **[GET]** se muestra la vista principal, cada método se relaciona con una acción estas son: **insertar, eliminar, modificar, editar, faker, vaciar.**

### 📄 Carpeta `validarFormulario`
Contiene una función la cual verifica, en el **SELECT** si contiene un registro asociado sql, y su opción, en este caso si **el género: Masculino** es equivalente a la opción Masculino se elige el **SELECT,** o si el género fuera: Femenino este debe ser equivalente a **la opción: Femenino** para elegir el **SELECT**, la condición sirve para todos los sql asociados y opciones asociadas estáticamente.

Los demás archivos corresponden a la instalación de **`componentes de composer`**. 

## 🚀 Comandos para Cargar el Proyecto
**Servidor Mongo**
mongo localhost:27017

**BD Mongo**
mongod

