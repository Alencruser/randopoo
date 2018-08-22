<?php session_start();
if($_SESSION["login"]){
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="update.php" method="post">
		<div>
			<?php 
			require "logsql.php";
			try {
				$affiche=ORM::for_table('hiking')->where('id',htmlspecialchars($_POST["id"]))->find_many();
			foreach($affiche as $v){
				?>
				<label for="name">Name</label>
				<input type="text" name="name" value="<?php echo $v['name']; ?>">
			</div>

			<div>
				<label for="difficulty">Difficulté</label>
				<select name="difficulty">
					<option <?php if($v["difficulty"]=="très facile"){?>selected <?php } ?> value="très facile">Très facile</option>
					<option <?php if($v["difficulty"]=="facile"){?> selected <?php } ?> value="facile">Facile</option>
					<option <?php if($v["difficulty"]=="moyen"){?> selected <?php } ?> value="moyen">Moyen</option>
					<option <?php if($v["difficulty"]=="difficile"){?> selected <?php } ?> value="difficile">Difficile</option>
					<option <?php if($v["difficulty"]=="très difficile"){?> selected <?php } ?> value="très difficile">Très difficile</option>
				</select>
			</div>

			<div>
				<label for="distance">Distance</label>
				<input type="text" name="distance" value=<?php echo $v["distance"]; ?>>
			</div>
			<div>
				<label for="duration">Durée</label>
				<input type="duration" name="duration" value=<?php echo $v["duration"]; ?>>
			</div>
			<div>
				<label for="height_difference">Dénivelé</label>
				<input type="text" name="height_difference" value=<?php echo $v["height_difference"]; ?>>
			</div>
			<div>
				<label for="available">Disponible</label>
				<select name="available">
					<option <?php if($v["available"]=="oui"){ ?>selected <?php } ?> value="oui">Oui</option><!-- a finir -->
					<option <?php if($v["available"]=="non"){ ?>selected <?php } ?> value="non">Non</option>
				</select>
			</div>
			<input type="hidden" name="id" value=<?php echo $_POST['id'] ?>>
			<button type="submit" name="button">Envoyer</button>
		</form>
		<?php 
	}}catch(PDOException $e){
		echo "Erreur : ".$e->getMessage();
	}
		try {
			if(isset($_POST)){
				$update= ORM::for_table('hiking')->where('id',htmlspecialchars($_POST['id']))->find_one();
				$update->name= htmlspecialchars($_POST['name']);
				$update->difficulty= htmlspecialchars($_POST['difficulty']);
				$update->distance= htmlspecialchars($_POST['distance']);
				$update->duration= htmlspecialchars($_POST['duration']);
				$update->height_difference= htmlspecialchars($_POST['height_difference']);
				$update->available= htmlspecialchars($_POST['available']);
				$update->save();
			}
		}catch(PDOException $e){
			echo "Erreur : ".$e->getMessage();
			die();
		}
		?>
	</body>
	</html>
<?php } else {
	header('location:read.php');
} ?>