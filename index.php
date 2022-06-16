<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/index.css">
    <title>List of tasks</title>
</head>
<body>
<div class="main">
    <div>
        <h1 class="main_titre">List of tasks</h1>
    </div>
    <div class="main_content">
        <div class="tab_content">
            <table>
                <thead>
                <th>Name</th>
                <th>Duration</th>
                <th>Date</th>
                </thead>
                <?php
                foreach (get_tasks_list() as $ligne){
                    echo "<tr onclick=\"location.href='edit_task.php?tasks_id=".$ligne['tasks_id']."'\">
                        <td>".$ligne['name']."</td>
                        <td>".$ligne['duration']."</td>
                        <td>".$ligne['date']."</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
        <div class="btn_validation">
            <button type="submit" ><a href="edit_task.php">New task</a></button>
        </div>

    </div>
</div>
</body>
</html>