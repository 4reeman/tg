let btn_key = $('#submit_key');
let btn_token = $('#submit_token');
let btn_telegram = $('#redirect');

let current_step = 1;

function validateKey() {
    let key =  $('#api_key').val()
    let url = 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + key;
    $.ajax({
        type: 'GET',
        url: url,
        success: function(data, textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            sendApiKey(key);
            step();
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            alert('Invalid Personal Key');
        }
    });
}

function validateToken() {
    let key =  $('#api_key').val()
    let token =  $('#api_token').val()
    let url = 'https://api.trello.com/1/members/me/?key=' + key + '&token=' + token;
    $.ajax({
        type: 'GET',
        url: url,
        success: function(data, textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            sendToken(token);
            step();
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            alert('Invalid Token');
        }
    });
}

btn_key.on('click', ()=>{
    validateKey();
});

btn_token.on('click', ()=>{
    validateToken();
});

btn_telegram.on('click', ()=>{
    sendButton();
});

function step() {
    let steps = document.querySelectorAll('.step');
    let bars = document.querySelectorAll('.progress_bar');
    let forms = document.querySelectorAll('.form_validation');

    steps[current_step-1].classList.add('successful_step');
    steps[current_step-1].classList.remove('current_step');
    steps[current_step].classList.add('current_step');
    bars[current_step-1].classList.add('successful_step');
    forms[current_step-1].classList.remove('active_form');
    forms[current_step].classList.add('active_form');

    current_step+=1;
}

function sendApiKey(key) {
    let url = 'https://server4reema.vps.webdock.cloud/index.php';
    $.ajax({
        url: url,
        type: 'POST',
        data: JSON.stringify({
            'user_id': getAllUrlParams(queryString).id,
            'api_key': key
        }),
        headers: {
            "Accept": "application/json; odata=verbose",
            "Source": "trello_authorization",
            "Data": "key"
        },
        processData: false,
        success: function(data, textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });
}

function sendToken(token) {
    let url = 'https://server4reema.vps.webdock.cloud/index.php';
    $.ajax({
        url: url,
        type: 'POST',
        data: JSON.stringify({
            'user_id': getAllUrlParams(queryString).id,
            'personal_token': token
        }),
        headers: {
            "Accept": "application/json; odata=verbose",
            "Source": "trello_authorization",
            "Data": "token"
        },
        processData: false,
        success: function(data, textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });
}

function sendButton() {
    let url = 'https://server4reema.vps.webdock.cloud/index.php';
    $.ajax({
        url: url,
        type: 'POST',
        data: JSON.stringify({
            'message': {
                'text': 'trello',
                'from': {
                    'id': getAllUrlParams(queryString).id
                }
            }
        }),
        headers: {
            "Accept": "application/json; odata=verbose",
            "Source": "trello_authorization",
            "Data": "message"
        },
        processData: false,
        success: function(data, textStatus, jqXHR){
            step();
            console.log(textStatus + ": " + jqXHR.status);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });
}

const queryString = window.location.search;

function getAllUrlParams(url) {
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
    var obj = {};

    if (queryString) {

        queryString = queryString.split('#')[0];

        var arr = queryString.split('&');

        for (var i = 0; i < arr.length; i++) {

            var a = arr[i].split('=');

            var paramName = a[0];
            var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

            paramName = paramName.toLowerCase();
            if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

            if (paramName.match(/\[(\d+)?\]$/)) {

                var key = paramName.replace(/\[(\d+)?\]/, '');
                if (!obj[key]) obj[key] = [];

                if (paramName.match(/\[\d+\]$/)) {
                    var index = /\[(\d+)\]/.exec(paramName)[1];
                    obj[key][index] = paramValue;
                } else {
                    obj[key].push(paramValue);
                }
            } else {

                if (!obj[paramName]) {
                    obj[paramName] = paramValue;
                } else if (obj[paramName] && typeof obj[paramName] === 'string'){
                    obj[paramName] = [obj[paramName]];
                    obj[paramName].push(paramValue);
                } else {
                    obj[paramName].push(paramValue);
                }
            }
        }
    }

    return obj;
}

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