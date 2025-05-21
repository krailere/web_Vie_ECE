<?php
include('config.php');

// Récupère les données envoyées via le formulaire
$pseudo = substr(trim($_POST['pseudo']), 0, 50);
$comment = trim($_POST['comment']);
$vde_id = intval($_POST['vde_id']);

if ($pseudo && $comment && $vde_id) {
    $_SESSION['pseudo'] = $pseudo;

// Préparation de la requête pour insérer une réponse à une VdE
    $stmt = $db->prepare("INSERT INTO comments (vde_id, pseudo, comment, date) VALUES (?, ?, ?, NOW())");
// Exécution de la requête avec les valeurs sécurisées
    $stmt->execute([$vde_id, $pseudo, $comment]);
}

// Redirige l'utilisateur vers la page d'accueil après l'action
header("Location: show_vdece.php?id=$vde_id");
?>