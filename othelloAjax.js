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
