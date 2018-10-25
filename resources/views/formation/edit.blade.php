@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div align="right">
            <a href="{{route('formation.index')}}" class="btn btn-outline-info"><i class="fas fa-list"></i> Liste de formations</a>
        </div>
        <div class="card border-info" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="text-info"><i class="fas fa-edit"></i> Modification de formation</h3>
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

                <form method="post" action="{{action('FormationController@update', $id)}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="code-formation"><i class="fas fa-code"></i> Code de formation *</label>
                        <input type="text" class="form-control" id="code-formation" value="{{$formation->code_formation}}" name="code_formation">
                    </div>
                    <div class="form-group">
                        <label for="intitule-formation"><i class="fas fa-book"></i> Intitulé de formation *</label>
                        <input type="text" class="form-control" id="intitule-formation" value="{{$formation->intitule_formation}}" name="intitule_formation">
                    </div>
                    <div class="form-group">
                        <label for="duree-formation"><i class="fas fa-calendar-alt"></i> Durée *</label>
                        <input type="text" class="form-control" id="duree-formation" value="{{$formation->duree_formation}}"  name="duree_formation" required>
                    </div>
                    <div class="form-group">
                        <label for="objectif"><i class="fas fa-bolt"></i> Objectifs</label>
                        <textarea class="form-control" id="objectif" name="objectif" rows="3">{{$formation->objectif}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="prerequis"><i class="fas fa-toolbox"></i> Prérequis</label>
                        <textarea class="form-control" id="prerequis" name="prerequis" rows="3">{{$formation->prerequis}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="deb-pro"><i class="fas fa-briefcase"></i> Débouchés Professionels</label>
                        <textarea class="form-control" id="deb-pro" name="deb_pro" rows="3">{{$formation->deb_pro}}</textarea>
                    </div>  
                    <div class="form-group">
                        <label for="prix-formation"><i class="fas fa-dollar-sign"></i> Prix de formation</label>
                        <input type="number" class="form-control" id="prix-formation" value="{{$formation->prix_formation}}" name="prix_formation">
                    </div>
                    <button type="submit" class="btn btn-outline-info" value="Edit"><i class="fas fa-edit"></i> Modifier formation</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection