<?php 
ob_start();
?>
<h2>Modification du contenu au Blog</h2>
	<form action="<?= URL ?>article/updateValidation/<?= $article->getId()?>" method="POST" enctype="multipart/form-data">
		<p>Titre : <input type="text" name="titre" value="<?= $article->getTitre()?>"></p>
		<p>Commentaire : <br><textarea name="commentaire" cols="50" rows="10">
            <?= $article->getCommentaire()?></textarea></p>
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
		<p>Choisissez une photo avec une taille inf à 3Mo</p>
        <h3>Votre image actuelle:</h3>
        <img src="<?= URL."public/assets/images/".$article->getPhoto()?>">
		<input type="file" name="photo">
		<br>
		<input type="submit" name="ok" value="Envoyer">		
	</form>
    
<?php 
$titre="Modification";
$content=ob_get_clean();
require "template.php";

?>