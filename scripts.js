$(function() {
    var turn = 1;
  
    $("button").click(function() {
        console.log(getRowIndex(this));
        console.log(getColumnIndex(this));
        if ($(this).is(":empty")){
           
            if(turn == 1) {
                $("#screen").text("PLAYER 2");
                this.innerText = "X";
                turn = 2;           
            } else {   
                $("#screen").text("PLAYER 1");
                this.innerText = "O";
                turn = 1;
            }
        }
        // checkWin(this);
    });
});

function reset() {
    location.reload();
}
// function checkWin(elementClicked) {
//     const symbol = elementClicked.innerText;
//     const column_index = getColumnIndex(elementClicked);
//     const row_index = getRowIndex(elementClicked);
//     const table = document.querySelector('#game_table')
//     console.log(table.rows[row_index].cells[column_index]);
//     console.log(elementClicked);
//     console.log($('#game_table').eq(row_index).find('td').eq(column_index).text());
// }
function submitClick() {
    const player1name = $("#player1").val();
    const player2name = $("#player2").val();
    const data = {
        player1: player1name,
        player2: player2name
    };
    
    fetch('logic.php', {
        method: 'POST',
        headers: { 
            'Accept': 'application/json, text/plain, */*',
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => console.log(response.text()))
    // .then(response => $("#screen").html(response.text()))

}

function getRowIndex(element) {
    return $(element).parent().index();
}

function getColumnIndex(element) {
    return $(element).parent().parent().index();
}