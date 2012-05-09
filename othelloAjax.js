<<<<<<< HEAD:js/othelloAjax.js
//load a game
function loadGame(id)
{
	$.post("ajaxLoad.php", { gameId: id }, function(data) {
		//alert(id);
		var info = data.split(",");
		
		player1 = info[0];
		player2 = info[1];
		turn = info[2];
		pieces = info[3];
		finished = info[4];
		gameId = info[5];
		
		$('#main').html("<canvas id = \"Game\" width = 501 height = 501 ></canvas>");
		setup("Game");
		
		clearCanvas("Game");
		drawBoard("Game");
		drawPieces("Game", pieces);
		toggleTurn();
		toggleTurn();
		var winning = pieceCount();
		if(finished == "1")
			$('#turn').html(winning + " has triumphed!");
	});
}

//create a game
function createGame(player1, player2)
{
	$.post("ajaxCreate.php", { player: player1, opponent: player2 }, function(data) {
		if(data != "-1")
			loadGame(data);
		else
			$('#main').html("<h2 style='text-align:center'>Game Creation Error</h2><div class='message'>You already have a game with this opponent. Finish one fight before starting another.");
			$('#main').append("<div style='margins:auto;width 200px;'><input type='button' id='games' value='Go to Current Games'></input><input type='button' id='recreate' value='Select Other Opponent'></input>");
			
			$('#games').click(function()
			{
				currentGames();
			});
			
			$('#recreate').click(function()
			{
				$.post("playersAjax.php", function(data)
					{
						$("#main").html(data);
						$("div.player").click(function()
						{
							createGame(currentUser, $(this).attr('id'));
						});
					});
			});
	});
}

//save a game
function saveGame()
{
	$.post("ajaxSave.php", { gameId: gameId, done: finished, turn: turn, layout: pieces });
}

function currentGames()
{
	$.post("games.php", function(data){
		$('#main').html(data);
		$('div.game').click(function(e)
		{
			loadGame($(this).attr('id'));			
		});
	});
}
=======
//load a game
function loadGame(id)
{
	$.post("php/ajaxLoad.php", { gameId: id }, function(data) {
		//alert(id);
		var info = data.split(",");
		
		player1 = info[0];
		player2 = info[1];
		turn = info[2];
		pieces = info[3];
		finished = info[4];
		gameId = info[5];
		
		
		clearCanvas("Game");
		drawBoard("Game");
		drawPieces("Game", pieces);
		toggleTurn();
		toggleTurn();
		var winning = pieceCount();
		if(finished == "1")
			$('#turn').html(winning + " has triumphed!");
	});
}

//create a game
function createGame(player1, player2)
{
	$.post("php/ajaxCreate.php", { player: player1, opponent: player2 }, function(data) {
		//alert(data);
		loadGame(data);
	});
}

//save a game
function saveGame()
{
	
	$.post("php/ajaxSave.php", { gameId: gameId, done: finished, turn: turn, layout: pieces });
}
>>>>>>> f5196afed7a72f8821ef072ae8929a2d0cebda80:othelloAjax.js
