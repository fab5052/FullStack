<?php
try {
    $conn = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Afpa1234');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "<br>";
    echo "N° :" . $e->getCode();
    die("Fin du script");
}

$disc_id = $_GET['disc_id'];

// Récupérer les informations du disque
$sql_select = "SELECT * FROM disc WHERE disc_id = :disc_id";
$stmt = $conn->prepare($sql_select);
$stmt->bindParam(':disc_id', $disc_id);
$stmt->execute();
$disc_info = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $new_title = $_POST['new_title'];
    $new_artist_id = $_POST['new_artist'];
    $new_year = $_POST['new_year'];
    $new_genre = $_POST['new_genre'];
    $new_label = $_POST['new_label'];
    $new_price = $_POST['new_price'];

    // Gestion du téléchargement de fichier
    $new_picture = '';
    if (isset($_FILES['new_picture']) && $_FILES['new_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/Assets/images/';
        
        // Assurer que le dossier de téléchargement existe
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $uploadFile = $uploadDir . basename($_FILES['new_picture']['name']);
        
        // Vérifier le type de fichier
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif'); // Extensions autorisées
        
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            exit;
        }
        
        if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $uploadFile)) {
            $new_picture = basename($_FILES['new_picture']['name']);
        } else {
            echo "Erreur lors du téléchargement du fichier.";
            exit;
        }
    } else {
        echo "Aucun fichier téléchargé.";
        exit;
    }
    

    // Préparation et exécution de la requête de mise à jour
    $sql_update = "UPDATE disc SET disc_title = :title, artist_id = :artist_id, disc_genre = :genre, disc_year = :year, disc_label = :label, disc_price = :price,disc_picture = :picture WHERE disc_id = :disc_id";

    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':title', $new_title);
    $stmt->bindParam(':artist_id', $new_artist_id);
    $stmt->bindParam(':genre', $new_genre);
    $stmt->bindParam(':year', $new_year);
    $stmt->bindParam(':label', $new_label);
    $stmt->bindParam(':price', $new_price);
    $stmt->bindParam(':picture', $new_picture);
    $stmt->bindParam(':disc_id', $disc_id);

    if ($stmt->execute()) {
        echo "Enregistrement mis à jour avec succès.";
        header("Location: detail.php?disc_id=$disc_id");
        exit;
    } else {
        echo "Erreur lors de la mise à jour de l'enregistrement : " . $stmt->errorInfo()[2];
    }
}

?>


<?php
  require_once("update_form.php");

  ?>