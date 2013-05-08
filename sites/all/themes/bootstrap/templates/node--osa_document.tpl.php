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
          <h3 class="titre-affaire"><?php print $content['pageDocument']['verboseReference'] ?>
            <br />
          </h3>
          <h3>
            <small class="subtitle-affaire">Un document pour l'affaire "<?php print $content['pageDocumentAffaire']['titreAffaire'] ?>" - 
              <?php print $content['pageDocumentAffaire']['idAffaire'] ?>
            </small>
          </h3>
        </div>
        
         <a class="btn btn-small " href="<?php print url('node/' . $content['pageDocument']['nid']) ?>/edit">Modifier le document</a>
         |
         <a class="btn btn-small " href="<?php print url('node/' . $content['pageDocumentAffaire']['nid']) ?>">Aller à la fiche Affaire</a>
        
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
  <?php print_r($content['pageDocumentAffaire']) ?>
</pre>-->