@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card border-info" style="margin-top: 20px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7"><h3 class="text-info"><i class="fas fa-graduation-cap"></i> Formation</h3></div>
                    <div class="col-md-5"><a href="{{route('formation.index')}}" class="btn btn-outline-info"><i class="fas fa-list"></i> Liste de formations</a></div>
                </div>
                <hr>
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 30px;">
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(\Session::has('success'))
                <div class="alert alert-success" role="alert" style="margin-top: 30px;">
                    {{\Session::get('success')}}
                </div>
                @endif
                <div>
                    <p><strong><i class="fas fa-code "></i> Code : </strong>{{$formation->code_formation}}</p>
                    <p><strong><i class="fas fa-book"></i> Intitulé : </strong>{{$formation->intitule_formation}}</p>
                    <p><strong><i class="fas fa-calendar-alt"></i> Durée : </strong>{{$formation->duree_formation}}</p>
                    <p><strong><i class="fas fa-bolt"></i> Objectif : </strong>{{$formation->objectif}}</p>
                    <p><strong><i class="fas fa-toolbox"></i> Prérequis : </strong>{{$formation->prerequis}}</p>
                    <p><strong><i class="fas fa-briefcase"></i> Débouchés professionels : </strong>{{$formation->deb_pro}}</p>
                    <p><strong><i class="fas fa-dollar-sign"></i> Prix original : </strong>{{$formation->prix_formation}} DA</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card border-success" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="text-success"><i class="fas fa-calendar-alt"></i> Sessions</h3>
                <hr>
                <div>
                    @if($sessions->count() == 0)
                    <p class="text-danger">Pour l'instant, Il n'y a pas de session pour cette formation !</p>
                    @else
                    <p>Vous trouvez ici les dates des prochains lancements pour cette formations: </p>
                    <ul>
                        @foreach($sessions as $row)
                        <li><strong>{{$row->date_lancement}}</strong></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        @if($promotions->count() != 0)
        <div class="card border-danger animated shake" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="text-danger"><i class="fas fa-award"></i> Promotions</h3>
                <hr>
                <div>
                    <p>Vous trouvez ici les périodes des promotions pour cette formation: </p>
                    <ul>
                        @foreach($promotions as $row)
                        <li>de <strong>{{$row->date_debut}}</strong> jusqu'à <strong>{{$row->date_fin}}</strong> avec une réduction de : <strong>{{$row->pourcentage}} %</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection