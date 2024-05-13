<h1>Confirmación de Alquiler de Coche - Recibo de Compra</h1>
<p>Estimado/a {{$name}},</p>
<p>Gracias por elegir Eurocarting para cubrir tus necesidades de movilidad. Nos complace confirmar tu reserva y el alquiler del siguiente vehículo:</p>
<ul>
    <li>Modelo de coche: {{$car->brand}} {{$car->model}}</li>
    <li>Fecha de recogida: {{$loan->start_date}}</li>
    <li>Fecha de devolución: {{$loan->end_date}}</li>
</ul>
<br>
<ul>
    <li>Detalles del Pago:</li>
    <li>Método de Pago: PayPal</li>
    <li>Total pagado: {{$loan->amount}}</li>
    <li>Número de Confirmación: {{$loan->id}}</li>
    <br>
</ul>
<p>No dudes en contactarnos en cualquier momento si necesitas hacer cambios en tu reserva o si tienes alguna pregunta. Nuestro equipo estará encantado de ayudarte.</p>
<p>Esperamos que disfrutes de tu experiencia con nuestro coche de alquiler y que satisfaga todas tus necesidades de transporte durante tu estancia con nosotros.</p>
<p>¡Gracias por elegirnos!</p>
<p>Atentamente,</p>
<p>Eurocarting</p>






