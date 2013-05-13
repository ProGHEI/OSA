

<div id="container" class="container">

  <header role="banner" id="page-header">
    <?php if ($site_slogan): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#header -->

  <div class="row-fluid">







    <?php if ($page['sidebar_first']): ?>
      <aside class="span2" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>  

    <section class="conteneur-principal <?php print _bootstrap_content_span(2); ?>">  

      <div class="row-fluid">
        <div class="span12" id="block-header">
          <div class="span8">
            <div class="titre">

            </div>
            <div class="sous-titre">
              La Junior-Entreprise de HEI
            </div>
          </div>
          <div class="span4">

            <div class="span12">

              <div id="twitter">
                <a href="https://twitter.com/proghei" target="_blank"><img src="<?php print url('sites/extranet.proghei.fr/themes/bootstrap/assets/img/twitte32.png') ?>" alt=""></a>
              </div>
              <div id="facebook">
                <a href="https://www.facebook.com/pages/ProGHEI-La-Junior-Entreprise-dHEI/232534073459701" 
                   target="_blank"><img src="<?php print url('sites/extranet.proghei.fr/themes/bootstrap/assets/img/faceboo32.png') ?>" alt=""></a>
              </div>

            </div>

            <div class="span12">
              <!--              <div id="viadeo">
                              <a href="http://www.linkedin.com/company/prog'hei" target="_blank"><img src="sites/extranet.proghei.fr/themes/bootstrap/assets/img/linkedi32.png" alt=""></a>
                            </div>-->
              <div id="linkedin">
                <a href="http://www.linkedin.com/company/prog'hei" target="_blank"><img src="<?php print url('sites/extranet.proghei.fr/themes/bootstrap/assets/img/linkedi32.png') ?>" alt=""></a>
              </div>
            </div>

          </div>
        </div>

      </div>

      <header id="navbar" role="banner" class="navbar navbar-fixed-top">
        <div class="navbar-inner">

          <div class="container">
            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>

            <?php if ($logo): ?>
              <a class="logo pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
              </a>
            <?php endif; ?>

            <?php if ($site_name): ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="brand"><?php print $site_name; ?></a>
              </h1>
            <?php endif; ?>

            <?php if ($primary_nav || $secondary_nav || !empty($page['navigation'])): ?>
              <div class="nav-collapse">
                <nav role="navigation">
                  <?php if ($primary_nav): ?>
                    <?php print render($primary_nav); ?>
                  <?php endif; ?>
                  <?php if (!empty($page['navigation'])): ?>
                    <?php print render($page['navigation']); ?>
                  <?php endif; ?>
                  <?php if ($secondary_nav): ?>
                    <?php print render($secondary_nav); ?>
                  <?php endif; ?>
                </nav>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </header>

      <?php if ($title == 'Accueil'): ?>

        <div id="myCarousel" class="carousel slide">
          <div class="carousel-inner">
            <div class="item active">
              <img src="sites/all/themes/bootstrap/assets/img/groupe.png" alt="">
              <div class="carousel-caption">
                <h4>L'équipe 2012-2013</h4>
                <p>Avec des profils différents, des âges différents, des vocations différentes, nous vous donnons le meilleur de nous même pour atteindre vos objectifs. ProG'HEI, c'est avant tout une équipe motivée</p>
              </div>
            </div>
            <div class="item">
              <img src="sites/all/themes/bootstrap/assets/img/teamwork.png" alt="">
              <div class="carousel-caption">
                <h4>Le travail d'équipe</h4>
                <p>La masse de travail, nous l'abattons sans remords grace à l'entraide de nos membres !</p>
              </div>
            </div>
            <div class="item">
              <img src="sites/all/themes/bootstrap/assets/img/dsi.png" alt="">
              <div class="carousel-caption">
                <h4>Des membres éclairés</h4>
                <p>Nos membres éclairent les problèmes que nous rencontrons de leurs lumières. Nous ne laissons aucun aspect dans l'ombre !</p>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
        </div>



      <?php endif; ?>
      <?php if ($page['highlighted']): ?>
        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <br />
      <?php
//      if ($breadcrumb): print $breadcrumb;
//      endif;
      ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <div class="contenu-principal">
        <?php if ($title): ?>
          <div class="separateur"><h1 class="page-header"><?php print $title; ?></h1></div>
        <?php endif; ?>

        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php
        if (($tabs) && isset($node->type)):
          if (($title != 'Outil - OSA') && ($node->type != 'osa_affaire') && ($node->type != 'osa_client') && ($node->type != 'osa_etudiant') && ($node->type != 'osa_document')):
            print render($tabs);
          endif;
        endif;
        ?>
        <?php if ($page['help']): ?> 
          <div class="well"><?php print render($page['help']); ?></div>
        <?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>


        <?php if ($title == 'Outil - OSA'): ?>

          <div class="span12 OSA">
            <div class="span3">
              <a class="btn" href="<?php print url('node/add/osa-client') ?>">Ajouter un client</a>
            </div>
            <div class="span3">
              <a class="btn" href="<?php print url('node/add/osa-etudiant') ?>">Ajouter un étudiant</a>
            </div>
            <div class="span3">
              <a class="btn" href="<?php print url('node/add/osa-affaire') ?>">Ajouter une affaire</a>
            </div>
            <div class="span3">
              <a class="btn" href="<?php print url('node/add/osa-document') ?>">Ajouter un document</a>
            </div>
          </div>
          <br />
          <div class="span12 OSA">
            <div class="span3">
              <a class="btn" href="<?php print url('liste-clients') ?>">Consulter les clients</a>
            </div>
            <div class="span3">
              <a class="btn" href="<?php print url('liste-etudiants') ?>">Consulter les étudiants</a>
            </div>
            <div class="span3">
              <a class="btn" href="<?php print url('liste-affaires') ?>">Consulter les affaires</a>
            </div>
            <div class="span3">
              <a class="btn" href="<?php print url('liste-documents') ?>">Consulter documents</a>
            </div>
          </div>

        <?php else: ?>
          <?php print render($page['content']); ?>           
        <?php endif; ?>



      </div>
    </section>

    <?php if ($page['sidebar_second']): ?>
      <aside class="span2 menu-navigation well" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>

</div>
<footer class="footer container">
  <div class="infos-legales">
    <p class="infos-legales">
      ProG'HEI - La Junior Entreprise d'HEI
      <br>
      13 Rue de Toul - 59046 Lille Cedex
      <br>
      <a href="http://www.hei.fr">HEI</a> | <a href="http://www.junior-entreprises.com/">CNJE</a>
    </p>

  </div>
  <?php print render($page['footer']); ?>
</footer>


