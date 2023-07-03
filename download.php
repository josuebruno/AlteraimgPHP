<?php
if(isset($_GET['image']) && isset($_GET['width']) && isset($_GET['height'])) {
  $imagePath = $_GET['image'];
  $width = $_GET['width'];
  $height = $_GET['height'];

  // Carregar a imagem original
  $originalImage = imagecreatefromstring(file_get_contents($imagePath));

  if ($originalImage === false) {
    // Tratar o caso em que a imagem não pode ser carregada corretamente
    die('A imagem não pôde ser carregada.');
  }

  // Redimensionar a imagem
  $resizedImage = imagescale($originalImage, $width, $height);

  if ($resizedImage === false) {
    // Tratar o caso em que a imagem não pode ser redimensionada corretamente
    die('A imagem não pôde ser redimensionada.');
  }

  // Definir o cabeçalho para forçar o download da imagem como JPEG
  header('Content-Type: image/jpeg');
  header('Content-Disposition: attachment; filename="download.jpg"');

  // Exibir a imagem redimensionada como JPEG
  imagejpeg($resizedImage);

  // Liberar a memória
  imagedestroy($originalImage);
  imagedestroy($resizedImage);
}
?>
