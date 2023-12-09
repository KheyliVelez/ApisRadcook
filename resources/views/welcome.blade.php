@extends('layouts.app')

@section('content')

<div class="container">

    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow-lg">

          <div class="carousel-item active" data-bs-interval="2000">
            <img src="{{ asset('images/slider1.jpg') }}" class="d-block w-100" alt="">
          </div>


          <div class="carousel-item" data-bs-interval="3000">
            <img src="{{ asset('images/slider2.jpg') }}" class="d-block w-100" alt="...">
          </div>


          <div class="carousel-item" data-bs-interval="3000">
            <img src="{{ asset('images/slider3.png') }}" class="d-block w-100" alt="...">
          </div>

          <div class="carousel-item " data-bs-interval="3000">
            <img src="{{ asset('images/slider4.jpeg') }}" class="d-block w-100" alt="...">
          </div>

          <div class="carousel-item" data-bs-interval="3000">
            <img src="{{ asset('images/slider4.jpg') }}" class="d-block w-100" alt="...">
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel"  data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel"  data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container py-5">

        <div class="jumbotron custom-jumbotron rounded shadow-sm text-center text-success bg-custom-beish">
            <h1 class="display-4">¡Bienvenidos a RadCook!</h1>
            <p class="lead">Descubre, crea e interactua con miles de recetas, todo al alcance de tu despensa </p>
            <hr class="my-4">
            <p>Descubre de qué trata nuestro proyecto</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="{{ url('/learn') }}" role="button">Descubre RadCook</a>
            </p>
            <br>
        </div>
    </div>
    <!--
    <section class="d-flex flex-column justify-content-center align-items-center pt-5  text-center w-100 m-auto" id="intro">

        <div class="jumbotron custom-jumbotron rounded shadow-sm text-center  bg-custom-beish">
            <h1 class="p-3 fs-2 border-top border-3">Tu receta en tu despensa <span class="text-success">RadCook<span></h1>
                <p class="p-3  fs-4"> <span class="text-success">RadCook</span> Te ayuda a encontrar esa receta para cada ocasión, ingresa tus propios ingredientes o encuentra gran variedad creadas por nuestros propios usuarios...
                    <br> ¡Comparte tu receta y sé parte de esta gran comunidad!
                </p>
        </div><br>

        <div class="jumbotron custom-jumbotron rounded shadow-sm text-center  bg-custom-beish">

        </div>

    </section> -->

    <div class="container">
        <div class="jumbotron custom-jumbotron rounded shadow-sm text-center text-success bg-custom-beish">
            <form method="POST" action="{{ route('recip.filter') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @csrf
                <div class="form-check form-check-inline">
                    @foreach($map as $type => $ingredients)
                        @foreach ($ingredients as $ingredient)
                            <input type="checkbox" name="ingredients[]" value={{$ingredient['id']}}> <label>{{$ingredient['name']}}</label>
                        @endforeach
                    @endforeach
                </div>
                <div class="box-footer mt20">
                    <button type="submit" class="btn btn-success">{{ __('Buscar') }}</button>
                </div>
                <br>
            </form>
        </div>
        <br><br>
            <div class="row justify-content-center">
            @foreach ($recipes as $recipe)
                <div class="col-md-4 row justify-content-center">
                    <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                        <div class="card-header shadow-sm rounded"><h2>{{$recipe->name}}<br></h2></div>
                        <div class="card-body">
                            <img class="receta rounded" src="{{ asset($recipe->image) }}" alt="">
                            <br>
                          <h2 class="card-title">Descripción</h2>
                          <p class="card-text">{{$recipe->description}}</p>

                        </div>
                        <a class="btn btn-sm btn-primary " href="{{ route('recipes.show',$recipe->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver receta') }}</a>
                    </div>
                </div>
            @endforeach

        <!--
            <div class="col-md-3 row justify-content-center">
                <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                    <div class="card-header shadow-sm rounded"><h2>Huevos pericos<br></h2></div>
                    <div class="card-body">
                        <img class="receta rounded" src="{{ asset('images/huevoperico.jpg') }}" alt="">
                        <br>
                      <h2 class="card-title">Descripción</h2>
                      <p class="card-text"> Los "huevos pericos" es un plato típico de la gastronomía colombiana.
                        Se prepara principalmente con huevos batidos y mezclados con tomate y cebolla picados finamente.
                      </p>

                    </div>
                    <a href="#" class="btn btn-success">Ver receta</a>
                </div>
            </div>
            <div class="col-md-3 row justify-content-center">
                <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                    <div class="card-header shadow-sm rounded"><h2>Arroz con leche</h2></div>
                    <div class="card-body">
                        <img class="receta rounded" src="{{ asset('images/arrozconleche.jpg') }}" alt="">
                        <br>
                      <h2 class="card-title">Descripción</h2>
                      <p class="card-text">
                        El arroz con leche es un postre tradicional que se disfruta en muchas partes del mundo,
                        con variantes regionales. Consiste en una mezcla de arroz cocido,
                         leche, azúcar y a menudo canela, cocidos juntos hasta obtener una textura cremosa y dulce
                        </p>
                    </div>
                    <a href="#" class="btn btn-success">Ver receta</a>
                </div>
            </div>
            <div class="col-md-3 row justify-content-center">
                <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                    <div class="card-header shadow-sm rounded"><h2>Fríjoles<br></h2></div>
                    <div class="card-body">
                        <img class="receta rounded" src="{{ asset('images/frijoles.jpg') }}" alt="">
                        <br>
                      <h2 class="card-title">Descripción</h2>
                      <p class="card-text">
                        Los frijoles son un alimento básico en muchas culturas.
                        Son legumbres ricas en proteínas y se preparan cocinándolos
                         hasta que estén tiernos y se sirven en una variedad de platos,
                         desde sopas hasta guarniciones.
                        </p>

                    </div>
                    <a href="#" class="btn btn-success">Ver receta</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center "  >

            <div class="col-md-3 row justify-content-center">
                <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                    <div class="card-header shadow-sm rounded"><h2>Arroz blanco<br></h2></div>
                    <div class="card-body">
                        <img class="receta rounded" src="{{ asset('images/arrozblanco.jpg') }}" alt="">
                        <br>
                      <h2 class="card-title">Descripción</h2>
                      <p class="card-text"> El arroz blanco es un plato básico y versátil
                        que consiste en granos de arroz cocidos al vapor o hervidos hasta que se
                        vuelven tiernos y suaves. Este plato es consumido en todo el mundo
                         y sirve como acompañamiento ideal para una amplia variedad de platos,
                          desde carnes y aves hasta vegetales y salsas.
                      </p>
                    </div>
                    <a href="#" class="btn btn-success">Ver receta</a>

                </div>
            </div>
            <div class="col-md-3 row justify-content-center">
                <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                    <div class="card-header shadow-sm rounded"><h2>Milanesa de cerdo</h2></div>
                    <div class="card-body">
                        <img class="receta rounded" src="{{ asset('images/milanesadecerdo.jpg') }}" alt="">
                        <br>
                      <h2 class="card-title">Descripción</h2>
                      <p class="card-text">
                        La milanesa de cerdo es un plato que consiste en filetes finos de carne de cerdo empanizados y fritos
                         hasta que estén dorados y crujientes. Es una deliciosa preparación que combina la ternura de la carne de cerdo
                          con una cobertura crujiente, y es popular en muchas cocinas del mundo.
                        </p>

                    </div>
                    <a href="#" class="btn btn-success">Ver receta</a>
                </div>
            </div>
            <div class="col-md-3 row justify-content-center">
                <div class="card bg-light mb-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 18rem;">
                    <div class="card-header shadow-sm rounded"><h2>Puré de papa<br></h2></div>
                    <div class="card-body">
                        <img class="receta rounded" src="{{ asset('images/purepapa.jpg') }}" alt="">
                        <br>
                      <h2 class="card-title">Descripción</h2>
                      <p class="card-text">
                        El puré de papa es un plato clásico que consiste en papas cocidas y
                         luego aplastadas o trituradas hasta obtener una textura suave y cremosa.
                          Es un acompañamiento versátil y reconfortante que se sirve comúnmente
                          con otros platos como carnes y salsas.
                        </p>
                    </div>
                    <a href="#" class="btn btn-success">Ver receta</a>
                </div>
            </div>
        </div>
    </div>
    </div>-->

    <section class="w-100">
    <div class="row w-75 mx-auto" id="servicios-fila-1">
        <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-start my-5 icono-wrap">
            <img src="{{ asset('images/ingredientes.png') }}" alt="ingredientes"   width="180" height="160">

            <div>
                <h2 class="fs-5 mt-4 px-4 pb-1">Sus ingredientes</h2>
                <p class="px-4">Ingrese sus ingredientes</p>
            </div>

        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-start  my-5 icono-wrap">
            <img src="{{ asset('images/crear.png') }}" width="180" height="160">

            <div>
                <h3 class="fs-5 mt-4 px-4 pb-1 icono-wrap">Crear</h3>
                <p class="px-4">Cree su receta</p>
            </div>
        </div>
    </div>

    <div class="row w-75 mx-auto mb-5" id="servicios-fila-2">
        <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-start  my-5 icono-wrap">
            <img src="{{ asset('images/recetas.png') }}" alt="recetas" width="180" height="160">

            <div>
                <h3 class="fs-5 mt-4 px-4 pb-1">Recetas</h3>
                <p class="px-4">Busque en nuestro gran contenido de recetas.</p>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-start my-5 icono-wrap">
            <img src="{{ asset('images/foro.png') }}" alt="Foro" width="180" height="160" >

            <div>
                <h3 class="fs-5 mt-4 px-4 pb-1">Foro</h3>
                <p class="px-4">Dialogue y comparta su opinión en nuestro foro.</p>
            </div>
        </div>
    </div>
</section>


    <div class="jumbotron custom-jumbotron rounded shadow-sm text-center  bg-custom-beish">
        <div class="container w-50 m-auto text-center" id="equipo">
            <h1 class="mb-5 fs-2"><br>Una receta no tiena alma. <span class="text-success"><br>Es el cocinero es quien debe darle alma a la receta</span>.</h1>
            <p class="fs-4 ">Somos un equipo pequeño compremetidos con el desarrollo de esta plataforma web... descarga nuestra app en tu movil donde podras guardar y descargar tus recetas. <br> </p>
        </div>
    </div>


</div>
<footer class="bg-success py-3 text-center">
    <a href="#" class="text-white">RadCook, todos los derechos reservados. <br>
    Contacto: radcook@gmail.com</a>
</footer>

@endsection
