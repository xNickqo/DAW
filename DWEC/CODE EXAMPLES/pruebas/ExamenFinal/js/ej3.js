document.addEventListener("DOMContentLoaded", function () {
    let passwordInput = document.getElementById("password");
    let form = document.getElementById("formulario");

    // Crear dinámicamente el <span> para el error
    let errorSpan = document.createElement("span");
    errorSpan.style.color = "red";
    passwordInput.insertAdjacentElement("afterend", errorSpan);

    // Crear dinámicamente el <p> para la seguridad de la contraseña
    let strengthText = document.createElement("p");
    passwordInput.insertAdjacentElement("afterend", strengthText);

    // Validar la contraseña en tiempo real
    passwordInput.addEventListener("input", function () {
        let password = this.value;
                errorSpan.textContent = "";
                strengthText.textContent = "";
                strengthText.style.color = "";

                if (password.length < 6) {
                    errorSpan.textContent = "La contraseña debe tener al menos 6 caracteres.";
                    strengthText.textContent = "Débil";
                    strengthText.style.color = "red";
                    return;
                }

                let esFuerte = password.length >= 10 && tieneNumeros(password) && tieneMayusculas(password) && tieneEspeciales(password);
                let esMedia = password.length >= 8 && (tieneNumeros(password) || tieneMayusculas(password));

                if (esFuerte) {
                    strengthText.textContent = "Fuerte";
                    strengthText.style.color = "green";
                } else if (esMedia) {
                    strengthText.textContent = "Media";
                    strengthText.style.color = "orange";
                } else {
                    strengthText.textContent = "Débil";
                    strengthText.style.color = "red";
                }
    });

    // Bloquear el envío si la contraseña es débil
    form.addEventListener("submit", function (e) {
        if (passwordInput.value.length < 6) {
            e.preventDefault();
            errorSpan.textContent = "La contraseña no cumple con los requisitos mínimos.";
        } else {
            window.alert("Enviado");
        }
    });
});

// Función para verificar tipos de caracteres
function tieneNumeros(password) {
    for (let i = 0; i < password.length; i++) {
        if (password[i] >= "0" && password[i] <= "9") {
            return true;
        }
    }
    return false;
}

function tieneMayusculas(password) {
    for (let i = 0; i < password.length; i++) {
        if (password[i] >= "A" && password[i] <= "Z") {
            return true;
        }
    }
    return false;
}

function tieneEspeciales(password) {
    let caracteresEspeciales = "@#$%^&*()_+-=[]{};:'\"\\|,.<>/?";
    for (let i = 0; i < password.length; i++) {
        if (caracteresEspeciales.includes(password[i])) {
            return true;
        }
    }
    return false;
}