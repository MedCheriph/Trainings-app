@extends('layouts.app')

@section('content')

<style>
    th { cursor: pointer; }
</style>

<div class="row">
    <div class="col-12">
        @if(Auth::user()['type'] == 'admin')
        <div align="right">
            <a href="{{route('promotion.create')}}" class="btn btn-outline-info"><i class="fas fa-plus-circle"></i> Ajouter session</a>
        </div>
        @endif
        <div class="row">
            <div class="input-group col-12" style="margin-top: 15px;">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="searchCode" onkeyup="SearchFunctionCode()" class="form-control form-control-lg" placeholder="Code ou Intitulé de formation ...">
            </div>
        </div>
        <div class="card border-info" style="margin-top: 15px;">
            <div class="card-body">
                <span style="float: right;">*<strong>{{$promotions->count()}}</strong> sessions au total</span>
                
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 30px;">
                    {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table id="formationsTable" class="table table-hover" style="margin-top: 30px;">
                    <thead>
                        <tr>
                            <th scope="col" onclick="sortTable(1)">code_formation <i class="fas fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(2)">intitule_formation <i class="fas fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Date de lancement <i class="fas fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)">Remise <i class="fas fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Prix calculé <i class="fas fa-sort-down"></i></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $date = date("Y-m-d");
                        ?> 
                        @foreach($promotions as $row)
                            @if($date < $row->date_lancement)
                            <tr>
                                <th scope="row">{{$row->code_formation}}</th>
                                <td>{{$row->intitule_formation}}</td>
                                <td>{{$row->date_lancement}}</td>
                                <td>
                                    @if($row->pourcentage == NULL)
                                        <p class="text-danger">Pas de remise</p>
                                    @else
                                        <p class="text-success">{{$row->pourcentage}} %</p>
                                    @endif
                                </td>
                                <th>
                                   {{$row->prix_c}} DA
                                </th>
                                @if(Auth::user()['type'] == 'admin')
                                <td>
                                    <a href="{{action('PromotionController@edit', $row->id)}}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i> Modifier</a>
                                </td>
                                <td>
                                    <form action="{{action('PromotionController@destroy', $row->id)}}" method="post" class="delete_form">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Supprimer</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- delete formations -->
<script>
$(document).ready(function(){
    $('.delete_form').on('submit', function(){
        if(confirm('Voulez vous vraiment supprimer cette formation ?')){
            return true;
        }else{
            return false;
        }
    });
});
</script>
<!-- search formation -->
<script>
function SearchFunctionCode() {
    var input, filter, table, tr, td1,td2,td3,i;
    input = document.getElementById("searchCode");
    //input.trim();
    filter = input.value.toUpperCase().trim();
    table = document.getElementById("formationsTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("th")[0];
        td2 = tr[i].getElementsByTagName("td")[0];
        td3 = tr[i].getElementsByTagName("td")[1];

        if(td1&&td2){
            if(td1.innerHTML.toUpperCase().indexOf(filter) > -1 ||
                td2.innerHTML.toUpperCase().indexOf(filter)> -1 ||
                td3.innerHTML.toUpperCase().indexOf(filter)> -1) {
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        } 
    }
}

</script>
<!-- sort formations -->
<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("formationsTable");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else 
                if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++; 
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>

@endsection