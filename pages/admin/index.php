<h1>TIMELINE</h1>
<p id="description">Commandes :<br/>
<strong>/r [id]</strong> pour supprimer un message <br/>
<strong>/V [message] </strong>pour écrire en vert pas beau</p>
<form action="" method="POST">
	<input type="text" name="message" placeholder="Message" />
	<input type="submit" value="Discuter">
</form>

<div id="timeline">
<?php foreach (App::getInstance()->getTable('Timeline')->allDESC() as $key => $value): ?>
				<div class="timelineMessage">
					<div class="auteur">
						[<?=$value->id;?>] <?=$value->name;?>
					</div>
					<div class="message <?=$value->color?>">
						<?=$value->message;?>
					</div>
				</div>
<?php endforeach ?>
</div>