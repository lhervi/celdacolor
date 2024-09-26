# Celdacolor

## Descripción

**Celdacolor** es una aplicación web interactiva desarrollada en PHP que permite agregar color a una matriz, celda por celda, dependiendo del valor contenido en cada celda. Esta funcionalidad es crucial para garantizar que Excel reconozca los colores de las celdas cuando se copian desde la página que contiene la matriz. Si las celdas se colorean usando una hoja de estilos, al copiarlas, Excel solo recibe los valores, y los colores se pierden.

## Características

- **Coloreado Celda por Celda**: Permite a los usuarios aplicar colores a celdas individuales basándose en valores específicos, asegurando que se mantenga el formato al exportar a Excel.
- **Reglas de Coloreado**: Puedes definir múltiples reglas para determinar qué colores se aplican a diferentes rangos. Por ejemplo, en un sistema que mide valores de 0 a 10 (como notas escolares):
  - Rojo para valores por debajo de 5.
  - Amarillo para valores entre 5 y 7.
  - Verde para valores superiores a 7.
- **Múltiples Criterios**: Se pueden aplicar distintos criterios de coloreado sobre los mismos datos. Por ejemplo, un criterio podría usar rojo para 0 a 5 y azul para 5 a 10, permitiendo personalizar el visualización según las necesidades.

## Propósito

Este proyecto fue creado como un ejemplo para demostrar una solución a un problema específico que puede enfrentar otro desarrollador. Aunque el ejemplo original forma parte de un proyecto privado más grande, esta versión ofrece una alternativa libre para abordar la misma problemática.

## Estructura del Proyecto

Aunque para el pintado de las celdas se requiere relativamente poco código, para esta demostración se añadieron elementos adicionales que permiten evidenciar el funcionamiento del componente. 

## A Quién Le Interese

Si te interesa utilizar la lógica empleada en esta aplicación, revisa las clases en la carpeta `celdacolor/src/models/ranges`. Allí encontrarás la lógica para el pintado de las celdas. Esta lógica está relacionada con los archivos JSON en `celdacolor/storageFiles` y con `celdacolor/config/constantes.php`. El resto del código está diseñado principalmente para la demostración.

## Tecnologías Utilizadas

- **PHP**: Lenguaje de programación utilizado para el backend.
- **HTML/CSS**: Tecnologías utilizadas para la estructura y el estilo de la aplicación.
- **JavaScript**: Para la interactividad en el cliente.

## Instalación

1. **Clona el repositorio**:
   ```bash
   git clone https://github.com/lhervi/celdacolor.git

2. **Navega al directorio del proyecto**:
 ```bash
cd celdacolor
```

3. Configura un servidor web: Puedes usar un servidor local como XAMPP, MAMP o cualquier servidor que soporte PHP.

Abre tu navegador y dirígete a http://localhost/celdacolor (o la ruta que corresponda según tu configuración).

Abre tu navegador y dirígete a http://localhost/celdacolor (o la ruta que corresponda según tu configuración).

## Uso
1. Selecciona un color utilizando la paleta de colores proporcionada.
2. El código hexadecimal del color seleccionado se mostrará en la pantalla.
3. Copia el código para usarlo en tus proyectos.

## Contribuciones
Las contribuciones son bienvenidas. Si deseas colaborar, por favor sigue estos pasos:

1. Haz un fork del proyecto.
2. Crea una nueva rama (git checkout -b feature-nuevaCaracteristica).
3. Realiza tus cambios y haz un commit (git commit -m 'Añadir nueva característica').
4. Sube tus cambios (git push origin feature-nuevaCaracteristica).
5. Crea un pull request.

## Licencia
Este proyecto está bajo la Licencia MIT. Para más detalles, consulta el archivo LICENSE.

"" Contacto
Si tienes alguna pregunta o comentario, no dudes en contactarme a través de:

Email: [lhervi@gmail.com]
GitHub: lhervi

