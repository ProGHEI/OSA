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

  //check des documents de l'étudiant pour affichage des messages d'erreur
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
          <h3 class="titre-affaire"><?php print $content['affaire']['titreAffaire'] ?> - <?php print $content['affaire']['idAffaire'] ?>
            <br />
          </h3>
          <h3><small class="subtitle-affaire">Une affaire du domaine <?php print $content['affaire']['domaineAffaire'] ?></small></h3>
        </div>
        <div class="row-fluid">
          <div class="span6">
            <p><h3>Informations</h3></p>
            <table class="table table-bordered table-hover table-condensed">
              <thead>
                <tr>
                  <th colspan="3">Dates</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1er contact</td>
                  <td colspan="2">
                    <?php
                    print $content['affaire']['dates']['premierContact']['1'] . ' ' .
                        $content['affaire']['dates']['premierContact']['2'] . ' ' .
                        $content['affaire']['dates']['premierContact']['3']
                    ?></td>
                </tr>
                <tr>
                  <td>Début</td>
                  <td colspan="2">
                    <?php
                    print $content['affaire']['dates']['debut']['1'] . ' ' .
                        $content['affaire']['dates']['debut']['2'] . ' ' .
                        $content['affaire']['dates']['debut']['3']
                    ?></td>
                </tr>
                <tr>
                  <td>Fin</td>
                  <td colspan="2">
                    <?php
                    print $content['affaire']['dates']['fin']['1'] . ' ' .
                        $content['affaire']['dates']['fin']['2'] . ' ' .
                        $content['affaire']['dates']['fin']['3']
                    ?></td>
                </tr>

              </tbody>
            </table>

            <table class="table table-bordered table-hover table-condensed">
              <thead>
                <tr>
                  <th>Chef de projet</th>
                  <th>Réalisateur</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <?php print_r($content['affaire']['CDP']['name']) ?>
                  </td>
                  <td>
                    <?php print_r($content['etudiant']['nomEtudiant'] . ' ' . $content['etudiant']['prenomEtudiant']) ?>
                  </td>
                </tr>

              </tbody>
            </table>



          </div>
          <div class="span6">
            <p><h3>Documents</h3></p>

            <?php
            if ($documentManquant) {
              ?> 
              <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Document manquant dans le dossier de l'étudiant !
              </div>
              <?php
            }
            ?>

            <table class="table table-bordered table-hover recapAffaire">

              <tbody>
                <?php foreach ($content['documents'] as $courantDocument) { ?>

                  <tr class="<?php
                if ($courantDocument['etatDocument'] == 'envoye') {
                  $etat = 'success';
                  echo $etat;
                }
                elseif (($courantDocument['etatDocument'] == 'termine') || ($courantDocument['etatDocument'] == 'valide')) {
                  $etat = 'warning';
                  echo $etat;
                }
                elseif ($courantDocument['etatDocument'] == 'commence') {
                  $etat = 'info';
                  echo $etat;
                }
                  ?>">

                    <td class="strong"> <!-- Référence document --> 
                      <?php print getVerboseReference($courantDocument['referenceDocument']) ?>
                    </td>
                    <td> <!-- État du document --> 
                      <?php print getVerboseEtat($courantDocument['etatDocument']) ?>
                    </td>
                    <td> <!-- Bouton pour modifier le document --> 
                      <a class="btn btn-small btn-<?php echo $etat ?>" href="<?php print $courantDocument['nid'] ?>/edit">Modifier</a>
                    </td>
                  </tr>

                 <?php }
                ?>



              </tbody>
            </table>
            <a class="btn btn-small" href="add/osa-document/<?php print $content['affaire']['nid'] ?>">Ajouter un document</a>
          </div>

        </div>
      </div>


    </div>
  </div>
  <hr> <br />

  <div class="accordion span12" id="accordion2">
    <div class="accordion-group span6">
      <div class="accordion-heading">
        <a class="accordion-toggle inline" data-toggle="collapse" href="#etudiant">
          <strong>Élève réalisateur</strong> - <?php print_r($content['etudiant']['nomEtudiant'] . ' ' . $content['etudiant']['prenomEtudiant']) ?>
        </a>
      </div>
      <div id="etudiant" class="accordion-body collapse">
        <div class="accordion-inner">


          <address>
            <strong><?php
                print($content['etudiant']['nomEtudiant']
                    . ' ' . $content['etudiant']['prenomEtudiant']
                    . ' - ' . $content['etudiant']['idEtudiant'])
                ?></strong> <br>
            <br />

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

            <div class="documents-etudiants">
              <ul>
                <?php
                if (true) {
                  
                }
                ?>
              </ul>
            </div>


          </address>


          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Tous les documents étudiants sont à jour
          </div>
          <ul>
            <?php if ($content['etudiant']['ficheAdhesionRemise'] == 0) { ?>

              <div class="alert alert-error">
                Fiche de membre manquante
              </div>
              <?php
            }
            if ($content['etudiant']['ficheMembreActifRemise'] == 0) {
              ?>

              <div class="alert alert-error">
                Fiche membre actif manquant
              </div>
              <?php
            }

            if ($content['etudiant']['paiementCotisationEffectue'] == 0) {
              ?>

              <div class="alert alert-error">
                Paiement de la cotisation non effectué
              </div>
              <?php
            }
            if ($content['etudiant']['certificatScolariteRemis'] == 0) {
              ?>

              <div class="alert alert-error">
                Certificat de scolarité manquant
              </div>
              <?php
            }
            if ($content['etudiant']['attestationSecuSocialeRemise'] == 0) {
              ?>

              <div class="alert alert-error">
                Attestation de sécurité sociale manquante
              </div>
              <?php
            }
            if ($content['etudiant']['photocopieCarteIdentiteRemise'] == 0) {
              ?>

              <div class="alert alert-error">
                Photocopie de la carte d'identité manquante
              </div>
              <?php
            }
            ?>
          </ul>



          <a class="btn btn-small inline" href="<?php print $content['etudiant']['nid'] ?>/edit">Modifier fiche étudiant</a>
  <!--        <pre>
          <?php print_r($content['etudiant']) ?>
          </pre>-->

        </div>
      </div>
    </div>
    <div class="accordion-group span6">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse"href="#client">
          <strong>Client</strong> - <?php print($content['client']['nomClient'] . ' ' . $content['client']['prenomClient'] . ' - ' . $content['client']['entreprise']) ?>
        </a>
      </div>
      <div id="client" class="accordion-body collapse">
        <div class="accordion-inner">

          <address>
            <strong>
              <?php
              print( 'Entreprise  ' . $content['client']['entreprise']
                  . ' <br /> ' . $content['client']['fonction']
                  . ' ' . $content['client']['nomClient']
                  . ' ' . $content['client']['prenomClient']
                  . ' - ' . $content['client']['idClient'])
              ?></strong> <br>
            <br />

            <i class="icon-home icon-adresse"> </i>
            <div class="inline adresse-etudiant">
              <?php
              if (isset($content['client']['numeroDeVoie'])
                  && ($content['client']['voie'] != '')
                  && ($content['client']['codePostal'] != '')
                  && ($content['client']['ville'] != '')) {


                print(
                    $content['client']['numeroDeVoie'] . ' ' .
                    $content['client']['voie']);
                ?>
                <br />
                <?php
                print (
                    $content['client']['codePostal'] . ' ' .
                    $content['client']['ville']
                );
              }
              else {
                print ('<br />Adresse incomplète<br />');
              }
              ?>
              <br />
            </div>

            <i class="icon-envelope icon-adresse"> </i>
            <div class="inline adresse-etudiant">
              <?php
              if (($content['client']['mail'] != '')
                  && ($content['client']['tel'] != '')) {


                print(
                    $content['client']['mail'] . '<br />' .
                    $content['client']['tel']);
              }
              else {
                print ('Numéro de téléphone ou adresse mail manquante<br /><br />');
              }
              ?>
            </div>

            <div class="documents-etudiants">
              <ul>
                <?php
                if (true) {
                  
                }
                ?>
              </ul>
            </div>


          </address>

          <a class="btn btn-small inline" href="<?php print $content['client']['nid'] ?>/edit">Modifier fiche client</a>
  <!--        <pre>
          <?php print_r($content['client']) ?>
          </pre>-->

        </div>
      </div>
    </div>
  </div>



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
<!--
<pre>
<?php print_r($content) ?>
</pre>-->