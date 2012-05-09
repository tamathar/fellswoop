//load a game
function loadGame(id)
{
	if(update != false)
	{
		window.clearInterval(update);
		update = false;
	}
	$.post("ajaxLoad.php", { gameId: id }, function(data) {
		//alert(id);
		var info = data.split(",");
		
		player1 = info[0];
		player2 = info[1];
		turn = info[2];
		pieces = info[3];
		finished = info[4];
		gameId = info[5];
		
		var currentpturn;
		if(turn == 0)
			currentpturn = player1;
		else
			currentpturn = player2;
		$('#main').html("<h3 style='text-align:center'>" + currentpturn + "'s Turn</h3><canvas id = \"Game\" width = 551 height = 501 ></canvas>");
		setup("Game");
		
		clearCanvas("Game");
		drawBoard("Game");
		drawPieces("Game", pieces);
		toggleTurn();
		toggleTurn();
		var winning = pieceCount();
		if(finished == "1")
			$('#turn').html(winning + " has triumphed!");
		
		
		update = self.setInterval("loadGame(" + id + ")",1000*5);
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
	if(update != false)
	{
		window.clearInterval(update);
		update = false;
	}
	$.post("games.php", function(data){
		$('#main').html(data);
		$('div.game').click(function(e)
		{
			loadGame($(this).attr('id'));			
		});
	});
}