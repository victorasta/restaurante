

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuario
        <small>Perfil</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Perfil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Perfil </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-condensed table-hovered">
                <tr>
                  <th>Usuario</th>
                  <td><?php echo $user_data['username']; ?></td>
                </tr>
                <tr>
                  <th>Correo</th>
                  <td><?php echo $user_data['email']; ?></td>
                </tr>
                <tr>
                  <th>Nombres</th>
                  <td><?php echo $user_data['firstname']; ?></td>
                </tr>
                <tr>
                  <th>Apellido(s)</th>
                  <td><?php echo $user_data['lastname']; ?></td>
                </tr>
                <tr>
                  <th>Género</th>
                  <td><?php echo ($user_data['gender'] == 1) ? 'Masculino' : 'Femenino'; ?></td>
                </tr>
                <tr>
                  <th>Teléfono</th>
                  <td><?php echo $user_data['phone']; ?></td>
                </tr>
                <tr>
                  <th>Grupo</th>
                  <td><span class="label label-info"><?php echo $user_group['group_name']; ?></span></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#profileMainNav").addClass('active');
    });
  </script>
