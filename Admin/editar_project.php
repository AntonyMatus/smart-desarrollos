<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    
    }

    require 'config.php';

    $id = intval($_GET['id']);

    $sqProject = "SELECT * FROM projects where id = :id"; 
    $queryProject = $pdo->prepare($sqProject);
    $queryProject->bindParam(':id', $id, PDO::PARAM_INT);
    $queryProject->execute();
    $project = $queryProject->fetch(PDO::FETCH_OBJ);


    $sqlImages = "SELECT * FROM project_images where project_id = :project_id";
    $queryImages = $pdo->prepare($sqlImages);
    $queryImages->bindParam(':project_id', $id, PDO::PARAM_INT);
    $queryImages->execute();
    $images = $queryImages->fetchAll(PDO::FETCH_OBJ);

?>
<?php
include('includes/header.php');
?>


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Editar Projecto</h4>
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

            
            <form class="mb-5" action="edit_project.php?id=<?php echo $project->id ?>" 
            method="POST" 
            enctype="multipart/form-data">
                <?php if(isset($_GET['ok'])): ?>
                    <?php if ($_GET['ok'] == 'success'): ?>
                        <div
                            class="p-4 mb-8 font-semibold text-md text-center rounded-lg shadow-md text-green-700 bg-green-100"
                        >
                            <span>Proyecto actualizado.</span>
                        </div>
                        <?php endif ?>
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
                            <input type="text" class="form-control"  name="nombre" required value="<?php echo $project->nombre ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" class="form-control"  name="full_name" required value="<?php echo $project->full_name ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <div>
                                <input type="text"  name="categoria" class="form-control" required  value="<?php echo $project->categoria ?>"/>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio</label>
                            <div>
                                <input type="text"  name="price" class="form-control" required 
                                value="<?php echo $project->price ?>"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Año</label>
                            <div></div>
                                <input type="text" class="form-control" required  name="year"  
                                value="<?php echo $project->year ?>"/>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Metros<sup>2</sup></label>
                            <div></div>
                                <input type="text" class="form-control" required  name="metros_cuadrados"  
                                value="<?php echo $project->metros_cuadrados ?>"/>
                            </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ubicación</label>
                            <div></div>
                                <input type="text" class="form-control" required  name="ubicacion"  
                                value="<?php echo $project->ubicacion ?>"/>
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
                            Actualizar
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_projects.php">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
            <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
      <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 justify-center">
        <?php foreach ($images as $image) { ?>
          <div style="position: relative;">
            <?php if ($project->cover != $image->filename) { ?>
              <div class="mt-2 ml-2" style="display: flex; position: absolute;">
                <a
                  class="flex items-center justify-between px-2 py-2 mr-2 text-md font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray bg-white"
                  aria-label="Edit"
                  title="Imagen de portada"
                  onclick="setCoverProject(<?php echo $image->id ?>, <?php echo $project->id ?>)"
                >
                  <svg class="w-5 h-5" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                  </svg>
                </a>
                <a
                  class="flex items-center justify-between px-2 py-2 text-md font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray bg-white"
                  aria-label="Delete"
                  title="Eliminar"
                  onclick="deleteImageProject(<?php echo $image->id ?>, <?php echo $project->id ?>)"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                  </a>
              </div>
            <?php } ?>
            <img class="img-size" loading="lazy" src="assets/images/projects/<?php echo $image->filename ?>" />
          </div>
        <?php } ?>
      </div>
    </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>
<script>
    function setCoverProject(id, project_id) {
        Swal.fire({
                    title: "¿Esta seguro de realizar esta acción?",
                    text: "!No podrás revertir esto!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#58db83",
                    cancelButtonColor: "#ec536c",
                    confirmButtonText: "Si, eliminar!",
                    cancelButtonText: 'Cancelar!',
                }).then(function (result) {
                        if(result.value)
                        {
                        location.href = 'cover.php?id='+id;
                            Swal.fire(
                                'Eliminado!',
                                'El imagen de portada ha sido actualizada.',
                                'success'
                            )
                            location.href = 'editar_project.php?id='+project_id;
                        }
            });
        }

        function deleteImageProject(id, project_id) {
        Swal.fire({
                    title: "¿Esta seguro de realizar esta acción?",
                    text: "!No podrás revertir esto!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#58db83",
                    cancelButtonColor: "#ec536c",
                    confirmButtonText: "Si, eliminar!",
                    cancelButtonText: 'Cancelar!',
                }).then(function (result) {
                        if(result.value)
                        {
                        location.href = 'deleteImage.php?id='+id;
                            Swal.fire(
                                'Eliminado!',
                                'El imagen de portada ha sido Eliminada.',
                                'success'
                            )
                            location.href = 'editar_project.php?id='+project_id;
                        }
            });
        };
      
    
    
</script>

