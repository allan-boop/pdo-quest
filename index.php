<?php
require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//--------------------------------------------FORMULAIRE-----------------------------------------------------------
echo '</ul>';
?>
<form action="index.php" method="POST">
 <p>firstname : <input type="text" name="firstname" /></p>
 <p>lastname: <input type="text" name="lastname" /></p>
 <p><input type="submit" value="OK"></p>
</form>
<?php
// ------------------------------------------Requete préparé--------------------------------------------------------------------
if(isset($_POST['firstname']) && isset($_POST['lastname']) && $_POST['firstname'] !== '') {
$firstname = trim($_POST['firstname']); 
$lastname = trim($_POST['lastname']);

$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();

$friends = $statement->fetchAll();
header('Location: index.php');
}
//-------------------------------------------Boucle pour afficher la liste-----------------------------------------------------------------
echo '<ul>';
foreach($friends as $friend) {
    echo '<li>'.$friend['firstname'] . ' ' . $friend['lastname'].'</li>';
}

?>
</body>
</html>

