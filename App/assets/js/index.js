
let btn = $('#submit_btn');

function sendData() {
    let key =  $('#api_key').val()
    let url = 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + key;
    $.ajax({
        type: 'GET',
        url: url,
        success: function(data, textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });
}
btn.on('click', ()=>{
   sendData();
});






let accordion = $('.accordion');

for (let i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}