<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <title>Tweet Academy</title>
</head>
<body>

<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img src="image/logo.png" /><a class="navbar-brand" href="#">Tweet Academy</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Vous avez déjà un compte ?</p></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Se connecter </b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                     <div class="row">
                            <div class="col-md-12">
                                
                                 <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                             <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                             <label class="sr-only" for="exampleInputPassword2">Password</label>
                                             <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                             <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                        </div>
                                        <div class="checkbox">
                                             <label>
                                             <input type="checkbox"> keep me logged-in
                                             </label>
                                        </div>
                                 </form>
                            </div>
                            <div class="bottom text-center">
                                New here ? <a href="#"><b>Join Us</b></a>
                            </div>
                     </div>
                </li>
            </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container">    
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">S'inscrire </div>
            </div>     

            <div class="panel-body" >

                <div id="login-alert" class="alert alert-danger col-sm-12"></div>

                <?php 
                if(!empty($_POST['envoyer']) && !empty($_POST['displayName']) && !empty($_POST['fullName']) && !empty($_POST['mail']) && !empty($_POST['password'])){

                    if($usermanager->verification($_POST['mail'],$_POST['displayName']) == false){

                        echo "<p>Wrong Password OR Username</p>";

                    }
                    else {
                        $user = new User($_POST['fullName'],$_POST['displayName'],$_POST['mail'],$_POST['password']);
                        $usermanager->create($user);
                        $_GET['controller'] = 'home';
                        echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."'); </script>";

                    }
                }
                ?>
                <form method="post" action="" id="loginform" class="form-horizontal" role="form">


                    <div class="form-group">
                        <input type="text" class="form-control" id="fullName" name='fullName' placeholder="Nom Prénom">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Pseudo">
                    </div>

                    <div class="form-group">
                        <input class="form-control"  value="" placeholder="Adresse email" type="mail" class="form-control" id="mail" name="mail">                                        
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe">
                    </div>



                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Rester connecté
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <input type="submit" name="envoyer" value="S'inscrire" id="btn-login" class="btn btn-success">

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div class="log">
                                Vous avez déjà un compte? 
                                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                    Se connecter !
                                </a>
                            </div>
                        </div>
                    </div>    
                </form>     

            </div>                     
        </div>  
    </div>
</div> 


<form action="" method="post">
    <div class="form-group">
        <label for="mail">Email address:</label>
        <input type="mail" class="form-control" id="mail" name="mail">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name='password'>
    </div>
    <input type="submit" class="btn btn-default" value='Login' name="login">
</form>
<?php
if(!empty($_POST['login']))
{
    if($usermanager->exist($_POST['mail'], $_POST['password'])[1] == true){
        $_GET['controller'] = 'home';
        $_SESSION['idUser'] = $usermanager->exist($_POST['mail'], $_POST['password'])[0];
        echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."'); </script>";
        echo "C'est bon tes co !";
    }

}
?>

</body>
</html>