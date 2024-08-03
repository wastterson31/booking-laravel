<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Tus viajes seguros</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontAwesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tooplate-style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>

    <style>
        .search-container {
            margin-top: 30px;
        }

        .search-input {
            height: 50px;
            font-size: 18px;
        }

        .search-button {
            height: 50px;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <section class="banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="left-side">
                        <div class="logo">
                            <img src="{{ asset('img/logo.png') }}" alt="Flight Template">
                        </div>
                        <div class="tabs-content">
                            <h4>Consulta el horario de viajes</h4>
                            <div class="search-container">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input" id="search-input"
                                        placeholder="Buscar vuelos disponibles a la ciudad de:">
                                    <button class="btn btn-primary search-button" type="button"
                                        onclick="buscarVuelos()">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-content">
                            <h4>Cancelar vuelo por código único</h4>
                            <div class="input-group">
                                <input type="text" class="form-control search-input" id="cancelar-input"
                                    placeholder="Ingrese el código único del boleto">
                                <button class="btn btn-danger search-button" type="button"
                                    onclick="cancelarVuelo()">Cancelar o buscar mi vuelo</button>
                            </div>
                        </div>
                        <div class="page-direction-button">
                            <a href="#"><i class="fa fa-phone"></i>Contactanos</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <section id="first-tab-group" class="tabgroup">
                        <div id="tab1">
                            <div class="submit-form">
                                <h4>Consultar disponibilidad para<em>viajar</em>:</h4>
                                <form id="form-submit" action="{{ route('ticket.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="ciudad_origen_id">De:</label>
                                                <select id="ciudad_origen_id" required name='ciudad_origen_id'>
                                                    <option value="">Select a location...</option>
                                                    @foreach ($ciudades as $ciudad)
                                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="ciudad_destino_id">A:</label>
                                                <select id="ciudad_destino_id" required name='ciudad_destino_id'>
                                                    <option value="">Select a location...</option>
                                                    @foreach ($ciudades as $ciudad)
                                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="fecha_salida">FECHA DE SALIDA:</label>
                                                <input name="fecha_salida" type="date" class="form-control date"
                                                    id="fecha_salida" placeholder="Select date..." required>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="fecha_regreso">FECHA DE REGRESO:</label>
                                                <input name="fecha_regreso" type="date" class="form-control date"
                                                    id="fecha_regreso" placeholder="Select date..." required>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="correo">CORREO:</label>
                                                <input name="correo" type="email" class="form-control" id="correo"
                                                    placeholder="Enter your email..." required>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="celular">CELULAR:</label>
                                                <input name="celular" type="text" class="form-control"
                                                    id="celular" placeholder="Enter your phone number...">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="nombre_completo">NOMBRE COMPLETO:</label>
                                                <input name="nombre_completo" type="text" class="form-control"
                                                    id="nombre_completo" placeholder="Enter your full name...">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="numero_identificacion">NÚMERO DE IDENTIFICACIÓN:</label>
                                                <input name="numero_identificacion" type="text"
                                                    class="form-control" id="numero_identificacion"
                                                    placeholder="Enter your identification number...">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <label for="categoria_id">CATEGORÍA:</label>
                                                <select id="categoria_id" required name='categoria_id'>
                                                    <option value="">Seleccione una categoría...</option>
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <fieldset>
                                                <button type="submit" id="form-submit-btn"
                                                    class="btn btn-primary">Ordenar un boleto ahora</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>


    @include('propiedad.footer')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén los elementos del formulario y el selector de categoría
            const categoriaSelect = document.getElementById('categoria_id');
            const submitButton = document.getElementById('form-submit-btn');

            // Función para verificar la disponibilidad de la categoría
            function checkCategoryAvailability(categoriaId) {
                fetch(`/categoria/check-availability?categoria_id=${categoriaId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.puestosDisponibles > 0) {
                            submitButton.disabled = false;
                        } else {
                            submitButton.disabled = true;
                            alert('No hay asientos disponibles en esta categoría.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        submitButton.disabled = true;
                    });
            }

            // Evento para verificar la disponibilidad cuando cambie la categoría
            categoriaSelect.addEventListener('change', function() {
                const categoriaId = this.value;
                checkCategoryAvailability(categoriaId);
            });

            // Inicialmente desactivar el botón si no hay categoría seleccionada
            submitButton.disabled = !categoriaSelect.value;
        });

        function buscarVuelos() {
            var ciudadDestino = document.getElementById("search-input").value.trim();
            if (ciudadDestino) {

                $.ajax({
                    url: "{{ route('buscar.vuelos') }}",
                    type: 'GET',
                    data: {
                        ciudad_destino: ciudadDestino
                    },
                    success: function(data) {
                        if (data.length > 0) {

                            var vuelosDisponibles = data.map(function(vuelo) {
                                return `Origen: ${vuelo.ciudad_destino}, Destino: ${vuelo.ciudad_origen}, Salida:  ${vuelo.hora_salida}, Llegada: ${vuelo.hora_llegada}`;
                            }).join('\n');


                            Swal.fire({
                                icon: 'info',
                                title: `Vuelos disponibles para ${ciudadDestino}:`,
                                html: vuelosDisponibles
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: `No se encontraron vuelos disponibles para ${ciudadDestino}`,
                                text: 'Por favor, intenta con otra ciudad.'
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error en la petición AJAX', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en la búsqueda de vuelos',
                            text: 'Ocurrió un error al buscar vuelos disponibles. Inténtalo de nuevo más tarde.'
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo vacío',
                    text: 'Por favor ingresa una ciudad para buscar vuelos disponibles.'
                });
            }
        }

        $(document).ready(function() {
            $('#form-submit').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: response.message.icon || 'success',
                            title: response.message.title,
                            text: response.message.text
                        });
                    },
                    error: function(xhr) {
                        var errorMessage = 'Ocurrió un error al procesar tu solicitud.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const ciudadOrigenSelect = document.getElementById('ciudad_origen_id');
            const ciudadDestinoSelect = document.getElementById('ciudad_destino_id');
            const todasCiudades =
                @json($ciudades);

            ciudadOrigenSelect.addEventListener('change', function() {
                const selectedCiudadOrigenId = ciudadOrigenSelect.value;


                ciudadDestinoSelect.innerHTML = '<option value="">Selecciona una ciudad...</option>';


                todasCiudades.forEach(function(ciudad) {
                    if (ciudad.id != selectedCiudadOrigenId) {
                        const option = document.createElement('option');
                        option.value = ciudad.id;
                        option.textContent = ciudad.nombre;
                        ciudadDestinoSelect.appendChild(option);
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        function cancelarVuelo() {
            var codigoBoleto = document.getElementById("cancelar-input").value.trim();
            if (codigoBoleto) {
                $.ajax({
                    url: "{{ route('filtrar.vuelo') }}",
                    type: 'GET',
                    data: {
                        codigo_boleto: codigoBoleto
                    },
                    success: function(data) {
                        if (data) {
                            var informacionVuelo = `Código único: ${data.codigo_unico}\n` +
                                `Origen: ${data.ciudad_origen.nombre}\n` +
                                `Destino: ${data.ciudad_destino.nombre}\n` +
                                `Fecha de salida: ${data.fecha_salida}\n` +
                                `Fecha de regreso: ${data.fecha_regreso}\n` +
                                `Correo: ${data.correo}\n` +
                                `Celular: ${data.celular}\n` +
                                `Nombre completo: ${data.nombre_completo}\n` +
                                `Costo: ${data.costo_cancelacion}\n` +
                                `Número de identificación: ${data.numero_identificacion}`;

                            Swal.fire({
                                icon: 'info',
                                title: `Detalles del vuelo cancelado`,
                                text: informacionVuelo,
                                showCancelButton: true,
                                confirmButtonText: 'Cancelar vuelo',
                                cancelButtonText: 'Seguir con el vuelo'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¿Estás seguro?',
                                        text: 'La cancelación tiene un costo del 10% del valor del ticket.',
                                        showCancelButton: true,
                                        confirmButtonText: 'Sí, cancelar',
                                        cancelButtonText: 'No, mantener'
                                    }).then((confirmacion) => {
                                        if (confirmacion.isConfirmed) {
                                            $.ajax({
                                                url: "{{ route('cancelar.vuelo') }}",
                                                type: 'GET',
                                                data: {
                                                    codigo_boleto: codigoBoleto
                                                },
                                                success: function(response) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: '¡Vuelo cancelado!',
                                                        text: `Se ha cancelado el vuelo exitosamente. Costo de cancelación: ${response.costo_cancelacion}`
                                                    });
                                                },
                                                error: function(error) {
                                                    console.error(
                                                        'Error en la petición AJAX',
                                                        error);
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error al cancelar el vuelo',
                                                        text: 'Ocurrió un error al cancelar el vuelo. Inténtalo de nuevo más tarde.'
                                                    });
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'info',
                                                title: 'Vuelo no cancelado',
                                                text: 'El vuelo no ha sido cancelado.'
                                            });
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Seguir con el vuelo',
                                        text: 'Continuar con el proceso del vuelo.'
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: `No se encontró información para el código de boleto ingresado`,
                                text: 'Verifica el código e intenta de nuevo.'
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error en la petición AJAX', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al obtener información del vuelo',
                            text: 'Ocurrió un error al obtener la información del vuelo. Inténtalo de nuevo más tarde.'
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo vacío',
                    text: 'Por favor ingresa el código único del boleto para cancelar el vuelo.'
                });
            }
        }
    </script>






</body>

</html>
