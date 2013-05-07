<?php

function formatDateFR($timestamp) {
  $variable = array();
  $weekday_fr = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
  $month_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août",
    "septembre", "octobre", "novembre", "décembre");
  list($variable[0], $variable[1], $variable[2], $variable[3]) = explode('/', date("w/d/n/Y", $timestamp));

  // Passage d'un numéro à la correspondance en toute lettres.
  $variable[0] = $weekday_fr[$variable[0]];
  $variable[2] = $month_fr[$variable[2]];

  return $variable;
}

function getAllClients() {

//Query DB for Rows
  $query = db_select('osa_client');
  $query->fields('osa_client', array('idClient', 'nomClient', 'entreprise'));
  $query->orderBy('nomClient', 'ASC');
  $results = $query->execute();

  //define rows
  $options = array();
  $options[''] = array('' => 'Sélectionnez');
  if (!is_null($results))
    foreach ($results as $result) {
      $options[$result->entreprise] = array(
        $result->idClient => $result->nomClient,
      );
    }
  return $options;
}

function getAllEtudiants() {

//Query DB for Rows
  $query = db_select('osa_etudiant');
  $query->fields('osa_etudiant', array('idEtudiant', 'nomEtudiant', 'prenomEtudiant'));
  $query->orderBy('idEtudiant', 'ASC');
  $results = $query->execute();

  //define rows
  $options = array();
  $options[''] = array('' => 'Sélectionnez');
  if (!is_null($results))
    foreach ($results as $result) {
      $options[$result->idEtudiant] = array(
        $result->idEtudiant => $result->prenomEtudiant . ' ' . $result->nomEtudiant,
      );
    }
  return $options;
}

function getAllUsers() {

//Query DB for Rows
  $query = db_select('users');
  $query->fields('users', array('uid', 'name'));
  $query->orderBy('name', 'ASC');
  $results = $query->execute();

  //define rows
  $options = array();
  $options[''] = array('' => 'Sélectionnez');
  if (!is_null($results))
    foreach ($results as $result) {
      if ($result->name != 'admin') {
        $options[$result->uid] = array(
          $result->uid => $result->name,
        );
      }
    }
  return $options;
}

function getAllAffaires() {

//Query DB for Rows
  $query = db_select('osa_affaire');
  $query->fields('osa_affaire', array('idAffaire', 'titreAffaire'));
  $query->orderBy('idAffaire', 'ASC');
  $results = $query->execute();

  //define rows
  $options = array();
  $options[''] = array('' => 'Sélectionnez');
  if (!is_null($results))
    foreach ($results as $result) {
      $options[$result->idAffaire] = array(
        $result->idAffaire => $result->titreAffaire,
      );
    }
  return $options;
}

function getAllStatuts() {

  $liste = array(
    'negociation' => 'En Négociation',
    'enCours' => 'En Cours',
    'commencee' => 'Commencée',
    'terminee' => 'Terminée',
  );

  return $liste;
}

function getVerboseStatut($statut) {
  if ($statut == 'negociation') {
    return 'En Négociation';
  }
  elseif ($statut == 'enCours') {
    return 'En Cours';
  }
  elseif ($statut == 'commencee') {
    return 'Commencée';
  }
  elseif ($statut == 'terminee') {
    return 'Terminée';
  }
  else {
    return 'Statut non défini';
  }
}

function getAllEtats() {

  $liste = array(
    'commence' => 'Commencé',
    'termine' => 'Terminé',
    'valide' => 'Validé',
    'envoye' => 'Envoyé',
  );

  return $liste;
}

function getVerboseEtat($etat) {
  if ($etat == 'commence') {
    return 'Commencé';
  }
  elseif ($etat == 'termine') {
    return 'Terminé';
  }
  elseif ($etat == 'valide') {
    return 'Validé';
  }
  elseif ($etat == 'envoye') {
    return 'Envoyé';
  }
  else {
    return 'Statut non défini';
  }
}

function getAllReferences() {

  $liste = array(
    'avantProjet' => 'Avant Projet',
    'propositionCommerciale' => 'Proposition Commerciale',
    'procesVerbalRecette' => 'Procès Verbal de Recette',
    'conventionClient' => 'Convention Client',
    'conventionEtudiant' => 'Convention Étudiant',
    'avenantRecapMission' => 'Avenant Récapitulatif Mission',
    'avenantConventionClient' => 'Avenant Convention Client',
  );

  return $liste;
}

function getVerboseReference($reference) {
  if ($reference == 'avantProjet') {
    return 'Avant Projet';
  }
  elseif ($reference == 'propositionCommerciale') {
    return 'Proposition Commerciale';
  }
  elseif ($reference == 'procesVerbalRecette') {
    return 'PV Recette';
  }
  elseif ($reference == 'conventionClient') {
    return 'Convention Client';
  }
  elseif ($reference == 'conventionEtudiant') {
    return 'Convention Étudiant';
  }
  elseif ($reference == 'avenantRecapMission') {
    return 'Avenant Récap. Mission';
  }
  elseif ($reference == 'avenantConventionClient') {
    return 'Avenant Conv. Client';
  }
  else {
    return 'Statut non défini';
  }
}

function getAllDomaines() {

  $liste = array(
    'informatique' => 'Informatique',
    'general' => 'Ingénierie Générale',
  );

  return $liste;
}

function getVerboseDomaine($etat) {
  if ($etat == 'informatique') {
    return 'Informatique';
  }
  elseif ($etat == 'general') {
    return 'Ingénierie Générale';
  }
  else {
    return 'Domaine non défini';
  }
}

function objectToArray($d) {
  if (is_object($d)) {
    // Gets the properties of the given object
    // with get_object_vars function
    $d = get_object_vars($d);
  }

  if (is_array($d)) {
    /*
     * Return array converted to object
     * Using __FUNCTION__ (Magic constant)
     * for recursive call
     */
    return array_map(__FUNCTION__, $d);
  }
  else {
    // Return array
    return $d;
  }
}