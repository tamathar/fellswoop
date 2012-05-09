<!DOCTYPE HMTL>
<?php 
	//require "connect.php";
/*session_start(); 
	
	require_once "sdk/src/facebook.php";
	
	$facebook = new facebook(
	array(
		'appId'  => '394565850573684',
		'secret' => '4ef12047f4dd402b76ca6a1b68bf8502',
	));
	
	$user = $facebook->getUser();
	
	if($user){
		try
		{
			$user_profile = $facebook->api('/me');
			
		}
		catch (FacebookApiException $e) 
		{
			$login = $facebook->getLoginUrl();
			header ("Location: $login");
		}
	}
	
	var_dump ($user_profile);*/
?>
<html>
	<head>
		 <LINK href="css/game.css" rel="stylesheet" type="text/css">
		  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
		
		
		<script src="js/Othello.js"></script>
		<script src="js/othelloAjax.js"></script>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		   <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<script>
			 $(function() {
                $('#nav > div').hover(
                function () {
                    var $this = $(this);
                    $this.find('img').stop().animate({
                        'width'     :'199px',
                        'height'    :'199px',
                        'top'       :'-25px',
                        'left'      :'-25px',
                        'opacity'   :'1.0'
                    },500,'easeOutBack',function(){
                        $(this).parent().find('ul').fadeIn(700);
                    });

                    $this.find('a:first,h2').addClass('active');
                },
                function () {
                    var $this = $(this);
                    $this.find('ul').fadeOut(500);
                    $this.find('img').stop().animate({
                        'width'     :'52px',
                        'height'    :'52px',
                        'top'       :'0px',
                        'left'      :'0px',
                        'opacity'   :'0.1'
                    },5000,'easeOutBack');

                    $this.find('a:first,h2').removeClass('active');
                }
            );
            });

		
		$(document).ready(function() {
		
		
			setup("Game");
		
			
		
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
			
		 		$('a.view').click(function() {
		
		alert("j");
		$.post("games.php",
			function(data){
				alert("i work");
			});
		
		
			
			$('body').after('<div id="face">jj <div/>');
			//$(face).show();
			$('<div id="face">').appendTo('body').html(html);
			$('div.face,h2').append("Click on opponent to finish game ");
			$('div.face,h3').html("Current Games");
			$('div.face,a').html(data);
			
			//});
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
		
		 
		 		
	/*
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
		 */
		
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

	$('a.top').click(function()
	{
		$.post("leaders.php", function(data){
			alert(data);
			$("#main").html(data);
		});
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
		var currentUser = '<?php// echo $_SESSION['username'];?>';
	</script>
	</head>
	<body >
	



	<div class="navigation" id="nav">
                <div class="item user">
                    <img src="images/bg_user.png" alt="" width="199" height="199" class="circle"/>
                    <a href="#" class="icon"></a>
                    <h2>User</h2>
                    <ul>
                        <li><a href="#">Statistics</a></li>
                        <li><a href="#">Achievements</a></li>
                    </ul>
                </div>
			
			<div class="item fellswoop">
                    <img src="images/bg_home.png" alt="" width="199" height="199" class="circle"/>
                    <a href="#" class="icon"></a>
                    <h2>Fellswoop</h2>
                    <ul>
                        <li><a href="#">New Game</a></li>
                        <li><a href="#" class="view">Current Games</a></li>
                        <li><a href="#" class="top">Top Scores</a></li>
                    </ul>
                </div>
				
				 <div class="item facebook">
                    <img src="images/bg_shop.png" alt="" width="199" height="199" class="circle"/>
                    <a href="#" class="icon"></a>
                    <h2>Share</h2>
                    <ul>
                        <li><a href="#">Invite</a></li>
                        
                    </ul>
                </div>
	</div>
				

		<div class="title">
		<img src="images/b.png"  alt="" />
	<!--<h1> Fellswoop </h1> -->
	</div>
	
	<div id = "main" style="height:501; width:501; background-color:#23B3BA; float:right;">
	<h1> Top Scores </h1>
	<h2> a </h2>

	
	</div>





	</body>
</html>
