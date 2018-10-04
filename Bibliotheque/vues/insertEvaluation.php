<?php
 require_once('./modele/classes/Evaluation.class.php');

 $RATING_EV="";
 $COMMENTAIRE="";
 $FKCOMPTE="";
 $FKLIVRE="";

 if (isset($_POST['insert']))
{
    $evaluation = new Evaluation();

    $RATING_EV= $evaluation->setRating_ev($_POST['RATING_EV']);
    $COMMENTAIRE=$evaluation->setCommentaire($_POST['COMMENTAIRE']);
    $FKCOMPTE=$evaluation->setFkCompte($_POST['FKCOMPTE']);
    $FKLIVRE=$evaluation->setFkLivre($_POST['FKLIVRE']);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>

    <span align="center"><h1>Insert new Evaluation</h1></span>
   
    <form action="" class="form-horizontal " method="post" enctype="multipart/form-data">
        <div class="form-group">
           <div class="col-sm-12">
                <label for="RATING_EV"  class="col-sm-2 form-form-control-label" >RATING_EV</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="RATING_EV" id="RATING_EV" value="<?php echo $RATING_EV?>" placeholder="Entrer évaluation">
                    <?php if (ISSET($_POST["field_messages"]["RATING_EV"])) 
				        echo "<br/><span class=\"warningMessage\">".$_POST["field_messages"]["RATING_EV"]."</span>";
                    ?>
                </div>
             </div>
        </div>
        <div class="form-group">
           <div class="col-sm-12">
            <label for="commentaire" class="col-sm-2 form-form-control-label">COMMENTAIRE</label>
            <div class="col-sm-10">
               <input type="text" class="form-control" name="COMMENTAIRE" id="COMMENTAIRE" value="<?php echo $COMMENTAIRE?>" placeholder="Entrer votre commentaire">
               <?php if (ISSET($_POST["field_messages"]["COMMENTAIRE"])) 
				        echo "<br /><span class=\"warningMessage\">".$_POST["field_messages"]["COMMENTAIRE"]."</span>";
                    ?>
            </div>
            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-12">
            <label for="EmailCompte" class="col-sm-2 form-form-control-label"> compte Email</label>
            <div class="col-sm-10">
                    <input type="email" class="form-control" name="FKCOMPTE" id="FKCOMPTE" value="<?php echo $FKCOMPTE?>" placeholder="gth@gmail.com">
                    <?php if (ISSET($_POST["field_messages"]["FKCOMPTE"])) 
				        echo "<br /><span class=\"warningMessage\">".$_POST["field_messages"]["FKCOMPTE"]."</span>";
                    ?>
            </div>
        </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label for="IsbnLivreAEvaluer" class="col-sm-2 form-form-control-label">isbn livre</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="FKLIVRE" id="FKLIVRE" value="<?php echo $FKLIVRE?>" placeholder="Entrer le Numéro du livre à évaluer">
            <?php if (ISSET($_POST["field_messages"]["FKLIVRE"])) 
				        echo "<br /><span class=\"warningMessage\">".$_POST["field_messages"]["FKLIVRE"]."</span>";
                    ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row col-sm-12">
                <div class="col-sm-4">
                <input type="hidden" name="action"  value="insert" id="insert">
                <input type="submit" name="insert" class=" btn btn-success btn-lg " value="Insert" id="insert">
                </div>
            </div>
        </div>
    </form>

     <!-- jQuery CDN - Slim version (=without AJAX) -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
      $(function() {
          $('.warningMessage').css('color','red');
         });
    </script>
  
</body>
</html>