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

  //print render($content['idAffaire']);
  //print render($content);
  ?>


  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">

        <div class="hero-unit-tiny">
          <h3 class="titre-affaire">Client : <?php print $content['client']['nomClient'] ?> 
            <?php print $content['client']['prenomClient'] ?>
            <br />
          </h3>
          <h3>
            <small class="subtitle-affaire"> id client : <?php print $content['client']['idClient'] ?>
            </small>
          </h3>
        </div>

        <div class="span12">
          <h4>Informations</h4>

          <i class="icon-home icon-adresse"> </i>
          <div class="inline adresse-etudiant">
            <?php
            if (isset($content['client']['numeroDeVoie'])
                && isset($content['client']['voie'])
                && isset($content['client']['codePostal'])
                && isset($content['client']['ville'])) {


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
              print ('Adresse incomplète');
            }
            ?>
            <br />
          </div>

          <i class="icon-envelope icon-adresse"> </i>
          <div class="inline adresse-etudiant">
            <?php
            if (isset($content['client']['mail'])
                && isset($content['client']['tel'])) {


              print(
                  $content['client']['mail'] . '<br />' .
                  $content['client']['tel']);
            }
            else {
              print ('Numéro de téléphone ou adresse mail manquante');
            }
            ?>
          </div>

          <br />
          <br />
          <a class="btn btn-small inline" href="<?php print url('node/' . $content['client']['nid']) ?>/edit">Modifier fiche client</a>

        </div>
        

      </div>

      <br />
      <br />

      <div class="span12 affaires-realisees">
        <h4>Affaires sollicitées</h4>
        <table class="table table-bordered table-hover recapAffaire">
          <thead>
            <tr>
              <th>id de l'affaire</th>
              <th>Titre</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($content['client']['affaires'] as $affaire) { ?>
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
  <?php print_r($content['client']) ?>
</pre>-->