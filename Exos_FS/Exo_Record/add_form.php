<?php
  require_once("header.php");

  ?>
<?php
  require_once("add_script.php");

  ?>

<h2>Ajouter un vinyle </h2>
<form method="post" action="add_script.php" enctype="multipart/form-data">
    <label for="new_title">Title:</label>
    <input type="text" id="new_title" name="new_title" value=""><br>
    
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
    <input type="text" id="new_year" name="new_year" value=""><br>
    
    <label for="new_genre">Genre:</label>
    <input type="text" id="new_genre" name="new_genre" value=""><br>

    <label for="new_label">Label:</label>
    <input type="text" id="new_label" name="new_label" value=""><br>

    <label for="new_price">Price:</label>
    <input type="text" id="new_price" name="new_price" value=""><br>

    <label for="new_picture">Image:</label>
    <input type="file" id="new_picture" name="new_picture"><br>

    <input type="submit" class=' btn btn-primary' value="Ajouter">
 
</form>
   <a href="index.php"><button class=' btn btn-primary'>Retour</button></a>

<?php
  require_once("footer.php");

  ?>




























