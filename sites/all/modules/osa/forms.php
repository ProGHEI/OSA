<?php

/**
 * Page-level module <strong>Outil OSA</strong>
 * 
 * @author Stanislas BOYET <stanislas@boyet.me>
 * 
 * @package osa.forms
 * 
 * @description
 * Ce fichier regroupe tous les formulaires utilisés dans la génération de
 * contenu par le biais des formulaires. Il est appelé par le .module lors de
 * la création de contenu.
 */

/**
 * Implement hook_form() pour la gestion des formulaires d'affaire
 * 
 * @param node $node Type de node que l'on va créer
 * @param form_state $form_state  Etat du formulaire
 * @return form Le formulaire généré pour le client
 */
function osa_affaire_form($node, &$form_state) {


  //On récupère les listes permettant de remplir les champs 'select'
  //(listes déroulantes)

  $listeEtudiants = getAllEtudiants();
  $listeUsers = getAllUsers();
  $listeStatuts = getAllStatuts();
  $listeClients = getAllClients();
  $listeDomaines = getAllDomaines();

  /*
   * Format de date que l'on veut tout au long des formulaire
   */

  $format = 'd-m-Y';


  // Provide a default date in the format YYYY-MM-DD HH:MM:SS.
  $date = '01-01-2013';


  // Si le node n'existe pas, on prend des valeurs par défaut.
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
    $dateDebut = $date;
    $dateFin = $date;
    $datePremierContact = $date;
    $origine = '';
    $domaineAffaire = '';
    $active = 'Sélectionnez';
  }
  else {

    // Si le node existe, on rappatrie les informations
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
    $dateDebut = $data['dateDebut'];
    $dateFin = $data['dateFin'];
    $datePremierContact = $data['datePremierContact'];

    $origine = $data['origine'];
  }

  // On construit le formulaire avec les informations reçues
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
    '#default_value' => $sommeFrais,
    '#weight' => -2,
    '#size' => 4,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['nbJEH'] = array(
    '#title' => t('Nombre de JEH'),
    '#type' => 'textfield',
    '#default_value' => $nbJEH,
    '#weight' => -8,
    '#size' => 4,
    '#required' => TRUE,
  );
  $form['prixJEH'] = array(
    '#title' => t('Prix fixé d\'un seul JEH'),
    '#type' => 'textfield',
    '#default_value' => $prixJEH,
    '#weight' => -7,
    '#size' => 4,
    '#field_suffix' => '€',
    '#required' => TRUE,
  );
  $form['pourcentPrevi'] = array(
    '#title' => t('Pourcentage prévisionnel reversé à l\'étudiant'),
    '#type' => 'textfield',
    '#default_value' => $pourcentPrevi,
    '#weight' => -1,
    '#size' => 3,
    '#field_suffix' => '%',
    '#required' => FALSE,
  );
  $form['sommeHTPrevi'] = array(
    '#title' => t('Somme hors taxes prévisionnelle reversée à l\'étudiant'),
    '#type' => 'textfield',
    '#default_value' => $sommeHTPrevi,
    '#weight' => -0,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['accompte'] = array(
    '#title' => t('Accompte déjà versé par l\'entreprise'),
    '#type' => 'textfield',
    '#default_value' => $accompte,
    '#weight' => 1,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );
  $form['soldeFinal'] = array(
    '#title' => t('Solde final'),
    '#type' => 'textfield',
    '#default_value' => $soldeFinal,
    '#weight' => 2,
    '#size' => 5,
    '#field_suffix' => '€',
    '#required' => FALSE,
  );

  $form['dateDebut'] = array(
    '#type' => 'date_select',
    '#title' => t('Date de début de l\'affaire'),
    '#default_value' => $dateDebut,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
  );

  $form['dateFin'] = array(
    '#type' => 'date_select',
    '#title' => t('Date de fin de l\'affaire'),
    '#default_value' => $dateFin,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
  );

  $form['datePremierContact'] = array(
    '#type' => 'date_select',
    '#title' => t('Date de premier contact avec le client'),
    '#default_value' => $datePremierContact,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
  );

  $form['origine'] = array(
    '#title' => t('Origine de l\'affaire'),
    '#type' => 'textarea',
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

  return $form;
}

/**
 * Implement hook_form() pour la gestion des formulaires de clients
 * 
 * @param node $node Type de node que l'on va créer
 * @param form_state $form_state  Etat du formulaire
 * @return form Le formulaire généré pour le client
 */
function osa_client_form($node, &$form_state) {

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
    '#default_value' => $nomClient,
    '#weight' => -9,
    '#required' => FALSE,
  );
  $form['prenomClient'] = array(
    '#title' => t('Prénom'),
    '#type' => 'textfield',
    '#default_value' => $prenomClient,
    '#weight' => -8,
    '#required' => FALSE,
  );
  $form['fonction'] = array(
    '#title' => t('Fonction au sein de l\'entreprise'),
    '#type' => 'textfield',
    '#default_value' => $fonction,
    '#weight' => -7,
    '#required' => FALSE,
  );
  $form['entreprise'] = array(
    '#title' => t('Entreprise du client'),
    '#type' => 'textfield',
    '#default_value' => $entreprise,
    '#weight' => -6,
    '#required' => TRUE,
  );
  $form['numeroDeVoie'] = array(
    '#title' => t('Numéro de voie'),
    '#type' => 'textfield',
    '#default_value' => $numeroDeVoie,
    '#weight' => -5,
    '#required' => FALSE,
    '#size' => 2,
  );
  $form['voie'] = array(
    '#title' => t('Voie'),
    '#type' => 'textfield',
    '#default_value' => $voie,
    '#weight' => -4,
    '#required' => FALSE,
  );
  $form['codePostal'] = array(
    '#title' => t('Code postal'),
    '#type' => 'textfield',
    '#default_value' => $codePostal,
    '#weight' => -3,
    '#required' => FALSE,
  );
  $form['ville'] = array(
    '#title' => t('Ville'),
    '#type' => 'textfield',
    '#default_value' => $ville,
    '#weight' => -2,
    '#required' => FALSE,
  );
  $form['mail'] = array(
    '#title' => t('Adresse email'),
    '#type' => 'textfield',
    '#default_value' => $mail,
    '#weight' => -1,
    '#required' => FALSE,
  );
  $form['tel'] = array(
    '#title' => t('Numéro de téléphone'),
    '#type' => 'textfield',
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

/**
 * Implement hook_form() pour la gestion des formulaires d'étudiants
 * 
 * @param node $node Type de node que l'on va créer
 * @param form_state $form_state  Etat du formulaire
 * @return form Le formulaire généré pour l'étudiant
 */
function osa_etudiant_form($node, &$form_state) {

  /*
   * Format de date que l'on veut tout au long des formulaire
   */

  $format = 'd-m-Y';


  // Provide a default date in the format YYYY-MM-DD HH:MM:SS.
  $date = '01-01-2013';

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

    $dateInscription = $date;
    $dateCotisation = $date;
    // Boleans
    $ficheAdhesionRemise = 0;
    $ficheMembreActifRemise = 0;
    $paiementCotisationEffectue = 0;
    $certificatScolariteRemis = 0;
    $attestationSecuSocialeRemise = 0;
    $photocopieCarteIdentiteRemise = 0;
  }
  else {
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
    $dateInscription = $data['dateInscription'];
    $dateCotisation = $data['dateCotisation'];

    $ficheAdhesionRemise = $data['ficheAdhesionRemise'];
    $ficheMembreActifRemise = $data['ficheMembreActifRemise'];
    $paiementCotisationEffectue = $data['paiementCotisationEffectue'];
    $certificatScolariteRemis = $data['certificatScolariteRemis'];
    $attestationSecuSocialeRemise = $data['attestationSecuSocialeRemise'];
    $photocopieCarteIdentiteRemise = $data['photocopieCarteIdentiteRemise'];
  }

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
    '#default_value' => $nomEtudiant,
    '#weight' => -9,
    '#required' => FALSE,
  );
  $form['prenomEtudiant'] = array(
    '#title' => t('Prénom'),
    '#type' => 'textfield',
    '#default_value' => $prenomEtudiant,
    '#weight' => -8,
    '#required' => FALSE,
  );
  $form['insee'] = array(
    '#title' => t('Numéro INSEE'),
    '#type' => 'textfield',
    '#default_value' => $insee,
    '#weight' => -7,
    '#required' => FALSE,
  );
  $form['numeroDeVoie'] = array(
    '#title' => t('Numéro de voie'),
    '#type' => 'textfield',
    '#default_value' => $numeroDeVoie,
    '#weight' => -5,
    '#required' => FALSE,
  );
  $form['voie'] = array(
    '#title' => t('Voie'),
    '#type' => 'textfield',
    '#default_value' => $voie,
    '#weight' => -4,
    '#required' => FALSE,
  );
  $form['codePostal'] = array(
    '#title' => t('Code postal'),
    '#type' => 'textfield',
    '#default_value' => $codePostal,
    '#weight' => -3,
    '#required' => FALSE,
  );
  $form['ville'] = array(
    '#title' => t('Ville'),
    '#type' => 'textfield',
    '#default_value' => $ville,
    '#weight' => -2,
    '#required' => FALSE,
  );
  $form['mail'] = array(
    '#title' => t('Adresse email'),
    '#type' => 'textfield',
    '#default_value' => $mail,
    '#weight' => -1,
    '#required' => FALSE,
  );
  $form['tel'] = array(
    '#title' => t('Numéro de téléphone'),
    '#type' => 'textfield',
    '#default_value' => $tel,
    '#weight' => 0,
    '#required' => FALSE,
  );

  $form['dateInscription'] = array(
    '#type' => 'date_select',
    '#title' => t('Date d\'inscription'),
    '#default_value' => $dateInscription,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
  );

  $form['dateCotisation'] = array(
    '#type' => 'date_select',
    '#title' => t('Date de cotisation'),
    '#default_value' => $dateCotisation,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
  );

  $form['ficheAdhesionRemise'] = array(
    '#title' => t('Fiche adhésion remise'),
    '#type' => 'checkbox',
    '#default_value' => $ficheAdhesionRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#required' => FALSE,
  );
  $form['ficheMembreActifRemise'] = array(
    '#title' => t('Fiche membre actif remise'),
    '#type' => 'checkbox',
    '#default_value' => $ficheMembreActifRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#required' => FALSE,
  );
  $form['paiementCotisationEffectue'] = array(
    '#title' => t('Paiement de la cotisation effectué'),
    '#type' => 'checkbox',
    '#default_value' => $paiementCotisationEffectue,
    '#weight' => 1,
    '#return_value' => 1,
    '#required' => FALSE,
    '#rows' => 1,
  );
  $form['certificatScolariteRemis'] = array(
    '#title' => t('Certificat de scolarité remis'),
    '#type' => 'checkbox',
    '#default_value' => $certificatScolariteRemis,
    '#weight' => 1,
    '#return_value' => 1,
    '#required' => FALSE,
  );
  $form['attestationSecuSocialeRemise'] = array(
    '#title' => t('Attestation sécurité sociale étudiante remise'),
    '#type' => 'checkbox',
    '#default_value' => $attestationSecuSocialeRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#required' => FALSE,
  );
  $form['photocopieCarteIdentiteRemise'] = array(
    '#title' => t('Photocopie carte d\'identité remise'),
    '#type' => 'checkbox',
    '#default_value' => $photocopieCarteIdentiteRemise,
    '#weight' => 1,
    '#return_value' => 1,
    '#required' => FALSE,
  );

  return $form;
}

