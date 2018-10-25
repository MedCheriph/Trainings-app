@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div align="right">
            <a href="{{route('promotion.index')}}" class="btn btn-outline-info"><i class="fas fa-list"></i> Liste de sessions</a>
        </div>
        <div class="card border-info" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="text-info"><i class="fas fa-edit"></i> Modification de session</h3>
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
                <form method="post" action="{{action('PromotionController@update', $id)}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id_formation" value="{{$promotion[0]->id_formation}}">
                    <div class="form-group">
                        <label for="iintitule_formation"><i class="fas fa-graduation-cap"></i> Formation</label>
						<input type="text" class="form-control" value="{{$promotion[0]->intitule_formation}}" id="intitule_formation" name="intitule_formation" disabled>
						</select>
                    </div>
                    <div class="form-group">
                        <label for="date_lancement"><i class="fas fa-calendar-alt"></i> Date de lancement</label>
                        <input type="date" class="form-control" value="{{$promotion[0]->date_lancement}}" id="date_lancement" name="date_lancement">
                    </div>
                    <br>
                    <h3 class="text-success"><i class="fas fa-graduation-cap"></i> Promotion</h3>
                    <hr>

                    <div class="form-group">
                        <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date debut</label>
                        <input type="date" class="form-control" value="{{$promotion[0]->date_debut}}" id="date_debut" name="date_debut">
                    </div>
                    <div class="form-group">
                        <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date fin</label>
                        <input type="date" class="form-control" value="{{$promotion[0]->date_fin}}" id="date_fin" name="date_fin">
                    </div>
                    <div class="form-group">
                        <label for="pourcentage"><i class="fas fa-percentage"></i> Pourcentage</label>
                        <input type="number" class="form-control" value="{{$promotion[0]->pourcentage}}" id="pourcentage" name="pourcentage">
                    </div>
                    
                    <button type="submit" class="btn btn-outline-info"><i class="fas fa-edit"></i> Modifier session</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection