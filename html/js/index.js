
let btn = $('#submitBtn');

function sendData() {
    let apiKey = $('#Key').val();
    $.ajax({
        url: 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' ,
        type: "post",
        data: "baz=doh",
        success: function() {
            display("Done, look at your console's network tab");
        },
        error: function(jqXHR, textStatus, errorThrown){
            // log the error to the console
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
        }
    });
}
btn.on('click', ()=>{
   sendData();
});