<h1>Ejemplo practico de creación de una API RESTful</h1>


<h3>Consideraciones iniciales</h3>

<p>
Imaginemos que un cliente solicita el envío de un pedido mediante una llamada a la API REST para almacenarlo en 
la base de datos.
</p>
<p>
El pedido debe contener:
<ul>
    <li>Nombre y apellidos del cliente</li>
    <li>Email (Único por cliente)</li>
    <li>Teléfono/li>
    <li>Dirección de entrega (solo puede existir una por pedido)</li>
    <li>Fecha de entrega</li>
    <li>Franja de hora seleccionada para la entrega (variable, pueden ser desde franjas de 1h hasta de 8h)</li>
</ul>
Una vez tenemos guardada la información del pedido, debe asignarse a un driver que tengamos dado de alta en el sistema de forma aleatoria.
</p>

<p>
Por otro lado, nuestros drivers mediante su aplicación, necesitan obtener el listado de tareas para completar en el día. Es necesario contar con un endpoint que reciba como parámetro el ID del driver y la fecha de los pedidos que queremos obtener y nos devuelva un JSON con el listado.  
</p>