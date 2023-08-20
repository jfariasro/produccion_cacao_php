function evitarEspacios(event) {
    if (event.keyCode === 32) {
        event.preventDefault();
    }
}

const inputs = document.querySelectorAll('input[type="text"][onkeypress]'); // Obtener solo los campos de texto con el atributo onkeypress
for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keypress', function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            console.log('Presionaste Enter en el campo:', this.id);
        } else {
            evitarEspacios(event);
        }
    });
}
