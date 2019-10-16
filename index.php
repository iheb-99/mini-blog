<?php
session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

	require_once 'includes/config.php';

	$posts = get_all_posts();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<!-- logged in user information -->
		
		<?php  if (isset($_SESSION['username'])) : ?>
			<p> <a href="index.php?logout='1'" style="color: red;">Déconnexion</a> </p>
		<?php endif ?>
    <div class="container">
        <h1 class="text-center">Blog</h1>
        <div class="row">
            <?php foreach($posts as $post): ?>
                <div class="col-md-4">
                    <h2><?php echo $post['title'] ?></h2>
                    <p><?= $post['content'] ?></p>
					<p><?= $post['cat_title'] ?></p>
					
						<select name="modif-cat"><option value="5">8-electronique</option><option value="6">6-mecanique</option><option value="7">7-fruit</option><option value="0">0-autre</option></select>

					<form method="POST" action="index.php">
						<input name="indice" type="hidden" value="<?php echo $post['id'] ;?>">
            			<input type="submit" value="supprimer" />
					</form>
					<form method="POST" action="index.php">
						<label for="modif-tit">Titre : </label><input type="text" name="modif-tit" id="titre" placeholder="Entrez le nouveau 							titre..." maxlength="50" /><br />
						<label for="contenu">contenu : </label><br /><textarea name="modif-con" id="contenu" placeholder="Entrez le nouveau 							contenu..."></textarea><br />
						<label for="caty">categorie : </label><input type="int" name="modif-caty" id="caty" placeholder="Entrez le nouveau num..." 							maxlength="50" /><br />
	    				<input name="ind" type="hidden" value="<?php echo $post['id'] ;?>">
            			<input type="submit" value="Envoyer" />
					</form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
	<br/><br/>
        <h2>vous voulez ajoutez un article ?</h2>
        <form method="POST" action="index.php">
            
            <label for="titre">Titre : </label><input type="text" name="titre" id="titre" placeholder="Entrez le titre..." maxlength="50" /><br />
            <label for="contenu">contenu : </label><br /><textarea name="contenu" id="contenu" placeholder="Entrez le contenu..."></textarea><br />
			<label for="caty">categorie : </label><input type="int" name="caty" id="caty" placeholder="Entrez le num..." maxlength="50" /><br />
	    <input type="hidden" name="a" value="<?php $_GET['articles']?>"/>
            <input type="submit" value="Envoyer" />
        </form>

</body>
</html>
