// 1. Selección de elementos
let form = document.forms.userForm;
let userListDiv = document.getElementById("userList");
let addUserBtn = document.getElementById("addUserBtn");

// 2. Evento para agregar usuario
addUserBtn.addEventListener("click", addUser);

// Función para agregar un usuario a la lista
function addUser() {
    let name = form.name.value;
    let email = form.email.value;

    if (!name || !email) {
        alert("Por favor completa todos los campos.");
        return;
    }

    // 3. Crear los elementos necesarios
    let userDiv = document.createElement("div");
    userDiv.classList.add("user-item");

    let nameText = document.createTextNode("Nombre: " + name);
    let emailText = document.createTextNode(" | Correo: " + email);
    let lineBreak = document.createElement("br");

    // 4. Botón de eliminar
    let deleteBtn = document.createElement("button");
    deleteBtn.textContent = "Eliminar";
    deleteBtn.onclick = () => deleteUser(userDiv);

    // 5. Botón de editar
    let editBtn = document.createElement("button");
    editBtn.textContent = "Editar";
    editBtn.onclick = () => editUser(userDiv, name, email);

    // 6. Append de todos los elementos
    userDiv.appendChild(nameText);
    userDiv.appendChild(emailText);
    userDiv.appendChild(lineBreak);
    userDiv.appendChild(editBtn);
    userDiv.appendChild(deleteBtn);
    userListDiv.appendChild(userDiv);

    // 7. Limpiar formulario
    form.reset();
}

// Función para eliminar usuario
function deleteUser(userDiv) {
    userListDiv.removeChild(userDiv);
}

// Función para editar usuario
function editUser(userDiv, name, email) {
    // Crear campos para editar el nombre y el email
    let editName = prompt("Nuevo nombre:", name);
    let editEmail = prompt("Nuevo correo:", email);

    if (editName && editEmail) {
        userDiv.childNodes[0].textContent = "Nombre: " + editName;
        userDiv.childNodes[1].textContent = " | Correo: " + editEmail;
    } else {
        alert("Por favor, introduce datos válidos.");
    }
}
