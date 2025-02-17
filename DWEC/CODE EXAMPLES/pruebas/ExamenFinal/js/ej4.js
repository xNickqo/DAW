window.onload = inicio;

function inicio(){
    // Manejar el envío del formulario
    document.getElementById('dataForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const title = document.getElementById('title').value;
        const body = document.getElementById('body').value;

        const formData = {
            title: title,
            body: body,
            userId: 1
        };

        // Usar los tres métodos diferentes
        sendWithXMLHttpRequest(formData);
        sendWithFetch(formData);
        sendWithAJAX(formData);
    });
}

// Enviar datos usando XMLHttpRequest
function sendWithXMLHttpRequest(formData) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://jsonplaceholder.typicode.com/posts', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 201) {
            document.getElementById('response').innerHTML = `<pre>${xhr.responseText}</pre>`;
        }
    };
    xhr.send(JSON.stringify(formData));
}

// Enviar datos usando Fetch API
function sendWithFetch(formData) {
    fetch('https://jsonplaceholder.typicode.com/posts', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('response').innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
    })
    .catch(error => {
        document.getElementById('response').innerHTML = `Error: ${error}`;
    });
}

// Enviar datos usando $.ajax() de jQuery
function sendWithAJAX(formData) {
    $.ajax({
        url: 'https://jsonplaceholder.typicode.com/posts',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function(response) {
            document.getElementById('response').innerHTML = `<pre>${JSON.stringify(response, null, 2)}</pre>`;
        },
        error: function(xhr, status, error) {
            document.getElementById('response').innerHTML = `Error: ${error}`;
        }
    });
}