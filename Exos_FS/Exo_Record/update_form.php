<?php
  require_once("header.php");

  ?>


<?php
  require_once("update_script.php");

  ?>

<h2 class="mb-3">Formulaire de modification</h2>
<form method="post" action="" enctype="multipart/form-data">
<div class="container col-1 mb-5 p-4 mt-3 justify-content-center ">
    <div class="row">
    <label for="new_title">Title:</label>
    <input type="text" id="new_title" name="new_title" value="<?= $disc_info['disc_title']; ?>"><br>
    
    <label for="new_artist">Artist:</label>
    <select id="new_artist" name="new_artist">
        <?php
        $sql_artists = "SELECT * FROM artist";
        $stmt_artists = $db->query($sql_artists);
        while ($artist = $stmt_artists->fetch(PDO::FETCH_ASSOC)) {
            $selected = ($disc_info['artist_id'] == $artist['artist_id']) ? 'selected' : '';
            echo "<option value=\"{$artist['artist_id']}\" $selected>{$artist['artist_name']}</option>";
        }
        ?>
    </select><br>

    <label for="new_year">Year:</label>
    <input type="text" id="new_year" name="new_year" value="<?= $disc_info['disc_year']; ?>"><br>
    
    <label for="new_genre">Genre:</label>
    <input type="text" id="new_genre" name="new_genre" value="<?= $disc_info['disc_genre']; ?>"><br>

    <label for="new_label">Label:</label>
    <input type="text" id="new_label" name="new_label" value="<?= $disc_info['disc_label']; ?>"><br>

    <label for="new_price">Price:</label>
    <input type="text" id="new_price" name="new_price" value="<?= $disc_info['disc_price']; ?>"><br>

    <label for="new_picture">Image:</label>
    
    <img src="Assets/images/<?= $disc_info['disc_picture']; ?>" width="100" height="100" alt="Current Image"><br>
    <input type="file" id="new_picture" name="new_picture"><br>
    
    <input type="submit" class=' btn btn-primary' value="modifier">
    <a href="detail.php?disc_id=<?= $disc_id; ?>"><button class=' btn btn-primary'>Retour</button></a>
</form>
</div>
</div>

<?php
  require_once("footer.php");

  ?>