<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ITM Studya | Formations</title>
    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body style="background-color: #EEEEEE;">
    <div class="container">
        <!-- zone de recherche -->
        <div class="card border-info mb-12" style="margin-top: 50px;">
            <div class="card-body text-info">
                <h5 class="card-title">Recherche</h5>
                <form method="" action="">
                    <div class="form-row">
                        <div class="col-10" style="margin-left: 20px;">
                            <input type="text" name="search_input" class="form-control form-control-lg" placeholder="Code de formation">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-outline-info">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- tableau des formations -->
        <div class="card border-info mb-12" style="margin-top: 30px;">
            <div class="card-body text-info" style="margin-top: 20px;">
                <h5 class="card-title">Tableau des formations</h5>
                <table class="table table-hover text-dark" style="margin-top: 30px;">
                    <thead>
                        <tr>
                            <th scope="col">Code de formation</th>
                            <th scope="col">Intitulé de formation</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">INF001</th>
                            <td>JAVA Programmation Objet</td>
                            <td>8000 DA</td>
                            <td><a href="#">Consulter</a></td>
                        </tr>
                        <tr>
                            <th scope="row">INF002</th>
                            <td>Pack Web Master</td>
                            <td>6000 DA</td>
                            <td><a href="#">Consulter</a></td>
                        </tr>
                        <tr>
                            <th scope="row">INF003</th>
                            <td>Abobe Photoshop & Illustrator</td>
                            <td>6000 DA</td>
                            <td><a href="#">Consulter</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>