<!DOCTYPE html>

<html lang="fr">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Site Jarditou - Bootstrap</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Bootstrap select pour styliser le menu déroulant dans formulaire -->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <!-- Feuille de style CSS -->
  <link rel="stylesheet" href="<?=base_url('assets\css\style.css')?>">
  <!-- Script pour sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

  <script>
    swal({
      title: "Good job !",
      text: "Votre mot de passe a bien été modifié !",
      icon: "success",
      button: false,
    });
    window.setTimeout("location=(<?=site_url('produits/liste')?>;)", 2000); // Redirection vers le tableau des produits avec un laps de temps
  </script>

</body>

</html>