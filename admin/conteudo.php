
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link font-weight-bold" href="index.php">Home<span class="sr-only">(Página
                                    atual)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="sobre.php">Sobre nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="produtos.php">Loja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="contato.php">Contato</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 h-80vh" src="img/pokemart-1.jpg" alt="Primeiro Slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="font-weight-bold">Seu ponto de encontro Pokémon favorito há 28 anos!</h5>
                    <p class="font-weight-light">Encontre tudo o que você precisa para suas aventuras</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-80vh" src="img/pokemart-2.jpg" alt="Segundo Slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-dark font-weight-bold">Transforme sua coleção Pokémon em algo épico!</h5>
                    <p class="text-dark font-weight-light">Produtos oficiais e exclusivos do Japão</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-80vh" src="img/pokemart-3.jpg" alt="Terceiro Slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="font-weight-bold">A jornada Pokémon começa aqui!</h5>
                    <p class="font-weight-light">Compre seus itens favoritos e se prepare para a aventura</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
    <main class="container my-4">
        <div class="row">
            <article class="col-md-8">
                <h1 class="font-weight-bold">A MELHOR POKÉMART DA REGIÃO!</h1>
                <!-- accordion -->
                <div class="accordion" id="accordionExample">
                    <!-- card -->
                    <div class="card">
                        <div class="card-header" id="headingOne" style="background-color: #E5BB2A;">
                            <h5 class="mb-0">
                                <!-- button -->
                                <button class="btn btn-link font-weight-bold text-white" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne" style="text-decoration: none;">
                                    Variedade de Produtos
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                A PokéMart é o destino ideal para treinadores e amantes de Pokémon. Oferecemos uma ampla
                                variedade de produtos, desde poções e elixires até itens raros e acessórios para seus
                                Pokémon. Nossa seleção cuidadosamente escolhida garante que você sempre tenha o que
                                precisa para suas aventuras. Venha explorar e descubra novos itens que podem fazer a
                                diferença em suas batalhas!
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo" style="background-color: #4DAD5A;">
                            <h5 class="mb-0">
                                <button class="btn btn-link font-weight-bold text-white" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                                    aria-controls="collapseTwo" style="text-decoration: none;">
                                    Atendimento especializado
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                Na PokéMart, valorizamos nossos clientes e nos esforçamos para oferecer um atendimento
                                excepcional. Nossa equipe de atendentes é apaixonada por Pokémon e está sempre pronta
                                para ajudar. Seja para esclarecer dúvidas sobre produtos ou oferecer recomendações
                                personalizadas, estamos aqui para garantir que sua experiência de compra seja a melhor
                                possível!
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree" style="background-color: #30A7D6;">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed font-weight-bold text-white" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree" style="text-decoration: none;">
                                    Promoções Exclusivas
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                A PokéMart está sempre em busca de oferecer as melhores ofertas para seus clientes.
                                Fique de olho em nossas promoções exclusivas e descontos especiais que aparecem
                                regularmente. Com ofertas imperdíveis em produtos selecionados, você pode economizar
                                enquanto se equipa para suas jornadas. Não perca a chance de aproveitar as melhores
                                ofertas da PokéMart!
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <aside class="col-md-4">
                <section>
                    <div class="text-white p-3 mb-3 font-weight-bold" style="background-color: #30a7d6">
                        OPINIÃO DE CLIENTES
                    </div>
                    <!-- carousel -->
                    <div id="reviewCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="d-block w-100 text-center">
                                    <p>
                                        "O Poké Mart é o melhor lugar para comprar itens para minhas
                                        aventuras! Adoro a variedade de produtos disponíveis!"
                                    </p>
                                    <p><strong>— Ash Ketchum.</strong></p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="d-block w-100 text-center">
                                    <p>
                                        "Os preços são justos e a equipe é super amigável! Sempre
                                        que vou lá, saio satisfeito!"
                                    </p>
                                    <p><strong>— Misty.</strong></p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="d-block w-100 text-center">
                                    <p>
                                        "Ótimo atendimento e produtos de qualidade. Recomendo a
                                        todos os treinadores!"
                                    </p>
                                    <p><strong>— Brock.</strong></p>
                                </div>
                            </div>
                        </div>

                        <a class="carousel-control-prev blk" href="#reviewCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon blk" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next blk" href="#reviewCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon blk" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </section>
                <section>
                    <div class="text-white p-3 mb-3 font-weight-bold" style="background-color: #30a7d6">
                        ÚLTIMAS NOTÍCIAS
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <h5 class="font-weight-bold text-center">ATENDENTE DO POKÉMART MANDANDO O PASSINHO</h5>
                                <p class="font-weight-light text-center">- PokeMonDaily</p>
                                <img class="d-block w-100 h-95vh" src="img/GIF-POKEMART.gif" alt="Primeiro Slide">
                            </div>
                            <div class="carousel-item">
                                <h5 class="font-weight-bold text-center">ENFERMEIRA JOY TAMBÉM TEM O GINGADO</h5>
                                <p class="font-weight-light text-center">- ThePokeTimes</p>
                                <img class="d-block w-100 h-95vh" src="img/GIF-NURSEJOY.gif" alt="Segundo Slide">
                            </div>
                            <div class="carousel-item">
                                <h5 class="font-weight-bold text-center">JAMES FLAGRADO EM BATALHA DE CAPOEIRA</h5>
                                <p class="font-weight-light text-center">- PKM</p>
                                <img class="d-block w-100 h-95vh" src="img/GIF-JAMES.gif" alt="Terceiro Slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </div>
                </section>

            </aside>
        </div>
    </main>
