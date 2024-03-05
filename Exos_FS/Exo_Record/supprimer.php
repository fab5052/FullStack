<?php
  require_once("header.php");

  ?>


<?php
// Vérifier si l'identifiant du disque est passé dans l'URL
if(isset($_GET['disc_id'])) {
    // Récupérer l'identifiant du disque depuis l'URL
    $disc_id = $_GET['disc_id'];
    
    // Inclure le fichier de configuration de la base de données
    require_once "detail.php";
    
    try {
        // Connexion à la base de données
        $conn = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Afpa1234');
        // Configuration pour afficher les erreurs PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Requête SQL de suppression du disque
        $sql = "DELETE FROM disc WHERE disc_id = :disc_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':disc_id', $disc_id);
        $stmt->execute();
        
        echo "Le disque a été supprimé avec succès.";
        header("Location: index.php");
        exit; 
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    
    // Fermer la connexion à la base de données
    $conn = null;
} 
?>

<?php
  require_once("footer.php");

  ?>
