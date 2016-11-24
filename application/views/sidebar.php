<div class="col-sm-3 col-lg-2 nav-side-menu no-padding">
    <div class="brand">
    Brand Logo
      <span class = "visible-xs g_value oswald" id = "mobile_qty_gallions"><?= $argent; ?> <img id='img_gallion' src='<?php echo img_url('gallion2.png'); ?>'/></span>
    </div>
    <div id="infos_user" class="text-center oswald">
      <div id="pseudo_user">
        <?php echo $pseudo; ?>
      </div>
      <div id="gallions_user">
        <span class='g_value'><?= $argent;  ?></span> <img id='img_gallion' src='<?php echo img_url('gallion2.png'); ?>'/></span>
      </div>
    </div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="#">
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

            </ul>
     </div>
</div>