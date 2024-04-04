var alertList = document.querySelectorAll('.alert')
alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
})

//Validar Login
function login(obj) {
    var usuario = obj.usuario.value;
    if (!usuario) {
        Swal.fire({
            title: 'Login',
            text: "Debe de ingresar un usuario",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.usuario.focus();
        return false;
    }
    if (usuario.length < 3){
        Swal.fire({
            title: 'Login',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.usuario.focus();
        return (false);
    }
    var contraseña = obj.contraseña.value;
    if (!contraseña) {
        Swal.fire({
            title: 'Login',
            text: "Debe de ingresar la contraseña",
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
            title: 'Login',
            text: "Faltan dígitos en este campo de texto o numero. ",
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

//Validar Registro de Usuario
// function registrousuario(obj) {
//     var name = obj.name.value;
//     if (!name) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Debe de ingresar un nombre",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.name.focus();
//         return false;
//     }
//     if (name.length < 3){
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Faltan dígitos en este campo de texto.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.name.focus();
//         return (false);
//     }
//     if (name.trim() == "") {
//         Swal.fire({
//            title: 'Registro de Usuario',
//            text: "El campo de nombre no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
      
//        obj.name.focus();
//        return false;
//     }
//     if (/^([a-zA-Z0-9])\1+$/.test(name)) {
//          Swal.fire({
//             title: 'Registro de Usuario',
//             text: "El campo de nombre no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
       
//         obj.name.focus();
//         return false;
//     }
//     if (!/^[A-Z][a-z]+$/.test(name)) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
       
//         obj.name.focus();
//         return false;
//     }
//     var nameA = obj.nameA.value;
//     if (!nameA) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Debe de ingresar un apellido",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.nameA.focus();
//         return false;
//     }
//     if (nameA.length < 3){
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Faltan dígitos en este campo de texto.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.nameA.focus();
//         return (false);
//     }
//     if (nameA.trim() == "") {
//         Swal.fire({
//            title: 'Registro de Usuario',
//            text: "El campo de nombre no debe contener espacios en blancos.",
//            icon: 'warning',
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            }).then((result) => {
//        if (result.isConfirmed) {

//            this.submit();
//        }
//        })
      
//        obj.nameA.focus();
//        return false;
//     }
//     if (/^([a-zA-Z0-9])\1+$/.test(nameA)) {
//          Swal.fire({
//             title: 'Registro de Usuario',
//             text: "El campo de nombre no debe contener caracteres repetidos.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
       
//         obj.nameA.focus();
//         return false;
//     }
//     if (!/^[A-Z][a-z]+$/.test(nameA)) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
       
//         obj.nameA.focus();
//         return false;
//     }
//     var email = obj.email.value;
//     if (!email) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Debe de ingresar un e-mail",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })

//         obj.email.focus();
//         return false;
//     }
//     if (email.length < 4){
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Faltan dígitos en este campo de texto.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.email.focus();
//         return (false);
//     }
//     var username = obj.username.value;
//     if (!username) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Debe de ingresar un nombre de usuario",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.username.focus();
//         return false;
//     }
//     if (username.length < 3){
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Faltan dígitos en este campo de texo.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.username.focus();
//         return (false);
//     }
//     // var rol = obj.rol.value;
//     // if (rol==0){
//     //     alert("Debe de seleccionar el Rol del Usuario");
//     //     return (false);
//     // }
//     var password = obj.password.value;
//     if (!password) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Debe de ingresar la contraseña",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.password.focus();
//         return false;
//     }
//     if (password.length < 4){
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Faltan dígitos en este campo de texo o numero.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
		
// 		obj.password.focus();
// 		return (false);
// 	}
//     var password_confirmation = obj.password_confirmation.value;
//     if (!password_confirmation) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Debe de ingresar la confirmación de la contraseña",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.password_confirmation.focus();
//         return false;
//     }
//     if (password_confirmation.length < 4){
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Faltan dígitos en este campo de texto o numero.",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
	
// 		obj.password_confirmation.focus();
// 		return (false);
// 	}
//     if (password_confirmation != password) {
//         Swal.fire({
//             title: 'Registro de Usuario',
//             text: "Las contraseñas no coinciden",
//             icon: 'warning',
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             }).then((result) => {
//         if (result.isConfirmed) {

//             this.submit();
//         }
//         })
        
//         obj.password_confirmation.focus();
//         return false;
//     }
    
// }


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

    if (!/^[A-Z][a-ó-z ]+$/.test(nombre)) {
        Swal.fire({
            title: 'Nombre',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
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


    if (nombre_division.length < 6){
        Swal.fire({
            title: 'División',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre_division.focus();
        return (false);
    }

    
    if (/^([a-zA-Z0-9])\1+$/.test(nombre_division)) {
        Swal.fire({
            title: 'División',
            text: "El campo de división no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre_division.focus();
        return false;
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

    if (nombre_sede.length < 4){
        Swal.fire({
            title: 'Sede',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.nombre_sede.focus();
        return (false);
    }
    if (nombre_sede.trim() == "") {
         Swal.fire({
            title: 'Sede',
            text: "El campo de la sede no debe contener espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre_sede.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(nombre_sede)) {
         Swal.fire({
            title: 'Sede',
            text: "El campo de la sede no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre_sede.focus();
        return false;
    }
    if (!/^[A-Z][a-ñ-z]+$/.test(nombre_sede)) {
        Swal.fire({
            title: 'Sede',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
       
        obj.nombre_sede.focus();
        return false;
    }
    var checkboxes = document.getElementsByName("divisiones[]");
        var isChecked = false;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }
        if (!isChecked) {
            Swal.fire({
                title: 'Sede',
                text: "Debe seleccionar al menos una división",
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
        return true;
}
    
//Validar Plazos de Vigencia
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
            text: "Debe  ingresar la medida de tiempo correspondiente",
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

    // if (nombre_cargo.length < 4){
    //     Swal.fire({
    //         title: 'Cargo',
    //         text: "Faltan dígitos en este campo de texto.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })

    //     obj.nombre_cargo.focus();
    //     return (false);
    // }
    // if (nombre_cargo.trim() == "") {
    //     Swal.fire({
    //         title: 'Cargo',
    //         text: "El campo de cargo no debe contener espacios en blanco.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
         
    //     obj.nombre_cargo.focus();
    //     return false;
    // }

    // if (/^([a-zA-Z0-9])\1+$/.test(nombre_cargo)) {
    //     Swal.fire({
    //         title: 'Cargo',
    //         text: "El campo de cargo no debe contener caracteres repetidos.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.nombre_cargo.focus();
    //     return false;
    // }
    // if (!/^[A-Z][a-z]+$/.test(nombre_cargo)) {
    //     Swal.fire({
    //         title: 'Cargo',
    //         text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
    //         icon: 'warning',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         }).then((result) => {
    //     if (result.isConfirmed) {

    //         this.submit();
    //     }
    //     })
       
    //     obj.nombre_cargo.focus();
    //     return false;
    // }
   
}

//Validar Persona
function persona(obj) {
    var nombre = obj.nombre.value;
    if (!nombre) {
        Swal.fire({
            title: 'Persona',
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
            title: 'Persona',
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
    if (nombre.trim() == "") {
        Swal.fire({
            title: 'Persona',
            text: "El Campo del nombre no debe contener solo espacios en blancos.",
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
    if (/^([a-zA-Z0-9])\1+$/.test(nombre)) {
        Swal.fire({
            title: 'Persona',
            text: "El campo del nombre no debe contener solo caracteres repetidos.",
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
    if (!/^[A-Z][a-z]+$/.test(nombre)) {
        Swal.fire({
            title: 'Persona',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
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
            title: 'Persona',
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
            title: 'Persona',
            text: "Faltan dígitos en este campo de texto.",
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
            title: 'Persona',
            text: "El campo de apellido no debe contener solo espacios en blancos.",
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
    if (/^([a-zA-Z0-9])\1+$/.test(apellido)) {
        Swal.fire({
            title: 'Persona',
            text: "El campo de apellido no debe contener solo caracteres repetidos.",
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
    if (!/^[A-Z][a-z]+$/.test(apellido)) {
        Swal.fire({
            title: 'Persona',
            text: "El apellido debe comenzar con una letra mayúscula y las demás en minúscula.",
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
    var cedula = obj.cedula.value;
    if (!cedula) {
        Swal.fire({
            title: 'Persona',
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
    if (cedula.length < 7){
        Swal.fire({
            title: 'CI Persona',
            text: "Faltan dígitos en este campo de numero.",
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
    if (cedula.trim() == "") {
        Swal.fire({
            title: 'Persona',
            text: "El campo de cédula no debe contener solo espacios en blancos.",
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
    if (/^([a-zA-Z0-9])\1+$/.test(cedula)) {
        Swal.fire({
            title: 'Persona',
            text: "El campo de cédula no debe contener solo caracteres repetidos.",
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
    var id_usuario = obj.id_usuario.value;
    if (!id_usuario) {
        Swal.fire({
            title: 'Persona',
            text: "Debe de ingresar un id usuario.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_usuario.focus();
        return false;
    }
    if (id_usuario.length < 4){
        Swal.fire({
            title: 'Persona',
            text: "Faltan dígitos en el id usuario.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_usuario.focus();
        return (false);
    }
    if (id_usuario.trim() == "") {
        Swal.fire({
            title: 'Persona',
            text: "El campo de id usuario no debe contener solo espacios en blnacos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_usuario.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(id_usuario)) {
        Swal.fire({
            title: 'Persona',
            text: "El campo de id usuario no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_usuario.focus();
        return false;
    }
    var cargo = obj.cargo.value;
    if (!cargo){
        Swal.fire({
            title: 'Persona',
            text: "Debe de seleccionar el cargo de la persona.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.cargo.focus();
        return (false);
    }
    var telefono = obj.telefono.value;
    if (!telefono) {
        Swal.fire({
            title: 'Persona',
            text: "Debe de ingresar el numero de telefono.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.telefono.focus();
        return false;
    }
    if (telefono.length < 11){
        Swal.fire({
            title: 'Teléfono de la Persona',
            text: "Faltan dígitos en este campo de numero. Mínimo 11",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.telefono.focus();
        return (false);
    }
    var id_sede = obj.id_sede.value;
    if (!id_sede) {
        Swal.fire({
            title: 'Persona',
            text: "Debe de seleccionar la sede",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_sede.focus();
        return false;
    }
    var id_division = obj.id_division.value;
    if (!id_division){
        Swal.fire({
            title: 'Persona',
            text: "Debe de seleccionar la división",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_division.focus();
        return (false);
    }
}

//Validar Marca
function Marca(obj) {
var nombre_marca = obj.nombre_marca.value;
if (!nombre_marca) {
    Swal.fire({
        title: 'Marca',
        text: "Debe de ingresar una marca.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {

        this.submit();
    }
    })
    
    obj.nombre_marca.focus();
    return false;
}

    if (nombre_marca.length < 2){
        Swal.fire({
            title: 'Marca',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
         
        obj.nombre_marca.focus();
        return (false);
    }
    if (nombre_marca.trim() == "") {
        Swal.fire({
            title: 'Marca',
            text:  "El campo de marca no debe contener espacios en blanco.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
       
        obj.nombre_marca.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(nombre_marca)) {
        Swal.fire({
            title: 'Marca',
            text:  "El campo de marca no debe contener caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
        
        obj.nombre_marca.focus();
        return false;
    }
   if (!/^[A-Z][a-z]+$/.test(nombre_marca)) {
      Swal.fire({
           title: 'Marca',
           text:  "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
          icon: 'warning',
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           }).then((result) => {
       if (result.isConfirmed) {
    
           this.submit();
      }
       })
        
       obj.nombre_marca.focus();
       return false;

   }

}

//Validar Modelo
function Modelo(obj) {
var nombre_modelo = obj.nombre_modelo.value;
    if (!nombre_modelo) {
        Swal.fire({
            title: 'Modelo',
            text: "Debe de ingresar un modelo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
        
        obj.nombre_modelo.focus();
        return false;
    }
    if (nombre_modelo.length < 2){
        Swal.fire({
            title: 'Modelo',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
        
        obj.nombre_modelo.focus();
        return (false);
    }
    if (nombre_modelo.trim() == "") {
        Swal.fire({
            title: 'Modelo',
            text:  "El campo de modelo no debe contener espacios en blanco.",  
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
             
        obj.nombre_modelo.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(nombre_modelo)) {
        Swal.fire({
            title: 'Modelo',
            text:  "El campo de modelo no debe contener caracteres repetidos.",  
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {
    
            this.submit();
        }
        })
        
        obj.nombre_modelo.focus();
        return false;
    }
    // if (!/^[A-Z][a-z]+$/.test(nombre_modelo)) {
   //    Swal.fire({
   //         title: 'Modelo',
   //         text:  "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
   //        icon: 'warning',
   //         confirmButtonColor: '#3085d6',
   //         cancelButtonColor: '#d33',
   //         }).then((result) => {
   //     if (result.isConfirmed) {
    
   //         this.submit();
   //    }
   //     })
        
    //    obj.nombre_modelo.focus();
    //    return false;

   // }

}

//Validar Tipo Periferico
function TipoPeriferico(obj) {
var tipo = obj.tipo.value;
    if (!tipo) {
        Swal.fire({
            title: 'Tipo de Periférico',
            text: "Debe de ingresar un tipo de periférico.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.tipo.focus();
        return false;
    }
    
    if (tipo.trim() == "") {
        Swal.fire({
            title: 'Tipo de Periférico',
            text: "El campo de tipo de periférico no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.tipo.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(tipo)) {
        Swal.fire({
            title: 'Tipo de Periférico',
            text: "El campo de tipo de periférico no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.tipo.focus();
        return false;
    }
    if (!/^[A-Z][a-z]+$/.test(tipo)) {
        Swal.fire({
            title: 'Tipo de Periférico',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.tipo.focus();
        return false;
    }
}

//Validar Periferico
function Periferico(obj) {
    var id_tipo = obj.id_tipo.value;
    if (id_tipo==0) {
        Swal.fire({
            title: 'Periférico',
            text: "Debe de ingresar el periférico",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_tipo.focus();
        return false;
    }
    var id_marca = obj.id_marca.value;
    if (id_marca==0){
        Swal.fire({
            title: 'Periférico',
            text: "Debe de seleccionar una marca",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_marca.focus();
        return (false);
    }
    var id_modelo = obj.id_modelo.value;
    if (id_modelo==0){
        Swal.fire({
            title: 'Periférico',
            text: "Debe de seleccionar un modelo",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.id_modelo.focus();
        return (false);
    }
    var serial = obj.serial.value;
    if (!serial) {
        Swal.fire({
            title: 'Periférico',
            text: "Debe de ingresar el serial.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serial.focus();
        return false;
    }
    if (serial.length < 5){
        Swal.fire({
            title: 'Periférico',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
		
		obj.serial.focus();
		return (false);
	}
    if (serial.trim() == "") {
        Swal.fire({
            title: 'Periférico',
            text: "El campo de serial no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serial.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(serial)) {
        Swal.fire({
            title: 'Periférico',
            text: "El campo de serial no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serial.focus();
        return false;
    }
    var serialA = obj.serialA.value;
    if (!serialA) {
        Swal.fire({
            title: 'Periférico',
            text: "Debe de ingresar el serial activo.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serialA.focus();
        return false;
    }
    if (serialA.length < 5){
        Swal.fire({
            title: 'Periférico',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
		
		obj.serialA.focus();
		return (false);
	}
    if (serialA.trim() == "") {
        Swal.fire({
            title: 'Periférico',
            text: "El campo de serial activo no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serialA.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(serialA)) {
        Swal.fire({
            title: 'Periférico',
            text: "El campo de serial activo no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serialA.focus();
        return false;
    }
    if (!/^[A-Z]-[0-9]+$/.test(serialA)) {
        Swal.fire({
             title: 'Periférico',
             text:  "El serial activo debe comenzar con una letra mayúscula en guion y los demás en numero.",
            icon: 'warning',
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             }).then((result) => {
         if (result.isConfirmed) {
      
             this.submit();
        }
         })
          
         obj.serialA.focus();
         return false;
  
    }
}

//Validar Sistemas Operatvos
function sistemas_operatvos(obj) {
    var tipo = obj.tipo.value;
    if (!tipo) {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "Debe de seleccionar un tipo de sistema operativo",
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
    var nombre = obj.nombre.value;
    if (!nombre) {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "Debe de ingresar el nombre.",
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
    if (nombre.length < 4){
        Swal.fire({
            title: 'Sistema Operativo',
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
    if (nombre.trim() == "") {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "El campo nombre no debe contener solo espacios en blancos.",
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
    if (/^([a-zA-Z0-9])\1+$/.test(nombre)) {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "El campo nombre no debe contener solo caracteres repetidos.",
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
    if (!/^[A-Z][a-z]+$/.test(nombre)) {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "El nombre debe comenzar con una letra mayúscula y las demás en minúscula.",
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
    var version = obj.version.value;
    if (!version) {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "Debe de ingresar la versión.",
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
    if (version.length < 1){
		Swal.fire({
            title: 'Sistema Operativo',
            text: "Faltan dígitos en este campo de texto. ",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
		obj.version.focus();
		return (false);
	}
    if (version.trim() == "") {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "El campo versión No debe contener solo espacios en blancos.",
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
    if (/^([a-zA-Z0-9])\1+$/.test(version)) {
        Swal.fire({
            title: 'Sistema Operativo',
            text: "El campo versión no debe contener solo caracteres repetidos.",
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
}

//Validar Equipo
function Equipo(obj) {
    var marca = obj.marca.value;
    if (marca==0){
        Swal.fire({
            title: 'Equipo',
            text: "Debe de seleccionar la marca",
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
    var modelo = obj.modelo.value;
    if (modelo==0){
        Swal.fire({
            title: 'Equipo',
            text: "Debe de seleccionar el modelo",
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
    var serial = obj.serial.value;
    if (!serial) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de ingresar el serial",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serial.focus();
        return false;
    }
    if (serial.length < 5){
        Swal.fire({
            title: 'Equipo',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
		
		obj.serial.focus();
		return (false);
	}
    if (serial.trim() == "") {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de serial no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serial.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(serial)) {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de serial no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serial.focus();
        return false;
    }
    var serialA = obj.serialA.value;
    if (!serialA) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de ingresar el serial activo",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serialA.focus();
        return false;
    }
    if (serialA.length < 5){
        Swal.fire({
            title: 'Equipo',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
		
		obj.serialA.focus();
		return (false);
	}
    if (serialA.trim() == "") {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de serial activo no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serialA.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(serialA)) {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de serial activo no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.serialA.focus();
        return false;
    }
    if (!/^[A-Z]-[0-9]+$/.test(serialA)) {
        Swal.fire({
             title: 'Equipo',
             text:  "El serial activo debe comenzar con una letra mayúscula en guion y los demás en numero.",
            icon: 'warning',
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             }).then((result) => {
         if (result.isConfirmed) {
      
             this.submit();
        }
         })
          
         obj.serialA.focus();
         return false;
  
    }
    var cpu = obj.cpu.value;
    if (!cpu) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de ingresar el modelo del procesador",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.cpu.focus();
        return false;
    }
    if (cpu.length < 2){
        Swal.fire({
            title: 'Equipo',
            text: "Faltan dígitos en este campo de texto.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.cpu.focus();
        return (false);
    }
    if (cpu.trim() == "") {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de modelo del procesador no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.cpu.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(cpu)) {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de modelo del procesador no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.cpu.focus();
        return false;
    }
    var velocidad = obj.velocidad.value;
    if (!velocidad) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de ingresar la velocidad",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.velocidad.focus();
        return false;
    }
    if (velocidad.length < 2 ){
        Swal.fire({
            title: 'Velocidad',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.velocidad.focus();
        return (false);
    }
    if (velocidad.trim() == "") {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de velocidad no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
    
        obj.velocidad.focus();
        return false;
    }
    if (/^([a-zA-Z0-9-.])\1+$/.test(velocidad)) {
        Swal.fire({
            title: '',
            text: "El campo velocidad no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.velocidad.focus();
        return false;
    }
    var ram = obj.ram.value;
    if (!ram) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de ingresar la memoria ram",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.ram.focus();
        return false;
    }
    if (ram.length < 1){
        Swal.fire({
            title: 'RAM',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })

        obj.ram.focus();
        return (false);
    }
    if (ram.trim() == "") {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de memoria ram no debe contener solo espacios en blancos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.cpu.focus();
        return false;
    }
    if (/^([a-zA-Z0-9-.])\1+$/.test(ram)) {
        Swal.fire({
            title: 'Equipo',
            text: "El campo de memoria ram no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.ram.focus();
        return false;
    }
    var disco = obj.disco.value;
    if (!disco) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de ingresar el disco duro",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.disco.focus();
        return false;
    }
    if (disco.length < 2){
        Swal.fire({
            title: 'Disco',
            text: "Faltan dígitos en este campo de numero.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.disco.focus();
        return (false);
    }
    if (disco.trim() == "") {
        Swal.fire({
            title: 'Equipo',
            text: "El campo del disco duro no debe contener solo espacios en blancos",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.disco.focus();
        return false;
    }
    if (/^([a-zA-Z0-9])\1+$/.test(disco)) {
        Swal.fire({
            title: 'Equipo',
            text: "El campo del disco duro no debe contener solo caracteres repetidos.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
        if (result.isConfirmed) {

            this.submit();
        }
        })
        
        obj.disco.focus();
        return false;
    }
    var tipo = obj.tipo.value;
    if (!tipo) {
        Swal.fire({
            title: 'Equipo',
            text: "Debe de seleccionar un tipo de sistema operativo",
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
    var id_so = obj.id_so.value;
    if (id_so==0){
        Swal.fire({
            title: 'Equipo',
            text: "Debe de seleccionar el sistema operativo",
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
    if (/^([a-zA-Z0-9])\1+$/.test(name)) {
        Swal.fire({
            title: 'Usuario',
            text: "El campo de nombre del usuario no debe contener solo caracteres repetidos.",
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
    if (/^([a-zA-Z0-9])\1+$/.test(name)) {
        Swal.fire({
            title: 'Rol',
            text: "El campo de rol no debe contener solo caracteres repetidos.",
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
            title: 'Rol',
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
}

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

/*--------------Index--------------
function validar(obj) {
    var usuario = obj.usuario.value;
    if (!usuario) {
        alert("Debe de ingresar un usuario");// Alerta lanza un mensaje que sale cuando se cumple la condicion
        obj.usuario.focus();//focus hace que se seleccione el campo que se esta validando
        return false;
    }
	
    var contrasena = obj.contrasena.value;
    if (!contrasena) {
        alert("Debe de ingresar una contraseña");
        obj.contrasena.focus();
        return false;
    }
}
*/
/*--------------Registro medicos--------------
function medicos(obj) {
    var ci = obj.ci.value;
    if (!ci) {
        alert("Debe de ingresar la cédula");
        obj.ci.focus();
        return false;
    }
    if (ci.length < 5){
		alert("Faltan dígitos en la cédula");
		obj.ci.focus();
		return (false);
	}
    var nombremed = obj.nombremed.value;
    if (!nombremed) {
        alert("Debe de ingresar un nombre");
        obj.nombremed.focus();
        return false;
    }
    if (nombremed.length < 2){
        alert("Faltan dígitos en el nombre");
        obj.nombremed.focus();
        return (false);
    }
    var apellidomed = obj.apellidomed.value;
    if (!apellidomed) {
        alert("Debe de ingresar el apellido");
        obj.apellidomed.focus();
        return false;
    }
    var sexo = obj.sexo.value;
    if (!sexo) {
        alert("Debe de seleccionar un sexo");
        return false;
    }
    var codigompps = obj.codigompps.value;
    if (!codigompps) {
        alert("Falta ingresar el código MPPS");
        obj.codigompps.focus();
        return false;
    }
    if (codigompps.length < 2){
		alert("Faltan dígitos en el código MPPS");
		obj.codigompps.focus();
		return (false);
	}
    var codigocmy = obj.codigocmy.value;
    if (!codigocmy) {
        alert("Falta ingresar el código CMY");
        obj.codigocmy.focus();
        return false;
    }
    if (codigocmy.length < 2){
		alert("Faltan dígitos en el código CMY");
		obj.codigocmy.focus();
		return (false);
	}

}*/

/*--------------Registro pacientes--------------
function paciente(obj) {
    var nombrepaci = obj.nombrepaci.value;
    if (!nombrepaci) {
        alert("Debe de ingresar el nombre del paciente");
        obj.nombrepaci.focus();
        return false;
    }
    if (nombrepaci.length < 2){
        alert("Faltan dígitos en el nombre");
        obj.nombrepaci.focus();
        return (false);
        }
    var apellidopaci = obj.apellidopaci.value;
    if (!apellidopaci) {
        alert("Debe de ingresar los apellido del paciente");
        obj.apellidopaci.focus();
        return false;
    }

    if (apellidopaci.length < 2){
    alert("Faltan dígitos en el apellido");
    obj.apellidopaci.focus();
    return (false);
    }
    var sexo = obj.sexo.value;
    if (!sexo) {
        alert("Debe de seleccionar un sexo");
        return false;
    }
    var fecha_nacimiento = obj.fecha_nacimiento.value;
    if (!fecha_nacimiento) {
        alert("Debe de ingresar la fecha de nacimiento");
        obj.fecha_nacimiento.focus();
        return false;
    }
    var edad = obj.edad.value;
    if (edad > 12){
        alert("El paciente debe de tener una edad menor o igual a 12");
        obj.edad.focus();
        return false;
    }
    var edad = obj.edad.value;
    if (edad < 0){
        alert("El paciente debe de tener una edad mayor o igual a 0");
        obj.edad.focus();
        return false;
    }
    var combo1 = obj.combo1.value;
    if (combo1==0){
        alert("Debe de seleccionar el estado");
        return false;
    }
    var combo2 = obj.combo2.value;
    if (combo2==0){
        alert("Debe de seleccionar el municipio");
        return false;
    }
    var combo3 = obj.combo3.value;
    if (combo3==0){
        alert("Debe de seleccionar la parroquia");
        return false;
    }
    var direccion = obj.direccion.value;
    if (direccion==0){
        alert("Debe de colocar la direccion");
        return false;
    }
}*/
/*----------------Validaciones para el calendario de fecha de nacimiento y edad del paciente-----------
function evitarnumero(){
    if(edad==119){
        document.getElementById("edad").value = " ";
    }
}
function calcular_edad(){
    var f=document.forma;
    var fecha_nacimiento = f.fecha_nacimiento.value;

    //OPTENER EL DIA
    var gui = fecha_nacimiento.charAt(2);//buscar el primer guion
    if(gui=="-"){
        var dia_nacim = fecha_nacimiento.substring(0, 2);//los 2 primeros digitos
        var n_dia = dia_nacim.length;//numero de digitos del dia
        var t_dia = (n_dia + 1);//se suma 1 a la posicion del dia
    }else{
        var dia_nacim = fecha_nacimiento.substring(0, 1);//el primer digito
        var n_dia = dia_nacim.length;//numero de digitos del dia
        var t_dia = (n_dia + 1);//se suma 1 a la posicion del dia
    }
    //OPTENER EL AÑO
    var long = fecha_nacimiento.length;//numero total de digitos de la fecha
    var ult = fecha_nacimiento.lastIndexOf('-');//posicion del ultimo guion
    var uno = (ult + 1);//se suma 1 a la posicion del guion para no contar el mismo guion
    var anio_nacim = fecha_nacimiento.substring(uno, long);//se optiene los 4 ultimos numeros
    //OPTENER EL MES
    var mes_nacim = fecha_nacimiento.substring(t_dia, ult);//los digitos intermedio

    fecha_hoy = new Date();
    ahora_anio = fecha_hoy.getYear();
        ahora_mes = fecha_hoy.getMonth();
        ahora_dia = fecha_hoy.getDate();
        edad = (ahora_anio + 1900) - anio_nacim;

    if ( ahora_mes < (mes_nacim - 1)){
            edad--;
        }
        if (((mes_nacim - 1) == ahora_mes) && (ahora_dia < dia_nacim)){ 
            edad--;
        }
        if (edad > 1900){
            edad -= 1900;
        }
    if(edad < 0){
        document.getElementById("edad").value = edad;
        
    }else{
        document.getElementById("edad").value = edad;
    }

}

function solonumfecha(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    // Patron de entrada, en este caso no acepta nada
    patron =/[]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}*/
/*--------------Registro Especialidad--------------
function especialidadMed(obj){    
	var especialidad = obj.especialidad.value;
    if (!especialidad) {
        alert("Debe de ingresar una especialidad");
        obj.especialidad.focus();
        return false;
    }
    if (especialidad.length < 5){
        alert("Faltan dígitos en la especialidad");
        obj.especialidad.focus();
        return (false);
        }
}*/

/*--------------Registro patologia--------------
function patologiaPaci(obj){    
	var patologia = obj.patologia.value;
    if (!patologia) {
        alert("Debe de ingresar una patología");
        obj.patologia.focus();
        return false;
    }
    if (patologia.length < 3){
        alert("Faltan dígitos en la patologia");
        obj.patologia.focus();
        return (false);
        }
}*/

/*--------------Registro Estado--------------
function MaestroEstado(obj){    
	var estado = obj.estado.value;
    if (!estado) {
        alert("Debe de ingresar un estado");
        obj.estado.focus();
        return false;
    }
    if (estado.length < 2){
        alert("Faltan dígitos en el estado");
        obj.estado.focus();
        return (false);
        }
}*/

/*--------------Registro Municipio--------------
function MaestroMunicipio(obj){
    var id_estado = obj.id_estado.value;
    if (id_estado==0){
        alert("Debe de seleccionar el estado");
        return false;
    }
	var municipio = obj.municipio.value;
    if (municipio.length < 3){
        alert("Faltan dígitos en el municipio");
        obj.municipio.focus();
        return (false);
        }
    if (!municipio) {
        alert("Debe de ingresar un municipio");
        obj.municipio.focus();
        return false;
    }
}*/

/*--------------Registro Parroquia--------------
function MaestroParroquia(obj){    
	var combo1 = obj.combo1.value;
    if (combo1==0){
        alert("Debe de seleccionar el estado");
        return false;
    }
    var id_municipio = obj.id_municipio.value;
    if (id_municipio==0){
        alert("Debe de seleccionar el municipio");
        return false;
    }
    var parroquia = obj.parroquia.value;
    if (!parroquia) {
        alert("Debe de ingresar una parroquia");
        obj.parroquia.focus();
        return false;
    }
    if (parroquia.length < 4){
        alert("Faltan dígitos en la parroquia");
        obj.parroquia.focus();
        return (false);
    }
}*/
/*--------------Actualizar Municipio--------------
function ActualizarMunicipio(obj){    
    var municipio = obj.municipio.value;
    if (!municipio) {
        alert("Debe de ingresar un municipio");
        obj.municipio.focus();
        return false;
    }
    if (municipio.length < 2){
        alert("Faltan dígitos en la municipio");
        obj.municipio.focus();
        return (false);
    }
}*/
/*--------------Actualizar Parroquia--------------
function ActualizarParroquia(obj){    
    var parroquia = obj.parroquia.value;
    if (!parroquia) {
        alert("Debe de ingresar una parroquia");
        obj.parroquia.focus();
        return false;
    }
    if (parroquia.length < 2){
        alert("Faltan dígitos en la parroquia");
        obj.parroquia.focus();
        return (false);
    }
}*/

/*--------------Citas--------------------
function citas(obj){    
	var paciente_cita = obj.paciente_cita.value;
    if (!paciente_cita) {
        alert("Debe de buscar un paciente");
        obj.paciente_cita.focus();
        return false;
    }
	var medico_cita = obj.medico_cita.value;
    if (!medico_cita) {
        alert("Debe de buscar el médico");
		obj.medico_cita.focus();
        return false;
    }
    
    /*var especialidad= obj.especialidad.value;
    if(!especialidad){
        alert("Se necesita la Especialidad para buscar el medico");
        obj.especialidad.focus();
        return false;
    }

    var fecha= obj.fecha.value;
	if(!fecha){
		alert("Se necesita la fecha para continuar");
		obj.fecha.focus();
		return false;
	}
    var hora= obj.hora.value;
	if(!hora){
		alert("Se necesita la hora para continuar");
		obj.hora.focus();
		return false;
	}
    var tipodecita = obj.tipodecita.value;
    if (!tipodecita) {
        alert("Defina el tipo de cita");
        return false;
    }

    /*var tipodecita = obj.tipodecita.value;
    if (tipodecita == Referencia) {

	//var medico_referencia = obj.medico_referencia.value;
    if (!medico_referencia) {
        alert("Debe de ingresar el médico que referencia");
        return false;
    }

    //var observacion_paci_ref = obj.observacion_paci_ref.value;
    if (!observacion_paci_ref) {
        alert("Debe de ingresar la observación de el médico que referencia");
        return false;
        }
    }

    var tipodecita = obj.tipodecita.value;
    if (tipodecita == Seguimiento) {

    var observacion_paci_seg = obj.observacion_paci_seg.value;
    if (!observacion_paci_seg) {
        alert("Debe de ingresar la observación de el paciente ");
        return false;
        }
    }   
}*/

/*----------------------------- Validacion proceso cita------------------------
function proceso_cita(obj){
    var fechanueva = obj.fechanueva.value;
    if (!fechanueva) {
        alert("Debe de ingresar la nueva fecha de la cita");
        obj.fechanueva.focus();
        return false;
    }
    var hora = obj.hora.value;
    if (!hora) {
        alert("Debe de ingresar la hora de la cita");
        obj.hora.focus();
        return false;
    }
}*/

/*---------------------Cambiar contraseña--------------------------
function clave(obj) {
    var actualPass = obj.actualPass.value;
    if (!actualPass) {
        alert("Debe de ingresar la contraseña actual");
        obj.actualPass.focus();
        return false;
    }
    var nuevaPass = obj.nuevaPass.value;
    if (!nuevaPass) {
        alert("Debe de ingresar la nueva contraseña");
        obj.nuevaPass.focus();
        return false;
    }
    var confirmarPass = obj.confirmarPass.value;
    if (!confirmarPass) {
        alert("Debe de confirmar la Nueva contraseña");
        obj.confirmarPass.focus();
        return false;
    }
    if (confirmarPass != nuevaPass) {
        alert("Las contraseñas deben de ser iguales");
        obj.confirmarPass.focus();
        return false;
    }
}*/
/*----------------------------- Validacion registrar usuario------------------------
function usuario(obj){
    var ciusuario = obj.ciusuario.value;
    if (!ciusuario) {
        alert("Debe de ingresar la cedula del usuario");
        obj.ciusuario.focus();
        return false;
    }
    var nombreusu = obj.nombreusu.value;
    if (!nombreusu) {
        alert("Debe de ingresar el nombre del usuario");
        obj.nombreusu.focus();
        return false;
    }
    var apellidosusu= obj.apellidosusu.value;
    if (!apellidosusu) {
        alert("Debe de ingresar el apellido del usuario");
        obj.apellidosusu.focus();
        return false;
    }
    var nombreusuario = obj.nombreusuario.value;
    if (!nombreusuario) {
        alert("Debe de ingresar el nombre de usuario");
        obj.nombreusuario.focus();
        return false;
    }
    var claveusuario = obj.claveusuario.value;
    if (!claveusuario) {
        alert("Debe de ingresar la clave");
        obj.claveusuario.focus();
        return false;
    }
}*/
/*----------------------Validacion de no permitir letras en los campos de texto de cedula y codigo del medico------------
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
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}*/
/*--------------Validacion de no permitir numeros en los campos de texto de nombre y apellido de medicos y pacientes-----------------
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
    patron =/[a-zA-ZÑñáéíóú ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);

}*/
/*--------------Validacion de no permitir numeros en el campo de texto de especialidad-----------------
function Espe_Pat(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-zA-ZÑñáéíóú/ ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);

}*/


/*--------------Validacion de no permitir espacios en los campos de texto de usuario y clave del registro de Usuarios-----------------
function sinespacios(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite 
    if (tecla==8){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-zA-ZÑñáéíóú0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);

}*/

/*------------------Funcion para que las letras introducidas en nombre y apellido de medico y paciente se vuelvan mayusculas
function mayus(w) {
    w.value = w.value.toUpperCase();
}
/*
/*-----------------Ventanas modales de medico----------------
function modalmedic(obj){
    var ci = obj.ci.value;
    if (!ci) {
        alert("Debe de ingresar la cédula");
        obj.ci.focus();
        return false;
    }
    if (ci.length < 5){
		alert("Faltan dígitos en la cédula");
		obj.ci.focus();
		return (false);
    }
}*/
/*-----------------Ventana modal eliminar de medicos----------------
function eliminarmedic(obj){
    var ci = obj.ci.value;
    if (!ci) {
        alert("Debe de ingresar la cédula");
        obj.ci.focus();
        return false;
    }
    if (ci.length < 5){
		alert("Faltan dígitos en la cédula");
		obj.ci.focus();
		return (false);
    }
    var cerrar = confirm("¿Desea eliminar este resgistro?");
	if (cerrar){
		return true;
	}else{
		return false;
	}
}
/*-----------------Ventanas modales de especialidad----------------
function modalespecialidad(obj){
    var especialidad = obj.especialidad.value;
    if (!especialidad) {
        alert("Debe de ingresar el nombre de la especialidad");
        obj.especialidad.focus();
        return false;
    }
}
/*-----------------Ventana modal eliminar de especialidad----------------
function eliminarespecialidad(obj){
    var especialidad = obj.especialidad.value;
    if (!especialidad) {
        alert("Debe de ingresar el nombre de la especialidad");
        obj.especialidad.focus();
        return false;
    }
    var cerrar = confirm("¿Desea eliminar este resgistro?");
	if (cerrar){
		return true;
	}else{
		return false;
	}
}
/*-----------------Ventanas modales de patologia----------------
function modalespatologia(obj){
    var patologia = obj.patologia.value;
    if (!patologia) {
        alert("Debe de ingresar el nombre de la patologia");
        obj.patologia.focus();
        return false;
    }
}
/*-----------------Ventana modal eliminar de patologia----------------
function eliminarpatologia(obj){
    var patologia = obj.patologia.value;
    if (!patologia) {
        alert("Debe de ingresar el nombre de la patologia");
        obj.patologia.focus();
        return false;
    }
    var cerrar = confirm("¿Desea eliminar este resgistro?");
	if (cerrar){
		return true;
	}else{
		return false;
	}
}*/