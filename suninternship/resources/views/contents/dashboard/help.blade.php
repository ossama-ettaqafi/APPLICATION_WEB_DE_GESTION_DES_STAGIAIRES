<section id="dashboard" class="section">
  <h2>Tableau de bord</h2>
  <p>
    Bienvenue sur le Tableau de bord ! Ici, vous pouvez surveiller et
    gérer différents aspects de votre programme de stage.
  </p>
  <p>
    Le Tableau de bord offre un aperçu des statistiques importantes et
    vous permet d'effectuer des actions telles que l'ajout, la
    modification et la suppression d'internes.
  </p>
</section>

<section id="interns" class="section">
  <h2>Stagiaires</h2>
  <p>
    La section Stagiaires vous permet de gérer les stagiaires participant
    à votre programme. Vous pouvez effectuer les actions suivantes :
  </p>
  <ul>
    <li>
      Ajouter un stagiaire : Cliquez sur le bouton
      <i class="fas fa-plus"></i> pour ajouter un nouveau stagiaire dans
      le système. Remplissez les informations requises telles que le nom,
      l'âge, l'école et le secteur.
    </li>
    <li>
      Modifier un stagiaire : Pour modifier les informations d'un
      stagiaire, cliquez sur le bouton <i class="fas fa-edit"></i> à côté
      de ses informations. Vous pouvez mettre à jour son nom, son âge, son
      école et son secteur.
    </li>
    <li>
      Supprimer un stagiaire : Si un stagiaire ne fait plus partie du
      programme, cliquez sur le bouton <i class="fas fa-trash"></i> pour
      supprimer ses informations du système.
    </li>
    <li>
      Imprimer une attestation de stagiaire : Pour imprimer une attestation de
      stagiaire, cliquez sur le bouton <i class="fas fa-print"></i> pour lancer
      l'impression du document.
    </li>
  </ul>
  <p>
    Vous pouvez également consulter des informations détaillées sur chaque
    stagiaire en cliquant sur leur nom ou leur image.
  </p>
</section>

<section id="menu-options" class="section">
  <h2>Options de menu</h2>
  <p>
    Le menu situé sur le côté gauche du Tableau de bord permet d'accéder à
    différentes sections et fonctionnalités :
  </p>
  <ul>
    <li>
      <i class="fas fa-tachometer-alt"></i> Tableau de bord : Accédez à la
      page principale du Tableau de bord.
    </li>
    <li>
      <i class="fas fa-user-graduate"></i> Stagiaires : Gérez les
      stagiaires, ajoutez de nouveaux stagiaires, modifiez ceux existants
      et supprimez des stagiaires.
    </li>
    <li>
      <i class="fas fa-tasks"></i> Activités : Affichez et gérez les
      activités liées au programme de stage.
    </li>
    <li>
      <i class="fas fa-cog"></i> Paramètres : Configurez les paramètres du
      compte, changez le mot de passe, mettez à jour les paramètres de
      sécurité et gérez les préférences de l'application.
    </li>
    <li>
      <i class="fas fa-question-circle"></i> Aide : Accédez à la
      documentation d'aide et aux ressources de support.
    </li>
    <li>
      <i class="fas fa-sign-out-alt"></i> Déconnexion : Déconnectez-vous
      du Tableau de bord.
    </li>
  </ul>
</section>

<section class="help-section">
  <div class="container">
    <h1>Contactez le développeur</h1>
    <p>
      Si vous rencontrez des bugs ou avez des suggestions de nouvelles
      fonctionnalités, n'hésitez pas à contacter le développeur. Vos
      commentaires sont précieux pour améliorer notre application.
    </p>

    <form action="#" method="POST" class="contact-form">
      <div class="form-group">
        <label for="name">Votre nom</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Entrez votre nom"
          required
        />
      </div>

      <div class="form-group">
        <label for="email">Votre adresse e-mail</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Entrez votre adresse e-mail"
          required
        />
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea
          id="message"
          name="message"
          placeholder="Entrez votre message"
          required
        ></textarea>
      </div>

      <button type="submit" class="submit-btn">Envoyer</button>
    </form>
  </div>
</section>