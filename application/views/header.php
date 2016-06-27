
<body>

<nav class="navbar navbar-default navbar-inverse" role="navigation">
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
      <a class="navbar-brand harrypotter main-title" href="#">Chocogrenouille.fr</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-home fa" aria-hidden="true"></i> Accueil</a></li>
        <li><a href="#"><i class="fa fa-book fa" aria-hidden="true"></i> Guide du jeu</a></li>
        <li><a href="#"><i class="fa fa-trophy" aria-hidden="true"></i> Classements</a></li>
        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Inscription</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-in fa" aria-hidden="true"></i><b> Connexion</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                     <div class="row">
                            <div class="col-md-12">
                                 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                        <div class='harrypotter text-center main-title'>Connexion</div>
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputEmail2">Pseudo</label>
                                             <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span><input type="email" class="form-control" id="exampleInputEmail2" placeholder="Pseudo" required>
                                        </div>  
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                 <label class="sr-only" for="exampleInputPassword2">Mot de passe</label>
                                                 <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span><input type="password" class="form-control" id="exampleInputPassword2" placeholder="Mot de passe" required>
                                             </div>
                                             <div class="help-block text-right"><a href="">Mot de passe oublié ?</a></div>
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                                        </div>
                                        <div class="checkbox">
                                             <label>
                                             <input type="checkbox"> Rester connecté
                                             </label>
                                        </div>
                                 </form>
                            </div>
                            <div class="bottom text-center">
                                Nouveau ? <a href="#"><b>Rejoignez-nous</b></a>
                            </div>
                     </div>
                </li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
