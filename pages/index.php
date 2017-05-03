<h1 id="titre">Qu'est ce que ChatIRCool ?</h1>

<p id="description">C'est un chat IRC qui est entièrement open source dont vous pouvez aller chercher les codes sur Github et créer votre propre instance. Amusez vous !</p>

<h1>TIMELINE</h1>
<div id="timeline">
<?php foreach (App::getInstance()->getTable('Timeline')->all20() as $key => $value): ?>
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