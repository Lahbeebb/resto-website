function openAuthModal() {
    document.getElementById('authModal').style.display = 'block';
  }

  function closeAuthModal() {
    document.getElementById('authModal').style.display = 'none';
  }

  function showTab(tab) {
    document.getElementById('signup').style.display = (tab === 'signup') ? 'block' : 'none';
    document.getElementById('signin').style.display = (tab === 'signin') ? 'block' : 'none';
  }


 



//  Ouvrir la fenêtre modale quand on clique sur "BUY"
document.querySelectorAll('.dish a').forEach(button => {
  button.addEventListener('click', (e) => {
    e.preventDefault(); // Empêche le comportement par défaut du lien
    document.getElementById('orderModal').style.display = 'block'; // Affiche la modale
  });
});

//  Fermer la modale
function closeOrderModal() {
  document.getElementById('orderModal').style.display = 'none';
}

//  Gestion de l'envoi du formulaire de commande
document.getElementById('orderForm').addEventListener('submit', function(e) {
  e.preventDefault(); // Empêche le rechargement de la page

  const formData = new FormData(this); // Récupère les données du formulaire

  //  Envoie des données au fichier PHP (commande.php)
  fetch('commande.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text()) // On récupère la réponse en texte
  .then(response => {
    if (response.trim() === 'success') {
      // Si la commande est enregistrée avec succès :
      document.getElementById('orderForm').style.display = 'none'; // Cacher le formulaire
      const successMsg = document.getElementById('successMsg');
      successMsg.style.display = 'block'; // Afficher le message de succès

      //  Après 3 secondes, cacher le message, réinitialiser le formulaire et fermer la modale
      setTimeout(() => {
        successMsg.style.display = 'none'; // Cacher le message
        document.getElementById('orderForm').reset(); // Vider les champs
        document.getElementById('orderForm').style.display = 'block'; // Réafficher le formulaire
        closeOrderModal(); // Fermer la fenêtre modale
      }, 3000); //  délai de 3 secondes
    } else {
      // Si erreur côté serveur, afficher une alerte
      alert('Erreur lors de l\'enregistrement !');
    }
  });
});



// Ouvrir la fenêtre modale de réclamation
function openReclamationModal() {
  document.getElementById('reclamationModal').style.display = 'block';
}

// Fermer la fenêtre modale de réclamation
function closeReclamationModal() {
  document.getElementById('reclamationModal').style.display = 'none';
}

// Gestion de l'envoi du formulaire de réclamation
document.getElementById('reclamationForm').addEventListener('submit', function(e) {
  e.preventDefault(); // Empêche le rechargement de la page

  const formData = new FormData(this); // Récupère les données du formulaire

  // Envoie des données au fichier PHP (reclamation.php)
  fetch('reclamation.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text()) // On récupère la réponse en texte
  .then(response => {
    if (response.trim() === 'success') {
      // Si la réclamation est envoyée avec succès :
      document.getElementById('reclamationForm').style.display = 'none'; // Cacher le formulaire
      const successMsg = document.getElementById('reclamationSuccessMsg');
      successMsg.style.display = 'block'; // Afficher le message de succès

      // Après 3 secondes, cacher le message, réinitialiser le formulaire et fermer la modale
      setTimeout(() => {
        successMsg.style.display = 'none'; // Cacher le message
        document.getElementById('reclamationForm').reset(); // Vider les champs
        document.getElementById('reclamationForm').style.display = 'block'; // Réafficher le formulaire
        closeReclamationModal(); // Fermer la fenêtre modale
      }, 3000); // Délai de 3 secondes
    } else {
      // Si erreur côté serveur, afficher une alerte
      alert('Erreur lors de l\'enregistrement de votre réclamation !');
    }
  });
});
