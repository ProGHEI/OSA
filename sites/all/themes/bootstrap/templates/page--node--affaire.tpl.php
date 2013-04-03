<div id="banniere" class="banniere">
  <div id="image-banniere">

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

    <section class="conteneur-principal <?php print _bootstrap_content_span($columns); ?>">  
      <?php if ($page['highlighted']): ?>
        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if ($breadcrumb): print $breadcrumb;
      endif;
      ?>
      <a id="main-content"></a>
        <?php print render($title_prefix); ?>
      <div class="contenu-principal">
        <?php if ($title): ?>
          <h1 class="page-header"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php if ($tabs): ?>
          <?php print render($tabs); ?>
        <?php endif; ?>
        <?php if ($page['help']): ?> 
          <div class="well"><?php print render($page['help']); ?></div>
        <?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
<?php print render($page['content']); ?>
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