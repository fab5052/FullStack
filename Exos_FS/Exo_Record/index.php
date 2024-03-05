<?php
  require_once("header.php");

  
    ?>


<?php

    try
    {
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', 'Afpa1234');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Erreur : " .$e->getMessage() . "<br>";
        echo "N° :" .$e->getCode();
        die("Fin du script");
    }
    
    
        
        // Vérification de la présence de la clé disc_id dans $_GET
         if (isset($_GET["disc_id"])) {
        //     // Préparation de la requête avec un paramètre
             $requete = $db->prepare("SELECT * FROM disc WHERE disc_id = ?");
        //     // Exécution de la requête en passant la valeur du paramètre
             $requete->execute(array($_GET["disc_id"]));
        //     // Récupération du résultat
             $disc = $requete->fetch(PDO::FETCH_OBJ);

             if (!$disc) {
                 echo "Aucun enregistrement trouvé.";
             }
            
            }

   $sql = "SELECT *
 FROM artist 
 INNER JOIN disc  ON artist.artist_id = disc.artist_id ORDER BY artist_name ASC";

$result = $db->query($sql);



?>
   

<?php
$stmt = $db->prepare("SELECT * FROM disc");
$stmt->execute();


$count = $stmt->rowCount();
echo "<h1>Liste des disques ($count)</h1>";


?>


<div class="container">

    <a href="add_form.php" class="justify-content-end d-flex"><button class="btn btn-primary">Ajouter</button></a>

    <div class="row">
        <?php while($row = $result->fetch()) { ?>
            <div class="col-md-6 mb-5 mt-3">
                <div class="row">
                    <div class="col-md-5">
                        <img src='Assets/images/<?php echo $row['disc_picture']; ?>' alt='<?php echo $row['disc_title']; ?>' class='img-fluid' />
                    </div>
                    <div class="col-md-7">
                        <h3><?php echo $row["disc_title"]; ?></h3>
                        <h5><?php echo $row["artist_name"]; ?></h5>
                        <p><strong>Label :</strong><?php echo $row["disc_label"]; ?></p>
                        <p>Year: <?php echo $row["disc_year"]; ?></p>
                        <p><strong>Genre:</strong> <?php echo $row["disc_genre"]; ?></p>
                        <a href='detail.php?disc_id=<?php echo $row["disc_id"]; ?>'><button class="btn btn-primary d-flex">Detail</button></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
  require_once("footer.php");

  ?>
