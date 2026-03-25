<?php
$retries = 5;
$conn = null;

while ($retries > 0) {
    $conn = @pg_connect("host=db port=5432 dbname=test_db user=postgres password=root");
    if ($conn) break;
    $retries--;
    sleep(2);
}

if (!$conn) {
    die("Erreur connexion DB après plusieurs tentatives");
}

$message = "";

// Création table si elle n'existe pas
pg_query($conn, "
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255)
)
");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $stmt = pg_prepare($conn, "insert_user", "INSERT INTO users(nom) VALUES($1)");
    pg_execute($conn, "insert_user", [$nom]);
    $message = "Utilisateur enregistré ✅";
}

// Récupération des utilisateurs
$result = pg_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini App PHP + PostgreSQL</title>
</head>
<body>

<h1>Mon application PHP Docker avec PostgreSQL</h1>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required>
    <button type="submit">Envoyer</button>
</form>

<p><?= $message ?></p>

<h2>Liste des utilisateurs</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nom</th>
    </tr>

    <?php if ($result && pg_num_rows($result) > 0): ?>
        <?php while ($row = pg_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nom']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">Aucun utilisateur</td>
        </tr>
    <?php endif; ?>

</table>

</body>
</html>