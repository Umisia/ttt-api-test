var win_array = [
    [1,2,3], [4,5,6], [7,8,9],
    [1,4,7], [2,5,8], [3,5,9],
    [1,5,9],
    [3,5,7] ];
var available_fields = [1,2,3,4,5,6,7,8,9];
var won = false;

$(function() {
    //press on game board
    $("button").click(function() {
        if ($('#gameID').is(":empty")) {
            $('#errorText').html("start or load game first");
        } else if (!won){
            if ($(this).is(":empty")){
                this.innerText = "X";
                registerMove(this);  
                if (!won) {
                    computerMove();
                }
            }
        }   
    });

    $('#startGame').click(function (e) {
        $('#gameResult').html("");

        available_fields = [1,2,3,4,5,6,7,8,9];
        clearBoard();
        e.preventDefault(); 
        console.log("click create");
        const player1name = $("#player1").val();
        player_name = player1name;
        const dataplayer = { 'name': player1name };
        if (player1name) {
            get_userid_by_name(dataplayer);
            $('#displayPossitionsH2').html("");
            $('#displayEmptyPositions').show();
            won = false;
        } else {
            $('#errorText').html("provide a name");
        }
    });


    $('#displayGames').click(function (e) {
        $('#resultInfo').html("");
        e.preventDefault(); 
        displayGames();
    });


    $('#displayGamesByUser').click(function (e) {
        $('#resultInfo').html("");
        console.log('displayGamesByUser click');
        e.preventDefault(); 
        const username = $("#usernameSearch").val();
        if (username) {
            displayGamesByUser(username);
        } else {
            $('#errorText').html("provide an username");
        }
    });
        

    $('#displayEmptyPositions').click(function (e) {
        console.log('displayEmptyPositions click');
        e.preventDefault(); 
        $('#displayPossitionsH2').html(available_fields.join(" "));
    });

        
    $('#displayGameByID').click(function (e) {
        console.log('displayGameByID click');
        e.preventDefault(); 
        const gameid = $("#gamesSearch").val();
        if (gameid) {
            displayGameByID(gameid);
        } else {
            $('#errorText').html("provide a game id");
        }
    });


});
      
function get_userid_by_name(dataplayer){
    console.log('get user');
    $.ajax({
       method: "get",
       url: "http://localhost/ttt-api-test/api/user/get_id.php",
       data: dataplayer,
       success: function(response) {
           console.log(response);
           if (response.id >= 0) {
            const datagame = { 
                'userid': response.id,
                'result' : 3
             };
                console.log("user exists");
                create_game(datagame);
           } else {
                console.log("user not exists");
                create_user(dataplayer, create_game);
           }
       }, error: function(xhr, status, error) {
           console.log(status);
           console.log(error);
           console.log(xhr);
       }
   });
}

function create_game(data) {
    console.log('create game');
     $.ajax({
        method: "post",
        url: "http://localhost/ttt-api-test/api/game/create.php",
        data: JSON.stringify(data),
        success: function(response) {
            console.log(response);
            $('#gameID').text('Game ID: ' + response.id);
        }, error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    });
}

function create_user(data, callback) {
    console.log('create user');
    $.ajax({
        method: "post",
        url: "http://localhost/ttt-api-test/api/user/create.php",
        data: JSON.stringify(data),
        success: function(response) {
            console.log(response);
            // $('#displayInfo').html("user created");
            if (callback) {
                const datagame = { 
                    'userid': response.id,
                    'result' : 3
                 };
                callback(datagame);
            }
        }, error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    });
}

function checkWin() {
    win_array.forEach(function (arr, i) {
        var td1 = $("#field_"+(arr[0])).text();
        var td2 = $("#field_"+(arr[1])).text();
        var td3 = $("#field_"+(arr[2])).text();
        var gameresult = -1;

        if (td1 !== "" && td1 === td2 && td1 === td3){
            if (td1 === "X") {
                gameresult = 1 //player won
            } else if (td1 === "O") {
                gameresult = 0 //player lost
            }
            won = true;
            setGameResultText(gameresult)
            updateGameResult(gameresult);
        }
    }); 
}

function updateGameResult(gameresult) {
    // console.log("updateGameResult")
    const movedata = { 
        'id': $('#gameID').text().split(": ")[1],
        'result' : gameresult,
     };
     $.ajax({
        method: "patch",
        url: "http://localhost/ttt-api-test/api/game/update_result.php",
        data: JSON.stringify(movedata),
        success: function(response) {
            console.log(response);
        }, error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    });
}

