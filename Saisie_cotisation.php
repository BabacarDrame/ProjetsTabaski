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

    <title>Saisie cotisation</title>
</head>
<body>
    <?php  
      // connexion dans  la base de  donnees
             $bdd = new PDO('mysql:host=localhost; dbname=EspaceMembre', 'root', ''); 
                
                   
                 
       
        if(isset($_POST['submit'])){
            if(!empty($_POST['matricul']) && !empty($_POST['date'])  && !empty($_POST['montant'])){
                  $matricule=$_POST['matricul'];
                  $date=$_POST['date'];
                  $mois=$_POST['mois'];
                  $motif=$_POST['motif']; 
                  $montant=$_POST['montant'];
                  $verifmatri=$bdd->prepare("SELECT * FROM cotisation WHERE Matricule=?");
                  $verifmatri->execute(array($matricule));
                  $resultverif= $verifmatri->rowCount();
                    if($resultverif==0)
                    {
                      $insertcotis=$bdd->prepare("INSERT INTO cotisation(numcotis,Matricule,Datecotis,Mois,Motif,Montant) VALUES(?,?,?,?,?,?)");
                      try
                      {$insertcotis->execute(array(null,$matricule,$date,$mois,$motif,$montant));
                      }catch(PDOException $e){
                        die($erreur="Erreur de  connextion a la base de donnée :<font color='red'>vous n'etes pas membre?</font> 
                                    <a href='Saisie_membre.php' _blank='target'>S'inscrire</a>");
                    }
                      
                      $erreur="Merci d'avoir  cotisé";
                    }else{$erreur="Vous etes deja cotisé ce moi";}
                  
            }else{
                    $erreur="veillez remplir tous les champs";
                }
        }else {$erreur="veillez renseigner vos informations";}

    
    ?>
      <?php 
           include("menu.php");
       ?>
      <div class="container">
       <div class="panel panel-info">
         <div class=panel-heading>Veillez remplir le  formulaire</div>
         <div class=panel-body>
      <form action="" method="post">
        <fieldset>
            <legend>Cotisation</legend>
            <div class="form-group">
            <label for="matricul">Matricule :</label>
            <input type="text" name="matricul" id="" class="form-control">
            </div>
            <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="" class="form-control" >
            </div>
            <div class="form-group">
            <label for="mois">Mois :</label>
            
              <select name="mois" id="" class="form-control">
                  <option  name="mois" value="0">---</option>
                  <option  name="mois" value="Janvier">Janvier</option>
                  <option  name="mois" value="Fevrier">Fevrier</option>
                  <option  name="mois" value="Mars">Mars</option>
                  <option  name="mois" value="Avril">Avril</option>
                  <option  name="mois" value="Mai">Mais</option>
                  <option  name="mois" value="Juin">Juin</option>
                  <option  name="mois" value="Juilet">juillet</option>
                  <option  name="mois" value="Aout">Aout</option>
                  <option  name="mois" value="Septembre">Septembre</option>
                  <option  name="mois" value="Octobre">Octobre</option>
                  <option  name="mois" value="Novembre">Novembre</option>
                  <option  name="mois" value="Decembre">Decembre</option>
              </select>
              </div>
              <div class="form-group">
            <label for="">Motif :</label>
            <select name="motif" id="" class="form-control">
                <option name="motif" value="0">----</option>
                <option name="motif" value="inscription">Inscription</option>
                <option name="motif" value="mensualité">Mensualité</option>
            </select>
            </div>
            <div class="form-group">
             <label for="montant">Montant :</label>
              <input type="number" name="montant" id="" class="form-control">
              <input type="submit" value="Valider" name="submit"class="form-control btn btn-success" >
             </div>
        </fieldset>
      </form>
      </div>
       </div>
       </div>
    <?php 
       if(isset($erreur)){
        echo '<font color="red">'.$erreur."</font>";
       }
    ?>
    <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js">
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>