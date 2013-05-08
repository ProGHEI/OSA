<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && $title): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php if ($display_submitted): ?>

    <?php endif; ?>
  </header>

  <?php
  // Hide comments, tags, and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  hide($content['field_tags']);

  $documentManquant = FALSE;
  foreach ($content['etudiant']['documents'] as $value) {

    if ($value == 0) {
      $documentManquant = TRUE;
    }
  }
  //print render($content['idAffaire']);
  //print render($content);
  ?>


  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">

        <div class="hero-unit-tiny">
          <h3 class="titre-affaire">Étudiant réalisateur : <?php print $content['etudiant']['nomEtudiant'] ?> 
            <?php print $content['etudiant']['prenomEtudiant'] ?>
            <br />
          </h3>
          <h3>
            <small class="subtitle-affaire"> id étudiant : <?php print $content['etudiant']['idEtudiant'] ?>
            </small>
          </h3>
        </div>

        <div class="span5">
          <h4>Informations</h4>

          <i class="icon-home icon-adresse"> </i>
          <div class="inline adresse-etudiant">
            <?php
            if (isset($content['etudiant']['numeroDeVoie'])
                && isset($content['etudiant']['voie'])
                && isset($content['etudiant']['codePostal'])
                && isset($content['etudiant']['ville'])) {


              print(
                  $content['etudiant']['numeroDeVoie'] . ' ' .
                  $content['etudiant']['voie']);
              ?>
              <br />
              <?php
              print (
                  $content['etudiant']['codePostal'] . ' ' .
                  $content['etudiant']['ville']
              );
            }
            else {
              print ('Adresse incomplète');
            }
            ?>
            <br />
          </div>

          <i class="icon-envelope icon-adresse"> </i>
          <div class="inline adresse-etudiant">
            <?php
            if (isset($content['etudiant']['mail'])
                && isset($content['etudiant']['tel'])) {


              print(
                  $content['etudiant']['mail'] . '<br />' .
                  $content['etudiant']['tel']);
            }
            else {
              print ('Numéro de téléphone ou adresse mail manquante');
            }
            ?>
          </div>

          <br />
          <br />
          <a class="btn btn-small inline" href="<?php print url('node/' . $content['etudiant']['nid']) ?>/edit">Modifier fiche étudiant</a>

        </div>
        <div class="span5">

          <h4>Documents</h4>

          <?php if (!$documentManquant) { ?>

            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Tous les documents étudiants sont à jour
            </div>

          <?php }
          ?>
          <?php if ($content['etudiant']['ficheAdhesionRemise'] == 0) { ?>

            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Fiche de membre manquante
            </div>
            <?php
          }
          if ($content['etudiant']['ficheMembreActifRemise'] == 0) {
            ?>

            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Fiche membre actif manquant
            </div>
            <?php
          }

          if ($content['etudiant']['paiementCotisationEffectue'] == 0) {
            ?>

            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Paiement de la cotisation non effectué
            </div>
            <?php
          }
          if ($content['etudiant']['certificatScolariteRemis'] == 0) {
            ?>

            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Certificat de scolarité manquant
            </div>
            <?php
          }
          if ($content['etudiant']['attestationSecuSocialeRemise'] == 0) {
            ?>

            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Attestation de sécurité sociale manquante
            </div>
            <?php
          }
          if ($content['etudiant']['photocopieCarteIdentiteRemise'] == 0) {
            ?>

            <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">×</button>
              Photocopie de la carte d'identité manquante
            </div>
            <?php
          }
          ?>
        </div>

      </div>

      <br />
      <br />

      <div class="span12 affaires-realisees">
        <h4>Affaires réalisées</h4>
        <table class="table table-bordered table-hover recapAffaire">
          <thead>
            <tr>
              <th>id de l'affaire</th>
              <th>Titre</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($content['etudiant']['affaires'] as $affaire) { ?>
              <tr class="<?php
            if ($affaire['statutAffaire'] == 'terminee') {
              $etat = 'success';
              echo $etat;
            }
            elseif (($affaire['statutAffaire'] == 'enCours') || ($affaire['statutAffaire'] == 'commencee')) {
              $etat = 'warning';
              echo $etat;
            }
            elseif ($affaire['statutAffaire'] == 'negociation') {
              $etat = 'info';
              echo $etat;
            }
              ?>">
                <td><?php print $affaire['idAffaire'] ?></td>
                <td><?php print $affaire['titreAffaire'] ?></td>
                <td><?php print $affaire['verboseStatutAffaire'] ?></td>
                <td class="table-link"><a class="btn btn-small inline btn-<?php echo $etat ?> " href="<?php print url('node/' . $affaire['nid']) ?>">Aller à l'affaire</a></td>
              </tr>
            <?php }
            ?>


          </tbody>
        </table>
      </div>


    </div>
  </div>
  <hr> <br />



  <span class="submitted">
    <?php print $user_picture; ?>
    <?php print $submitted; ?>
  </span>



  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php /* print render($content['comments']); */ ?>

</article> <!-- /.node -->

<!--<pre>
  <?php print_r($content['etudiant']) ?>
</pre>-->