/**
 * Implement hook_form() pour la gestion des formulaires de documents
 * 
 * @param node $node Type de node que l'on va créer
 * @param form_state $form_state  Etat du formulaire
 * @return form Le formulaire généré pour le document
 */
function osa_document_form($node, &$form_state) {


  /*
   * Format de date que l'on veut tout au long des formulaire
   */

  $format = 'd-m-Y';


  // Provide a default date in the format YYYY-MM-DD HH:MM:SS.
  $date = '01-04-2013';

  $listeEtats = getAllEtats();
  $listeAffaires = getAllAffaires();
  $listeReferences = getAllReferences();

  if (!isset($node->nid)) {

    // On récupère l'argument numéro 3
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
      // avant de désactiver le champs

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
    $dateSignature = $date;
    $dateCommence = $date;
    $dateTermine = $date;
    $dateEnvoi = $date;
    $validationPresident = 0;
    
  }
  else {

    // On désactive la sélection de l'affaire
    $disabled = FALSE;

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

    $idAffaire = $data['idAffaire'];
    $referenceDocument = $data['referenceDocument'];
    $etatDocument = $data['etatDocument'];
    $dateSignature = $data['dateSignature'];
    $dateCommence = $data['dateCommence'];
    $dateTermine = $data['dateTermine'];
    $dateEnvoi = $data['dateEnvoi'];

    $validationPresident = $data['validationPresident'];
  }

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
    '#type' => 'date_select',
    '#default_value' => $dateCommence,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
    '#weight' => -7,
    '#required' => FALSE,
  );
  $form['dateTermine'] = array(
    '#title' => t('Date de fin'),
    '#type' => 'date_select',
    '#default_value' => $dateTermine,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
    '#weight' => -6,
    '#required' => FALSE,
  );
  $form['dateSignature'] = array(
    '#title' => t('Date de la signature'),
    '#type' => 'date_select',
    '#default_value' => $dateSignature,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
    '#weight' => -5,
    '#required' => FALSE,
  );
  $form['dateEnvoi'] = array(
    '#title' => t('Date de l\'envoi du document'),
    '#type' => 'date_select',
    '#default_value' => $dateEnvoi,
    '#date_format' => $format,
    '#date_label_position' => 'within',
    '#date_year_range' => '-3:+3',
    '#weight' => -4,
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