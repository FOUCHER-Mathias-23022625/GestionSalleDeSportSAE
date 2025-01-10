<?php/*
require_once 'config.php';  // Inclut la configuration de la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEvenement = $_POST['idEvenement'];
    $nomUtilisateur = $_POST['nomUtilisateur'];

    // Connexion à la base de données
    try {
        $pdo = new PDO($dsn, $username, $password);  // Variables de configuration de la BDD
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête SQL
        $sql = "INSERT INTO participation (IdEvenement, NomUtilisateur) VALUES (:idEvenement, :nomUtilisateur)";
        $stmt = $pdo->prepare($sql);

        // Exécution de la requête avec les valeurs
        $stmt->execute([
            ':idEvenement' => $idEvenement,
            ':nomUtilisateur' => $nomUtilisateur
        ]);

        echo "Inscription réussie !";

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}*/
?>
