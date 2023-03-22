<?php 
session_start();

if(!isset($_SESSION['user_id'])){
header('location:login.php');
} else {

}
?>
<?php
include('config.php');

$query = "SELECT * FROM projects";
$projects = $pdo->prepare($query);
$projects->execute();

$result = $projects->fetchAll();

include('includes/header.php');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Lista de Projectos</h4>
            <ol class="breadcrumb">
                
                
            </ol>
            
            <?php include('message.php'); ?>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <a href="crear_project.php" class="btn btn-client waves-effect waves-light float-right m-b-10 ">Crear Proyecto</a>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr class="text-center">
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                            <?php foreach($result as $dato): ?>
                        <tr class="text-center">
                            <td class="text-center"><?php echo $dato['id'] ?></td>
                            <td><?php echo $dato['nombre'] ?></td>
                            <td ><?php echo $dato['categoria']?></td>
                            <td class="text-center">
                            <a href="<?php echo "editar_project.php?id=" .$dato['id'] ?>"><i  class="fas fa-pencil-alt" style="color: violet;"></i></a>
                                     &nbsp; &nbsp;&nbsp;&nbsp;
                            <a onclick="delete_blog(<?php echo $dato['id'] ?>)"><i class="fas fa-trash-alt" style="color: #ec536c;"></i></a>  
                                

                            </td>
                        </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
</div> <!-- end row -->

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>
<script>
    function delete_blog(id){
            Swal.fire({
                title: "Estas seguro de eliminar este proyecto?",
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
                       location.href = 'delete_project.php?id='+id;
                        Swal.fire(
                            'Eliminado!',
                            'El usuario fue eliminado.',
                            'success'
                        )
                    }
               });
        }
</script>
