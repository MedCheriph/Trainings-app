@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div align="right">
            <a href="{{route('formation.index')}}" class="btn btn-outline-info"><i class="fas fa-list"></i> Liste de formations</a>
        </div>
        <div class="card border-info" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="text-info"><i class="fas fa-plus-circle"></i> Ajout de formation</h3>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 30px;">
                    {{\Session::get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form method="post" action="{{url('formation')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="code-formation"><i class="fas fa-code"></i> Code de formation *</label>
                        <input type="text" class="form-control" id="code-formation" placeholder="ex. INF001" name="code_formation" required>
                    </div>
                    <div class="form-group">
                        <label for="intitule-formation"><i class="fas fa-book"></i> Intitulé de formation *</label>
                        <input type="text" class="form-control" id="intitule-formation" placeholder="ex. Bureautique" name="intitule_formation" required>
                    </div>
                    <div class="form-group">
                        <label for="duree-formation"><i class="fas fa-calendar-alt"></i> Durée *</label>
                        <input type="text" class="form-control" id="duree-formation" placeholder="ex. 3 mois" name="duree_formation" required>
                    </div>
                    <div class="form-group">
                        <label for="objectif"><i class="fas fa-bolt"></i> Objectifs</label>
                        <textarea class="form-control" id="objectif" name="objectif" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prerequis"><i class="fas fa-toolbox"></i> Prérequis</label>
                        <textarea class="form-control" id="prerequis" name="prerequis" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deb-pro"><i class="fas fa-briefcase"></i> Débouchés Professionels</label>
                        <textarea class="form-control" id="deb-pro" name="deb_pro" rows="3"></textarea>
                    </div>        
                    <div class="form-group">
                        <label for="prix-formation"><i class="fas fa-dollar-sign"></i> Prix de formation</label>
                        <input type="number" min="0" step="10" class="form-control" id="prix-formation" placeholder="ex. 8000" name="prix_formation" required>
                    </div>
                    <button type="submit" class="btn btn-outline-info"><i class="fas fa-plus-circle"></i> Ajouter formation</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection