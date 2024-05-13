@extends('layouts.header')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/details.css') }}">


<main class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <section class="car-details">
                <h2>Detalles del Coche</h2>
                <ul>
                    <img class="img-fluid img-responsive rounded product-image" src="{{asset($car->image)}}" style="max-height: 200px; margin-bottom: 20px;">
                    <li><span><strong>{{$car->brand}} {{ $car->model }}</strong></span></li>

                    <li>Fecha de recogida: {{ date('d/m/Y', strtotime($startDate)) }}</li>
                    <li>Fecha de devolución: {{ date('d/m/Y', strtotime($endDate)) }}</li>
                    <!-- Agrega más detalles según tus necesidades -->
                    <li>Precio del coche: €{{ $car->price * $numberOfDays }}.00</li> <!-- Corrección aquí -->
                    <li id="insurance-price-label">Precio del seguro: €0.00</li>
                    <!-- Formulario para redirigir a la ruta /paypal/payment/{id} -->
                    <form id="paypal-form" action="{{ route('payment', $car->id) }}" method="POST">

                        @csrf
                        <li id="total-price-label" name="amount">Precio total: €{{ $car->price * $numberOfDays }}.00</li>
                        <!-- Precio total oculto -->
                        <input type="hidden" name="amount" id="total-price" value="{{ $car->price * $numberOfDays }}">
                        <input type="hidden" name="start_date" id="start_date" value="{{ date('Y-m-d', strtotime($startDate)) }}">
                        <input type="hidden" name="end_date" id="end_date" value="{{ date('Y-m-d', strtotime($endDate)) }}">
                        <!-- Botón para redirigir -->
                        <button type="submit" class="btn btn-danger">Paga con PayPal</button>
                    </form>
                </ul>
            </section>
        </div>
        <div class="col-md-8">
            <section class="insurance-plans">
                <h2>Planes de seguro</h2>
                <!-- Aquí mostrar los planes de seguro disponibles -->
                <div class="row">
                    @foreach($insurancePlans as $plan)
                        <div class="col-md-4 mb-3">
                            <div class="card" style="min-height: 310px">
                                <div class="card-body">
                                    <h5 class="card-title" style="margin-top: 20px">{{ $plan->name }}</h5>
                                    <?php echo $plan->description;?>
                                    <p class="card-text">Precio: {{ $plan->price }}</p>
                                    <button class="btn btn-danger" onclick="togglePlan(this, {{ $plan->price }})">Seleccionar Plan</button>
                                    <input type="hidden" value="{{ $plan->id }}" name="insurance_plan_id" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="additional-services">
                <h2>Servicios Aficionales</h2>
                <!-- Aquí mostrar los servicios adicionales para el coche -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Conductor adicional</h5>
                        <p class="card-text">Ampliar la cobertura del seguro para agregar otro conductor</p>
                        <button id="cleaning-service-btn" class="btn btn-danger" onclick="toggleServiceButton(this, 10)">Añadir (+€10.00)</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cross border</h5>
                        <p class="card-text">Si vas a conducir a otro país, necesitarás contratar una cobertura especial para extender la protección a otros territorios.</p>
                        <button id="cleaning-service-btn" class="btn btn-danger" onclick="toggleServiceButton(this, 10)">Añadir (+€10.00)</button>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Silla para niños</h5>
                        <p class="card-text">Solicita hasta tres asientos para niños. Los asientos incluyen una cubierta higiénica desechable.</p>
                        <button id="delivery-service-btn" class="btn btn-danger" onclick="toggleServiceButton(this, 20)">Añadir (+€20.00)</button>
                    </div>
                </div>
                <!-- Agrega más servicios según tus necesidades -->
            </section>
        </div>
    </div>
</main>

<script>
    let insurancePrice = 0;
    let additionalServicesPrice = 0;
    const numberOfDays = {{ $numberOfDays }};
    const defaultPrice = {{ $car->price }}; // Precio por defecto del alquiler del coche

    function togglePlan(button, price) {
        const buttons = document.querySelectorAll('.btn-danger');
        buttons.forEach(btn => {
            if (btn !== button && btn.classList.contains('selected')) {
                removePlan(price);
                btn.textContent = 'Seleccionar Plan';
                btn.classList.remove('selected');
            }
        });

        if (button.classList.contains('selected')) {
            removePlan(price);
            button.textContent = 'Seleccionar plan';
            button.classList.remove('selected');
        } else {
            addPlan(price);
            button.textContent = 'Eliminar';
            button.classList.add('selected');
        }
    }

    function addPlan(price) {
        insurancePrice += price;
        updateInsurancePrice(price);
        updateTotalPrice();
    }

    function removePlan(price) {
        insurancePrice -= price;
        updateInsurancePrice(0);
        updateTotalPrice();
    }

    function toggleServiceButton(button, servicePrice) {
        if (button.classList.contains('added')) {
            removeService(servicePrice);
            button.textContent = 'Añadir (+€' + servicePrice.toFixed(2) + ')';
            button.classList.remove('added');
        } else {
            addService(servicePrice);
            button.textContent = 'Eliminar';
            button.classList.add('added');
        }
    }

    function addService(servicePrice) {
        additionalServicesPrice += servicePrice;
        updateTotalPrice();
    }

    function removeService(servicePrice) {
        additionalServicesPrice -= servicePrice;
        updateTotalPrice();
    }

    // Función para actualizar el precio total y el valor oculto del formulario
    function updateTotalPrice() {
        const totalPriceLabel = document.getElementById('total-price-label');
        const totalRentPrice = defaultPrice * numberOfDays;
        const grandTotal = insurancePrice + totalRentPrice + additionalServicesPrice;
        totalPriceLabel.textContent = "Precio total: €" + grandTotal.toFixed(2);

        // Actualizar el valor oculto del formulario
        document.getElementById('total-price').value = grandTotal.toFixed(2);
    }

    function updateInsurancePrice(price) {
        insurancePrice = price;
        const insurancePriceLabel = document.getElementById('insurance-price-label');
        insurancePriceLabel.textContent = "Precio del seguro: €" + price.toFixed(2);
    }

</script>

@endsection
