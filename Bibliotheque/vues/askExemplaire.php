

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="csslistel.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
   <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="accueil.css">

<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <h1 align="center">ASK EXEMPLAIRE</h1>
  <?php
    require_once('./modele/configs/Constant.php');
    require_once('./modele/LivreDAO.class.php');
    $isbn = "9782746093218";
    $dao = new LivreDAO();
    $livre = $dao->findParIsbn($isbn);
      // $livreAuteur =$dao ->findAllAutoComplete();
    ?>
 <div class="panel panel-success col-sm-12 favori">
        <div class="panel-heading">
            <a href='<?= $livre->getTitre() ?>' target='_blank'><?= $livre->getTitre() ?></a>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <figure>
                    <img src="<?= Constant::IMAGEPATH . $livre->getCouverture() ?>"  class="img-thumbnail" alt="Image d\'un livre" width="100" height="150"/>
                    </figure>
                </div>
                <div class="col-md-5">
                    <strong> Titre: </strong> <?= $livre->getTitre() ?><br>
                    <strong> Auteur: </strong> <?= $livre->getAuteur() ?><br>
                    <strong> Maison d'edition: </strong><?= $livre->getMaisonedition() ?><br>
                    <strong> Date du parution: </strong><?= $livre->getParution() ?><br>
                    <strong> Langue d'edition: </strong><?= $livre->getLangue() ?><br>
                </div>
                <div class="col-md-2">
                               
                    <input type="submit" value="Evaluer"  class="btn btn-success btn-xs btn-block"> <br> <br> 
                    <input type="text"  class="form-control" id="numero_exemplaire" name="numero_exemplaire"><br>Numéro Exemplaire                        
                 </div>
                 <div class="col-md-2">
                   <input type="submit" value="Détail Livre"   class="btn btn-primary btn-xs btn-block" > <br> <br> 
                    <input type="submit"  value="Ajouter Exemplaire"  class="btn btn-primary btn-xs btn-block" > <br> <br> 
                    <input type="submit"  value="Modifier Livre"   class="btn btn-primary btn-xs btn-block"> <br> <br> 
                    <input type="submit"  value="Supprimer Livre"   class="btn  btn-danger btn-xs btn-block">
                </div>
            </div>
            </div>
        </div> 
    </div> 
    <ul class="list-group">    
     <li class="list-group-item ">  
     <div class="panel panel-success col-sm-12 favori">
        <div class="panel-heading ">
         
        </div>
        <div class="panel-body">
        <form action=""  class="form-horizontal ">
        <legend><b>Liste des exemplaires</b></legend>
            <div class="row form-group">
                <div  class=" col-md-4"> 
                <div class="alert alert-info" role="alert"><label for=""> <b> Propriétaire, détenteur courrent</b></label></div>      
        </form>                   
                </div>
                <div class="col-md-2">
                        <input type="submit" value="demander"   class="btn btn-info btn-xs btn-block" >  
                </div>
                <div class="col-md-2">
                       
                </div>
                
                <div class="col-md-3"> 
                <label for=""> <b> détenteur courrent</b></label> <br> 

                <input type="text"  class="form-control" id="txtnom_detenteur" name="nom_detenteur" placeholder="nom"> <br>              
                <figure>
                    <img src="<?= Constant::IMAGEPATH . $livre->getCouverture() ?>"  class="img-thumbnail" alt="Image d\'un livre" width="100" height="150"/>
                    </figure> <br> <br> <br> <br> <br> <br>
                 <input type="button" value="Ask this book">      
                </div>
            </div> 
        </div>
     </li>
     
    
    <?php 

    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav> 
</div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>  
    <script>
    $(document).ready(function () {
        $('#txtnom_detenteur').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: '$livre',
					data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						result($.map(data, function (item) {
							return item;
                        }));
                    }
                });
            }
        });
    });
    
</script>  
</body>
</html>