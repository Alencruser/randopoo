<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Randonnées</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <?php if(!isset($_SESSION["login"])) { ?>
      <a class="navbar-brand mr-auto text-white" href="login.php">Se connecter</a><?php } else { ?>
        <a class="navbar-brand ml-auto text-white" href="logout.php">Se deconnecter</a><?php } ?>
      </nav>
      <h1>Liste des randonnées</h1>
      <table>
        <tr>
          <th>Nom</th>
          <th>Difficulté</th>
          <th>Distance (Km)</th>
          <th>Durée (hh:mm:ss)</th>
          <th>Dénivelé (Mètres)</th>
          <th>Disponible</th>
        </tr>
        <?php 
        try {
         require "logsql.php";
         $reads= ORM::for_table('hiking')->find_many();
         foreach($reads as $v){
          ?> 
          <tr>
            <td>
              <?php 
              echo $v["name"];
              ?>
            </td>
            <td>
              <?php 
              echo $v["difficulty"];
              ?>
            </td>
            <td>
              <?php 
              echo $v["distance"];
              ?>
            </td>
            <td>
              <?php 
              echo $v["duration"];
              ?>
            </td>
            <td>
              <?php 
              echo $v["height_difference"];
              ?>
            </td>
            <td>
              <?php 
              echo $v["available"];
              ?>
            </td>
            <?php if($_SESSION["login"]) { ?>
              <td>
                <form action="update.php" method="POST">
                  <input type="hidden" name="id" value=<?php echo $v["id"] ?>>
                  <button class="btn btn-primary" type="submit">Modifier</button>
                </form>
              </td>
              <td>
                <form action="delete.php" method="POST">
                  <input type="hidden" name="id" value=<?php echo $v["id"] ?>>
                  <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
              </td>
            <?php } ?>
          </tr>
          <?php 
        }
      }catch(PDOException $e){
        echo "Erreur : ".$e->getMessage();
      }

      ?>
    </table>
    <?php if($_SESSION["login"]) { ?>
      <a href="create.php"><button class="btn btn-primary btn-lg">Creer une randonnée</button></a><?php } ?>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
    </html>
