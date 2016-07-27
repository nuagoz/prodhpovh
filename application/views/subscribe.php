<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
    <!-- Overlay -->
    <div class="overlay"></div>
    <div class="carousel-inner">
        <div class="item slides active">
            <div class="slide-3"></div>
            <div class="text_hero">

                <div class="container animated bounceInDown visible" data-delay='1000' id='sub_content'>
                <div class="row">
                        <h1 class='text-center harrypotter blue category'>S'inscrire</h1>
                        
                    </div>
                <img src="<?php echo base_url()."assets/img/parchemin.png"; ?>" class="img-responsive" id='parchemin'/>
                    
                    <div class="row">
                        <?=form_open()?>
                        <div class='col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4'>
                            <?php
                                if($this->session->flashdata('confirmation'))
                                  {
                                    echo '<div class="alert alert-success contest_error" >';
                                      echo '<button type="button" class="close" data-dismiss="alert">×</button>';
                                      echo $this->session->flashdata('confirmation');
                                    echo '</div>';
                                  }
                                if(validation_errors())
                                  {/* Affichage des erreurs du formulaire d'inscription */
                                    echo '<div class="alert alert-danger contest_error">';
                                      echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                                      echo validation_errors('<li>', '</li>');
                                    echo '</div>';
                                  }
                                ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon hp-input-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control champs_lettre" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?= set_value('pseudo') ?>" required>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon hp-input-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control champs_lettre" id="pass1" name="pass1" placeholder="Mot de passe" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <!--<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Retapez le mot de passe" required>
                                    <div class="input-group-addon"></div>-->
                                    <span class="input-group-addon hp-input-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control champs_lettre" id="pass2" name="pass2" placeholder="Retapez le mot de passe" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon hp-input-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" class="form-control champs_lettre" id="mail" name="mail" placeholder="Adresse e-mail" value="<?= set_value('mail') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Valider l'inscription</button>
                            </div>
                        </div>
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>