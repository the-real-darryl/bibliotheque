<?php
// -- Contr�leur frontal --
require_once('./controleur/ActionBuilder.class.php');
if (ISSET($_GET['class']) && ISSET($_GET['action']))
{
	$vue = ActionBuilder::getAction($_GET['class'])->execute($_GET['action']);
}
else	
{
	$vue = ActionBuilder::getAction('')->execute('');
}
// On affiche la page (vue)
include_once('./vues/main.php');
?>