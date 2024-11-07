window.onload = inicio;

function inicio()
{
    console.log("Funcion Inicio Llamada");
    primos();
}

function primos()
{
    document.form.primos.value = "";
    let num = 1;
    let countprimos = 0;

    while (countprimos <= 100)
    {
        let i = 1;
        let count = 0;
        while (i <= num)
        {
            if (num % i == 0)
                count++;
            i++;
        }
        if (count === 2)
        {
            document.form.primos.value += num + "|";
            countprimos++;
        }
        num++;
    }
}
