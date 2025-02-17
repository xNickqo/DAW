window.onload = inicio;

function inicio(){
    let userInput = document.getElementById("userInput");

    userInput.addEventListener('submit', function(event){
        event.preventDefault();
        addTask();
    });
}

let idCounter = 0;

function addTask(){
    idCounter+=1;

    let input = document.querySelector('input[type="text"]');
    let newValue = input.value;

    let list = document.getElementById("list");
    list.innerHTML += ` <div class="task-container" id="${idCounter}">
                            <label for="">
                                <input type="checkbox">
                                ${newValue}
                            </label>
                            <img src="./IMAGES/delete.png" alt="" class="closeBtn">
                        </div>`;
    //console.log("idCounter = ", idCounter);
    
    input.value = '';
    updateStats();

    list.addEventListener('click', function(event){
        if(event.srcElement.nodeName == 'INPUT'){
            updateStats();
        } else if (event.srcElement.nodeName == 'IMG'){
            deleteTask(event.srcElement.parentNode.id);
        }
    });
}

function updateStats(){
    let stats = document.getElementById("stats");
    let element = list.querySelectorAll("div");
    let checkbox = list.querySelectorAll('input[type="checkbox"]:checked');
    stats.innerHTML = `Tareas pendientes: ${element.length} Completadas: ${checkbox.length}`;
}

function deleteTask(id){
    let taskToDelete = document.getElementById(id);
    list.removeChild(taskToDelete);
    updateStats();
}