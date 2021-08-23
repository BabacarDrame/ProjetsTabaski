<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootsttrap 3 -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
    <title>Saisie membre</title>
</head>
<body>
<?php 
    $bdd = new PDO('mysql:host=localhost; dbname=espacemembre', 'root', '');
    if(isset($_GET['submit'])){
          if(!empty($_GET['matricul']) && !empty($_GET['nom']) && !empty($_GET['prenom']) && !empty($_GET['adresse']) && !empty($_GET['tel']) ){
              $matricule=htmlspecialchars($_GET['matricul']);
              $nom= htmlspecialchars($_GET['nom']);
              $prenom=htmlspecialchars($_GET['prenom']);
              $adresse=htmlspecialchars($_GET['adresse']);
              $tel=htmlspecialchars($_GET['tel']);
              $matricul=$bdd->prepare("SELECT* FROM membre WHERE Matricule=?");
              $matricul->execute(array($matricule));
              $matriculexist=$matricul->rowCount();
                if($matriculexist==0)
                {
                      $insertmbr=$bdd->prepare("INSERT INTO membre(Matricule,Nom,Prenom,Adresse,Tel) VALUES(?,?,?,?,?,?)");
                      $insertmbr->execute(array($matricule,$nom,$prenom,$adresse,$tel));
                      // $alert=" Bonjour"." ".$nom. $prenom." "."Votre compte a bien été crée";
                      // header('Location:connexion.php');
                      echo "<a href=\"Saisie_cotisation.php\" _blank=\" target\"> me cotiser</a>";
                      $erreur= "<h4>Bonjour ".$nom." ". $prenom." Inscription reussi !<br> vous etes la bienvenue !</h4> ";   
                }else{
                         $erreur="<h3><font color='red'>Ce matricule existe  déja </font> <a href='Saisie_cotisation.php'>Me cotiser</a><br></h3>"; 
                    }
            
          }
    }else "veillez remplir  les  champs";
         
    ?>
     <?php 
           include("menu.php");
       ?>
     <div class="container">
       <div class="panel panel-info">
         <div class=panel-heading>Veillez saisir  les informations du membres</div>
         <div class=panel-body>

         
      <form action="" method="get">
        <fieldset>
            <legend>Inscription</legend>
            <div class="form-group">
              <label for="matricul">Matricule :</label>
              <input type="text" name="matricul" id="" required  class="form-control">
            </div>
            <div class="form-group">
              <label for="Nom">Nom :</label>
              <input type="text" name="nom" id="" required class="form-control">
            </div>
            <div class="form-group">
              <label for="Prenom">Prenom :</label>
              <input type="text" name="prenom" id="" required class="form-control">
             </div>
             <div class="form-group">
              <label for="Adresse">Address :</label>
              <input type="text" name="adresse" id="" required class="form-control">
            </div>
            <div class="form-group">
            <label for="Telephone">Telephone :</label>
            <input type="number" name="tel" id="" required class="form-control">
            </div>
            <div class="form-group">
            <input type="reset" value="Annuler" name="submit"class="form-control btn btn-danger">
            <input type="submit" value="valider" name="submit"class="form-control btn btn-success">
           </div>
        </fieldset>
      </form>
      </div>
     </div>
     </div> 
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
      <?php 
       if(isset($erreur)){
        echo '<font color="red">'.$erreur."</font>";
       }
    ?>
</body>
</html>