
<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    
    }
?>
<?php
include('includes/header.php');

?>


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Crear Projecto</h4>
                <ol class="breadcrumb">
                </ol>
            </div>
        </div>
</div>

<div class="row">
    <div class="col-lg-12">
    <div class="card m-b-20">
        
        <div class="card-body">

            <?php include('message.php'); ?>

            
            <form class="" action="create_project.php" method="POST" enctype="multipart/form-data">
            <?php if(isset($_GET['ok'])): ?>
                <?php if ($_GET['ok'] == 'error'): ?>
                <div
                    class="p-4 mb-8 font-semibold text-md text-center rounded-lg shadow-md text-red-700 bg-red-100"
                >
                    <span>Ocurrio un error al crear el proyecto verifica la información que ingresaste e intentalo de nuevo.</span>
                </div>
                <?php endif ?>
            <?php endif; ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control"  name="nombre" required placeholder="Escriba el nombre"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" class="form-control"  name="full_name" required placeholder="Escriba el nombre completo del proyecto"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <div>
                                <input type="text"  name="categoria" class="form-control" required placeholder="Escriba la categoria"/>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio</label>
                            <div>
                                <input type="text"  name="price" class="form-control" required placeholder="Escriba el precio"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Año</label>
                            <div></div>
                                <input type="text" class="form-control" required  name="year"  placeholder="Escribe el año"/>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Metros<sup>2</sup></label>
                            <div></div>
                                <input type="text" class="form-control" required  name="metros_cuadrados"  placeholder="Escribe los metros cuadrados"/>
                            </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ubicación</label>
                            <div></div>
                                <input type="text" class="form-control" required  name="ubicacion"  placeholder="Escribe la ubicación"/>
                            </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen</label>
                            <div>
                            <input 
                                type="file" 
                                class="filestyle" 
                                name="images[]" 
                                data-buttonname="btn-secondary"  
                                multiple>
                            </div>
                        </div>
                    </div>

                    
                    

                    
                    
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="register-btn" class="btn btn-client waves-effect waves-light mr-1">
                            Crear
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_projects.php">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>