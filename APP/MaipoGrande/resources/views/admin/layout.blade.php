<!DOCTYPE html>

@laravelPWA
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
  <!-- Font family-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Montserrat:ital,wght@0,400;0,500;0,900;1,500;1,700;1,800&display=swap" rel="stylesheet">

  <!-- Sweet alert--->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">

  <!-- material icons google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    @include('admin.navbar')

    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="font-family: 'Montserrat', sans-serif;">

<!--style="background: url(../imagenes/contacto.jpg) no-repeat center; background-size: cover; font-family: 'Cinzel Decorative', cursive;
      font-family: 'Montserrat', sans-serif; -->


      <!-- Main content -->
      <div class="content mt-3">
        <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach($errors->all() as $error) 
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
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

    <!-- jQuery 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js%22%3E"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
    <script src="{{asset('../plugins/jquery/jquery.min.js')}}"></script> 
    <!-- Bootstrap 4 -->
    <script src="{{asset('../plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('../dist/js/adminlte.min.js')}}"></script>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



    <script type="text/javascript">
      function ConsultaUserbyRut(e) {

        var Rut = e;


        $.ajax({
          type: 'POST',
          url: "{{ route('getUserByRut') }}",
          data: {
            "_token": $("meta[name='csrf-token']").attr("content"),


            "rut": Rut,
            

          }
          ,
          success: function(data){
            if (data.status == 'success'){
                //obtener datos
                var persona = data.persona
                var usuario = data.usuario
                var perfil = data.perfil
                var tipoPersonaLegal = data.tipoPersonaLegal

                //asignar datos
                $('#rut_edit').val(persona.RUT)
                $('#dv_edit').val(persona.DIGITO_VERIFICADOR)
                $('#nombre_edit').val(persona.NOMBRE)
                $('#apellido_edit').val(persona.APELLIDO)
                $('#tipocomprador_edit').val(perfil.ID_PERFIL)
                $('#tipopersona_edit').val(tipoPersonaLegal.ID_TIPO_PERSONA_LEGAL)
                $('#nombrefantasia_edit').val(persona.NOMBRE_FANTASIA)
                $('#comuna_edit').val(persona.ID_COMUNA)
                $('#codigopostal_edit').val(persona.CODIGO_POSTAL)
                $('#telefono_edit').val(persona.TELEFONO)
                $('#correo_edit').val(usuario.CORREO)

                $('#editarModal').modal('show')
            } else{
              console.log(data.exception)
            }
          },

          error: function(error){
            console.log(error);
          },

        })
      }

      $('#editarModal').on('modal.bs.hidden', function(){
        $('#rut_edit').val("")
        $('#dv_edit').val("")
        $('#nombre_edit').val("")
        $('#apellido_edit').val("")
        $('#tipocomprador_edit').val("")
        $('#tipopersona_edit').val("")
        $('#nombrefantasia_edit').val("")
        $('#comuna_edit').val("")
        $('#codigopostal_edit').val("")
        $('#telefono_edit').val("")
        $('#correo_edit').val("")
        $('#codigopostal_edit').val("")
        $('#contrasenia_edit').val("")
      })





      //alerta eliminacion usuario
      function AlertaEliminar(e) {

        var Rut = e;
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
      }

      $('#eliminar').submit(function(e){
    e.preventDefault();
    url = $(this).parent().attr('action');

      BootstrapDialog.confirm(
        '¿Está seguro que desea eliminar el elemento?', function(result){

        if(result) {
              $.ajax(url);
        }

      });
  });

      $('#UserCreatedForm').submit(function(e) {
        //e.preventDefault(); //evitar recargar la pagina
        //setTimeout(refresh, 10000);
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

            if (Obj.length === 0) {

              console.log(json);
              //alert('ok')
              //$('#prueba').modal('toggle')
              Swal.fire('Usuario Creado!')

            } else {
              //alert('error')
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Formulario incorrecto!',
                //footer: '<a href>Why do I have this issue?</a>'
              })

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


      $('#updateUserForm').submit(function(e) {
        //e.preventDefault();

         //// alert('funciona')

        var nombre = $('#nombre_edit').val();
        var apellido = $('#apellido_edit').val();
        var rutUser = $('#rut_edit').val();
        //var dv = $('#dv').val();
        var tipocomprador = $('#tipocomprador_edit').val();
        var tipopersona = $('#tipopersona_edit').val();
        var nombrefantasia = $('#nombrefantasia_edit').val();
        var comuna = $('#comuna_edit').val();
        var codigopostal = $('#codigopostal_edit').val();
        var telefono = $('#telefono_edit').val();

        
        // var apellido = $('#apellido_edit').val();
        // var rutUser = $('#rut_edit').val();
        // //var dv = $('#dv').val();
        // var tipocomprador = $('#tipocomprador_edit').val();
        // var tipopersona = $('#tipopersona_edit').val();
        // var nombrefantasia = $('#nombrefantasia_edit').val();
        // var comuna = $('#comuna_edit').val();
        // var codigopostal = $('#codigopostal_edit').val();
        // var telefono = $('#telefono_edit').val();
        //var correo = $('#correo').val();
        //var contrasenia = $('#contrasenia').val();


        $.ajax({
          type: 'POST', // PUT ES PARA MODIFICAR
          url: "{{ route('ModificarUsuario') }}",
          data: {
            "_token": $("meta[name='csrf-token']").attr("content"),

            "nombre": nombre,
            "apellido": apellido,
            "rut": rutUser,
            //"dv": dv,
            "tipocomprador": tipocomprador,
            "tipopersona": tipopersona,
            "nombrefantasia": nombrefantasia,
            "comuna": comuna,
            "codigopostal": codigopostal,
            "telefono": telefono,
            //"correo": correo,
            //"contrasenia": contrasenia
          },
          success: function(data) {
            var json = JSON.stringify(data);
            var Obj = JSON.parse(json);

            if(Obj.length === 0){

              console.log(json);
             
              alert('ok')
              
              //$('#editarModal').modal('toggle')
            }else{
              alert('error')
            }

            //console.log(Obj.length)
          },

          error: (error) => {
            alert('Formulario incompleto')

            console.log(error);
          },
        });
      });



      // $('#ProductCreatedForm').submit(function(e) {
      //   //e.preventDefault(); //evitar recargar la pagina
      //   //setTimeout(refresh, 10000);
      //   var nombreFruta = $('#nombreFruta').val();
      //   var descripcion = $('#descripcion').val();
      //   var imagen = $('#imagen').val();
      
      //   $.ajax({
      //     type: 'POST',
      //     url: "{{ route('CrearProducto') }}",
      //     data: {
      //       "_token": $("meta[name='csrf-token']").attr("content"),


      //       "nombreFruta": nombreFruta,
      //       "descripcion": descripcion,
      //       "imagenP": imagen
      //     },
      //     success: function(data) {
      //       var json = JSON.stringify(data);
      //       var Obj = JSON.parse(json);

      //       if (Obj.length === 0) {

      //         console.log(json);
      //         //alert('ok')
      //         //$('#prueba').modal('toggle')
      //         Swal.fire('Producto Creado!')

      //       } else {
      //         //alert('error')
      //         Swal.fire({
      //           icon: 'error',
      //           title: 'Oops...',
      //           text: 'Formulario incorrecto!',
      //           //footer: '<a href>Why do I have this issue?</a>'
      //         })

      //       }
      //       console.log(Obj.length)
      //     },

      //     error: (error) => {
      //       alert('Formulario incompleto')
      //       console.log(error);
      //     },
      //   });
      // });




      //producto 

      function getFruitById(id){
        $.ajax({
          type: 'GET',
          url: "{{ route('editProduct') }}",
          data: {
            id : id
          },
          success(response){
            data = JSON.parse(response)
            $("#product_id").val(data.ID_TIPO_FRUTA)
            $("#nombreEdit").val(data.NOMBRE)
            $("#descripcionEdit").val(data.DESCRIPCION)
            $("#old_foto").val(data.FOTO)
          }
        })
      }
    </script>
</body>

</html>