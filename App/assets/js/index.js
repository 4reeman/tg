
let btn = $('#submit_btn');

function sendData() {
    let key =  $('#api_key').val()
    let url = 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . key;
    alert(key);
    // let Http = new XMLHttpRequest();
    // Http.open("GET", url, true);
    // Http.send();
    // Http.onload = function() {
    //     alert(`Loaded: ${Http.status} ${Http.response}`);
    // };
    // Http.onreadystatechange =(e)=>{
    //     console.log(Http.responseText);
    // }
    //
    // Http.onerror = function() {
    //     alert(`Network Error`);
    // };
    //
    // Http.onprogress = function(e) {
    //     alert(`Received ${e.loaded} of ${e.total}`);
    // };


    $.ajax({
        type: 'GET',
        url: "https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=" . key,
        crossDomain: true,
        success: function (data, textStatus, xhr) {
            console.log(data);
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });

    // $.ajax({
    //     url: 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . key,
    //     type: 'GET',
    //     contentType: 'application/json',
    //     success: function(){
    //         alert('hello');
    //     },
    //     error: function(){
    //         alert('error');
    //     }
    // });
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