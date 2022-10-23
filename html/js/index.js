// 1. Создаём новый XMLHttpRequest-объект
let btn = document.getElementById('submitBtn');

function sendData() {
    let btnValue = document.getElementById('submitBtn').value;
    alert(btnValue);
    let xhr = new XMLHttpRequest();

// 2. Настраиваем его: GET-запрос по URL /article/.../load
xhr.open('GET', 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + btnValue);

// 3. Отсылаем запрос
xhr.send();

// 4. Этот код сработает после того, как мы получим ответ сервера
xhr.onload = function() {
    if (xhr.status != 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
        alert(`Ошибка ${xhr.status}: ${xhr.statusText}`); // Например, 404: Not Found
    } else { // если всё прошло гладко, выводим результат
        alert(`Готово, получили ${xhr.response.length} байт`); // response -- это ответ сервера
    }
};
xhr.onprogress = function(event) {
    if (event.lengthComputable) {
        alert(`Получено ${event.loaded} из ${event.total} байт`);
    } else {
        alert(`Получено ${event.loaded} байт`); // если в ответе нет заголовка Content-Length
    }

};

xhr.onerror = function() {
    alert("Запрос не удался");
};

}

btn.addEventListener('click', () => {
    sendData();
});
// const btn = document.getElementById('submitBtn');
//
// function sendData() {
//     console.log('Sending data');
//
//     const XHR = new XMLHttpRequest();
//
//     const urlEncodedDataPairs = [];
//
//     // Turn the data object into an array of URL-encoded key/value pairs.
//     for (const [name, value] of Object.entries(data)) {
//         urlEncodedDataPairs.push(`${encodeURIComponent(name)}=${encodeURIComponent(value)}`);
//     }
//
//     // Combine the pairs into a single string and replace all %-encoded spaces to
//     // the '+' character; matches the behavior of browser form submissions.
//     const urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');
//
//     // Define what happens on successful data submission
//     XHR.addEventListener('load', (event) => {
//         alert('Yeah! Data sent and response loaded.');
//     });
//
//     // Define what happens in case of error
//     XHR.addEventListener('error', (event) => {
//         alert('Oops! Something went wrong.');
//     });
//
//     // Set up our request
//     XHR.open('GET', 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + 'ea3b9632108faebab5ffab2128e103ef');
//
//     // Add the required HTTP header for form data POST requests
//     XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//
//     // Finally, send our data.
//     // XHR.send(urlEncodedData);
//     XHR.send();
// }
//
// btn.addEventListener('click', () => {
//     sendData();
// })
