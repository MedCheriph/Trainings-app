@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div align="right">
            <a href="{{route('promotion.index')}}" class="btn btn-outline-info"><i class="fas fa-list"></i> Liste des sessions</a>
        </div>
        <div class="card border-info" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="text-info"><i class="fas fa-calendar-alt"></i> Session</h3>
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
                <form method="post" action="{{url('promotion')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="id_formation"><i class="fas fa-graduation-cap"></i> Formation</label>
						<select class="custom-select" id="id_formation" name="id_formation">
							<option selected>Choisissez une formation</option>
							@foreach($formations as $row)
								<option value="{{$row['id']}}">{{$row['intitule_formation']}}</option>
							@endforeach
						</select>
                    </div>
                    <div class="form-group">
                        <label for="date_lancement"><i class="fas fa-calendar-alt"></i> Date de lancement</label>
                        <input type="date" class="form-control" id="date_lancement" name="date_lancement">
                    </div>
                    <br>
                    <h3 class="text-success"><i class="fas fa-graduation-cap"></i> Promotion</h3>
                    <hr>
                    <div class="form-group">
                        <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date debut</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut">
                    </div>
                    <div class="form-group">
                        <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin">
                    </div>
                    <div class="form-group">
                        <label for="pourcentage"><i class="fas fa-percentage"></i> Pourcentage</label>
                        <input type="number" class="form-control" id="pourcentage" name="pourcentage">
                    </div>
                    <button type="submit" class="btn btn-outline-info"><i class="fas fa-plus-circle"></i> Ajouter session</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection