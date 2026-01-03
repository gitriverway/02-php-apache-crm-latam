// Ejemplo de uso
const secretKey = "miClaveSecreta123"; // Debe ser una clave compartida entre cliente y servidor

function base64ToBase62(base64) {
  const base62Chars =
    "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  let num = BigInt(0);

  // Convertir Base64 a número (BigInt)
  for (let i = 0; i < base64.length; i++) {
    const charCode = base64.charCodeAt(i);
    if (charCode >= 65 && charCode <= 90)
      num = num * 64n + BigInt(charCode - 65); // A-Z
    else if (charCode >= 97 && charCode <= 122)
      num = num * 64n + BigInt(charCode - 71); // a-z
    else if (charCode >= 48 && charCode <= 57)
      num = num * 64n + BigInt(charCode + 4); // 0-9
    else if (charCode === 43) num = num * 64n + 62n; // +
    else if (charCode === 47) num = num * 64n + 63n; // /
  }

  // Convertir número a Base62
  let base62 = "";
  while (num > 0n) {
    base62 = base62Chars[num % 62n] + base62;
    num = num / 62n;
  }

  return base62;
}

function base62ToBase64(base62) {
  const base62Chars =
    "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  const base64Chars =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";

  let num = BigInt(0);

  // Convertir Base62 a número (BigInt)
  for (let i = 0; i < base62.length; i++) {
    num = num * 62n + BigInt(base62Chars.indexOf(base62[i]));
  }

  // Convertir número a Base64
  let base64 = "";
  while (num > 0n) {
    base64 = base64Chars[Number(num % 64n)] + base64;
    num = num / 64n;
  }

  // Asegurarse de que la longitud sea un múltiplo de 4
  while (base64.length % 4 !== 0) {
    base64 += "=";
  }

  return base64;
}

function encryptToBase62(data, secretKey) {
  const encrypted = CryptoJS.AES.encrypt(data, secretKey).toString();
  const base62 = base64ToBase62(encrypted);
  return base62;
}

function decryptFromBase62(encryptedBase62, secretKey) {
  // Convertir Base62 a Base64
  const encryptedBase64 = base62ToBase64(encryptedBase62);

  // Descifrar usando CryptoJS
  const bytes = CryptoJS.AES.decrypt(encryptedBase64, secretKey);
  return bytes.toString(CryptoJS.enc.Utf8); // Convertir a texto plano
}

/*********************************
 VERIFICAR USUARIO LOGIN
 *********************************/
function Verificar_Usuario() {
  let usu = $("#usuario").val().toUpperCase().trim();
  let pass = $("#password").val().trim();

  if (usu.length == 0 || pass.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_fields', 'Fill in the session fields'),
      "warning"
    );
  }

  var datos = new FormData();
  datos.append("user", usu);
  datos.append("pass", pass);

  $.ajax({
    url: "controller/usuarios/controlador_verificar_usuario.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        switch (data[0]["usuario_estatus"]) {
          case "INACTIVO":
            Swal.fire(
              t('messages.warning', 'Warning Message'),
              t('messages.user_inactive', 'The user is inactive, contact the administrator'),
              "warning"
            );
            break;
          default:
            // Supongamos que fecha_vigencia_credenciales es una fecha en formato ISO o similar
            const fecha_vigencia_credenciales = new Date(
              data[0]["fecha_vigencia_credenciales"]
            ); // Cambia esta fecha según sea necesario
            const fecha_actual = new Date(); // Obtiene la fecha y hora actual

            // Comparar las fechas
            if (fecha_actual > fecha_vigencia_credenciales) {
              // Encriptar
              const originalData = data[0]["usuario_id"];

              var encrypted = encryptToBase62(originalData, secretKey);

              window.location =
                "index.php?ruta=change-password&usuarios=" + encrypted;
            } else {
              Crear_Sesion(data);
            }

            break;
        }
      } else {
        Swal.fire(
          t('messages.warning', 'Warning Message'),
          t('messages.incorrect_credentials', 'Incorrect username and/or password'),
          "warning"
        );
      }
    },
  });
}

function Crear_Sesion(data) {
  var datos1 = new FormData();
  datos1.append("idusuario", data[0]["usuario_id"]);
  datos1.append("user", data[0]["usuario_nombre"]);
  datos1.append("rol", data[0]["rol_nombre"]);
  datos1.append("fecha_registro", data[0]["usuario_fecha_registro"]);
  datos1.append("empleado", data[0]["empleado_nombre"]);

  $.ajax({
    url: "controller/usuarios/controlador_crear_session.php",
    method: "POST",
    data: datos1,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      let timerInterval;
      Swal.fire({
        title: t('messages.welcome_system', 'WELCOME TO THE SYSTEM'),
        html: t('messages.redirecting', 'You will be redirected in <b></b> milliseconds.'),
        timer: 500,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
          timerInterval = setInterval(() => {
            const content = Swal.getContainer();
            if (content) {
              const b = content.querySelector("b");
              if (b) {
                b.textContent = Swal.getTimerLeft();
              }
            }
          }, 100);
        },
        willClose: () => {
          clearInterval(timerInterval);
        },
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          window.location = "inicio";
          // location.reload();
        }
      });
    },
  });
}

function mostrarPassword() {
  var cambio = document.getElementById("password");
  if (cambio.type == "password") {
    cambio.type = "text";
    $(".icon").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
  } else {
    cambio.type = "password";
    $(".icon").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
  }
}

function mostrarPasswordChange() {
  var cambio = document.getElementById("txt_con1");
  var cambio_confirmation = document.getElementById("txt_con2");
  if (cambio.type == "password") {
    cambio.type = "text";
    cambio_confirmation.type = "text";
    $(".icon").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
  } else {
    cambio.type = "password";
    cambio_confirmation.type = "password";
    $(".icon").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
  }
}

function actualizar_contrasena() {
  let encryptedData = $("#txt_usuarios").val();
  let pass = $("#txt_con1").val().trim();
  let pass_confirmation = $("#txt_con2").val().trim();

  if (pass.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_password_field', 'Fill in the password field'),
      "warning"
    );
  }
  if (pass_confirmation.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_repeat_password_field', 'Fill in the repeat password field'),
      "warning"
    );
  }
  if (pass != pass_confirmation) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.passwords_not_match', 'Passwords do not match'),
      "warning"
    );
  }

  // Desencriptar
  var decryptedData = decryptFromBase62(encryptedData, secretKey);

  var datos = new FormData();
  datos.append("usuario_id", decryptedData);
  datos.append("pass", pass);

  $.ajax({
    url: "controller/usuarios/controlador_usuario_cambiar_password.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          t('messages.data_updated_successfully', 'Data Updated Successfully'),
          "success"
        ).then((value) => {
          window.location = "inicio";
        });
      } else {
        Swal.fire(
          t('messages.warning', 'Warning Message'),
          t('messages.password_not_valid', 'Sorry, the password is not valid'),
          "warning"
        );
      }
    },
  });
}

function recuperar_contrasena() {
  let usu = $("#usuario").val().toUpperCase().trim();

  if (usu.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_fields_recover_password', 'Fill in the fields to recover the password'),
      "warning"
    );
  }

  crear_overlay();

  var datos = new FormData();
  datos.append("usuario", usu);

  $.ajax({
    url: "controller/usuarios/controlador_recuperar_usuario.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);

      if (respuesta != "ok") {
        Swal.fire(t('messages.confirmation', 'Confirmation Message'), respuesta, "error");
      } else {
        Swal.fire(
          "Mensaje De Confirmacion",
          "La nueva contraseña ha sido enviada a su correo",
          "success"
        ).then((value) => {
          window.location = "login";
        });
      }
      eliminar_overlay();
    },
  });
}

function crear_overlay() {
  $("#card-forgot-password").append(
    '<div class="overlay dark" id="overlay-forgot-password"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay() {
  $("#overlay-forgot-password").remove();
}
