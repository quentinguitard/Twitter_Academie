
	<nav class="navbar navbar-default top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav">
					<li><a href="index.php?controller=home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Acceuil<span class="sr-only"></span></a></li>
					<li><a href="#"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notifications</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages</a></li>
					<li><img src="image/logo.png" /><a class="navbar-brand" href="index.php">Tweet Academy</a></li>
				</ul>

				<form class="navbar-form navbar-left">
					<div class="form-group search">
						<input type="text" class="form-control" placeholder="Search" id="test">
					</div>
					<button type="submit" class="glyphicon glyphicon-search"></button>
				</form>

				<div class="btn-group">
					<form method="post">
						<input type="submit" class="btn btn-info" value="Deconection" name="disconect">
					</form>

<script>
$(function() {

   $( "#test" ).autocomplete({

     source: function (requete, reponse){

         $.ajax({

             url: "models/search.php",

             dataType: "json",

             data: {

                 q: $( "#test" ).val()

             },

             success: function(data) {

               reponse(data);      

             },

         error: function(err) {

           console.error(err);

         }          

       });

     }

  });

});
</script>


<?php
if(!empty($_POST['disconect'])){
	session_destroy();
    echo "<script> window.location.assign('index.php'); </script>";
}
?>

				</div>

			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>