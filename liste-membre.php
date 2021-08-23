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
    <title>Liste des membres</title>
</head>
<body>
<?php 
                   //On se connecte 
                   $base = new PDO ('mysql:host=localhost; dbname=espacemembre','root', ''); 
                   $liste=$base->prepare("SELECT numcotis, Prenom,Nom, dateCotis,Mois,Motif,Montant FROM membre INNER JOIN cotisation ON membre.Matricule = cotisation.Matricule");
                   $liste->execute();
                   $Resultat=$liste->fetchAll(PDO::FETCH_ASSOC);
                   
                   
                   

                   ?> 
                   <?php include_once 'menu.php'; ?>
<div class="container is-max-desktop">
<article class="panel panel-info">
<p class="panel-heading">LISTE DES COTISATISANTS 
<input type="text" name="input"style="float:right;outline:none; border:solid 1px ;" placeholder="Rechercher">
 &nbsp
<i class="fas fa-search" style="float:right; margin-top:4px;"></i>
<!-- <button id="search-button" type="button" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button> -->
</p>


<table class="table table-striped table-bordered " style="font-size: 15px; height: 3x 0px;">
  <!-- <caption>
    Liste des cotisations
  </caption> -->
  <thead class="">
    <tr class="bg-default">
      <th scope="col"><b>NUM COTIS</b></th>
      <th scope="col"><b>PRENOM</b></th>
      <th scope="col"><b>NOM</th>
      <th scope="col"><b>DATE COTISATION</th>
      <th scope="col"><b>MOIS</th>
      <th scope="col"><b>MOTIF</th>
      <th scope="col"><b>MONTANT</th>
      <th scope="col"><b>Action</th>
    </tr>
  </thead>
  <tbody>
      <?php   foreach($Resultat as $cotisation){
          ?>
    <tr class="">
    <td><b><i><?= $cotisation['numcotis']?></i></td>
    <td><b><?= $cotisation['Prenom']?></td>
      <td><b><?= $cotisation['Nom']?></td>
      <td><b><?= $cotisation['dateCotis']?></td>
      <td><b><?= $cotisation['Mois']?></td>
      <td><b><?= $cotisation['Motif']?></td>
      <td><b><?= $cotisation['Montant']?></td>
      <td>
          <a href="liste-membre.php?numcotis=<?= $cotisation['numcotis']?>">
          <span class="glyphicon glyphicon-edit"></span>
          </a>
          &nbsp
          <a href="Supression.php">
          <span class="glyphicon glyphicon-trash"></span>
          </a>
      </td>
    </tr>
    <?php
    }
    ?> 
  </tbody>
</table>
<!-- <a href="SaisieCotisation.php">Saisie Cotisation</a><br>
<a href="ModifierPaiement.php">Modifier Cotisation</a><br>
<a href="RchercheCotisation.php">Recherche Cotisation</a><br>
<a href="SupprimerCotisation.php">Supprimer Cotisation</a> -->

      </article>
   

