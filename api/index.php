       <?php
if (isset($_GET['keyword'])) {
  $keyword = urlencode($_GET['keyword']);
  $category = urlencode($_GET['category']);
  $api_key = '13119377-fc7e10c6305a7de49da6ecb25';

  $url = 'https://pixabay.com/api/?key=' . $api_key . '&q=' . $keyword;
  if (!empty($category)) {
    $url .= '&category=' . $category;
  }

  // Realizar la petición a la API de Pixabay y mostrar los resultados
}
?>
<?php
if (isset($_GET['keyword'])) {
  // ...

  $json = file_get_contents($url);
  $data = json_decode($json, true);

  if ($data['totalHits'] > 0) {
    echo '<div class="container">';
    echo '<div class="row">';
    foreach ($data['hits'] as $hit) {
      echo '<div class="col-md->';}
    }
}
      ?>

<!DOCTYPE html>
<body>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BUSCAR IMAGENES</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Buscar imagen del producto</h1>
    <hr>

    <div class="row">
        <form id="search-form" class="form-inline">
            <div class="form-group">
                <label for="search">Search:</label>
                <input type="text" class="form-control" id="search" placeholder="Search images...">
            </div>
            <div class="form-group">
          <label for="category">Categoría:</label>
          <select class="form-control" id="category" name="category">
                    <option value="">Select Category</option>
                    <option value="science">Science</option>
                    <option value="education">Education</option>
                    <option value="people">People</option>
                    <option value="feelings">Feelings</option>
                    <option value="computer">Computer</option>
                    <option value="buildings">Buildings</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>

            
        </form>
    </div>

    <hr>

    <div id="results" class="row">
        <!-- Results will be displayed here -->
    </div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- JavaScript-->
<script src="./js/app.js"></script>





   

  
  <div class="container">

  <?php include './modules/footer.php';
  ?>
</body>

</html>

</body>

</html>