
//GLOBAL VAR FOR THE SIZE OF EACH GAME BOARD SQUARE
var spaceSize = 75;
var mouseX;
var mouseY;
var mouseSpace;
var clickSpace;
var clickX;
var clickY;



//This function gets our Canvas
function grabCanvas(id)
{
	var canvas = document.getElementById(id);
	var context = canvas.getContext('2d');
	return context;
}

//Clear our canvas
function clearCanvas(id)
{
	var canvas = document.getElementById(id);
	canvas.width = canvas.width;
}

//This functions draws our board
function drawBoard(id)
{
	var context = grabCanvas(id);

	for(var i = 0; i < 9; i++)
	{
		context.moveTo(0, (i*spaceSize) + .5);
		context.lineTo((8*spaceSize) + .5, (i*spaceSize) + .5);
		
		context.moveTo((i*spaceSize) + .5, 0);
		context.lineTo((i*spaceSize) + .5, (8*spaceSize) + .5);
	}
	
	for( var i = 0; i < 4; i++)
		for(var j = 0; j < 4; j++)
		{
			var x1 = 2*j*spaceSize;
			var x2 = 2*j*spaceSize + spaceSize;
			var y1 = 2*i*spaceSize;
			var y2 = 2*i*spaceSize + spaceSize;
			
			context.fillStyle = "#AAAAAA";
			context.fillRect(x1, y1, spaceSize, spaceSize);
			context.fillRect(x2, y2, spaceSize, spaceSize);
		}
		
	context.stroke();
}

//This function draws the pieces contained in a string
function drawPieces(id, layOut)
{
	var context = grabCanvas(id);
	
	for(var i = 0; i < 64; i ++)
	{
		if(layOut[i] == "W")
			context.fillStyle = "#FFFFFF";
		else if(layOut[i] == "B")
			context.fillStyle = "#000000";
			
		if(layOut[i] != "-" || i == 64)
		{
			var x = (spaceSize * (i%8)) + (spaceSize/2);
			var y = (spaceSize * (Math.round((i/8) - .5))) + (spaceSize/2);
			//alert(x + " " + y);
			context.beginPath();
			context.arc(x, y , (spaceSize/2) - 3, 0*Math.PI, 2*Math.PI, true);
			context.stroke();
			context.fill();
		}
		
	}	

}

//This function places a piece given an index (0-63) and color (B/W)  - NOTE: does not redraw pieces
function placePiece(index, color, layOut)
{
	var pieces = layOut.substring(0, index) + color + layOut.substring(index+1);
	return pieces;
}

//This function adds onClick and onMouseOver events to the canvas
function setup(id)
{
	//function to track mouse
	$("#" + id).mousemove(function(e)
	{
		var offset =$('#Game').offset();
		mouseX = e.pageX - offset.left;
		mouseY = e.pageY - offset.top;
		
		var space = getSpace(mouseX, mouseY);
		
		if(space != mouseSpace)
			mouseSpace = space;
		
	});
	
	//function to trigger mouse clicks
	$("#" + id).mouseup(function(e)
	{
		//if(turn == "0" && player1 == $_SESSION['user']
		clickSpace = mouseSpace; //first, where are we
		clickX = clickSpace % 8;
		clickY = Math.round(clickSpace/8 - .5);
		
		var color = "B";
		if(turn == "1")
			color ="W";
		
		if(validateSpace(color, clickX, clickY) && (turn == "0" && player1 == currentUser || turn == "1" && player2 == currentUser))
		{
			pieces = placePiece(mouseSpace, color, pieces);//place piece
			capturePieces(color, clickX, clickY);
			
			clearCanvas(id);//redraw
			drawBoard(id);
			drawPieces(id, pieces);
			toggleTurn();//change turn
			checkPossible(color, 0);//check to make sure we don't retoggle
			if(finished == "1")//if the game is over say so
			{
				turn = "3";
				$("#turn").html("It is OVER");
			}
			saveGame();
			pieceCount();
		}
	});
}

//This function checks for impossible turn conditions
function checkPossible(color, count)
{
	var possible = false;
	if(color == "B")
		color = "W";
	else
		color = "B";
		
	for(var i = 0; i < 8; i++)
		for(var j = 0; j < 8; j++)
			if(validateSpace(color, i, j))
			{
				possible = true;
				count = 0;
				break;
			}
	
	if(!possible && count < 2)
	{
		count++;
		toggleTurn();
		checkPossible(color, count);
	}
	
	if(count >= 2)
	{
		finished = "1";
		/*if(color == "B")
			winner = player1;
		else
			winner = player2;*/
	}
				
}

//This function toggle's who's turn it is
function toggleTurn()
{
	if(turn == "0")
	{
		turn = "1";
		$("#turn").html("It is " + player2 + "'s turn. (White)");
	}
	else
	{
		turn = "0";
		$("#turn").html("It is " + player1 + "'s turn. (Black)");
	}
}

