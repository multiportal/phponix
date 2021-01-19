app.controller("fcController",function($http,$scope){
  $scope.url = {
     "registro":"/accion/registrar",
     "login":"/accion/login",
  }
  // REGISTRO SECTION
  $scope.registro = {};
  $scope.errores = {};
  $scope.registrarse = function(){
    $('#mregister').openModal({
      ready: function() { $('input[name="name"]').focus() }
    });
  }
  $scope.enviando = false;
  $scope.enviabtn = false;
  $scope.enviarRegistro = function(){
      if($scope.teracepto){
        $scope.enviando = true;
        $scope.enviabtn = true;
        
        $http.post($scope.url.registro, $scope.registro).then(function($data){
          $scope.enviando = false;
          $scope.enviabtn = false;
          if($data.data.estado == "true"){
              window.location.href = $data.data.url;
          }
          
          if($data.data.errores){
            Materialize.toast('Ingresa tus datos correctamente', 4000);
            $scope.errores = $data.data.errores;
            $('input[name="name"]').focus();
          }
          
        }, function(){
          alert("Error :(")
        });
      }else{
        Materialize.toast('Tienes que aceptar los terminos y condiciones', 4000);
      }
  }
  // END REGISTRO ------------------------
  //LOGIN SECTION
  $scope.errlogin = {};
  $scope.loginform = {};
  $scope.envLogin = false;
  $scope.enviarLogin = function(){
      if($scope.loginform.email !== "" && $scope.loginform.password !== ""){
        $scope.envLogin = true;
        
        $http.post($scope.url.login, $scope.loginform).then(function($data){
          $scope.envLogin = false;
          
          if($data.data.estado == "true"){
              window.location.href = $data.data.url;
          }
          
          if($data.data.estado == "false"){
             Materialize.toast('No existe este usuario en Formando Código', 4000);
          }
          
          if($data.data.errores){
            Materialize.toast('Algunos datos ingresados estan mal', 4000);
            $scope.errlogin = $data.data.errores;
            $('#login input[name="email"]').focus();
          }
          
        }, function(){
          Materialize.toast('Error en el servidor, contáctanos: info@formandocodigo.com', 4000);
        });
      }else{
        Materialize.toast('Ingresa tus datos correctamente', 4000);
      }
  }
  //END LOGIN ----------------------------
});