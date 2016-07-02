
<div class="container">

<div class="row">
  <h1 class='text-center harrypotter blue category'>S'inscrire</h1>
</div>
  <div class="row">
    <?=form_open('index.php/subscribe')?>
    <div class='col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3'>


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
            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?= set_value('pseudo') ?>" required>
            <div class="input-group-addon"></div>
          </div>
        </div>

      <div class="form-group">
       <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
        <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Mot de passe" required>
        <div class="input-group-addon"></div>
        </div>
      </div>

      <div class="form-group">
       <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Retapez le mot de passe" required>
        <div class="input-group-addon"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
        <input type="email" class="form-control" id="mail" name="mail" placeholder="Adresse e-mail" value="<?= set_value('mail') ?>">
        <div class="input-group-addon"></div>
        </div>
      </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Valider l'inscription</button>
    </div>
    </div>
    <?=form_close()?>
  </div>
</div>