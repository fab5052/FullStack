<?php
try {
    $conn = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'admin', 'Afpa1234');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST['new_title'];
    $new_artist_id = $_POST['new_artist'];
    $new_year = $_POST['new_year'];
    $new_genre = $_POST['new_genre'];
    $new_label = $_POST['new_label'];
    $new_price = $_POST['new_price'];
    $new_picture = $_POST['new_picture'];
    
 // Créer une chaîne de texte avec les informations
 $data = "Titre: $new_title\nArtiste ID: $new_artist_id\nAnnée: $new_year\nGenre: $new_genre\nLabel: $new_label\nPrix: $new_price\n: $new_picture\n";

 // Chemin du fichier texte où vous voulez écrire les informations
 $file = 'informations_extrait_du_form.txt';

 if (file_exists($file)) {
    unlink($file);
}

 // Écrire les informations dans le fichier
 file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

 // Message de confirmation
 echo "Les informations ont été extraites avec succès dans le fichier $file.";
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
    


    // Préparation et exécution de la requête d'insertion
    $sql_insert = "INSERT INTO disc (disc_title, artist_id, disc_year, disc_genre, disc_label, disc_price, disc_picture) 
                    VALUES (:title, :artist_id, :year, :genre, :label, :price, :picture)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bindParam(':title', $new_title);
    $stmt->bindParam(':artist_id', $new_artist_id);
    $stmt->bindParam(':year', $new_year);
    $stmt->bindParam(':genre', $new_genre);
    $stmt->bindParam(':label', $new_label);
    $stmt->bindParam(':price', $new_price);
    $stmt->bindParam(':picture', $new_picture);

    if ($stmt->execute()) {
        echo "Disque ajouté avec succès.";
        // Redirection vers une page de confirmation par exemple
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur lors de l'ajout du disque : " . $stmt->errorInfo()[2];
    }
}
?>




<?php
  require_once("add_form.php");

  ?>