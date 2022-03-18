<h2>Inscription</h2>
	<form action="<?= URL ?>AccountValidation" method="POST" enctype="multipart/form-data">
		<p>Mail: <input type="mail" name="mail"></p>
		<p>Mot de passe :<br><input type="password" name="mdp">
		</p><br>
        <p>Nom :<br><input type="text" name="name">
		</p><br>
		<input type="submit" name="ok" value="Envoyer">		
	</form>