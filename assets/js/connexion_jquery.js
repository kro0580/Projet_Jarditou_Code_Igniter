function verif2() 
{     
     // Récupère la valeur saisie dans le champ input      
     var email = $("#mail").val();
     var email_v = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,252}\.[a-z]{2,4}$/;
     var password = $("#password").val();
     var password_v = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/;
     
// On teste si la valeur est bonne

     // EMAIL

     if (email === "") 
     {            
        var html = '<div class="alert alert-danger" role="alert">Votre email doit être renseigné !</div>';
        $("#alert1").append(html); 
     }
     else if (email_v.test(email) == false)
     {
        var html = '<div class="alert alert-warning" role="alert">Format non valide !</div>';
        $("#alert1").append(html);
     }
     else
     {
         var html = '<div class="alert alert-success" role="alert">Votre email est validé</div>';
         $("#alert1").append(html);
     }


     // PASSWORD

     if (password === "") 
     {            
        var html = '<div class="alert alert-danger" role="alert">Votre mot de passe doit être renseigné !</div>';
        $("#alert2").append(html); 
        return false;
     }
     else if (password_v.test(password) == false)
     {
        var html = '<div class="alert alert-warning" role="alert">Format non valide !</div>';
        $("#alert2").append(html);
        return false;
     }
     else
     {
         var html = '<div class="alert alert-success" role="alert">Votre mot de passe est validé</div>';
         $("#alert2").append(html);
     }


    // Si aucun test n'a renvoyé faux, c'est qu'il n'y a pas d'erreur, le script arrive ici, le formulaire est envoyé via submit()
    document.forms[0].submit();

}

     $("#bouton_envoi2").click(function(event) 
{
    /* 
    On doit bloquer l'èvènement par défaut - ici l'envoi du formulaire avec l'instruction preventDefault(). Le paramètre 'event' est un objet (nommé librement) représentant l'évènement
    */         
    event.preventDefault();
 
    // Appel de la fonction verif()
    verif2();             
});