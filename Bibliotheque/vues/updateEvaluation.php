<?php 
 require_once('./modele/classes/Database.class.php');
 // initialize flag
 $OK = false;
 $done = false;
 // create database connection
 $conn=Database::getInstance();
 // get details of selected record
 if (isset($_GET['PKEVALUATION']) && !$_POST) {
 // prepare SQL query
 $sql = 'SELECT PKEVALUATION,RATING_EV,COMMENTAIRE,FKCOMPTE,FKLIVRE,CREATION FROM evaluation
 WHERE PKEVALUATION = ?';
 $stmt = $conn->prepare($sql);
 // bind the results
 $stmt->bindColumn(1, $PKEVALUATION);
 $stmt->bindColumn(2, $RATING_EV);
 $stmt->bindColumn(3, $COMMENTAIRE);
 $stmt->bindColumn(4, $FKCOMPTE);
 $stmt->bindColumn(5, $FKLIVRE);
 //$stmt->bindColumn(6, $CREATION);
 
 // execute query by passing array of variables
 $OK = $stmt->execute(array($_GET['PKEVALUATION']));
 $stmt->fetch();
 }
 // if form has been submitted, update record
 if (isset($_POST['update'])) {
     // prepare update query
     $sql = 'UPDATE evaluation SET RATING_EV = ?, COMMENTAIRE = ? , FKCOMPTE = ? , FKLIVRE = ? 
     WHERE PKEVALUATION = ?';
     $stmt = $conn->prepare($sql);
     // execute query by passing array of variables
     $stmt->execute(array($_POST['RATING_EV'], $_POST['COMMENTAIRE'],
     $_POST['FKCOMPTE'], $_POST['FKLIVRE'],$_POST['PKEVALUATION']));
     $done = $stmt->rowCount();
     } 
 // redirect if $_GET['PKEVALUATION'] not defined
 if ($done || !isset($_GET['PKEVALUATION'])) {
 header('Location: http://localhost:9791/New_CRUD_Evaluation_MVC/vues/readEvaluation.php');
 exit;
 }
 // store error message if query fails
 if (isset($stmt) && !$OK && !$done) {
 $error = $stmt->errorInfo();
 if (isset($error[2])) {
 $error = $error[2];
 }
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

    <span align="center"><h1>Update Evaluation</h1></span>
        <?php 
        if($PKEVALUATION == 0) 
        { ?>
         <p class="warningMessage">Invalid request: record does not exist.</p>
  <?php } 
       else 
        { ?> 
    <form action="" class="form-horizontal " method="post" enctype="multipart/form-data">
        <div class="form-group">
           <div class="col-sm-12">
                <label for="RATING_EV"  class="col-sm-2 form-form-control-label" >RATING_EV</label>
                <div class="col-sm-10">
                <input type="hidden" class="form-control" name="PKEVALUATION" id="PKEVALUATION" value="<?php echo $PKEVALUATION; ?>"> 
                    <input type="text" class="form-control" name="RATING_EV" id="RATING_EV" value="<?php  echo htmlentities($RATING_EV, ENT_COMPAT, 'utf-8'); ?>" placeholder="Rating">
                </div>
             </div>
        </div>
        <div class="form-group">
           <div class="col-sm-12">
            <label for="commentaire" class="col-sm-2 form-form-control-label">COMMENTAIRE</label>
            <div class="col-sm-10">
               <input type="text" class="form-control" name="COMMENTAIRE" id="COMMENTAIRE" value="<?php echo htmlentities($COMMENTAIRE , ENT_COMPAT, 'utf-8'); ?>" placeholder="Commentaire">
            </div>
            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-12">
            <label for="EmailCompte" class="col-sm-2 form-form-control-label"> compte Email</label>
            <div class="col-sm-10">
                    <input type="email" class="form-control" name="FKCOMPTE" id="FKCOMPTE" value="<?php echo htmlentities($FKCOMPTE , ENT_COMPAT, 'utf-8');?>" placeholder="gth@gmail.com">
            </div>
        </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label for="IsbnLivreAEvaluer" class="col-sm-2 form-form-control-label">isbn livre</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="FKLIVRE" id="FKLIVRE" value="<?php echo htmlentities($FKLIVRE , ENT_COMPAT, 'utf-8'); ?>" placeholder=" Numéro du livre">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row col-sm-12">
                <div class="col-sm-4">
                <input type="hidden"  name="action" id="PKEVALUATION" value="update" >
                <input  onclick='return ./vues/readEvaluation.php' type="submit" name="update" class=" btn btn-success btn-lg " value="update" id="update" >
                </div>
                
            </div>
        </div>
    </form>
    <?php } ?>
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
    <script>
      $(function() {
          $('.liste').css('color','yellow');
         });
    </script>
    <script>
      $(function() {
          $('.btn').click(function(){
             return "./vues/readEvaluation.php"
          });
         });
    </script>
  
</body>
</html>

