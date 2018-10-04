<?php require_once('./modele/classes/Compte.class.php');
    if(!ISSET($_SESSION)) SESSION_START();
    if(ISSET($_SESSION['connected']))
    {
        if($_SESSION['connected']->getAdmin())
        {
             echo   '<form role="form" class="container-fluid" method="post" action="?class=members&action=get_form_creation">
                    <button type="submit" class="btn btn-success btn-lg" id="create_user">Creer utilisateur</button>
                    </form>'
             ;
        }
    }
?>
<table class="table table-hover table-responsive" id="maTable">
<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">nom</th>
    <th scope="col">prenom</th>
    <th scope="col">e-mail</th>
    <?php 
    if(ISSET($_SESSION['connected']))
    {
    if($_SESSION['connected']->getAdmin())
    {
        echo '<th scope="col">mot de passe</th>
        <th scope="col">creation</th>
        <th scope="col">modification</th>
        <th scope="col">admin</th>';
    }
 } ?>
 </tr>
</thead>
<tbody>
    <?php
if(ISSET($_SESSION['email']))
require_once('./modele/classes/CompteDAO.class.php');
 try
 {
     $res = CompteDAO::findAll();
 }
 catch(PDOException $e)
 {
     print "Error!: " . $e->getMessage();
     die();
 }

  $row_class = "";

 for($row = 0;$row != $res->taille(); $row++)
 {
    if($_SESSION['connected']->getAdmin())
    {
     $row_class = ($res->get($row)->getActif())?'class=\'table-success\'':'class=\'table-danger\'';
    }?>
    <tr <?= $row_class ?> scope="row" onclick='location.href="?class=members&action=get_form&email=<?= $res->get($row)->getEmail() ?>"'>
        <th class="row" scope="row">
            <?= $row ?>
        </th>
        <td>
            <?= $res->get($row)->getNom() ?>
        </td>
        <td>
            <?= $res->get($row)->getPrenom() ?>
        </td>
        <td>
            <?= $res->get($row)->getEmail() ?>
        </td>
        <?php if(ISSET($_SESSION['connected']))
        if($_SESSION['connected']->getAdmin())
        {
            echo '<td>'.$res->get($row)->getPassword().'</td>
            <td>'.$res->get($row)->getCreation().'</td>
            <td>'.$res->get($row)->getModification().'</td>
            <td>'.($res->get($row)->getAdmin()?'vraie':'faux').'</td>';
        }?>
    </tr>
     <?php if(ISSET($_SESSION['connected']))
     if($_SESSION['connected']->getAdmin())
     echo '</a>'; ?>
<?php     
 }
?>
</tbody>
</table>
