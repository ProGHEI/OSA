<?php

/**
 * Implement hook_form() with the standard default form.
 */
function osa_affaire_form($node, &$form_state) {


  $listeEtudiants = getAllEtudiants();
  $listeUsers = getAllUsers();
  $listeStatuts = getAllStatuts();
  $listeClients = getAllClients();
  $listeDomaines = getAllDomaines();
  


  // get the default values for our form fields
  if (!isset($node->nid)) {

    $idAffaire = '';
    $idClient = 'Sélectionnez';
    $idEtudiant = 'Sélectionnez';
    $idCDP = 0;
    $titreAffaire = '';
    $statutAffaire = '';
    $recapitulatif = '';
    $prixHT = 0;
    $tva = 19.6;
    $sommeFrais = 0;
    $nbJEH = 0;
    $prixJEH = 0;
    $pourcentPrevi = 0;
    $sommeHTPrevi = 0;
    $accompte = 0;
    $soldeFinal = 0;
    $dateDebut = 0;
    $dateFin = 0;
    $datePremierContact = 0;
    $origine = '';
    $domaineAffaire = '';
    $active = 'Sélectionnez';
  }
  else {
    // query the db for info about our node
    $data = db_select('osa_affaire', 'd')
        ->fields('d', array(
          'nid',
          'uid',
          'idAffaire',
          'idClient',
          'idEtudiant',
          'titreAffaire',
          'recapitulatif',
          'prixHT',
          'tva',
          'sommeFrais',
          'nbJEH',
          'prixJEH',
          'pourcentPrevi',
          'sommeHTPrevi',
          'accompte',
          'soldeFinal',
          'dateDebut',
          'dateFin',
          'datePremierContact',
          'origine',
          'chartreQualite',
          'statutAffaire',
          'domaineAffaire',
          'idCDP',
          'active',))
        ->condition("d.nid", $node->nid)
        ->execute()
        ->fetchAssoc();

    $idAffaire = $data['idAffaire'];
    $statutAffaire = $data['statutAffaire'];
    $idClient = $data['idClient'];
    $idEtudiant = $data['idEtudiant'];
    $titreAffaire = $data['titreAffaire'];
    $recapitulatif = $data['recapitulatif'];
    $prixHT = $data['prixHT'];
    $tva = $data['tva'];
    $sommeFrais = $data['sommeFrais'];
    $nbJEH = $data['nbJEH'];
    $prixJEH = $data['prixJEH'];
    $pourcentPrevi = $data['pourcentPrevi'];
    $sommeHTPrevi = $data['sommeHTPrevi'];
    $accompte = $data['accompte'];
    $soldeFinal = $data['soldeFinal'];
    $domaineAffaire = $data['domaineAffaire'];
    $idCDP = $data['idCDP'];
    $active = $data['active'];

    $dateDebut['year'] = date('Y', $data['dateDebut']);
    $dateDebut['month'] = date('n', $data['dateDebut']);
    $dateDebut['day'] = date('d', $data['dateDebut']);

    $dateFin['year'] = date('Y', $data['dateFin']);
    $dateFin['month'] = date('n', $data['dateFin']);
    $dateFin['day'] = date('d', $data['dateFin']);

    $datePremierContact['year'] = date('Y', $data['datePremierContact']);
    $datePremierContact['month'] = date('n', $data['datePremierContact']);
    $datePremierContact['day'] = date('d', $data['datePremierContact']);

    $origine = $data['origine'];
    $chartreQualite = $data['chartreQualite'];
  }
  // build the form
  $form = array();

  $form['idAffaire'] = array(
    '#title' => t('id de l\'affaire'),
    '#type' => 'textfield',
    '#description' => t('Indiquez l\' id de l\'affaire.'),
    '#default_value' => $idAffaire,
    '#weight' => -15,
    '#required' => TRUE,
  );
  $form['statutAffaire'] = array(
    '#title' => t('Statut de l\'affaire'),
    '#type' => 'select',
    '#options' => $listeStatuts,
    '#default_value' => $statutAffaire,
    '#weight' => -13,
    '#required' => TRUE,
  );
  $form['idClient'] = array(
    '#title' => t('Client'),
    '#type' => 'select',
    '#description' => t('Indiquez le titre de l\'affaire.'),
    '#default_value' => $idClient,
    '#options' => $listeClients,
    '#weight' => -11,
    '#required' => TRUE,
  );
  $form['idCDP'] = array(
    '#title' => t('Chef de Projet'),
    '#type' => 'select',
    '#description' => t('Le chef de projet pour l\'affaire'),
    '#default_value' => $idCDP,
    '#options' => $listeUsers,
    '#weight' => -10,
    '#required' => FALSE,
  );
  $form['idEtudiant'] = array(
    '#title' => t('Étudiant'),
    '#type' => 'select',
    '#description' => t('Étudiant réalisateur'),
    '#default_value' => $idEtudiant,
    '#options' => $listeEtudiants,
    '#weight' => -10,
    '#required' => FALSE,
  );
  $form['titreAffaire'] = array(
    '#title' => t('Titre de l\'affaire'),
    '#type' => 'textfield',
    '#description' => t('Indiquez le titre de l\'affaire.'),
    '#default_value' => $titreAffaire,
    '#weight' => -14,
    '#required' => TRUE,
  );
  $form['domaineAffaire'] = array(
    '#title' => t('Domaine de compétences'),
    '#type' => 'select',
    '#description' => t('Indiquez le titre de l\'affaire.'),
    '#default_value' => $domaineAffaire,
    '#options' => $listeDomaines,
    '#weight' => -13,
    '#required' => TRUE,
  );
  $form['recapitulatif'] = array(
    '#title' => t('Récapitulatif de l\'affaire'),
    '#type' => 'textarea',
    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $recapitulatif,
    '#rows' => 5,
    '#weight' => -12,
    '#required' => FALSE,
  );
  $form['prixHT'] = array(
    '#title' => t('Prix (HT)'),
    '#type' => 'textfield',
    '#description' => t('Renseignez le prix hors taxes de l\'affaire, en euros.'),
    '#default_value' => $prixHT,
    '#weight' => -9,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => TRUE,
  );
  $form['tva'] = array(
    '#title' => t('TVA'),
    '#type' => 'textfield',
    '#description' => t('Renseignez la TVA qui s\'appliquera sur l\'affaire.'),
    '#default_value' => $tva,
    '#weight' => -6,
    '#size' => 3,
    '#field_suffix' => '%',
    '#required' => TRUE,
  );
  $form['sommeFrais'] = array(
    '#title' => t('Somme des frais annexes'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $sommeFrais,
    '#weight' => -2,
    '#size' => 4,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['nbJEH'] = array(
    '#title' => t('Nombre de JEH'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $nbJEH,
    '#weight' => -8,
    '#size' => 4,
    '#required' => TRUE,
  );
  $form['prixJEH'] = array(
    '#title' => t('Prix fixé d\'un seul JEH'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $prixJEH,
    '#weight' => -7,
    '#size' => 4,
    '#field_suffix' => '€',
    '#required' => TRUE,
  );
  $form['pourcentPrevi'] = array(
    '#title' => t('Pourcentage prévisionnel reversé à l\'étudiant'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $pourcentPrevi,
    '#weight' => -1,
    '#size' => 3,
    '#field_suffix' => '%',
    '#required' => FALSE,
  );
  $form['sommeHTPrevi'] = array(
    '#title' => t('Somme hors taxes prévisionnelle reversée à l\'étudiant'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $sommeHTPrevi,
    '#weight' => -0,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['accompte'] = array(
    '#title' => t('Accompte déjà versé par l\'entreprise'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $accompte,
    '#weight' => 1,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['soldeFinal'] = array(
    '#title' => t('Solde final'),
    '#type' => 'textfield',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $soldeFinal,
    '#weight' => 2,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['dateDebut'] = array(
    '#title' => t('Date du début de l\'affaire'),
    '#type' => 'date',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $dateDebut,
    '#weight' => -6,
    '#required' => TRUE,
  );
  $form['dateFin'] = array(
    '#title' => t('Date de fin de l\'affaire'),
    '#type' => 'date',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $dateFin,
    '#weight' => -5,
    '#required' => TRUE,
  );
  $form['datePremierContact'] = array(
    '#title' => t('Date du premier contact avec le client'),
    '#type' => 'date',
    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $datePremierContact,
    '#weight' => -4,
    '#required' => FALSE,
  );
  $form['origine'] = array(
    '#title' => t('Origine de l\'affaire'),
    '#type' => 'textarea',
//    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
    '#default_value' => $origine,
    '#rows' => 5,
    '#weight' => -3,
    '#required' => FALSE,
  );
  $form['active'] = array(
    '#title' => t('Affaire en cours'),
    '#type' => 'checkbox',
    '#default_value' => $active,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 1,
    '#required' => FALSE,
  );
//  $form['chartreQualite'] = array(
//    '#title' => t('Chartre qualité de l\'affaire'),
//    '#type' => 'textarea',
////    '#description' => t('Renseignez le récapitulatif de l\'affaire.'),
//    '#default_value' => $chartreQualite,
//    '#rows' => 5,
//    '#weight' => -6,
//    '#required' => FALSE,
//  );



  return $form;
}

function osa_client_form($node, &$form_state) {
  // get the default values for our form fields
  if (!isset($node->nid)) {

    $idClient = '';
    $nomClient = '';
    $prenomClient = '';
    $fonction = '';
    $entreprise = '';
    $numeroDeVoie = 1;
    $voie = '';
    $codePostal = '';
    $ville = '';
    $mail = '';
    $tel = '';
    $commentaire = '';
  }
  else {
    // query the db for info about our node
    $data = db_select('osa_client', 'c')
        ->fields('c', array(
          'nid',
          'uid',
          'idClient',
          'nomClient',
          'prenomClient',
          'fonction',
          'entreprise',
          'numeroDeVoie',
          'voie',
          'codePostal',
          'ville',
          'mail',
          'tel',
          'commentaire',))
        ->condition("c.nid", $node->nid)
        ->execute()
        ->fetchAssoc();

    $idClient = $data['idClient'];
    $nomClient = $data['nomClient'];
    $prenomClient = $data['prenomClient'];
    $fonction = $data['fonction'];
    $entreprise = $data['entreprise'];
    $numeroDeVoie = $data['numeroDeVoie'];
    $voie = $data['voie'];
    $codePostal = $data['codePostal'];
    $ville = $data['ville'];
    $mail = $data['mail'];
    $tel = $data['tel'];
    $commentaire = $data['commentaire'];
  }
  // build the form
  $form = array();

  $form['idClient'] = array(
    '#title' => t('id du client'),
    '#type' => 'textfield',
    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $idClient,
    '#weight' => -10,
    '#required' => TRUE,
  );
  $form['nomClient'] = array(
    '#title' => t('Nom de famille'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $nomClient,
    '#weight' => -9,
    '#required' => FALSE,
  );
  $form['prenomClient'] = array(
    '#title' => t('Prénom'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $prenomClient,
    '#weight' => -8,
    '#required' => FALSE,
  );
  $form['fonction'] = array(
    '#title' => t('Fonction au sein de l\'entreprise'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $fonction,
    '#weight' => -7,
    '#required' => FALSE,
  );
  $form['entreprise'] = array(
    '#title' => t('Entreprise du client'),
    '#type' => 'textfield',
    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $entreprise,
    '#weight' => -6,
    '#required' => TRUE,
  );
  $form['numeroDeVoie'] = array(
    '#title' => t('Numéro de voie'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $numeroDeVoie,
    '#weight' => -5,
    '#required' => FALSE,
    '#size' => 2,
  );
  $form['voie'] = array(
    '#title' => t('Voie'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $voie,
    '#weight' => -4,
    '#required' => FALSE,
  );
  $form['codePostal'] = array(
    '#title' => t('Code postal'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $codePostal,
    '#weight' => -3,
    '#required' => FALSE,
  );
  $form['ville'] = array(
    '#title' => t('Ville'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $ville,
    '#weight' => -2,
    '#required' => FALSE,
  );
  $form['mail'] = array(
    '#title' => t('Adresse email'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $mail,
    '#weight' => -1,
    '#required' => FALSE,
  );
  $form['tel'] = array(
    '#title' => t('Numéro de téléphone'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $tel,
    '#weight' => 0,
    '#required' => FALSE,
  );
  $form['commentaire'] = array(
    '#title' => t('Commentaire'),
    '#type' => 'textarea',
    '#description' => t('Quand joindre le client, nom de l\'assistant(e) etc ... '),
    '#default_value' => $commentaire,
    '#weight' => 1,
    '#required' => FALSE,
  );
  return $form;
}

function osa_etudiant_form($node, &$form_state) {
  // get the default values for our form fields
  if (!isset($node->nid)) {

    $idEtudiant = '';
    $nomEtudiant = '';
    $prenomEtudiant = '';
    $insee = '';
    $numeroDeVoie = 1;
    $voie = '';
    $codePostal = '';
    $ville = '';
    $mail = '';
    $tel = '';
    $dateInscription = 0;
    $dateCotisation = 0;
    // Boleans
    $ficheAdhesionRemise = 0;
    $ficheMembreActifRemise = 0;
    $paiementCotisationEffectue = 0;
    $certificatScolariteRemis = 0;
    $attestationSecuSocialeRemise = 0;
    $photocopieCarteIdentiteRemise = 0;
  }
  else {
    // query the db for info about our node
    $data = db_select('osa_etudiant', 'c')
        ->fields('c', array(
          'nid',
          'uid',
          'idEtudiant',
          'nomEtudiant',
          'prenomEtudiant',
          'insee',
          'numeroDeVoie',
          'voie',
          'codePostal',
          'ville',
          'mail',
          'tel',
          'dateInscription',
          'dateCotisation',
          'ficheAdhesionRemise',
          'ficheMembreActifRemise',
          'paiementCotisationEffectue',
          'certificatScolariteRemis',
          'attestationSecuSocialeRemise',
          'photocopieCarteIdentiteRemise',
        ))
        ->condition("c.nid", $node->nid)
        ->execute()
        ->fetchAssoc();

    $idEtudiant = $data['idEtudiant'];
    $nomEtudiant = $data['nomEtudiant'];
    $prenomEtudiant = $data['prenomEtudiant'];
    $insee = $data['insee'];
    $numeroDeVoie = $data['numeroDeVoie'];
    $voie = $data['voie'];
    $codePostal = $data['codePostal'];
    $ville = $data['ville'];
    $mail = $data['mail'];
    $tel = $data['tel'];

    $dateInscription['year'] = date('Y', $data['dateInscription']);
    $dateInscription['month'] = date('n', $data['dateInscription']);
    $dateInscription['day'] = date('d', $data['dateInscription']);

    $dateCotisation['year'] = date('Y', $data['dateCotisation']);
    $dateCotisation['month'] = date('n', $data['dateCotisation']);
    $dateCotisation['day'] = date('d', $data['dateCotisation']);

    $ficheAdhesionRemise = $data['ficheAdhesionRemise'];
    $ficheMembreActifRemise = $data['ficheMembreActifRemise'];
    $paiementCotisationEffectue = $data['paiementCotisationEffectue'];
    $certificatScolariteRemis = $data['certificatScolariteRemis'];
    $attestationSecuSocialeRemise = $data['attestationSecuSocialeRemise'];
    $photocopieCarteIdentiteRemise = $data['photocopieCarteIdentiteRemise'];
  }
  // build the form
  $form = array();

  $form['idEtudiant'] = array(
    '#title' => t('ID Étudiant'),
    '#type' => 'textfield',
    '#description' => t('Indiquez le numéro d\'étudiant HEI'),
    '#default_value' => $idEtudiant,
    '#weight' => -10,
    '#required' => TRUE,
  );
  $form['nomEtudiant'] = array(
    '#title' => t('Nom de famille'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $nomEtudiant,
    '#weight' => -9,
    '#required' => FALSE,
  );
  $form['prenomEtudiant'] = array(
    '#title' => t('Prénom'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $prenomEtudiant,
    '#weight' => -8,
    '#required' => FALSE,
  );
  $form['insee'] = array(
    '#title' => t('Numéro INSEE'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $insee,
    '#weight' => -7,
    '#required' => FALSE,
  );
  $form['numeroDeVoie'] = array(
    '#title' => t('Numéro de voie'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $numeroDeVoie,
    '#weight' => -5,
    '#required' => FALSE,
  );
  $form['voie'] = array(
    '#title' => t('Voie'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $voie,
    '#weight' => -4,
    '#required' => FALSE,
  );
  $form['codePostal'] = array(
    '#title' => t('Code postal'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $codePostal,
    '#weight' => -3,
    '#required' => FALSE,
  );
  $form['ville'] = array(
    '#title' => t('Ville'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $ville,
    '#weight' => -2,
    '#required' => FALSE,
  );
  $form['mail'] = array(
    '#title' => t('Adresse email'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $mail,
    '#weight' => -1,
    '#required' => FALSE,
  );
  $form['tel'] = array(
    '#title' => t('Numéro de téléphone'),
    '#type' => 'textfield',
//    '#description' => t('Indiquez l\' id du client'),
    '#default_value' => $tel,
    '#weight' => 0,
    '#required' => FALSE,
  );
  $form['dateInscription'] = array(
    '#title' => t('Date de l\'inscription'),
    '#type' => 'date',
    '#default_value' => $dateInscription,
    '#weight' => 1,
    '#required' => FALSE,
  );
  $form['dateCotisation'] = array(
    '#title' => t('Date de la cotisation'),
    '#type' => 'date',
    '#default_value' => $dateCotisation,
    '#weight' => 1,
    '#required' => FALSE,
  );
  $form['ficheAdhesionRemise'] = array(
    '#title' => t('Fiche adhésion remise'),
    '#type' => 'checkbox',
    '#default_value' => $ficheAdhesionRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['ficheMembreActifRemise'] = array(
    '#title' => t('Fiche membre actif remise'),
    '#type' => 'checkbox',
    '#default_value' => $ficheMembreActifRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['paiementCotisationEffectue'] = array(
    '#title' => t('Paiement de la cotisation effectué'),
    '#type' => 'checkbox',
    '#default_value' => $paiementCotisationEffectue,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
    '#rows' => 1,
  );
  $form['certificatScolariteRemis'] = array(
    '#title' => t('Certificat de scolarité remis'),
    '#type' => 'checkbox',
    '#default_value' => $certificatScolariteRemis,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['attestationSecuSocialeRemise'] = array(
    '#title' => t('Attestation sécurité sociale étudiante remise'),
    '#type' => 'checkbox',
    '#default_value' => $attestationSecuSocialeRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['photocopieCarteIdentiteRemise'] = array(
    '#title' => t('Photocopie carte d\'identité remise'),
    '#type' => 'checkbox',
    '#default_value' => $photocopieCarteIdentiteRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  return $form;
}

function osa_document_form($node, &$form_state) {
  // get the default values for our form fields

  $listeEtats = getAllEtats();
  $listeAffaires = getAllAffaires();
  $listeReferences = getAllReferences();

  if (!isset($node->nid)) {


    // On récupère l'argument numéro 4
    // Si on vient de la consultation de l'affaire, l'idAffaire sera
    // celui dont on vient

    $retrieveNidId = arg(3);
    
    if (isset($retrieveNidId)) {
      $retrieveIdAffaire = db_select('osa_affaire', 'd')
          ->fields('d', array(
            'nid',
            'idAffaire',))
          ->condition("d.nid", $retrieveNidId)
          ->execute()
          ->fetchAssoc();

      $idAffaire = $retrieveIdAffaire['idAffaire'];
      
      // Vérification que l'on ait bien récupéré un id 
      // avant de disable le champs
      
      if ($idAffaire != '') {
        $disabled = TRUE;
      }
            else {
        $disabled = FALSE;
      }
    }

    // Sinon, on set l'id à string vide, et on enable le champs
    else {
      $idAffaire = '';
      $disabled = FALSE;
    }


    $referenceDocument = '';
    $etatDocument = 0;
    $dateSignature = 0;
    $dateCommence = 0;
    $dateTermine = 0;
    $dateEnvoi = 0;
    $validationPresident = 0;
  }
  else {
    // On désactive la sélection de l'affaire
    $disabled = FALSE;
    // query the db for info about our node
    $data = db_select('osa_document', 'd')
        ->fields('d', array(
          'nid',
          'uid',
          'idAffaire',
          'referenceDocument',
          'etatDocument',
          'dateSignature',
          'dateCommence',
          'dateTermine',
          'dateEnvoi',
          'validationPresident',))
        ->condition("d.nid", $node->nid)
        ->execute()
        ->fetchAssoc();

//    $node->dateDebut['year'], $node->dateDebut['month'], $node->dateDebut['day']
//    string date ( string $format [, int $timestamp = time() ] )
//    
    $idAffaire = $data['idAffaire'];
    $referenceDocument = $data['referenceDocument'];
    $etatDocument = $data['etatDocument'];

    $dateSignature['year'] = date('Y', $data['dateSignature']);
    $dateSignature['month'] = date('n', $data['dateSignature']);
    $dateSignature['day'] = date('d', $data['dateSignature']);

    $dateCommence['year'] = date('Y', $data['dateCommence']);
    $dateCommence['month'] = date('n', $data['dateCommence']);
    $dateCommence['day'] = date('d', $data['dateCommence']);

    $dateTermine['year'] = date('Y', $data['dateTermine']);
    $dateTermine['month'] = date('n', $data['dateTermine']);
    $dateTermine['day'] = date('d', $data['dateTermine']);

    $dateEnvoi['year'] = date('Y', $data['dateEnvoi']);
    $dateEnvoi['month'] = date('n', $data['dateEnvoi']);
    $dateEnvoi['day'] = date('d', $data['dateEnvoi']);

    $validationPresident = $data['validationPresident'];
  }
  // build the form
  $form = array();

  $form['idAffaire'] = array(
    '#title' => t('Affaire concernée'),
    '#type' => 'select',
    '#default_value' => $idAffaire,
    '#options' => $listeAffaires,
    '#weight' => -9,
    '#required' => TRUE,
  );
  
  if ($disabled) {
    $form['idAffaire']['#disabled'] = TRUE;
  }
    else {
    $form['idAffaire']['#disabled'] = FALSE;
  }
  
  $form['referenceDocument'] = array(
    '#title' => t('Type de document'),
    '#type' => 'select',
    '#default_value' => $referenceDocument,
    '#options' => $listeReferences,
    '#weight' => -10,
    '#required' => TRUE,
  );
  $form['etatDocument'] = array(
    '#title' => t('État du document'),
    '#type' => 'select',
    '#default_value' => $etatDocument,
    '#options' => $listeEtats,
    '#weight' => -8,
    '#required' => TRUE,
  );
  $form['dateCommence'] = array(
    '#title' => t('Date de début'),
    '#type' => 'date',
    '#default_value' => $dateCommence,
    '#weight' => -7,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['dateTermine'] = array(
    '#title' => t('Date de fin'),
    '#type' => 'date',
    '#default_value' => $dateTermine,
    '#weight' => -6,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['dateSignature'] = array(
    '#title' => t('Date de la signature'),
    '#type' => 'date',
    '#default_value' => $dateSignature,
    '#weight' => -5,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['dateEnvoi'] = array(
    '#title' => t('Date de l\'envoi du document'),
    '#type' => 'date',
    '#default_value' => $dateEnvoi,
    '#weight' => -4,
    '#default_value' => 0,
    '#required' => FALSE,
  );
  $form['validationPresident'] = array(
    '#title' => t('Le président a-t-il validé le document avant envoi ?'),
    '#type' => 'checkbox',
    '#default_value' => $validationPresident,
    '#weight' => -3,
    '#return_value' => 1,
    '#default_value' => 0,
    '#required' => FALSE,
    '#rows' => 1,
  );


  return $form;
}