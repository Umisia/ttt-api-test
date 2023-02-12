
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<script type="text/javascript" src="jquery-3.6.2.js"></script>
	<link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="scripts.js"></script>
</head>

<body>
	<div class = "head"> 
		<div class = "top">
			<label>Player 1</label>
			<input type="text" id="player1" name="player1" >
			<input type="button" value="Start new game!" id="startGame">
		</div>

		<h2 style = "margin-left:100px" class= "top" id= "gameID" ></h2>

		<div class = "top" >
		<input style="display:none" type="button" value="get empty positions"  id="displayEmptyPositions">
		<label id = "displayPossitionsH2"></label>
		</div>
		</div>
		<br>
		
		<div class = "mid" style="clear:both; margin-top: 60px">
		<label>username search</label>
			<input type="text" id="usernameSearch" ><br>
			<input type="button" value="get all games by username" id="displayGamesByUser">
		</div><br>
			
		<div class = "mid" >
			<label>game id search</label>
			<input type="text" id="gamesSearch" ><br>
			<input type="button" value="load game by id" id="displayGameByID">

		</div><br>
		<input class = "mid" type="submit" value="get all games" id="displayGames" name="displayInfoBtn">
			
	
		<h2 style= "color:red" id = "errorText"></h2>
		<div>
		<table id="resultInfo" width=10%; border=1; cellpading=5;></table> <br><br>
		</div>
		<div>
		<table id="resultInfo2" width=10%; border=1; cellpading=5;></table>
		</div>
	
		<div class="container-fluid text-center">
			<h4 id="gameResult"></h4>
		</div>
	<br>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4">  </div>
			<div class="col-lg-4">
				<center>
					<table id = "game_table">
						<tr>
							<td>
								<button id="field_1"></button>
							</td>
							<td>
								<button id="field_2"></button>
							</td>
							<td>
								<button id="field_3"></button>
							</td>
						</tr>
						<tr>
							<td>
								<button id="field_4"></button>
							</td>
							<td>
								<button id="field_5"></button>
							</td>
							<td>
								<button id="field_6"></button>
							</td>
						</tr>
						<tr>
							<td>
								<button id="field_7"></button>
							</td>
							<td>
								<button id="field_8"></button>
							</td>
							<td>
								<button id="field_9"></button>
							</td>
						</tr>
					</table>
					<br>
					<br>
					<input type="button"
						class="reset btn btn-lg btn-danger btn-block"
						value="FINISH" onClick="reset()" />
				</center>
			</div>
	
		</div>
	</div>
    
    <style>
		.header {
			display: block;
		}
		.top {
			float: left;
			margin-top:20px;
			margin-left:20px;
		}
		.mid {
			margin-top:20px;
			margin-left:20px;
		}
        button {
            height: 80px;
            width: 80px;
            background-color: white;
            margin: 4px;
            padding: 4px;
			font-size: 48px;
        }
		.resulttable {
			font-size: 18px;
            padding: 4px;


		}
    </style>

</body>

</html>
