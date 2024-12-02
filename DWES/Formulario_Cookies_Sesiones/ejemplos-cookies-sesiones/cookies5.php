<?php

/* Como ya hemos visto, una cookie es un archivo creado por un sitio de Internet para almacenar información en el equipo, como por ejemplo, 
tus preferencias cuando visitas ese sitio. Cuando visites un sitio que usa cookies, el sitio puede pedirle al navegador que guarde una o más cookies en el disco duro.

Las cookies a menudo guardan tu configuración de los sitios web, como tu idioma preferido o la ubicación. Así, cuando vuelves a ese sitio,
el navegador envía de nuevo las cookies que le pertenecen, lo que le permite presentarte información personalizada en función de tus necesidades. 

Navegadores (clientes Web):
	- Firefox -> todas las cookies se guardan en un solo archivo ubicado en la carpeta perfil 
				Carpeta: C:\Users\<your Windows login username>\AppData\Roaming\Mozilla\Firefox\Profiles
	- Chrome ->  Carpeta: C:\Users\<your Windows login username>\appdata\local\google\chrome\userdata\default
	- IE -> Carpeta: C:\Users\<your Windows login username>\AppData\Local\Microsoft\Windows\Temporary\Internet Files\??
Operaciones sobre cookies:
	- Habilitar y deshabilitar cookies que los sitios web utilizan para rastrear tus preferencias.
    - Borrar cookies: cómo eliminar cookies que ya haya guardado un sitio web.
    - Impedir que los sitios web guarden sus preferencias o estados de sesión.
    - Deshabilitar cookies de terceros: cómo impedir que un sitio web que no estés visitando guarde cookies. 

Configurar cookies:
Firefox -> Haz clic en el botón Menú y elige Opciones. Selecciona el panel Privacidad y seguridad y ve a la sección Cookies y datos del sitio. 
Chrome -> En la esquina superior derecha, haz clic en Más Configuración. En la parte inferior, haz clic en Avanzada. 
	      En la sección "Privacidad y seguridad", haz clic en Configuración de contenido. Haz clic en Cookies Ver todas las cookies y datos de sitios.
 */



 // La cookie caducará en un año 
  if(isset($_COOKIE['contador']))
  { //Si la cookie exite -> recuperamos el valor del número visitas
    setcookie('contador', $_COOKIE['contador'] + 1, time() + 365 * 24 * 60 * 60); 
    $mensaje = 'Número de visitas: ' . $_COOKIE['contador']; 
  } 
  else 
  { 
    // Si la cookie no existe -> es el primer acceso, por tanto mensaje de bienvenida
    setcookie('contador', 1, time() + 365 * 24 * 60 * 60); 
    $mensaje = 'Bienvenido a nuestra página web'; 
  } 
?> 
<?xml version="1.0" encoding="iso-8859-1"?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Prueba de cookie</title> 
</head> 
<body> 
<p> 
<?php echo "$mensaje"; ?> 
</p> 
</body> 
</html> 