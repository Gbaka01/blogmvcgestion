<?php 

ob_start();
?>

	<h2>Formulaire d'ajout d'article au Blog</h2>
	<form action="<?= URL ?>article/validation" method="POST" enctype="multipart/form-data">
		<p>Titre : <input type="text" name="titre"></p>
		<p>Commentaire : <br><textarea name="commentaire" cols="50" rows="10"></textarea></p>
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
		<p>Choisissez une photo avec une taille inf à 3Mo</p>
		<input type="file" name="photo">
		<br>
		<input type="submit" name="ok" value="Envoyer">		
	</form>
    
		

<?php 
$titre="Ajout de l'article";
$content=ob_get_clean();
require "template.php";

?>