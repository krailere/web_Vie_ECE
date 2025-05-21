<?php include('config.php'); ?>
<?php
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 5;
$offset = ($page - 1) * $limit;
$total = $db->query("SELECT COUNT(*) FROM vde")->fetchColumn();
$stmt = $db->prepare("SELECT v.id, v.pseudo, v.content, v.date, COUNT(c.id) AS comments FROM vde v LEFT JOIN comments c ON v.id = c.vde_id GROUP BY v.id ORDER BY v.date DESC LIMIT :offset, :limit");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
// Exécution de la requête avec les valeurs sécurisées
$stmt->execute();
// Récupération de tous les résultats de la requête sous forme de tableau
$vdes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vie d’ECE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    .pagination .page-link {
      border-radius: 50% !important;
      width: 38px;
      height: 38px;
      padding: 0;
      line-height: 38px;
      text-align: center;
      background-color: white;
      border: 1px solid #00737b;
      color: #00737b;
    }
    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
      background-color: #00737b;
      color: white;
    }
  </style>
</head>
<body>
<div class="logo-background"></div>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">Vie d’ECE</a>
    <div>
      <a href="add_vdece.php" class="btn btn-light">+ Ajouter une VdE</a>
    </div>
  </div>
</nav>

<main class="container py-5">
  <div class="mb-5">
    <h1 class="fw-bold text-primary text-start">Vie d’ECE</h1>
    <p class="lead text-start">Partage tes anecdotes étudiantes et découvre celles des autres !</p>
  </div>

  <?php foreach ($vdes as $vde): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title text-primary">
          <?= htmlspecialchars($vde['pseudo']) ?> 
          <small class="text-muted">– <?= date('d/m/Y H:i', strtotime($vde['date'])) ?></small>
        </h5>
        <p class="card-text"><?= nl2br(htmlspecialchars($vde['content'])) ?></p>
        <div class="text-end mt-3">
          <a href="show_vdece.php?id=<?= $vde['id'] ?>" class="btn btn-outline-primary btn-sm">
            <?= $vde['comments'] ?> réponse(s)
          </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <nav>
    <ul class="pagination justify-content-center">
      <?php for ($i = 1; $i <= ceil($total / $limit); $i++): ?>
        <li class="page-item<?= $i == $page ? ' active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
</main>

<footer>
  &copy; 2025 Vie d’ECE – Projet ECE by Evan Mathéo Keenan
</footer>
</body>
</html>