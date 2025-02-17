document.addEventListener("DOMContentLoaded", function () {
    let formContainer = document.getElementById("form-container");
    let form = document.createElement("form");
    form.id = "miFormulario";

    let fields = [
        { id: "nombre", label: "Nombre: ", type: "text"},
        { id: "correo", label: "Correo Electrónico: ",},
        { id: "tel", label: "Teléfono: ", type: "text"},
        { id: "dir", label: "Dirección: ", type: "text"},
        { id: "codigoPostal", label: "Código Postal: ", type: "text"}
    ];

    fields.forEach(field => {
        let div = document.createElement("div");
        let label = document.createElement("label");
        let input = document.createElement("input");

        label.textContent = field.label;
        input.type = field.type;
        input.id = field.id;

        div.appendChild(label);
        div.appendChild(input);
        form.appendChild(div);
    });

    // Botón de enviar
    let submitButton = document.createElement("button");
    submitButton.textContent = "Enviar";
    submitButton.type = "submit";
    form.appendChild(submitButton);

    formContainer.appendChild(form);
});