//This function gets the square that the mouse is in given the coordinates of the mouse (return square 0 - 63)
function getSpace(x, y)
{
	var square = (Math.round((y/spaceSize)-.5) * 8) + Math.round((x/spaceSize)-.5);
	return square;	
}

//This function captures the opponents placed piece when a new piece is placed
function capturePieces(color, x, y)
{
	var i = 0;
	var j = 0;
	var mypieces;
	
	//fill left
	while(checkLeft(x-(i+1), y, color, true))
	{
		pieces = placePiece((y*8+(x-(i+1))), color, pieces);
		i++;
	}

	i=0; j=0;
	//fill right
	while(checkRight(x+(i+1), y, color, true))
	{
		pieces = placePiece((y*8+(x+(i+1))), color, pieces);
		i++;
	}
	
	i=0; j=0;
	//fill up
	while(checkUp(x, y-(j+1), color, true))
	{
		pieces = placePiece(((y-(j+1))*8+x), color, pieces);
		j++;
	}
	
	i=0; j=0;
	//fill down
	while(checkDown(x, y+(j+1), color, true))
	{
		pieces = placePiece(((y+(j+1))*8+x), color, pieces);
		j++;
	}
	
	i=0; j=0;
	//fill upleft
	while(checkUpLeft(x-(i+1), y-(j+1), color, true))
	{
		pieces = placePiece(((y-(j+1))*8+(x-(i+1))), color, pieces);
		i++; j++;
	}
	
	i=0; j=0;
	//fill downleft
	while(checkDownLeft(x-(i+1), y+(j+1), color, true))
	{
		pieces = placePiece(((y+(j+1))*8+(x-(i+1))), color, pieces);
		i++; j++;
	}
	
	i=0; j=0;
	//fill upright
	while(checkUpRight(x+(i+1), y-(j+1), color, true))
	{
		pieces = placePiece(((y-(j+1))*8+(x+(i+1))), color, pieces);
		i++; j++;
	}
	
	i=0; j=0;
	//fill downright
	while(checkDownRight(x+(i+1), y+(j+1), color, true))
	{
		pieces = placePiece(((y+(j+1))*8+(x+(i+1))), color, pieces);
		i++; j++;
	}
}

//This function returns whether or not a space is a valid move - color is the color of the player, not oppenent
function validateSpace(color, X, Y)
{
	space = Y*8+X;
	//Makes sure it's empty to begin with
	if(pieces[space] != "-")
		return false;
	
	if(checkLeft(X-1,Y,color, true) ||
		checkRight(X+1,Y,color, true) ||
		checkUp(X,Y-1,color, true) ||
		checkDown(X,Y+1,color, true) ||
		checkUpRight(X+1,Y-1,color, true) ||
		checkDownRight(X+1,Y+1,color, true) ||
		checkUpLeft(X-1,Y-1,color, true) ||
		checkDownLeft(X-1,Y+1,color, true))
			return true;
	
	return false;
}

//Function to count all the pieces on the board and display them
function pieceCount()
{
	var bCount = 0;
	var wCount = 0;
	for(var i = 0; i < 64; i++)
	{
		if(pieces[i] == "B")
			bCount++;
		if(pieces[i] == "W")
			wCount++;
	}
	
	$('#bcount').html(player1 + ": " + bCount + " pieces");
	$('#wcount').html(player2 + ": " + wCount + " pieces");
	
	if(bCount > wCount)
		return player1;
	return player2;
}

//-----------------------------------------Everything Below is a check<insert direction> function
function checkLeft(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
		
	if(pieces[space] == color)
		return true;
	else
		return checkLeft(x-1, y, color, false);
}

function checkRight(x, y, color, first)
{
	var space = y*8 + x;
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
			
	if(pieces[space] == color)
		return true;
	else
		return checkRight(x+1, y, color, false);
}

function checkUp(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
		
	if(pieces[space] == color)
		return true;
	else
		return checkUp(x, y-1, color, false);
}

function checkDown(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
		
	if(pieces[space] == color)
		return true;
	else
		return checkDown(x, y+1, color, false);
}

function checkUpRight(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
		
	if(pieces[space] == color)
		return true;
	else
		return checkUpRight(x+1, y-1, color, false);
}

function checkDownRight(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;

	if(pieces[space] == color)
		return true;
	else
		return checkDownRight(x+1, y+1, color, false);
}

function checkUpLeft(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
		
	if(pieces[space] == color)
		return true;
	else
		return checkUpLeft(x-1, y-1, color, false);
}

function checkDownLeft(x, y, color, first)
{
	var space = y*8 + x;
	
	if(pieces[space] == "-" || x < 0 || x > 7 || y < 0 || y > 7 || (pieces[space] == color && first))
		return false;
		
	if(pieces[space] == color)
		return true;
	else
		return checkDownLeft(x-1, y+1, color, false);
}