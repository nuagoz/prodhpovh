<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
    <!-- Overlay -->
    <div class="overlay"></div>
    <!-- Indicators 
        <ol class="carousel-indicators">
          <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#bs-carousel" data-slide-to="1"></li>
          <li data-target="#bs-carousel" data-slide-to="2"></li>
        </ol>-->
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item slides active">
            <div class="slide-1"></div>
            <div class="hero">
                <hgroup>
                    <h1 id='home-title' class='blue harrypotter' style='opacity:0;'>Revivez l'aventure</h1>
                </hgroup>
                <a href='#home-next' rel="relativeanchor" class="btn btn-hero btn-lg no-caps" role="button">Découvrir</a>
            </div>
        </div>
        <!-- <div class="item slides">
            <div class="slide-2"></div>
            <div class="hero">        
              <hgroup>
                  <h1>We are smart</h1>        
                  <h3>Get start your next awesome project</h3>
              </hgroup>       
              <button class="btn btn-hero btn-lg" role="button">See all features</button>
            </div>
            </div>
            <div class="item slides">
            <div class="slide-3"></div>
            <div class="hero">        
              <hgroup>
                  <h1>We are amazing</h1>        
                  <h3>Get start your next awesome project</h3>
              </hgroup>
              <button class="btn btn-hero btn-lg" role="button">See all features</button>
            </div>
            </div> -->
    </div>
    <div id='home-next'>
        <section id='sec_home_1' class='text-center'>
            <h1 class='uppercase harrypotter blue'>Le jeu</h1>
        </section>


            <div class='col-xs-12 blue harrypotter text-center uppercase' id='title_category'>
            Gagnez des points, montez au classement et devenez le sorcier le plus puissant.
            </div>


        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="box animated flipInY visible">
                <div class="box-icon">
                    <img src='<?php echo img_url('animaux/1.jpg'); ?>' class='img_home' />
                </div>
                <div class="info">
                    <h4 class="text-center">Élevez des animaux</h4>
                    <p>Obtenez des chouettes et hiboux de l'univers de Harry Potter. Faites les livrer du courrier pour gagner des gallions. Plus de 10 espèces sont disponibles.</p>
                    <!-- <a href="" class="btn">Link</a> -->
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="box animated flipInY visible" data-delay="1000">
                <div class="box-icon">
                    <img id='choco_home' src='<?php echo img_url('objets/choco.png'); ?>'/>
                </div>
                <div class="info">
                    <h4 id="carte_choco_home" class="text-center">Collectionnez les cartes de chocogrenouille</h4>
                    <p>Réalisez la collection complète des sorciers et sorcières célèbres avec les cartes de chocogrenouille. 101 cartes disponibles avec différents taux de rareté.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="box animated flipInY visible" data-delay="2000">
                <div class="box-icon">
                    <img src='<?php echo img_url('ingredients/aconit.png'); ?>' class='img_home' />
                </div>
                <div class="info">
                    <h4 class="text-center">Collectez des ingrédients</h4>
                    <p>32 ingrédients différents à récolter grâce à vos chouettes et hiboux qui vous permettrons de confectionner des potions.</p>
                </div>
                <div id ='list_ingredients'>
                    <img src='<?php echo img_url('ingredients/alchemille.png'); ?>' class='ingredient_home' />
                    <img src='<?php echo img_url('ingredients/champi_sauteur.png'); ?>' class='ingredient_home'/>
                    <img src='<?php echo img_url('ingredients/armoise.png'); ?>' class='ingredient_home'/>
                    <img src='<?php echo img_url('ingredients/ecorce_sorbier.png'); ?>' class='ingredient_home'/>
                    <img src='<?php echo img_url('ingredients/oeuf_serpencendre.png'); ?>' class='ingredient_home'/>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="box animated flipInY visible" data-delay="2000">
                <div class="box-icon">
                    <img src='<?php echo img_url('potions/potion_beaute.png'); ?>' class='img_home' />
                </div>
                <div class="info">
                    <h4 class="text-center">Confectionnez des potions</h4>
                    <p>A l'aide des ingrédients que vous aurez récolté vous pourez réaliser des potions plus ou moins puissantes, issues de l'univers de Harry Potter comme le Félix Félicis.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <a href='<?php echo base_url('subscribe'); ?>' class="btn btn-hero btn-lg no-caps btn-block">Commencer l'aventure</a>
        </div>
    </div>
</div>