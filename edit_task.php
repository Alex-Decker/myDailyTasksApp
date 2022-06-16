<?php
require_once ('functions.php');
if (isset($_GET["tasks_id"])) {
    $dbh = db_connect(user,pass);
    $stmt = $dbh->prepare("SELECT * FROM tasks WHERE tasks_id=".$_GET["tasks_id"]);
    $stmt->execute();
    $ligne = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/nouveauClient.css">
    <title>List clents</title>
</head>
<body>
<div class="main">
    <h1 class="main_titre"><?php if (isset($_GET["tasks_id"])) { echo 'Update task : '.$ligne['tasks_id'];}else{echo 'Create new task';}?></h1>

    <form action="edit_task.php" method="POST">
        <div class="line">
            <label for="Name">Name</label>
            <input type="text" name="name" id="nom" <?php if (isset($_GET["tasks_id"])) { echo 'value="'.$ligne['name'].'"';}?> required>
        </div>
        <div class="line">
            <label for="duration">Duration</label>
            <input type="text" name="duration" id="prenom" <?php if (isset($_GET["tasks_id"])) { echo 'value="'.$ligne['duration'].'"';}?> required>
        </div>
        <div class="line">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" <?php if (isset($_GET["tasks_id"])) { echo 'value="'.$ligne['date'].'"';}?>>
        </div>
        <div class="btn_validation">
            <button class="annuler" type="button"><a href="index.php">Annuler</a></button>
            <button class="enregistrer" type="submit" name="submit" <?php if (isset($_GET["tasks_id"])) { echo 'value="'.$_GET["tasks_id"].'"';}else{echo 'value="enregistrer"';}?>><?php if (isset($_GET["tasks_id"])) { echo 'Modifier';}else{echo 'Enregistrer';}?></button>
            <button class="supprimer" <?php if (isset($_GET["tasks_id"])) {echo 'type="button"';} else {echo 'type="reset"';}?>><a <?php
                if (isset($_GET["tasks_id"])) {
                    $l=$_GET["tasks_id"];
                    echo "onclick=\"return confirm('voulez-vous vraiment supprimer ce client ???')\"";
                    $result = delete_task($_GET["tasks_id"]);
                    echo "alert(".$result.")";
                }
                ?> ><?php if (isset($_GET["tasks_id"])) {echo 'Supprimer';} else {echo 'refrech';}?></a></button>
        </div>
    </form>

</div>
</body>
</html>
<?php
if(isset($_POST["submit"]) ){
    $name = $_POST["name"];
    $duration = $_POST["duration"];
    $date = $_POST["date"];
    if ($_POST["submit"] == "enregistrer"){
        $result = add_task($name,$duration,$date);
        echo "alert(".$result.")";

    }elseif ($_POST["submit"] != "enregistrer"){
        $result = edit_task($_GET["tasks_id"],$name,$duration,$date);
        echo "alert(".$result.")";
    }
}
