<h2>Connexion à mon application</h2>
	<form action="<?= URL ?>loginValidation" method="POST">
		<p>Mail: <input type="mail" name="mail"></p>
		<p>Mot de passe :<br><input type="password" name="mdp">
		</p><br>
		<input type="submit" name="ok" value="Envoyer">		
	</form>