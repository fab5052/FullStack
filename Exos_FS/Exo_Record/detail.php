<?php
  require_once("header.php");

  ?>


<?php

    try
    {
        $conn = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', 'Afpa1234');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Erreur : " .$e->getMessage() . "<br>";
        echo "N° :" .$e->getCode();
        die("Fin du script");
    }
    
?>


   

<h1>Détail</h1>

<?php


if(isset($_GET['disc_id'])) {
  
    $disc_id = $_GET['disc_id'];
       
    
} else {
    echo "Aucun identifiant de disque n'a été spécifié dans l'URL.";
}

$sql = "SELECT *
        FROM artist 
        INNER JOIN disc ON artist.artist_id = disc.artist_id 
        WHERE disc.disc_id = :disc_id";        

$stmt = $conn->prepare($sql);
$stmt->bindParam(':disc_id', $disc_id);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($result) {
    ?>
    <label>Artist:</label>
    <span><?php echo $result["artist_name"]; ?></span><br>
    
    <label>Title:</label>
    <span><?php echo $result["disc_title"]; ?></span><br>
    
    <label>Year:</label>
    <span><?php echo $result["disc_year"]; ?></span><br>
    
    <label>Price:</label>
    <span><?php echo $result["disc_price"]; ?></span><br>
    
    
    <img src='Assets/images/<?php echo $result['disc_picture']; ?>' alt='<?php echo $result['disc_title']; ?>' class='img-fluid' width="100" height="100"/><br>
    <?php
} else {
    echo "Aucun disque trouvé avec cet identifiant.";
}
?>
    <button class="btn btn-primary" onclick="window.location.href='modifier.php?disc_id=<?php echo $disc_id; ?>'">Modifier</button>
    <button class="btn btn-primary" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce disque?')) { window.location.href='supprimer.php?disc_id=<?php echo $disc_id; ?>' }">Supprimer</button>
    <a href="index.php"><button class="btn btn-primary">Retour</button></a>





    <?php
  require_once("footer.php");

  ?>
