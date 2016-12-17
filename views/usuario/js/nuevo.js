$().ready(function () {
    $("#form1").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages:{
            username:{
                required: "Debe introducir el nombre de usuario"
            },
            password:{
                required: "Debe introducir la contraseña"
            }
        }
    })
});


