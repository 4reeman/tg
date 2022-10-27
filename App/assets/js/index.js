
let btn = $('#submit_btn');

function sendData() {
    let key =  $('#api_key').val()
    $.ajax({
        url: 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . key,
        type: "get",
        data: "",
        success: function() {
            alert("Done, look at your console's network tab");
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

let accordion = $('.accordion');

for (let i = 0; i < accordion.length; i++) {
    accordion[i].on("click", ()=>{
        this.classList.toggle("active");
        console.log(this.nextElementSibling);
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}