<nav class="navbar navbar-default " role="navigation">
    <!-- El logotipo y el icono que despliega el menú se agrupan
         para mostrarlos mejor en los dispositivos móviles -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" title="Sistema de Monitoreo de los Vegetales 'Inicio' " href="index.php">SMV</a>
    </div>

    <!-- Agrupar los enlaces de navegación, los formularios y cualquier
         otro elemento que se pueda ocultar al minimizar la barra -->
    <div id="collapse" class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="">Registrarse</a></li>
            <?php
            if (isset($_SESSION['nombre'])) {

                if (isset($_SESSION['idpersona'])) {
                    ?>      
            <li><a href="mapas.php">Campos</a></li>
                <?php } ?> 
            <li><a href="noticias.php">Imagenes</a></li>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <?php
            if (isset($_SESSION['perfil'])) {
                if ($_SESSION['perfil'] == 1) {
                    ?>
                    <li><a href="usuarios.php">Usuarios</a></li>    

                    <?php
                }
                 if (($_SESSION['perfil'] == 1) ||($_SESSION['perfil'] == 3) ) {
                    ?>
<!--                    <li><a href="sig.php" title="Registros de mapas Sig" >Sig</a></li>    -->

                    <?php
                }
                
            }
        }
        if (!isset($_SESSION['nombre'])) {
            ?>
            <li><a href="ingresar.php">Ingresar</a></li>

        <?php } else {
            ?>
            <li><a href="logout.php">Salir</a></li>
            <li><a href="ayuda.php" class="glyphicon glyphicon-question-sign"></a></li>
      </ul>
           <?php
    }
    
            
     
        if (isset($_SESSION['nombre'])) { 
        ?>
        <ul class="nav  navbar-nav navbar-right  ">
            <li><a href=""><span class="badge"><?php echo $_SESSION['nombre'] ?> </span> </a>       
                 </li>
        </ul>   
    <?php } ?>


    </div>
</nav>