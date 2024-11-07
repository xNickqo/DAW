window.onload = inicio;

function inicio()
{
    document.form.Calcular.onclick=primos;
}

function primos()
{
    document.form.primos.value = "";
    let num = 1;
    let inicial = document.form.inicial.value;
    let final = document.form.final.value;

    num = inicial;
    while (num <= final)
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
        }
        num++;
    }
}
