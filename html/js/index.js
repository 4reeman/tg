const btn = document.getElementById('submitBtn');

function sendData() {
    console.log('Sending data');

    const XHR = new XMLHttpRequest();

    const urlEncodedDataPairs = [];

    // Turn the data object into an array of URL-encoded key/value pairs.
    for (const [name, value] of Object.entries(data)) {
        urlEncodedDataPairs.push(`${encodeURIComponent(name)}=${encodeURIComponent(value)}`);
    }

    // Combine the pairs into a single string and replace all %-encoded spaces to
    // the '+' character; matches the behavior of browser form submissions.
    const urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

    // Define what happens on successful data submission
    XHR.addEventListener('load', (event) => {
        alert('Yeah! Data sent and response loaded.');
    });

    // Define what happens in case of error
    XHR.addEventListener('error', (event) => {
        alert('Oops! Something went wrong.');
    });

    // Set up our request
    XHR.open('GET', 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + 'ea3b9632108faebab5ffab2128e103ef');

    // Add the required HTTP header for form data POST requests
    XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Finally, send our data.
    // XHR.send(urlEncodedData);
    XHR.send();
}

btn.addEventListener('click', () => {
    sendData();
})
