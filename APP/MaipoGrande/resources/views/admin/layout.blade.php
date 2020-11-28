<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Administrador | Maipo Grande</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- material icons google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    @include('admin.navbar')

    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <div class="content mt-3">
        <div class="container-fluid">
          @yield('content')
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->


    <!-- Main Footer -->
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('../plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('../plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('../dist/js/adminlte.min.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js%22%3E"></script>


    <script type="text/javascript">


  function ConsultaUserbyRut(e){

    var Rut = e; 


    $.ajax({
          type: 'POST',
          url: "{{ route('getUserByRut') }}",
          data: {
            "_token": $("meta[name='csrf-token']").attr("content"),


            "rut": Rut,

          }

          ,
          success: function(data) {
            var json = JSON.stringify(data);
            var Obj = JSON.parse(json);
            console.log(Obj.NOMBRE)

            document.getElementById("rut_edit").value = Obj.RUT;
            document.getElementById("dv_edit").value = Obj.DIGITO_VERIFICADOR;
            document.getElementById("nombre_edit").value = Obj.NOMBRE;
            document.getElementById("apellido_edit").value = Obj.APELLIDO;
            document.getElementById("tipocomprador_edit").value = Obj.TIPOCOMPRADOR;
            document.getElementById("tipopersona_edit").value = Obj.TIPOPERSONA;
            document.getElementById("nombrefantasia_edit").value = Obj.NOMBRE_FANTASIA;
            document.getElementById("comuna_edit").value = Obj.AS;
            document.getElementById("codigopostal_edit").value = Obj.CODIGO_POSTAL;
            document.getElementById("telefono_edit").value = Obj.TELEFONO;
            document.getElementById("correo_edit").value = Obj.CORREO;
            //document.getElementById("contrasenia_edit").value = Obj.CONTRASENA;


            $('#editarModal').modal('show')






          },

          error: (error) => {
            

            console.log(error);
          },

          })
  }

  


      $('#UserCreatedForm').submit(function(e) {
        e.preventDefault(); //evitar recargar la pagina


        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var rutUser = $('#rut').val();
        var dv = $('#dv').val();
        var tipocomprador = $('#tipocomprador').val();
        var tipopersona = $('#tipopersona').val();
        var nombrefantasia = $('#nombrefantasia').val();
        var comuna = $('#comuna').val();
        var codigopostal = $('#codigopostal').val();
        var telefono = $('#telefono').val();
        var correo = $('#correo').val();
        var contrasenia = $('#contrasenia').val();


        $.ajax({
          type: 'POST',
          url: "{{ route('CrearUsuario') }}",
          data: {
            "_token": $("meta[name='csrf-token']").attr("content"),


            "nombre": nombre,
            "apellido": apellido,
            "rut": rutUser,
            "dv": dv,
            "tipocomprador": tipocomprador,
            "tipopersona": tipopersona,
            "nombrefantasia": nombrefantasia,
            "comuna": comuna,
            "codigopostal": codigopostal,
            "telefono": telefono,
            "correo": correo,
            "contrasenia": contrasenia
          },
          success: function(data) {
            var json = JSON.stringify(data);
            var Obj = JSON.parse(json);

            if(Obj.length === 0){

              //alert('ok')
              //$('#prueba').modal('toggle')
              dat
            }else{
              alert('error')
            }

            console.log(Obj.length)


          },

          error: (error) => {
            alert('Formulario incompleto')

            console.log(error);
          },
        });
      });


      //function mostrarMensaje(mensaje){
        //$("#prueba").empty(); //limpiar modal
        //$("#prueba").append("<p>"+mensaje+"</p>"); //limpiar modal
        //$("#prueba").show(500); //limpiar modal
        //$("#prueba").hide(5000); //limpiar modal
        
      //}


      // $('#updateUserForm').submit(function(e) {
      //   e.preventDefault();

      //    //// alert('funciona')

      //   var nombre = $('#nombre').val();
      //   var apellido = $('#apellido').val();
      //   var rutUser = $('#rut').val();
      //   var dv = $('#dv').val();
      //   var tipocomprador = $('#tipocomprador').val();
      //   var tipopersona = $('#tipopersona').val();
      //   var nombrefantasia = $('#nombrefantasia').val();
      //   var comuna = $('#comuna').val();
      //   var codigopostal = $('#codigopostal').val();
      //   var telefono = $('#telefono').val();
      //   var correo = $('#correo').val();
      //   var contrasenia = $('#contrasenia').val();


      //   $.ajax({
      //     type: 'POST',
      //     url: "{{ route('ModificarUsuario') }}",
      //     data: {
      //       "_token": $("meta[name='csrf-token']").attr("content"),

      //       "nombre": nombre,
      //       "apellido": apellido,
      //       "rut": rutUser,
      //       "dv": dv,
      //       "tipocomprador": tipocomprador,
      //       "tipopersona": tipopersona,
      //       "nombrefantasia": nombrefantasia,
      //       "comuna": comuna,
      //       "codigopostal": codigopostal,
      //       "telefono": telefono,
      //       "correo": correo,
      //       "contrasenia": contrasenia
      //     },
      //     success: function(data) {
      //       var json = JSON.stringify(data);
      //       var Obj = JSON.parse(json);

      //       if(Obj.length === 0){

      //         //alert('ok')
      //         $('#prueba').modal('toggle')
      //       }else{
      //         alert('error')
      //       }

      //       console.log(Obj.length)
      //     },

      //     error: (error) => {
      //       alert('Formulario incompleto')

      //       console.log(error);
      //     },
      //   });
      // });


    </script>
</body>

</html>