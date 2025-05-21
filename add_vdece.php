<?php include('config.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Récupère les données envoyées via le formulaire
    $pseudo = substr(trim($_POST['pseudo']), 0, 50);
    $content = trim($_POST['content']);
    if ($pseudo && $content) {
        $_SESSION['pseudo'] = $pseudo;
// Préparation de la requête pour insérer une nouvelle anecdote (VdE)
        $stmt = $db->prepare("INSERT INTO vde (pseudo, content, date) VALUES (?, ?, NOW())");
// Exécution de la requête avec les valeurs sécurisées
        $stmt->execute([$pseudo, $content]);
// Redirige l'utilisateur vers la page d'accueil après l'action
        header("Location: index.php");
        exit;
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter une VdE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="logo-background"></div>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">Vie d’ECE</a>
  </div>
</nav>
<main class="container py-5">
  <h2 class="mb-4 text-center">Partager une anecdote</h2>
  <?php if ($error): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
  <?php endif; ?>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="pseudo" class="form-label">Votre pseudo</label>
          <input type="text" name="pseudo" id="pseudo" class="form-control" maxlength="50" required value="<?= htmlspecialchars($_SESSION['pseudo'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Votre anecdote</label>
          <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <button class="btn btn-primary w-100">Publier</button>
      </form>
    </div>
  </div>
</main>
<footer>
  &copy; 2025 Vie d’ECE – Projet ECE by Evan Mathéo Keenan
</footer>
</body>
</html>