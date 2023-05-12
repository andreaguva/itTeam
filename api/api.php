<?php
$apiKey = '13119377-fc7e10c6305a7de49da6ecb25';

// Obtener la palabra de búsqueda ingresada por el usuario
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Obtener la categoría seleccionada por el usuario
$category = isset($_GET['category']) ? $_GET['category'] : '';

$url = 'https://pixabay.com/api/?key=' . $apiKey . '&q=' . urlencode($searchQuery) . '&category=' . urlencode($category);

$response = file_get_contents($url);
$data = json_decode($response, true);

// Analizar la respuesta JSON
if ($data['totalHits'] > 0) {
    foreach ($data['hits'] as $image) {
        echo '<img src="' . $image['webformatURL'] . '" alt="Imagen">';
    }
} else {
    echo 'No se encontraron imágenes.';
}
?>
