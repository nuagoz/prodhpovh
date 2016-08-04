<div class="col-sm-3 col-lg-2">
  <nav class="navbar navbar-default navbar-fixed-side" id='left_part'>
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           <!-- <a id='menu_main' class="navbar-brand" href="./">HarryPotter.ovh</a> -->

            <li class="nav-header nostyle text-center">
              <a id='head_menu' href="/"><img id='logo_menu' alt="logo" src="<?php echo img_url('logo.png'); ?>"/></a>
              <div id='gallion_display' class='visible-xs-inline'><span id='menu_gallions'><span class='g_value'>1200</span> <img id='img_gallion' src='<?php echo img_url('gallion2.png'); ?>'/></span></div>
            </li>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-category ">

             <li class='text-center' id='start_category'>
                <span id='menu_pseudo'><?php echo $pseudo; ?></span>
              </li>

              <li class='text-center hidden-xs'>
                <span id='menu_gallions'><span class='g_value'><?php echo $argent; ?></span> <img id='img_gallion' src='<?php echo img_url('gallion2.png'); ?>'/></span>
              </li>
              <li>
                <a class='champ_menu' href="#"><i class="fa fa-user" aria-hidden="true"></i> Profil</a>
              </li>

              <li>
                <a class='champ_menu' href="<?php echo base_url('management'); ?>"><i class="fa fa-paw" aria-hidden="true"></i> Gestion</a>
              </li>

              <li>
                <a class='champ_menu' href="./"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Chemin de traverse</a>
              </li>

              <li>
                <a class='champ_menu' href="./"><i class="fa fa-archive" aria-hidden="true"></i> Inventaire</a>
              </li>

              <li>
                <a class='champ_menu' href="./"><i class="fa fa-envelope" aria-hidden="true"></i> Messagerie</a>
              </li>

              <li>
                <a class='champ_menu' href="./"><i class="fa fa-trophy" aria-hidden="true"></i> Classement</a>
              </li>

              <li>
                <a class='champ_menu' href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Déconnexion</a>
              </li>

            </ul>
          </div>
        </div>

    <!-- normal collapsible navbar markup -->
  </nav>
</div>