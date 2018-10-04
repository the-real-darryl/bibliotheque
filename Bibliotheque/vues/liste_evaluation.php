<h1 align="center">Liste des évaluations</h1>

<?php
require_once('./modele/classes/Evaluation.class.php');
require_once('./modele/classes/Liste.class.php');
require_once('./modele/classes/EvaluationDAO.class.php');

$liste = EvaluationDAO::readAll();
?>
<div class="container">
<table class="table table">
<thead>
<tr>
<th>&nbsp;</th>
<th scope="col">Date évaluation</th>
<th scope="col">Rating évaluation</th>
<th scope="col">Commentaire sur le livre</th>
<th scope="col">Compte E_mail de l\'enseignant</th>
<th scope="col">Isbn du livre évaluer</th>   
<?php 
    if(!ISSET($_SESSION)) SESSION_START();
    if(ISSET($_SESSION['connected']))
    {                    
        echo '<th>&nbsp;</th>
        <th>&nbsp;</th>';
    }
?>
</tr> 
</thead>

<tbody> 
<?php
while ($liste->next())
{
    $eval = $liste->current();
    if ($eval!=null)
    {
        ?>
        <tr>
        <th scope="row"><?= $liste->getCursor() ?></th>
        <td><?= $eval->getCreation() ?></td>
        <td><?= $eval->getRating_ev() ?></td>
        <td><?= $eval->getCommentaire() ?></td>
        <td><?= $eval->getFkCompte() ?></td>
        <td><?= $eval->getFkLivre() ?></td>
        <?php
        if(ISSET($_SESSION['connected']))
        {
            echo '<td><a class=\'btn btn-info\' href=\'?class=review&action=display_form&PKEVALUATION='.$eval->getPkevaluation().'\'>Update Evaluation</a></td> 
            <td><a class=\'btn btn-danger\' href=\'?class=review&action=displayBeforeDeletion&PKEVALUATION='.$eval->getPkevaluation().'\'>Delete Evaluation</a></td>';
        }?>
        </tr>
        <?php
    }
}
?>
</tbody>
</table>
</div>