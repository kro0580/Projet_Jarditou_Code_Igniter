<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site Jarditou - Bootstrap</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  <!-- Bootstrap select pour styliser le menu déroulant dans formulaire -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css" rel="stylesheet"> 
  <!-- Feuille de style CSS -->
  <link rel="stylesheet" href="http://localhost/Jarditou_ci/assets\css\style.css">
  <!-- Script pour sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

<script>
swal({
  title: "Etes-vous certain ?",
  text: "Une fois supprimé, ce produit ne pourra plus être réccupéré",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Bravo ! Votre produit a bien été supprimé !", {
      icon: "success",
      button: false,
    });
  } else {
    swal("Votre produit n'a pas été supprimé !");
  }
});
</script>
<script>
window.setTimeout("location=('http://localhost/Jarditou_ci/index.php/produits/liste');",6000); // Redirection vers le tableau des produits avec un laps de temps
</script>


</body>

</html>