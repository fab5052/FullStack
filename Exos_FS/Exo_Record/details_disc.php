<?php
$db = new PDO("mysql:host=localhost;charset=utf8;dbname=record" , "admin" , "Afpa1234");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['disc_id'])) {
    $disc_id = $_GET['disc_id'];

} else {
    echo "Aucun identifiant de disque n'a été spécifié dans l'URL.";
}

$requete = $db->prepare("SELECT * FROM disc WHERE disc_id=?");
$requete->execute(array($disc_id));
$disc = $requete->fetch(PDO::FETCH_OBJ);

    if($disc) {
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détails du disque</title>
</head>
<body>
    <div>
        <h1>Détails du disque</h1>
        <p>Disc N° <?= $disc_id ?></p>
        <p>Disc name <?= $disc->disc_name ?></p>
        <p>Disc year <?= $disc->disc_year ?></p>
        <p>Disc title<?= $disc->disc_title ?></p>
    </div>
</body>
</html>

<?php
    } else {
        echo "Disque non trouvé";
    }
} else {
    echo "Identifiant du disque non spécifié";
}
?>
