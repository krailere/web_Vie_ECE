<?php include('config.php');
$id = intval($_GET['id'] ?? 0);
$stmt = $db->prepare("SELECT * FROM vde WHERE id = ?");
// Exécution de la requête avec les valeurs sécurisées
$stmt->execute([$id]);
// Récupère les informations d’une VdE spécifique grâce à son ID
$vde = $stmt->fetch();
if (!$vde) {
    http_response_code(404);
    exit('VdE non trouvée');
}
$comments_stmt = $db->prepare("SELECT * FROM comments WHERE vde_id = ? ORDER BY date ASC");
// Exécution de la requête avec les valeurs sécurisées
$comments_stmt->execute([$id]);
// Récupération de tous les résultats de la requête sous forme de tableau
$comments = $comments_stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réponses - Vie d’ECE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <script>
  function postComment(event) {
    event.preventDefault();
    const form = event.target;
    fetch('add_comment.php', {
        method: 'POST',
        body: new FormData(form)
    }).then(response => response.text()).then(() => location.reload());
  }
  </script>
</head>
<body>
<div class="logo-background"></div>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">Vie d’ECE</a>
  </div>
</nav>
<main class="container py-4">
  <div class="card mb-4">
    <div class="card-body">
      <h4 class="card-title text-primary"><?= htmlspecialchars($vde['pseudo']) ?> <small class="text-muted">– <?= date('d/m/Y H:i', strtotime($vde['date'])) ?></small></h4>
      <p class="card-text fs-5 mt-3"><?= nl2br(htmlspecialchars($vde['content'])) ?></p>
    </div>
  </div>

  <h5>Réponses</h5>
  <?php if (count($comments) === 0): ?>
    <p class="text-muted">Aucun réponse pour l’instant.</p>
  <?php endif; ?>
  <?php foreach ($comments as $comment): ?>
    <div class="card mb-2">
      <div class="card-body">
        <strong><?= htmlspecialchars($comment['pseudo']) ?></strong> <small class="text-muted">(<?= date('d/m/Y H:i', strtotime($comment['date'])) ?>)</small>
        <p class="mb-0 mt-1"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
      </div>
    </div>
  <?php endforeach; ?>

  <div class="card mt-4">
    <div class="card-body">
      <h6>Ajouter un réponse</h6>
      <form method="post" onsubmit="postComment(event)">
        <input type="hidden" name="vde_id" value="<?= $vde['id'] ?>">
        <div class="mb-2">
          <input class="form-control" name="pseudo" maxlength="50" placeholder="Votre pseudo" value="<?= htmlspecialchars($_SESSION['pseudo'] ?? '') ?>">
        </div>
        <div class="mb-2">
          <textarea class="form-control" name="comment" rows="3" placeholder="Votre réponse..."></textarea>
        </div>
        <button class="btn btn-primary">Envoyer</button>
      </form>
    </div>
  </div>
</main>
<footer>
  &copy; 2025 Vie d’ECE – Projet ECE Projet ECE by Evan Mathéo Keenan
</footer>
</body>
</html>