@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <input type="text" id="Search" onkeyup="nameBrawl()" placeholder="Nome do Brawl.." title="Nome do Brawl">
    </div>
    <br>
    <div class="row justify-content-center">
        @foreach ($data as $brawl)
            <div class="card" style="width: 18rem;" id = "{{ $brawl['rarity']['name'] }}">
                <img class="card-img-top" src="{{$brawl['imageUrl'] ?? ''}}" alt="">
                <div class="card-body">
                <h5 class="card-title"><b>{{ $brawl['name'] }}</b></h5>

                <h6 class="card-title"><i>Raridade:</i></h6>
                <li class="card-subtitle">{{ $brawl['rarity']['name'] ?? '' }}</li>
                
                <h6 class="card-title"><i>Acessórios:</i></h6>
                @foreach ($brawl['gadgets'] as $gadgets)
                    <li class="card-subtitle">{{ $gadgets['name'] }}</li>
                @endforeach
                
                <h6 class="card-title"><i>Poder de estrela:</i></h6>
                @foreach ($brawl['starPowers'] as $starPowers)
                    <li class="card-subtitle">{{ $starPowers['name'] }}</li>
                @endforeach

                <p class="card-body">
                    {{ $brawl['description'] ?? '' }}
                </p>

                <a href="#" class="btn btn-primary">Detalhes</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function nameBrawl() {
        var input = document.getElementById("Search");
        var filter = input.value.toLowerCase();
        var nodes = document.getElementsByClassName('card');

        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
            nodes[i].style.display = "block";
            } else {
            nodes[i].style.display = "none";
            }
        }
    }
</script>
@endsection