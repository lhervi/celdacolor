CeldaColor es un ejemplo de una funcionalidad que permite agregar color a una matrix celda por celda, dependiendo del valor contenido

¿Por qué celda por celda?
Esto es necesario para lograr que Excel reconozca los colores de las celdas, cuando se copian desde la página que contiene la matrix. Si las celdas se colorean con una hoja de estilos, cuando se copian, Excel sólo recibe los valores, pero los colores se pierden.

¿Cuál es el aporte de esta solución?
Esta solución permite tener una serie de reglas, para definir los rangos y sus colores, pudiendo así, pintar las celdas de acuerdo a diferentes criterios. Por ejemplo, supongamos un sistema que mide valores que van desde 0 hasta 10, por ejemplo, notas escolares. Se pude tener como criterio que se pintará de rojo lo que esté por debajo de 5, a partir de 5 y hasta 7, se pintará de amarillo, y lo que sea mayor a 7 se pinta de verde. En paralelo, se puede tener un segundo sistema, que aplique sobre los mismos datos, donde de 0 a 5 es rojo y de 5 a 10 es azul. Se pueden tener cuantos crfiterios se deseen, incluso un color por cada número, y elegir entre el primero, el segundo o el tercer criterio.

¿Por qué hacer este ejemplo?
Cree este ejemplo porque el original fomra parte de uno proyecto privado más grande, así que por razones de privacidad, me pareció más adecuado hacer una versión libre de relación. Por otro lado, creo que esta solución puede ser útil a otro desarrollador que se encuentre con el mismo problema.

¿Cómo está estructurado?
Para resolver lo del pindatdo de las celdas, se requiere en realiad muy poco, pero para hacer la demostración, se requería más, así que me animé a añadir elementos que permitan demostrar lo que el componente hace



