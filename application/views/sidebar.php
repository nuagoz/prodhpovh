<?php

$info_xp = determine_niveau($info_membre['exp']);

?>
<div class="col-sm-3 col-lg-2 nav-side-menu no-padding">
    <div class="brand">
    Hpovh
      <span class = "visible-xs g_value oswald" id = "mobile_qty_gallions"><?= $info_membre['argent']; ?> <img id='img_gallion' src='<?php echo img_url('gallion2.png'); ?>'/></span>
    </div>
    <div id="infos_user" class="text-center oswald">
      <div id="pseudo_user">
        <?php echo $pseudo; ?>
      </div>
      <div id="gallions_user">
        <span class='g_value'><?= $info_membre['argent'];  ?></span> <img id='img_gallion' src='<?php echo img_url('gallion2.png'); ?>'/></span>
      </div>

      <div id="user_level">
        <span class="level badge badge-info">Niveau <span id='value_lvl'><?= $info_xp['niveau']; ?></span></span>
      </div>

      <div class='preview_xp'>
        <div class='relativeleft'>
          <span id='actual_xp'><?= $info_xp['xp_remaining']; ?></span> / <span id='needed_xp'><?= $info_xp['needed_xp'] ?></span> xp
        </div>
      </div>

      <div class="preview_level custom_progress">
        <div id='progress_level' class="progress_text progress-bar progress-bar-success progress-bar-striped" role="progressbar"
        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= $info_xp['pourcentage']; ?>%">
          &nbsp;
        </div>
      </div>

    </div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
      
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">

            <div id='menu_mobile' class="brand visible-xs">
            <span class = "pseudo_mobile oswald"><?= $pseudo ?></span>
              <span class="level badge badge-info level_mobile">Niveau <?= $info_xp['niveau']; ?></span>

              <div class="preview_level_mobile custom_progress">
                <div class="progress_text progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= $info_xp['pourcentage']; ?>%">
                  &nbsp;
                </div>
              </div>
            </div>

                <li>
                  <a href="<?php echo base_url('home'); ?>">
                  <i class="fa fa-user" aria-hidden="true"></i> Profil
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-paw" aria-hidden="true"></i> Gestion <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li class="active"><a href="<?php echo base_url('management'); ?>">Animaux</a></li>
                    <li><a class="menu-adapt" href="<?php echo base_url('management/cards'); ?>">Cartes</a></li>
                    <li><a href="<?php echo base_url('home'); ?>">Potions</a></li>
                </ul>

                <li>
                  <a href="<?php echo base_url('quidditch'); ?>">
                    <i class="fa fa-futbol-o" aria-hidden="true"></i> Quidditch
                  </a>
                </li>

                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Chemin de Traverse <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="service">
                  <li><a href="<?php echo base_url('shop/eeylops'); ?>">Eeylops</a></li>
                  <li><a href="<?php echo base_url('shop/bonbec'); ?>">Bonbec</a></li>
                </ul>

                 <li>
                  <a href="<?php echo base_url('inventory'); ?>">
                  <i class="fa fa-archive" aria-hidden="true"></i> Inventaire
                  </a>
                  </li>

                 <li>
                  <a href="#">
                  <i class="fa fa-envelope" aria-hidden="true"></i> Messagerie
                  </a>
                  <span id="nb_msg" class="badge">0</span>
                </li>

                <li>
                  <a href="<?php echo base_url('rank'); ?>">
                  <i class="fa fa-users fa-lg"></i> Classement
                  </a>
                </li>

                <li id="deconnexion">
                  <a href="<?php echo base_url('auth/logout'); ?>">
                    <button type="button" class="btn btn-danger btn-block">Déconnexion</button>
                  </a>
                </li>

            </ul>
     </div>
</div>