<?php 
    $base = new PDO ('mysql:host=localhost; dbname=espacemembre','root', ''); 
                    
                    if (isset ($_GET['numcotis'])){ 
                    
                    // on nettoie l id envoyé
                    $idcot= strip_tags($_GET['numcotis']);
                    $liste=$base->prepare("SELECT  numcotis,dateCotis,Mois,Motif,Montant,Matricule FROM cotisation WHERE NumCotis=:numcotis");
                    $liste->bindValue(':numcotis', $idcot, PDO::PARAM_INT);
                    $liste->execute();
                  $Resultat=$liste->fetch();
                    
                    ?>
 
 <article class="panel panel-danger"id="modifier">
 <p class="panel-heading">MODIFIER PAIEMENT</p>
 
 <form method="post" action="liste-membre.php">
 <div class=" form-group">
                          <label for="Date">NumeroCo</label>
                         <input type="number" name="Numco"  value="<?= $Resultat['numcotis']?>" class="form-control" required>
                        
                       </div>
                       <div class="md-form">
                        <label for="Date">Date cotisation</label>
                         <input type="date" name="datecotise" value="<?= $Resultat['dateCotis']?>" class="form-control" required>
                        
                       </div>
             
                       <div class="md-form">
                       <label for="Mois">Mois</label>
                       <select class="select form-control" name="mois" required>
                       <label for="Mois">Mois</label>
                       <option ><?= $Resultat['Mois']?></option>
       <option value="janvier">Janvier</option>
       <option value="fevrier">fevrier</option>
       <option value="mars">mars</option>
       <option value="avril">avril</option>
       <option value="mai">mai</option>
       <option value="juin">juin</option>
       <option value="juillet">juillet</option>
       <option value="aout">aout</option>
       <option value="septembre">septembre</option>
       <option value="octobre">octobre</option>
       <option value="novembre">novembre</option>
       <option value="decembre">decembre</option>
     </select>
                         
                       </div>
             
                       <div class="form-group">
                       <label for="motif">Motif</label>
                       <select class="select form-control" name="motif"  required>
                       <option value=""><?= $Resultat['Motif']?></option>
       <option value="Mensualité">Mensualité</option>
       <option value="Inscription">Inscription</option>
 </select>
                         
                       </div>
                    <div class="form-group">
                       <label for="montant">Montant</label>
                     <input type="number" name="montant" value="<?= $Resultat['Montant']?>"  class="form-control" required>
                     
                   </div>
         
             
                       <div class="form-group">
                       <label for="matricule">Matricule</label>
                         <input type="number" name="matricule" value="<?= $Resultat['Matricule']?>"  class="form-control" required>
                         
                       </div>
             
                       <div class="text-center mt-4">
                         <button type="submit" name="valider" class="btn btn-success"  value="valider">Modifier</button>
                         <button type="reset" name="annuler" class="btn btn-danger"  value="annuler">Annuler</button>
                       </div>
                     </form>
                     <a href="liste-membre.php">La liste des cotisants</a>
 </article>
 <?php 
                    }
                      
                    $base = new PDO ('mysql:host=localhost; dbname=espacemembre','root', '');
                    if (isset ($_POST['valider'])){ 
                    
  if(!empty($_POST['datecotise']) AND !empty($_POST['Numco']) AND !empty($_POST['mois']) AND !empty($_POST['motif']) AND !empty($_POST['matricule']));
                   $datecoti =strip_tags( $_POST['datecotise']); 
                 $mois=strip_tags( $_POST['mois']);
                 $motifs=strip_tags( $_POST['motif']);
                 $montant=strip_tags( $_POST['montant']);
                 $matricule=strip_tags( $_POST['matricule']);
                 $num=strip_tags($_POST['Numco']);
 
                 $sql = "UPDATE cotisation SET dateCotis=?,Mois=?,Motif=?,Montant=?,Matricule=? WHERE numcotis=?";
 
                 // on prepare la requete
                $query = $base->prepare($sql);
         
               
         
                // on "accroche" les parametres
             //    $query->bindValue(':Numco',  $num, PDO::PARAM_INT);
             //    $query->bindValue(':datecotise', $datecoti, PDO::PARAM_STMT);
             //    $query->bindValue(':mois', $mois, PDO::PARAM_STR);
             //    $query->bindValue(':motif', $motifs, PDO::PARAM_STR);
             //    $query->bindValue(':montant', $montant, PDO::PARAM_INT);
             //    $query->bindValue(':matricule', $matricule, PDO::PARAM_INT);
                 //  on excute la requete
                 $query->execute(array($datecoti,$mois,$motifs,$montant,$matricule,$num));
                 
                if ($query){ echo '<article class="message is-success">
                 <div class="message-header">
                   <p>modification effectue....</p>
                   <button class="delete" aria-label="delete"></button>
                 </div>
                 <div class="message-body">
                 
                   </div>
               </article>';
                  
                }else {
                 echo 'erreur....';
                }
                     $base=null;
                    } 
                    ?> 
                  </div>
  <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>