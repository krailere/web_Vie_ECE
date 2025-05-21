# 🌟 Vie d’ECE — Projet Web PHP MySQL

## 📚 Présentation

Vie d’ECE est un projet web développé en PHP/MySQL permettant aux étudiants de partager des anecdotes inspirées de "Vie de Merde (VDM)".  
Les utilisateurs peuvent publier des anecdotes, les consulter, et laisser des commentaires de manière interactive grâce à AJAX.  
Le site respecte une charte graphique inspirée du style Apple et des couleurs officielles de l’ECE.

---

## 🎯 Fonctionnalités

- 🔹 Page d’accueil listant les anecdotes avec **pagination**
- ✏️ Formulaire pour **ajouter une nouvelle VdE**
- 💬 Affichage détaillé d'une VdE avec **commentaires**
- ⚡ Ajout de commentaires via **AJAX** (sans rechargement de page)
- 🧠 Rétention du pseudo via **session PHP**
- 📱 Interface responsive avec **Bootstrap 5**
- 🎨 Charte graphique personnalisée : logo ECE, couleur #00737b, police Poppins
- 🖼️ Arrière-plan stylisé avec le **logo ECE intégré dans la page**
- 💻 Code structuré, léger, clair, prêt pour déploiement

---

## 🛠️ Technologies utilisées

- **PHP** (sans framework)
- **MySQL** (base `viedece`)
- **AJAX** (commentaires)
- **HTML5 / CSS3** + **Bootstrap 5**
- **Google Fonts (Poppins)**

---

## 🗃️ Structure du projet

```
vie-d-ece/
├── index.php             → Page d’accueil
├── add_vdece.php         → Formulaire d’ajout d’une anecdote
├── show_vdece.php        → Affichage d’une VdE + commentaires
├── add_comment.php       → Traitement AJAX pour les commentaires
├── config.php            → Connexion à la base (via PDO)
├── config.dist.php       → Exemple de config à copier
├── code.sql              → Script de création de la base MySQL
├── style.css             → Design général
├── background.png        → Logo ECE utilisé en filigrane
└── README.md             → Ce fichier
```

---

## 🧪 Installation locale (XAMPP / WAMP)

1. 📁 Copier tous les fichiers dans `C:/xampp/htdocs/vie-d-ece`
2. 🛠️ Lancer XAMPP et démarrer **Apache** et **MySQL**
3. 🌐 Ouvrir `http://localhost/phpmyadmin`  
   → Créer une base de données nommée **`viedece`**
4. 🧾 Importer le fichier `code.sql` dans `phpMyAdmin`
5. 📂 Copier `config.dist.php` en `config.php` si nécessaire
6. 🚀 Accéder au site via `http://localhost/vie-d-ece/`

---

## 👨‍💻 Auteurs

- Matheo ORPELIERE  
- Keenan LASSADE  
- Evan GOTLIEB  

Encadré par **Mme Amina Nahali — ECE Paris**

---

## 📌 Notes

- Ce projet respecte les consignes du sujet de web PHP (sessions, SQL, AJAX, design, pagination)
- Code documenté et organisé
- Compatible avec les navigateurs récents

---

