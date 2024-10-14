var alertList = document.querySelectorAll('.alert')
alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
})

//Validar Login
function login(obj) {
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe ingresar su nombre de usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (username.length < 3){
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "¡Parece que faltan algunos dígitos en el usuario que ingresaste!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return (false);
    }
    var contraseña = obj.contraseña.value;
    if (!contraseña) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe  ingresar su contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.contraseña.focus();
        return false;
    }
    if (contraseña.length < 4){
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "¡Parece que faltan algunos dígitos en la contraseña que ingresaste!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.contraseña.focus();
		return (false);
	}
    
}

//Validar Login boton del correo
function Email(obj) {
    var email_login= obj.email_login.value;
    if (!email_login) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "Debe ingresar su correo",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
 
        obj.email_login.focus();
        return false;
    }

    if (email_login.trim() == "") {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "El campo de gmail no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email_login.focus();
        return false;
    }

    if (/^([a-zA-Z0-9])\1+$/.test(email_login)) {
        Swal.fire({
            title: '¡Atención Usuario!',
            text: "El campo de gmail no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.email_login.focus();
        return false;
    }
    
}

//Validar Registro de USUARIO
function registrousuario(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un nombre",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }
    if (name.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return (false);
    }
    if (name.trim() == "") {
        Swal.fire({
           title: 'Registro de Usuario',
           text: "El campo de nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
      
       obj.name.focus();
       return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(name)) {
         Swal.fire({
            title: 'Registro de Usuario',
            text: "El campo de nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.name.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(name)) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.name.focus();
        return false;
    }
    var nameA = obj.nameA.value;
    if (!nameA) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un apellido",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nameA.focus();
        return false;
    }
    if (nameA.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nameA.focus();
        return (false);
    }
    if (nameA.trim() == "") {
        Swal.fire({
           title: 'Registro de Usuario',
           text: "El campo de nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
      
       obj.nameA.focus();
       return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(nameA)) {
         Swal.fire({
            title: 'Registro de Usuario',
            text: "El campo de nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nameA.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(nameA)) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nameA.focus();
        return false;
    }
    var email = obj.email.value;
    if (!email) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un e-mail",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.email.focus();
        return false;
    }
    if (email.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.email.focus();
        return (false);
    }
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar un nombre de usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (username.length < 3){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return (false);
    }
    // var rol = obj.rol.value;
    // if (rol==0){
    //     alert("Debe de seleccionar el Rol del Usuario");
    //     return (false);
    // }
    var password = obj.password.value;
    if (!password) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password.focus();
        return false;
    }
    if (password.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texo o numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
		
		obj.password.focus();
		return (false);
	}
    var password_confirmation = obj.password_confirmation.value;
    if (!password_confirmation) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Debe de ingresar la confirmación de la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password_confirmation.focus();
        return false;
    }
    if (password_confirmation.length < 4){
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Faltan dígitos en este campo de texto o numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
	
		obj.password_confirmation.focus();
		return (false);
	}
    if (password_confirmation != password) {
        Swal.fire({
            title: 'Registro de Usuario',
            text: "Las contraseñas no coinciden",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password_confirmation.focus();
        return false;
    }
    
}

//Validar Roles
function roles(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Rol',
            text: "Debe de ingresar el nombre del rol.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }
    if (name.length < 2){
		Swal.fire({
            title: 'Rol',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.name.focus();
		return (false);
	}
    if (name.trim() == "") {
        Swal.fire({
            title: 'Rol',
            text: "El campo de rol no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }

    if (/(\w)\1+/i.test(name.toLowerCase())) {
    Swal.fire({
            title: 'Rol',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

}

//Validar Usuario
function usuario(obj) {
    var name = obj.name.value;
    if (!name) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el nombre del usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }
    if (name.length < 3){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.name.focus();
		return (false);
	}
    if (name.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de nombre del usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.name.focus();
        return false;
    }

    if (/(\w)\1+/i.test(name.toLowerCase())) {
    Swal.fire({
            title: 'Usuario',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

    var email = obj.email.value;
    if (!email) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el e-mail",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
    
        obj.email.focus();
        return false;
    }
    if (email.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.email.focus();
		return (false);
	}
    if (email.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de e-mail no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.email.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(email)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de e-mail no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.version.focus();
        return false;
    }
    var username = obj.username.value;
    if (!username) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar el usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (username.length < 2){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.username.focus();
		return (false);
	}
    if (username.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(username)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de usuario no debe contener solo caracteres repetidos",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.username.focus();
        return false;
    }
    var password = obj.password.value;
    if (!password) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar la contraseña.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password.focus();
        return false;
    }
    if (password.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.password.focus();
		return (false);
	}
    if (password.trim() == "") {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de Contraseña no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.password.focus();
        return false;
    }
    // if (/^([a-zA-Z0-9])\1+$/.test(password)) {
    //     alert("El Campo Contraseña no debe contener solo Caracteres Repetidos.");
    //     obj.version.focus();
    //     return false;
    // }
    var confirm_password = obj.confirm_password.value;
    if (!confirm_password) {
        Swal.fire({
            title: 'Usuario',
            text: "Debe de ingresar la confirmación de la contraseña",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.confirm_password.focus();
        return false;
    }
    if (confirm_password.length < 4){
        Swal.fire({
            title: 'Usuario',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.confirm_password.focus();
		return (false);
	}
    if (confirm_password != password) {
        Swal.fire({
            title: 'Usuario',
            text: "Las contraseñas no coinciden",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.confirm_password.focus();
        return false;
    }
}

//Validar SOLICITANTE natrural
function Solicitante(obj) {
    var cedula = obj.cedula.value;
   if (!cedula) {
       Swal.fire({
           title: 'Solicitante',
           text: "Debe de ingresar la cédula.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.cedula.focus();
       return false;
   }

   if (cedula.length < 7 || cedula.length > 8){
    Swal.fire({
        title: 'Solicitante',
        text: "La cédula no puede tener más de 8 dígitos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.cedula.focus();
    return (false);
    }


   var nombre = obj.nombre.value;
   if (!nombre) {
       Swal.fire({
           title: 'Solicitante',
           text: "Debe de ingresar un nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.nombre.focus();
       return false;
   }
   if (nombre.length < 3){
       Swal.fire({
           title: 'Solicitante',
           text: "Faltan dígitos en este campo de nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return (false);
   }
   if (nombre.trim() == "") {
       Swal.fire({
           title: 'Solicitante',
           text: "El Campo del nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return false;
   }

   if (/(\w)\1+/i.test(nombre.toLowerCase())) {
    Swal.fire({
            title: 'Solicitante',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

//    if (/^[A-Z][a-zA-Z0-9]*$/.test(nombre)) {
//        Swal.fire({
//            title: 'Solicitante',
//            text: "El campo del nombre no debe contener caracteres repetidos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.nombre.focus();
//        return false;
//    }

   var apellido = obj.apellido.value;
   if (!apellido) {
       Swal.fire({
           title: 'Solicitante',
           text: "Debe de ingresar el apellido.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
   
       obj.apellido.focus();
       return false;
   }
   if (apellido.length < 4){
       Swal.fire({
           title: 'Solicitante',
           text: "Faltan dígitos en este campo de apellido.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       
       obj.apellido.focus();
       return (false);
   }
   if (apellido.trim() == "") {
       Swal.fire({
           title: 'Solicitante',
           text: "El campo de apellido no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.apellido.focus();
       return false;
   }
   if (/(\w)\1+/i.test(apellido.toLowerCase())) {
    Swal.fire({
            title: 'Solicitante',
            text: "El campo del apellido no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.apellido.focus();
        return false;
    }

//    if (/^[A-Z][a-zA-Z0-9]*$/.test(apellido)) {
//        Swal.fire({
//            title: 'Solicitante',
//            text: "El campo de apellido no debe contener caracteres repetidos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
       
//        obj.apellido.focus();
//        return false;
//    }
//  
}

// Validar SOLICITANTE JURIDICO
function Solicitante_juridico(obj) {    
    var rif = obj.rif.value;
    // Expresión regular que verifica que comience con una letra mayúscula seguida por 9 números y puede contener guiones
    var regex = /^[A-Z]-?\d{9,10}$/;

    if (!rif) {
        Swal.fire({
            title: 'Solicitante',
            text: "Debe de ingresar el RIF.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
        
        obj.rif.focus();
        return false;
    } else if (!regex.test(rif)) {
        Swal.fire({
            title: 'Solicitante',
            text: "El RIF debe comenzar con una letra mayúscula, seguido por números y puede contener guiones.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        });

        obj.rif.focus();
        return false;
    }


    if (rif.trim() == "") {
        Swal.fire({
            title: 'Solicitante',
            text: "El Campo del RIF de la empresa no debe contener espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.rif.focus();
        return false;
    }

    // if (/(\w)\1+/i.test(rif.toLowerCase())) {
    //     Swal.fire({
    //             title: 'Solicitante',
    //             text: "El campo del RIF no debe contener caracteres repetidos.",
    //             icon: 'warning',
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             }).then((result) => {
    //         if (result.isConfirmed) {
    
    //             this.submit();
    //         }
    //         })
            
    //         obj.rif.focus();
    //         return false;
    //     }

    if (/^([a-zA-Z0-9])\1+$/.test(rif)) {
        Swal.fire({
            title: 'Solicitante',
            text: "El campo del RIF de empresa no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

   var nombre_empresa = obj.nombre_empresa.value;
   if (!nombre_empresa) {
       Swal.fire({
           title: 'Solicitante',
           text: "Debe de ingresar un nombre de la empresa.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.nombre_empresa.focus();
       return false;
   }
   if (nombre_empresa.length <= 4){       //FALTA ACOMODAR
       Swal.fire({
           title: 'Solicitante',
           text: "Faltan más infromación del nombre de la empresa.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre_empresa.focus();
       return (false);
   }
   if (nombre_empresa.trim() == "") {
       Swal.fire({
           title: 'Solicitante',
           text: "El Campo de nombre de la empresa no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre_empresa.focus();
       return false;
   }

   var email_empresa= obj.email_empresa.value;
   if (!email_empresa) {
       Swal.fire({
           title: 'Solicitante',
           text: "Debe ingresar su correo",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
   
       obj.email_empresa.focus();
       return false;
   }

   if (email_empresa.trim() == "") {
       Swal.fire({
           title: 'Solicitante',
           text: "El campo de gmail no debe contener espacios en blanco.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.email_empresa.focus();
       return false;
   }

   if (/^([a-zA-Z0-9])\1+$/.test(email_empresa)) {
       Swal.fire({
           title: 'Solicitante',
           text: "El campo de correo no debe contener caracteres repetidos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.email_empresa.focus();
       return false;
   }
  
}

// Validar RECAUDO
function Recaudo(obj){
    var recaudo = obj.recaudo.value;
    if (!recaudo) {
        Swal.fire({
            title: 'Nombre',
            text: "Debe  ingresar nombre del recaudo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.recaudo.focus();
        return false;
    }

    if (recaudo.trim() == "") {
        Swal.fire({
            title: 'Nombre',
            text: "El campo de Nombre no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.recaudo.focus();
        return false;
    }

    if (/(\w)\2+/i.test(recaudo.toLowerCase())) {
        Swal.fire({
                title: 'Nombre',
                text: "El campo del nombre no debe contener caracteres repetidos.",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                }).then((result) => {
            if (result.isConfirmed) {
    
                this.submit();
            }
            })
            
            obj.nombre.focus();
            return false;
        }

    // if (!/^[A-Z][a-ó-z ]+$/.test(recaudo)) {
    //     Swal.fire({
    //         title: 'Nombre',
    //         text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.recaudo.focus();
    //     return false;

        
    // }

    // if (/^([a-zA-Z0-9])\1+$/.test(recaudo)) {
    //     Swal.fire({
    //         title: 'Nombre',
    //         text: "El campo nombre no debe contener caracteres repetidos.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.recaudo.focus();
    //     return false;
    // }

    if (recaudo.length < 4){
        Swal.fire({
            title: 'Nombre',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.recaudo.focus();
        return (false);
    }

    var select2Multiple = obj.select2Multiple.value;
    if (!select2Multiple){
        Swal.fire({
            title: 'Categoria',
            text: "Debe de seleccionar una o ambas Categoria",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.select2Multiple.focus();
        return (false);
    }

}

// Validar COMISIONADO

function Comisionado(obj) {
    var cedula = obj.cedula.value;
   if (!cedula) {
       Swal.fire({
           title: 'Comisionado',
           text: "Debe de ingresar la cédula.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.cedula.focus();
       return false;
   }
   if (cedula.length < 7 || cedula.length > 8){
    Swal.fire({
        title: 'Comisionado',
        text: "La cédula no puede tener más de 8 dígitos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.cedula.focus();
    return (false);
}

   var nombre = obj.nombre.value;
   if (!nombre) {
       Swal.fire({
           title: 'Comisionado',
           text: "Debe de ingresar un nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })

       obj.nombre.focus();
       return false;
   }
   if (nombre.length < 3){
       Swal.fire({
           title: 'Comisionado',
           text: "Faltan dígitos en este campo de nombre.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return (false);
   }

   if (nombre.trim() == "") {
       Swal.fire({
           title: 'Comisionado',
           text: "El Campo del nombre no debe contener espacios en blancos.",
           icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {

           this.submit();
       }
       })
       
       obj.nombre.focus();
       return false;
   }
   if (/(\w)\1+/i.test(nombre.toLowerCase())) {
        Swal.fire({
            title: 'Comisionado',
            text: "El campo del nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre.focus();
        return false;
    }

    var apellido = obj.apellido.value;
    if (!apellido) {
    Swal.fire({
        title: 'Comisionado',
        text: "Debe de ingresar el apellido.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })

    obj.apellido.focus();
    return false;
    }
    if (apellido.length < 4){
    Swal.fire({
        title: 'Comisionado',
        text: "Faltan dígitos en este campo de apellido.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })

    
    obj.apellido.focus();
    return (false);
    }
    if (apellido.trim() == "") {
    Swal.fire({
        title: 'Comisionado',
        text: "El campo de apellido no debe contener espacios en blancos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.apellido.focus();
    return false;
    }

    if (/(\w)\2+/i.test(apellido.toLowerCase())) {
    Swal.fire({
            title: 'Comisionado',
            text: "El campo del apellido no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.apellido.focus();
        return false;
    }
  
    var c_municipio = obj.c_municipio.value;
    if (!c_municipio){
        Swal.fire({
            title: 'Comisionado',
            text: "Debe de seleccionar un Municipio",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.c_municipio.focus();
        return (false);
    }


}

// Validar MINERAL
function Mineral(obj) {
    var tipo = obj.tipo.value;
    if (tipo==0){
        Swal.fire({
            title: 'Tipo',
            text: "Debe seleccionar un tipo de mineral.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }
   
    var nombre = obj.nombre.value;
    if (!nombre) {
        Swal.fire({
            title: 'Nombre',
            text: "Debe  ingresar nombre del mineral.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nombre.focus();
        return false;
    }

    if (nombre.trim() == "") {
        Swal.fire({
            title: 'Nombre',
            text: "El campo de Nombre no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.nombre.focus();
        return false;
    }

    if (/(\w)\2+/i.test(nombre.toLowerCase())) {
    Swal.fire({
            title: 'Mineral',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.apellido.focus();
        return false;
    }

    if (nombre.length < 2){
        Swal.fire({
            title: 'Nombre',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre.focus();
        return (false);
    }

    var categoria = obj.categoria.value;
    if (!categoria){
        Swal.fire({
            title: 'Categoria',
            text: "Debe de seleccionar una Categoria",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.categoria.focus();
        return (false);
    }

}

// Validar REGALIA
function Regalia(obj) {
    var monto = obj.monto.value;
    if (!monto) {
         Swal.fire({
             title: 'Regalia',
             text: "Debe de ingresar el monto.",
             icon: 'warning',
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
                }).then((result) => {
            if (result.isConfirmed) {
    
                this.submit();
            }
            })

            obj.monto.focus();
             return false;
    }

    var moneda_longitud = obj.moneda_longitud.value;
    if (!moneda_longitud) {
        Swal.fire({
            title: 'Moneda/Longitud',
            text: "Debe  seleccionar una moneda.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return false;
    }
    
    var moneda_longitud = obj.moneda_longitud.value;
    if (moneda_longitud==0){
        Swal.fire({
            title: 'Moneda/Longitud',
            text: "Debe seleccionar una moneda.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

}
    
//Validar PLAZO DE VIGENCIA
function Plazo(obj) {
    var cantidad = obj.cantidad.value;
    if (!cantidad) {
        Swal.fire({
            title: 'Plazos',
            text: "Debe  ingresar una cantidad.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.cantidad.focus();
        return false;
    }
     
    var medida_tiempo = obj.medida_tiempo.value;
    if (!medida_tiempo) {
        Swal.fire({
            title: 'Plazos',
            text: "Debe  ingresar la medida de tiempo correspondiente.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.medida_tiempo.focus();
        return false;
    }
}    

// Validar RECEPCIÓN DE RECAUDOS
function Recepcion (obj) {
    var tipo_solicitante = obj.tipo_solicitante.value;
    if (tipo_solicitante==0){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe seleccionar un tipo de solicitante.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var solicitante = document.getElementById('solicitante').value;
    if (!solicitante){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe seleccionar un solicitante.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var municipio = obj.municipio.value;
    if (!municipio){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe seleccionar un municipio.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var latitud = obj.latitud.value;
    if (!latitud) {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe ingresar la latitud.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    if (latitud.trim() == "") {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "El campo de latitud no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    if (latitud.length < 5){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.latitud.focus();
        return (false);
    }

    var longitud = obj.longitud.value;
    if (!longitud) {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe ingresar la longitud.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    if (longitud.trim() == "") {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "El campo de longitud no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    if (longitud.length < 5){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.longitud.focus();
        return (false);
    }

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (direccion.trim() == "") {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "El campo de direccion no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(direccion.toLowerCase())) {
    Swal.fire({
            title: 'Recepción de Recaudos',
            text: "El campo nombre no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.direccion.focus();
        return false;
    }

    if (direccion.length < 5){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.direccion.focus();
        return (false);
    }
    
    var categoria = obj.categoria.value;
    if (!categoria){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe seleccionar una categoria.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var nom_mineral = document.getElementById('nom_mineral').value;
    if (nom_mineral === "0"){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe seleccionar un mineral.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    // var simpleDataInput = obj.simpleDataInput.value;
    // if (!simpleDataInput){
    //     Swal.fire({
    //         title: 'Recepción de Recaudos',
    //         text: "Debe seleccionar la fecha comisionado.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }


}

// Validar PLANIFICACIÓN 
function Planificacion (obj) {
    var municipio = obj.municipio.value;
    if (municipio==0){
        Swal.fire({
            title: 'Planificación',
            text: "Debe seleccionar un municipio.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var comisionado = obj.comisionado.value;
    if (!comisionado){
        Swal.fire({
            title: 'Planificación',
            text: "Debe seleccionar un comisionado.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var nom_mineral = obj.nom_mineral.value;
    if (!nom_mineral){
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe seleccionar un mineral.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var direccion = obj.direccion.value;
    if (!direccion) {
        Swal.fire({
            title: 'Recepción de Recaudos',
            text: "Debe ingresar la dirección.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.direccion.focus();
        return false;
    }

}

// Validar INSPECCIÓN
function Inspeccion (obj) {
    var funcionario_acomp = obj.funcionario_acomp.value;
    if (!funcionario_acomp) {
        Swal.fire({
            title: 'Inspección',
            text: "Debe registar el funcionario acomapañante.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (funcionario_acomp.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de funcionario acomapañante no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        return false;
    }

    if (/(\w)\2+/i.test(funcionario_acomp.toLowerCase())) {
    Swal.fire({
            title: 'Inspección',
            text: "El campo funcionario acomapañante no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return false;
    }

    if (funcionario_acomp.length < 5){
        Swal.fire({
            title: 'Inspección',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        return (false);
    }

    var observaciones = obj.observaciones.value;
    if (!observaciones) {
        Swal.fire({
            title: 'Inspección',
            text: "Debe registar las observaciones.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.observaciones.focus();
        return false;
    }

    if (observaciones.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de observaciones no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.observaciones.focus();
        return false;
    }

    if (/(\w)\2+/i.test(observaciones.toLowerCase())) {
    Swal.fire({
            title: 'Inspección',
            text: "El campo observaciones no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.observaciones.focus();
        return false;
    }

    if (observaciones.length < 5){
        Swal.fire({
            title: 'Inspección',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.observaciones.focus();
        return (false);
    }

    var conclusiones = obj.conclusiones.value;
    if (!conclusiones) {
        Swal.fire({
            title: 'Inspección',
            text: "Debe registar las conclusiones.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.conclusiones.focus();
        return false;
    }

    if (conclusiones.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de conclusiones no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.conclusiones.focus();
        return false;
    }

    if (/(\w)\2+/i.test(conclusiones.toLowerCase())) {
    Swal.fire({
            title: 'Inspección',
            text: "El campo conclusiones no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.conclusiones.focus();
        return false;
    }

    if (conclusiones.length < 5){
        Swal.fire({
            title: 'Inspección',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.conclusiones.focus();
        return (false);
    }

    var latitud = obj.latitud.value;
    if (!latitud){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar la latitud.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (latitud.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de latitud no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.latitud.focus();
        return false;
    }

    // var longitud = obj.longitud.value;
    // if (!longitud){
    //     Swal.fire({
    //         title: 'Inspección',
    //         text: "Debe registrar la longitud.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    if (longitud.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de longitud no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud.focus();
        return false;
    }

    var lugar_direccion = obj.lugar_direccion.value;
    if (!lugar_direccion) {
        Swal.fire({
            title: 'Inspección',
            text: "Debe registar el lugar.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.lugar_direccion.focus();
        return false;
    }

    if (lugar_direccion.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de lugar no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.lugar_direccion.focus();
        return false;
    }

    if (/(\w)\2+/i.test(lugar_direccion.toLowerCase())) {
    Swal.fire({
            title: 'Inspección',
            text: "El campo lugar no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.lugar_direccion.focus();
        return false;
    }

    if (lugar_direccion.length < 5){
        Swal.fire({
            title: 'Inspección',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.lugar_direccion.focus();
        return (false);
    }

    var utm_norte = obj.utm_norte.value;
    if (!utm_norte){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar la utm norte.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (utm_norte.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de utm norte no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.utm_norte.focus();
        return false;
    }

    var utm_este = obj.utm_este.value;
    if (!utm_este){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar la utm este.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (utm_este.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de utm este no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.utm_este.focus();
        return false;
    }
    
    var longitud_terreno =  document.getElementById('longitud_terreno').value;
    if (!longitud_terreno){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar la Longitud del terreno.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (longitud_terreno.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de Longitud del terreno no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.longitud_terreno.focus();
        return false;
    }

    var ancho =  document.getElementById('ancho').value;
    if (!ancho){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar el Ancho del terreno.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (ancho.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de Ancho del terreno no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.ancho.focus();
        return false;
    }

    var profundidad =  document.getElementById('profundidad').value;
    if (!profundidad){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar la Profundidad del terreno.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (profundidad.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de Profundidad del terreno no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.profundidad.focus();
        return false;
    }

    var volumen =  document.getElementById('volumen').value;
    if (!volumen){
        Swal.fire({
            title: 'Inspección',
            text: "Debe registrar el Volumen del terreno.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (volumen.trim() == "") {
        Swal.fire({
            title: 'Inspección',
            text: "El campo de Volumen del terreno no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.volumen.focus();
        return false;
    }

}

// Validar Comprbante de pago
function ComprobantePago (obj) {
    var tipo_pago = obj.tipo_pago.value;
    if (tipo_pago==0){
        Swal.fire({
            title: 'Tipo de Pago',
            text: "Debe seleccionar un tipo de pago ",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

}

// Validar Licencia
function Licencia (obj) {
    // var providencia =  document.getElementById('providencia').value;
    // if (!providencia){
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "Debe registrar la providencia administrativa",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    // if (providencia.trim() == "") {
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "El campo de providencia administrativa no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.providencia.focus();
    //     return false;
    // }

    // var num_territorio =  document.getElementById('num_territorio').value;
    // if (!num_territorio){
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "Debe registrar el n° ocupación de territorio.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    // if (num_territorio.trim() == "") {
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "El campo de  n° ocupación de territorio no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.num_territorio.focus();
    //     return false;
    // }

    var plazo = obj.plazo.value;
    if (plazo==0){
        Swal.fire({
            title: 'Licencia',
            text: "Debe seleccionar un tipo de plazo ",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var talonario = obj.talonario.value;
    if (talonario==0){
        Swal.fire({
            title: 'Licencia',
            text: "Debe ingresar un talonario ",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    if (talonario.trim() == "") {
        Swal.fire({
            title: 'Licencia',
            text: "El campo de  talonario no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.talonario.focus();
        return false;
    }


}

// Validar Licencia
function PagoRegalia (obj) {
    var id_regalia = obj.id_regalia.value;
    if (id_regalia==0){
        Swal.fire({
            title: 'Pago Regalias',
            text: "Debe seleccionar una tasa de regalia ",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }

    var estatus_regalia = obj.estatus_regalia.value;
    if (estatus_regalia==0){
        Swal.fire({
            title: 'Estatus',
            text: "Debe seleccionar un estatus",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        return (false);
    }


    // if (providencia.trim() == "") {
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "El campo de providencia administrativa no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.providencia.focus();
    //     return false;
    // }

    // var num_territorio =  document.getElementById('num_territorio').value;
    // if (!num_territorio){
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "Debe registrar el n° ocupación de territorio.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    // if (num_territorio.trim() == "") {
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "El campo de  n° ocupación de territorio no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.num_territorio.focus();
    //     return false;
    // }

    // var plazo = obj.plazo.value;
    // if (plazo==0){
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "Debe seleccionar un tipo de plazo ",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    // var talonario = obj.talonario.value;
    // if (talonario==0){
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "Debe ingresar un talonario ",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
        
    //     return (false);
    // }

    // if (talonario.trim() == "") {
    //     Swal.fire({
    //         title: 'Licencia',
    //         text: "El campo de  talonario no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.talonario.focus();
    //     return false;
    // }


}


// Fin de la validación del Sistema Minas //

//Validacion de no permitir numeros en los campos de texto de solo letras

function soloLetras(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    if (tecla==0){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
patron =/[a-zA-ZÑñáéíóú .*/]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    
}


//Validacion de no permitir letras en los campos de texto de solo numeros
function solonum(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    if (tecla==0){
    return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9/*.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

/*--------------Validacion de no permitir espacios en los campos de texto de usuario y clave del registro de Usuarios-----------------*/
function sinespacios(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-zA-ZÑñáéíóú0-9/*._@#$%&()-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

/* function showHideForms() {
    const radios = document.querySelectorAll('input[type="radio"][name="customRadio"]'); // Select radio buttons
    const forms = document.querySelectorAll('#form-n, #form-j'); // Select forms
  
    // Initially show form-n and hide form-j
    forms[0].style.display = 'block';
    forms[1].style.display = 'none';
  
    // Add a change event listener to the radio buttons
    radios.forEach(radio => {
      radio.addEventListener('change', (event) => {
        const selectedFormId = `form-${event.target.value}`; // Get the ID of the form to show
        for (const form of forms) {
          form.style.display = form.id === selectedFormId ? 'block' : 'none';
        }
      });
    });
  } */
