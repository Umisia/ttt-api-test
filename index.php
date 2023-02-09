<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="scripts.js"></script>
</head>

<body>
		<form id="form">
			<label for="player1">Player 1</label><br>
			<input type="text" id="player1" name="player1" ><br>
			<label for="player2">Player 2</label><br>
			<input type="text" id="player2" name="player2"><br><br>
			<input type="button" value="Ready" onclick="submitClick()">
		  </form> 

		<div class="container-fluid text-center">
			<h4 id="screen">PLAYER 1</h4>
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
								<button class="sq1"></button>
							</td>
							<td>
								<button class="sq2"></button>
							</td>
							<td>
								<button class="sq3"></button>
							</td>
						</tr>
						<tr>
							<td>
								<button class="sq4"></button>
							</td>
							<td>
								<button class="sq5"></button>
							</td>
							<td>
								<button class="sq6"></button>
							</td>
						</tr>
						<tr>
							<td>
								<button class="sq7"></button>
							</td>
							<td>
								<button class="sq8"></button>
							</td>
							<td>
								<button class="sq9"></button>
							</td>
						</tr>
					</table>
					<br>
					<br>
					<input type="button"
						class="reset btn btn-lg btn-danger btn-block"
						value="RESET" onClick="reset()" />
				</center>
			</div>
	
		</div>
	</div>
    
    <style>
		form {
			margin: 10px;
		}
        button {
            height: 80px;
            width: 80px;
            background-color: white;
            margin: 4px;
            padding: 4px;
			font-size: 48px;
        }
    </style>

</body>

</html>
