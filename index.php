<!DOCTYPE HMTL>
<?php session_start(); ?>
<html>
	<head>
		 <LINK href="game.css" rel="stylesheet" type="text/css">
		
		<script src="Othello.js"></script>
		<script src="othelloAjax.js"></script>
		<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
		<script>




	
		
		$(document).ready(function() {
			setup("Game");
		 $(center).hide();
			$(menu).show();
			 $(side).hide();
			$(select).hide();
			$(face).hide();
			$(selectuser).hide();
			$('div.menu,ul').hide();
		
		$('#submit_btn').click(function(){
		//alert("h");
		var username = $('#username').val();
		var password = $('#password').val();
		
		$.post("check_login.php", {username: username, password: password},
			function(result){
				if(result == 1){
				//alert(result);
				//to remove login-popup
				 $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
			});
			
				//$('#menu').html(username);
			$('a.login-window').hide();
			$('div.menu,h1').show();
			$(select).show();
			$(face).hide();
				}
				else
				alert(result);
		
		
		
		});
		});
		
			
			$('a.start').click(function() {
			/*
		$(center).hide();
		$(outer).hide();
		$(menu).hide();
		*/
		$.post("users.php",
			function(data){
			//alert(data);
			$('a.login-window').hide();
			$('div.menu,h1').show();
			$(select).hide();
			$(selectuser).show();
			$(face).show();
			$('div.face,h2').html(data);
			});
		});
		
	
		 $('#btn').click(function(){
		 	var opponent = $('#addusername').val();
		 	createGame(currentUser, opponent);
			$('div.outer').hide();
			$(menu).hide();
			$(center).show();
			$(face).hide();
			$(side).show();
			
			$('div.face,h2').html(opponent);
			});
			/*
		 alert("h");
		
		 */
		
		 
		 		$('a.view').click(function() {
			/*
		$(center).hide();
		$(outer).hide();
		$(menu).hide();
		*/
		$.post("games.php",
			function(data){
			//alert(data);
			$('a.login-window').hide();
			$('div.menu,h1').show();
			$(select).hide();
			$(selectuser).hide();
			$(face).show();
			$('div.main').show();
			$('div.face,h2').html("Click on opponent to finish game ");
			$('div.face,h3').html("Current Games");
			$('div.face,a').html(data);
			
			});
		});
	
		 $('a.main').click(function() {
		 //$(this).addClass('onclick');
			$(menu).show(); 
			$(center).hide();
			//alert($(this).attr('class'));
			loadGame(33);
				
			$('div.outer').hide();
			$(menu).hide();
			$(center).show();
			$(face).hide();
			$(side).show();
			$(select).show();
			//$(this).removeClass('onclick');
		 });
		 
		
	$('a.login-window').click(function() {
		
                //Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border see css style
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
}); 
		
		
		</script>
	<script>
		var pieces = "----------------------------------------------------------------";
		var player1 = "player1";
		var player2 = "player2";
		var turn = "0";
		var finished = "0";
		var gameId = "0";
		var currentUser = '<?php echo $_SESSION['username'];?>';
	</script>
	</head>
	<body >
	
	<script>
		setInterval(function(){loadGame(gameId);}, 5000);
	</script>
	<div id="side">
				
				<img src="images/interface.jpg" class="stay"/>
		<a href="#main" class="main"><img src="images/main.jpg" class="image"></a>
			
</div>
			<div id="face">
			<h3> Users </h3>
			
<h2> </h2>
<a href="#users" class="users"></a>
<a href="#main" class="main"><img src="images/main.jpg" class="image"></a>
<br/>
</div>

			
			
		<div class="outer">	
	<div id="menu">
		
			<a href="#login-box" class="login-window"> <img src="images/multi.png" class="login_multi"/></a>
			<div id="login-box" class="login-popup">
				<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
					<form method="post" id="form"  action="">
						
						
							<span>Username or email</span>
							<input type="text" id="username" name="username" />
							
							    
								<span>Password</span>
								<input id="password" name="password"  type="password" >
							
								<input type="button" name="submit" id="submit_btn" type="button">Sign in</button>
									<p>
									<a class="forgot" href="#">Register</a>
									</p>        
						
					</form>
				</div>	
				<div id="select">
				
				<table>
  <tr>
    <td><a href="#start" class="start"><img src="images/newgame.jpg" class="image"></a></td>
   </tr>  
   <tr>
    <td><a href="#viewgames" class="view"><img src="images/current.jpg" class="image"></a></td>
  </tr>
  <tr>
   <td><a href="#stats"><img src="images/stats.jpg" class="image"></a></td>
 </tr>
</table> 
	
		
		
	
</div>
				<div id="selectuser">
					<form method="post" id="play" action="">
					<span> Enter a username to start a game </span>
					<input type="text" id="addusername" name="addusername" />
					<input type="button" name="submit" id="btn" type="button"> Play </button>
					</form>
			</div>
		
	<h1> Othello </h1>
	
	


</div>
</div>


		<!--<div id="menu">
		
			<h1> Othello </h1>
			<h2> Start </h2>
			<h2> View Current Games </h2>
			<h2> Stats </h2>
			
		
		
		</div>-->

		
		
		<div id="center">
			
			<canvas id = "Game" width = 601 height= 601></canvas>
			<div id="turn">test</div>
			<div id="wcount">test</div>
			<div id="bcount">test</div>
		</div>
		
	
	
		
		<script>
			drawBoard("Game");
			drawPieces("Game", "----------------------------B-----------------------------------");
		</script>
	
	</body>
</html>
