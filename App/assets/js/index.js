let btn = $('#submit_key');

function validateKey() {
    let key =  $('#api_key').val()
    let url = 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + key;
    $.ajax({
        type: 'GET',
        url: url,
        success: function(data, textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            $('.main').children('.form_validation').toggleClass('active_form');
            sendApiKey(key);
            return true;
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            alert('Invalid Personal Key');
            return false;
        }
    });
}

btn.on('click', ()=>{
    if (validateKey()) {
        $successful_step = $('.progress').children('.step:not([successful_step])');
        $successful_bar = $('.progress').children('.progress_bar:not([successful_step])');
        $.merge($successful_step, $successful_bar).addClass('successful_step');
    }
});

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

const queryString = window.location.search;

function getAllUrlParams(url) {

    // get query string from url (optional) or window
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // we'll store the parameters here
    var obj = {};

    // if query string exists
    if (queryString) {

        // stuff after # is not part of query string, so get rid of it
        queryString = queryString.split('#')[0];

        // split our query string into its component parts
        var arr = queryString.split('&');

        for (var i = 0; i < arr.length; i++) {
            // separate the keys and the values
            var a = arr[i].split('=');

            // set parameter name and value (use 'true' if empty)
            var paramName = a[0];
            var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

            // (optional) keep case consistent
            paramName = paramName.toLowerCase();
            if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

            // if the paramName ends with square brackets, e.g. colors[] or colors[2]
            if (paramName.match(/\[(\d+)?\]$/)) {

                // create key if it doesn't exist
                var key = paramName.replace(/\[(\d+)?\]/, '');
                if (!obj[key]) obj[key] = [];

                // if it's an indexed array e.g. colors[2]
                if (paramName.match(/\[\d+\]$/)) {
                    // get the index value and add the entry at the appropriate position
                    var index = /\[(\d+)\]/.exec(paramName)[1];
                    obj[key][index] = paramValue;
                } else {
                    // otherwise add the value to the end of the array
                    obj[key].push(paramValue);
                }
            } else {
                // we're dealing with a string
                if (!obj[paramName]) {
                    // if it doesn't exist, create property
                    obj[paramName] = paramValue;
                } else if (obj[paramName] && typeof obj[paramName] === 'string'){
                    // if property does exist and it's a string, convert it to an array
                    obj[paramName] = [obj[paramName]];
                    obj[paramName].push(paramValue);
                } else {
                    // otherwise add the property
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