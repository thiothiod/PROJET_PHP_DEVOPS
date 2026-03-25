<?php
$conn = new mysqli("db", "root", "root", "test_db");

if ($conn->connect_error) {
    die("Erreur connexion DB");
}

$message = "";

// Création table
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255)
)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];

    $stmt = $conn->prepare("INSERT INTO users (nom) VALUES (?)");
    $stmt->bind_param("s", $nom);
    $stmt->execute();

    $message = "Utilisateur enregistré ✅";
}

// 🔥 IMPORTANT : récupérer les données AVANT le HTML
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini App PHP</title>
</head>
<body>

<h1>Mon application PHP Docker</h1>

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

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
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