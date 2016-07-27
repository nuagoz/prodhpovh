<nav class="navbar navbar-default navbar-inverse" id='menu_hp' role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <!-- fond icone pour ouverture menu en mobile -->
                <span class="sr-only">Toggle navigation</span>
                <!-- traits de l'icone -->  
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand harrypotter main-title visible-xs" href="#">Harry Potter jeu</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-home fa" aria-hidden="true"></i> Accueil</a></li>
                <li><a href="<?php echo base_url('guide'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Guide du jeu</a></li>

                <?php if ($this->ion_auth->logged_in()) : ?>

                    <li><a href="<?php echo base_url('management'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Gestion</a></li>
                    <li><a href="<?php echo base_url('guide'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Profil</a></li>
                    <li><a href="<?php echo base_url('guide'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Chemin de traverse</a></li>
                    <li><a href="<?php echo base_url('guide'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Inventaire</a></li>
                    <li><a href="<?php echo base_url('guide'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Messagerie</a></li>
                    <li><a href="<?php echo base_url('guide'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Options</a></li>
                    
                <?php endif; ?>

                <li><a href="<?php echo base_url('rank'); ?>"><i class="fa fa-trophy" aria-hidden="true"></i> Classements</a></li>

                <?php if (!$this->ion_auth->logged_in()) : ?>

                    <li><a href="<?php echo base_url('auth/register'); ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Inscription</a></li>
                    <?php if ($this->uri->segment(2) === 'login'): ?>
                    <li><a href="<?php echo base_url('auth/login'); ?>"><i class="fa fa-sign-in fa" aria-hidden="true"></i> Connexion</a></li>
                    <?php else : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-in fa" aria-hidden="true"></i><b> Connexion</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?=form_open('auth/login');?>
                                        <div class='harrypotter text-center main-title'>Connexion</div>
                                        <div class="form-group">
                                            <label class="sr-only" for="conn_pseudo">Pseudo</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span><input type="text" class="form-control" id="conn_pseudo" name ="conn_pseudo" placeholder="Pseudo" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="sr-only" for="conn_mdp">Mot de passe</label>
                                                <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span><input type="password" class="form-control" id="conn_mdp" name="conn_mdp" placeholder="Mot de passe" required>
                                            </div>
                                            <div class="help-block text-right"><a href="">Mot de passe oublié ?</a></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="btn_connexion" class="btn btn-primary btn-block">Se connecter</button>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="remember"> Rester connecté
                                            </label>
                                        </div>
                                        <?=form_close();?>
                                    </div>
                                    <div class="bottom text-center">
                                        Nouveau ? <a href="#"><b>Rejoignez-nous</b></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                <?php else : ?>
                    <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-book fa" aria-hidden="true"></i> Deconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>