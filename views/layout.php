<!doctype html>
<html lang="en">
  <head>
    <title>24 Data</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <style>
        form {
            margin-bottom: 20px;
        }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#">24 Data</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <main role="main" class="container">

    <h1>24 Data JSON Table</h1>

    <?php foreach ($errors as $error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endforeach ?>

    <form method="GET" class="form">
        <div class="row">
            <div class="col-5">
                <select name="sort_by" class="form-control">
                    <option value="">Sort By</option>
                <?php foreach ($availableFields as $field): ?>
                    <?php if ($selectedSortBy == $field): ?>
                    <option selected><?= $field ?></option>
                    <?php else: ?>
                    <option><?= $field ?></option>
                    <?php endif ?>
                <?php endforeach ?>
                </select>
            </div>
            <div class="col-5">
                <select name="sort_order" class="form-control">
                    <option value="">Sort Order</option>
                    <?php if ($selectedSortOrder == 'ASC'): ?>
                    <option value="ASC" selected>Ascending</option>
                    <?php else: ?>
                    <option value="ASC">Ascending</option>
                    <?php endif ?>

                    <?php if ($selectedSortOrder == 'DESC'): ?>
                    <option value="DESC" selected>Descending</option>
                    <?php else: ?>
                    <option value="DESC">Descending</option>
                    <?php endif ?>
                </select>
            </div>
            <div class="col-2 text-right">
                <button type="submit" class="btn btn-outline-secondary">Sort</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
        </thead>
        <tbody>
            <?php foreach ($people as $person): ?>
            <tr>
                <td><?= $person->FName ?></td>
                <td><?= $person->LName ?></td>
                <td><?= $person->Age ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    </main><!-- /.container -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>

