var Listnerflag = false;
var createCards = false;

// event listner - auxilery click
document.addEventListener("auxclick",(e)=>{
   if(e.button === 1 && Listnerflag){
       $("#generateNumber").trigger("click");
   }
});

document.addEventListener("keyup",(e)=>{
    if(e.key === "Enter" && Listnerflag){
        $("#generateNumber").trigger("click");
    }
})



$(document).ready(()=>{
    // createCards the generateNumber button
    $("#createCards").prop('disabled',true);

    if(parseInt($("#amountofrolls").text())>0){
        createCards = true;
    }

    // setting a keyup listner
    $("#amountTxt").on('keyup',validateNextButton);

    // disabling or enabling the generateNumber
    $("#generateNumber").prop('disabled', parseInt($("#amountofrolls").text()) == 75);

    // creating the table
    $.get({
        url: "./api/createTable.php",
        success: async function( result ) {
            console.log(await result);
            tableRefresh(0);
        }
    });

    // verifying if there is cards set on the server end in the sessiom
    $.get({
        url:"./api/verifyCards.php",
        success:(result)=>{
            //
            $("#generateNumber").prop('disabled',result==0);
            $("#printCards").prop('disabled',result==0);
            Listnerflag = !(result==0);

        }
    });
    //checking if session has a victory
    victoryCheck();
    checkWins();
    // opening a new session old sessions saved on the database
    $("#newGame").click(()=>{
        window.location.replace("./api/newGame.php");
    });

    // create the cards
    $("#createCards").click(()=>{
        $.get({
            url: "./api/createCards.php",
            data:{amount:$("#amountTxt").val()},
            success: function ( result ) {
                console.log(result);
                $("#amountTxt").val("")
                $("#createCards").prop('disabled',true);
            }
        });
        // enabling the generateNumber button
        $("#generateNumber").prop('disabled',false);
        // enabling the printCards button
        $("#printCards").prop('disabled',false);
        // setting the listnerlag to true
        Listnerflag = true;
    });

    // click event - generating the next number
    $("#generateNumber").click(()=>{
        createCards = false;
        // should add wins to cards that filled some rows

        if(victoryCheck()) {
            $.get({
                url: "./api/generateNumber.php",
                success: (result) => {
                    // console.log(result);
                    tableRefresh(result);
                },
                error: err => {
                    console.log(err);
                }
            });

            Listnerflag = !(parseInt($("#amountofrolls").text()) == 74);


        }
        checkWins();
    });

    // click event - runs the show cards function
    $("#showCards").click(()=>{
        $.get({
            url: "./api/printCards.php",
            success: async function( result ) {
                showCards(result);
            },
        });
    });

    // click event - runs the print cards function
    $("#printCards").click(()=>{
        $.get({
            url: "./api/printCards.php",
            success: async function( result ) {
                print(result);
            },
        });
    });

});

// ********************************* functions section ****************************************************

// preventing pressing the create button when empty
function validateNextButton() {
    var buttonDisabled = $('#amountTxt').val().trim() === '' ;
    $('#createCards').prop('disabled', buttonDisabled || parseInt($("#amountofrolls").text())>0);
}

function checkWins(){
    $.get({
        url: "./api/checkWins.php",
        success: function (result) {
            $("#test").html(result);
        },
        error: (err) => {
            console.log(err);
        }
    });
}


// under work
function victoryCheck(){
    let flag = $.get({
        url:"./api/victory.php",
        success:(res)=>{
            if(res){
                arr = JSON.parse(res);
            }
            if(arr.length>0){
                $("#generateNumber").prop('disabled',true);
                Listnerflag = false;
                let winners="Winning cards: ";
                for(let x in arr){
                   winners += arr[x]+", ";
                }
                $("#victors").html(winners);
                return false;
            }
            else{
                return true;
            }
        },
        error:(err)=>{
            console.log(err);
        }
    });
    return flag;
}


// reloading the page on command
function reload(){ location.reload(); }

// refreshing the table when it called to
function tableRefresh(number){
    $.get({
        url: "./api/printTable.php",
        data: {
            number:number
        },
        success: function( result ) {
            $("#table").html(result);
        },
    });
}

// opening a new tab for printing the cards
function print(data){
    PrintPage = window.open(``);
    PrintPage.document.write(`
        <link rel="stylesheet" href="./dist/css/bootstrap-grid.css">
        <link rel="stylesheet" href="./dist/css/bootstrap.css">
        <link rel="stylesheet" href="./dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./print.css">
        <title>Print</title>
         `)
    PrintPage.document.write(data);
    PrintPage.document.write(`
    <script>
        setTimeout(function () { window.print(); }, 500);
        window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
    </script>`);
}

// opening a new tab to show the cards
function showCards(data){
    PrintPage = window.open(``);
    PrintPage.document.write(`
        <link rel="stylesheet" href="./dist/css/bootstrap-grid.css">
        <link rel="stylesheet" href="./dist/css/bootstrap.css">
        <link rel="stylesheet" href="./dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./print.css">
        <title>Cards</title>
         `)
    PrintPage.document.write(data);
}

