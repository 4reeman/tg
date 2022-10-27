
let btn = $('#submit_btn');

function sendData() {
    let key =  $('#api_key').val()

    $.ajax({
        url: 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . key,
        type: 'GET',
        contentType: 'application/json',
        success: function(){
            alert('hello');
        },
        error: function(){
            alert('error');
        }
    });
//     $.ajax({
//         url: "https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=" . key,
//         type: "GET",
//         data: "",
//         statusCode: {
//             404: function (responseObject, textStatus, jqXHR) {
//                 alert('404');
//                 // No content found (404)
//                 // This code will be executed if the server returns a 404 response
//             },
//             503: function (responseObject, textStatus, errorThrown) {
//                 // Service Unavailable (503)
//                 // This code will be executed if the server returns a 503 response
//             }
//         }
//
//     })
// .done(function(data){
//         alert(data);
//     })
//         .fail(function(jqXHR, textStatus){
//             alert('Something went wrong: ' + textStatus);
//         })
//         .always(function(jqXHR, textStatus) {
//             alert('Ajax request was finished')
//         });

}
btn.on('click', ()=>{
   sendData();
});

let accordion = $('.accordion');

for (let i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener("click", function() {
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



// url: 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . key,
// type: "get",
// data: "",
// success: function() {
//     alert("Done, look at your console's network tab");
// },
// error: function(jqXHR, textStatus, errorThrown){
//     // log the error to the console
//     console.log(
//         "The following error occured: "+
//         textStatus, errorThrown
//     );
// }