<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instrucciones
- configure el archivo .env, según sus necesidades
- php artisan migrate
- php artisan db:seed
- php artisan serve

## Login

- Una vez generadas las tablas correspondientes y cargado los datos de prueba, seleccione un usuario creado de la tabla pay_users, seleciones un email e ingrese la contraseña genérica password
<p align="center">
<a href="https://develop.etarjetas.cl/images/imagenesiniciales/login.png" target="_blank"><img src="https://develop.etarjetas.cl/images/imagenesiniciales/login.png" alt="Build Status"></a>
</p>

## Una vez loguedo

- Una vez loguedo correctanmente se mostrará una vista de todos los clientes registrados
<p align="center">
<a href="https://develop.etarjetas.cl/images/imagenesiniciales/clientes.png" target="_blank"><img src="https://develop.etarjetas.cl/images/imagenesiniciales/clientes.png" alt="Build Status"></a>
</p>

### Ver historial de pagos

- Presione el botón history, el cual resteará la tabla inicial, mostrando a continuación el historial de pagos del cliente con su respectivo estado
<p align="center">
<a href="https://develop.etarjetas.cl/images/imagenesiniciales/historial.png" target="_blank"><img src="https://develop.etarjetas.cl/images/imagenesiniciales/historial.png" alt="Build Status"></a>

## Ver pagos pendientes

- Presione el botón Add Pay, el mostrará una ventana modal con la información de los pagos pendientes
<p align="center">
<a href="https://develop.etarjetas.cl/images/imagenesiniciales/actualizar.png" target="_blank"><img src="https://develop.etarjetas.cl/images/imagenesiniciales/actualizar.png" alt="Build Status"></a>

## Actualizar Pago

- Presione el botón Update del formulario presentado en la ventana modal, para enviar los datos de actualización del pago pendiente
<p align="center">
<a href="https://develop.etarjetas.cl/images/imagenesiniciales/actualizar.png" target="_blank"><img src="https://develop.etarjetas.cl/images/imagenesiniciales/actualizar.png" alt="Build Status"></a>

## Envió Email

- Una vez finalizado el proceso de actualización queda registrada la tarea para el envió del emai al destinatario del mismo pago
<p align="center">
<a href="https://develop.etarjetas.cl/images/imagenesiniciales/jobs.png" target="_blank"><img src="https://develop.etarjetas.cl/images/imagenesiniciales/jobs.png" alt="Build Status"></a>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
