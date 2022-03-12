@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <label for="Search">Pesquisa</label>
                        <input class="form-control mb-3" type="text" id="Search" onkeyup="nameBrawl()"
                            placeholder="Nome do Brawl.." title="Nome do Brawl">
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center mb-2 d-flex">

                <div class="card">
                    <div class="card-body">
                        <center>
                            <small>Seleção Rápida</small>
                        </center>
                        <button onclick="Pesquisa(this)" id="Trophy" title="Trophy" class="btn rounded-pill w-auto rary">
                        </button>
                        <button onclick="Pesquisa(this)" id="Rare" title="Rare" class="btn rounded-circle w-auto rary Rare">
                        </button>
                        <button onclick="Pesquisa(this)" id="Super Rare" title="Super"
                            class="btn rounded-circle w-auto rary Super">
                        </button>
                        <button onclick="Pesquisa(this)" id="Epic" title="Epic" class="btn rounded-circle w-auto rary Epic">
                        </button>
                        <button onclick="Pesquisa(this)" id="Mythic" title="Mythic"
                            class="btn rounded-circle w-auto rary Mythic">
                        </button>
                        <button onclick="Pesquisa(this)" id="Legendary" title="Legendary"
                            class="btn rounded-circle w-auto rary Legendary">
                        </button>
                        <button onclick="Pesquisa(this)" id="Chromatic" title="Chromatic"
                            class="btn rounded-circle w-auto rary Chromatic">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <hr class="sep-3">
            </div>
            @foreach ($data as $brawl)
                <div class="col-md-4 mb-4">
                    <div class="card shadow" id="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <h5 class="card-title"><b>{{ $brawl['name'] }}</b></h5>
                                    </div>
                                    <div class="col-md-6 text-center rary {{ $brawl['rarity']['name'] }}">
                                        {{ $brawl['rarity']['name'] ?? '' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <img class="card-img-top brawl-img shadow" src="{{ $brawl['imageUrl'] ?? '' }}" alt="">
                            </div>

                            <div class="col-md-12">
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <h6 class="card-title"><i>Acessórios:</i></h6>

                                        <hr class="desc">
                                        @foreach ($brawl['gadgets'] as $gadgets)
                                            <li class="card-subtitle">{{ $gadgets['name'] }}</li>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="card-title"><i>Poder de estrela:</i></h6>
                                                                                <hr class="desc">
                                        @foreach ($brawl['starPowers'] as $starPowers)
                                            <li class="card-subtitle">{{ $starPowers['name'] }}</li>
                                        @endforeach
                                    </div>
                                    <p class="card-body">
                                        <hr class="desc">
                                        {{ $brawl['description'] ?? '' }}
                                    </p>
                                    <center>
                                        <a href="#">
                                            <button class="btn btn-outline-success w-50 rounded-pill shadow">
                                                Detalhes
                                            </button>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function nameBrawl() {
            var input = document.getElementById("Search");
            var filter = input.value.toLowerCase();
            var nodes = document.getElementsByClassName('col-md-4');

            for (i = 0; i < nodes.length; i++) {
                if (nodes[i].innerText.toLowerCase().includes(filter)) {
                    nodes[i].style.display = "block";
                } else {
                    nodes[i].style.display = "none";
                }
            }
        }

        function Pesquisa(o) {
            var Serach = document.getElementById('Search');
            Serach.value = o.id;
            nameBrawl();
        }
    </script>
@endsection
