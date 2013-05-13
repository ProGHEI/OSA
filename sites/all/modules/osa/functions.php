<?php

/**
 * Page-level module <strong>Outil OSA</strong>
 * 
 * @author Stanislas BOYET <stanislas@boyet.me>
 * 
 * @package osa.functions
 * 
 * @description 
 * Ce fichier sert à rappatrier toutes les fonctions utilisées dans le .module
 * et qui ne font pas partie des API propres à Drupal
 */

/**
 * Implements getAllClients()
 * @return array key=>valeur avec en key les id, en valeur les nom
 */
function getAllClients() {

//On récupère les lignes en BDD
  $query = db_select('osa_client');
  $query->fields('osa_client', array('idClient', 'nomClient', 'entreprise'));
  $query->orderBy('nomClient', 'ASC');
  $results = $query->execute();

  //Donc définis les lignes
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

/**
 * Implements getAllEtudiants()
 * @return array key=>valeur avec en key les id, en valeur les nom - prénom
 */
function getAllEtudiants() {

  $query = db_select('osa_etudiant');
  $query->fields('osa_etudiant', array('idEtudiant', 'nomEtudiant', 'prenomEtudiant'));
  $query->orderBy('idEtudiant', 'ASC');
  $results = $query->execute();

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

/**
 * Implements getAllUsers()
 * @return array key=>valeur avec en key les id, en valeur les nom
 */
function getAllUsers() {

  $query = db_select('users');
  $query->fields('users', array('uid', 'name'));
  $query->orderBy('name', 'ASC');
  $results = $query->execute();

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

/**
 * Implements getAllAffaires()
 * @return array key=>valeur avec en key les id, en valeur titres
 */
function getAllAffaires() {

  $query = db_select('osa_affaire');
  $query->fields('osa_affaire', array('idAffaire', 'titreAffaire'));
  $query->orderBy('idAffaire', 'ASC');
  $results = $query->execute();

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

/**
 * Implements getAllStatus()
 * @return array key=>valeur avec en key les statuts de BDD
 */
function getAllStatuts() {

  $liste = array(
    'negociation' => 'En Négociation',
    'enCours' => 'En Cours',
    'commencee' => 'Commencée',
    'terminee' => 'Terminée',
  );

  return $liste;
}

/**
 * Implements getVerboseStatut($statut)
 * @param string $statut le statut à traduire
 * @return string le statut correctement orthographié
 */
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

/**
 * Implements getAllEtats()
 * @return array key=>valeur avec en key les statuts de BDD
 */
function getAllEtats() {

  $liste = array(
    'commence' => 'Commencé',
    'termine' => 'Terminé',
    'valide' => 'Validé',
    'envoye' => 'Envoyé',
  );

  return $liste;
}

/**
 * Implements getVerboseEtats($etat)
 * @param string $etat l'état à traduire
 * @return string l'état correctement orthographié
 */
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

/**
 * Implements getAllReferences()
 * @return array key=>valeur avec en key les statuts de BDD
 */
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

/**
 * Implements getVerboseReference($reference)
 * @param string $reference la référence à traduire
 * @return string l'état correctement orthographié
 */
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

/**
 * Implements getAllDomaines()
 * @return array key=>valeur avec en key les statuts de BDD
 */
function getAllDomaines() {

  $liste = array(
    'informatique' => 'Informatique',
    'general' => 'Ingénierie Générale',
  );

  return $liste;
}

/**
 * Implements getVerboseDomaine($domaine)
 * @param string $domaine le domaine à traduire
 * @return string l'état correctement orthographié
 */
function getVerboseDomaine($domaine) {
  if ($domaine == 'informatique') {
    return 'Informatique';
  }
  elseif ($domaine == 'general') {
    return 'Ingénierie Générale';
  }
  else {
    return 'Domaine non défini';
  }
}

/**
 * Implements objecToArray($object)
 * @param object $object Objet à parser en Array()
 * @return array array de l'objet parsé
 */
function objectToArray($object) {
  if (is_object($object)) {
    // Gets the properties of the given object
    // with get_object_vars function
    $object = get_object_vars($object);
  }

  if (is_array($object)) {
    /*
     * Return array converted to object
     * Using __FUNCTION__ (Magic constant)
     * for recursive call
     */
    return array_map(__FUNCTION__, $object);
  }
  else {
    // Return array
    return $object;
  }
}

/**
 * Implements getVerboseDate($date)
 * @param string $date au format 'YYYY-mm-dd'
 * @return array la date en toute lettre et en chiffres
 */

function getVerboseDate($date) {

  $listeMois = date_month_names();

  $nbJour = substr($date, 8, 2);
  $jour = date_day_of_week_name($date, FALSE);
  $nbMois = substr($date, 5, 2);
  $mois = $listeMois[intval($nbMois)];
  $annee = substr($date, 0, 4);

  $dateToutesLettres = array(
    'nbJour' => $nbJour,
    'jour' => $jour,
    'nbMois' => $nbMois,
    'mois' => $mois,
    'annee' => $annee,
  );

  return $dateToutesLettres;
}