function computerMove(){
    var randomItem = available_fields[Math.floor(Math.random()*available_fields.length)];
    var elementid = "field_" + randomItem;
    document.getElementById(elementid).innerText = "O";
    registerMove(document.getElementById(elementid));  
}

function registerMove(button_clicked) {
    console.log('register move');
    const button_id = $(button_clicked).attr('id');
    const field = button_id.split("_")[1];
    const symbol = $(button_clicked).text();
    const gameid = $('#gameID').text().split(": ")[1];
    const movedata = { 
        'gameid': gameid,
        'field' : field,
        'symbol': symbol
     };

     $.ajax({
        method: "post",
        url: "http://localhost/ttt-api-test/api/move/register.php",
        data: JSON.stringify(movedata),
        success: function(response) {
            console.log(response);
        }, error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
            console.log(xhr);
        }
    });
   //remove from available_fields array
    var index = available_fields.indexOf(parseInt(field));
    if (index >-1) {
        available_fields.splice(index, 1);
    }
    checkWin();
    //no more available moves, DRAW
    if (available_fields.length == 0 && !won) {
        won = true;
        setGameResultText(2);
        updateGameResult(2);
    }
}

function displayGames() {
    $.ajax({
        method: "get",
        url: "http://localhost/ttt-api-test/api/game/read.php",
        success: function(response) {
            if(response.hasOwnProperty('message')) {
                $('#errorText').html("no games found");
            } else {
                console.log(response)
                $.each(response.data, function(i, item){
                    var table_id = '';
                    if(item.result === "not finished") {
                        table_id = '#resultInfo2'
                    } else {
                        table_id = '#resultInfo'
                    }
                    $(table_id).append("<th>GAMEID</th><th>USERID</th><th>RESULT</th>")
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.id),
                        $('<td>').text(item.userid),
                        $('<td>').text(item.result),
                    )
                    .appendTo(table_id);
                });
            }
        }
    });
}

function displayGamesByUser(username) {
    $.ajax({
        method: "get",
        url: "http://localhost/ttt-api-test/api/game/read_by_username.php",
        data:{'username': username},
        success: function(response) {
            if(response.hasOwnProperty('message')) {
                $('#errorText').html("no user found");
            } else {
                console.log(response);
                $('#resultInfo').append("<th>GAMEID</th><th>GAMERESULT</th><th>USERID</th><th>USERNAME</th>")
                $.each(response.data, function(i, item){
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.gameid),
                        $('<td>').text(item.gameresult),
                        $('<td>').text(item.userid),
                        $('<td>').text(item.username),
                    )
                    .appendTo('#resultInfo');
                });
            }
        }
    });

}

function displayGameByID(gameid) {
    $.ajax({
        method: "get",
        url: "http://localhost/ttt-api-test/api/game/read_game.php",
        data:{'gameid': gameid},
        success: function(response) {
            console.log(response);
            if(response.hasOwnProperty('message')) {
                $('#errorText').html("game not found");
            } else {
                available_fields = [1,2,3,4,5,6,7,8,9];

                $('#displayPossitionsH2').html("");
                clearBoard();
                $('#displayEmptyPositions').show();
                $('#gameID').text('Game ID: ' + response.data[0].gameid);
                $('#gameResult').html("");
                //no moves recorded
                if (!response.data[0].field) {
                    console.log("no moves recorded")
                } else {
                    response.data.forEach(function (data, i){
                        //remove from available_fields array
                        var index = available_fields.indexOf(data.field);
                        if (index >-1) {
                            available_fields.splice(index, 1);
                        }

                        var button_id = 'field_'+ data.field.toString();
                        document.getElementById(button_id).innerText = data.symbol;
                    });
                }
                if (response.data[0].gameresult === 3){ //can continue
                    won = false;
                } else if (response.data[0].gameresult !== 2){
                    won = true;
                    setGameResultText(response.data[0].gameresult);
                }
            }
        }
    });
}

function setUsernameFromGame(userid) {
    $.ajax({
        method: "get",
        url: "http://localhost/ttt-api-test/api/user/read_single.php",
        data:{'id': userid},
        success: function(response) {
            player_name = response.name;
            console.log(player_name)
        }
    });
}

function setGameResultText(result) {
    if (result === 1) {
        $('#gameResult').html("PLAYER WON")
    }else if (result=== 0) {
        $('#gameResult').html("PLAYER LOST")
    }else if (result=== 2) {
        $('#gameResult').html("DRAW")
    }
}
function clearBoard(){ 
    var fields = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    fields.forEach(function (field) {
        document.getElementById('field_'+ field.toString()).innerText = "";
    });
}

function reset() {
    //could make a new game with the same user
    available_fields = [1,2,3,4,5,6,7,8,9];
    location.reload();
}