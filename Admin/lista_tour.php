
<?php 
session_start();

if(!isset($_SESSION['user_id'])){
header('location:login.php');
} else {

}
?>
<?php
include('config.php');

$query = "SELECT P.id, P.name, P.status,  C.name AS category FROM tours P JOIN category C ON P.category_id = C.id";
$blog = $pdo->prepare($query);
$blog->execute();

$result = $blog->fetchAll();



include('includes/header.php');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Lista de Tours</h4>
            <ol class="breadcrumb">
                
                
            </ol>
            
            <?php include('message.php'); ?>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <a href="crear_tour.php" class="btn btn-brown waves-effect waves-light float-right m-b-10 ">Crear Tour</a>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr class="text-center">
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>options</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                            <?php foreach($result as $dato): ?>
                        <tr class="text-center">
                            <td class="text-center"><?php echo $dato['id'] ?></td>
                            <td><?php echo $dato['name'] ?></td>
                            <td><?php echo $dato['category'] ?></td>
                            <td >
                                <?php if( $dato['status'] === "0"): ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">No disponible</span>
                                <?php endif ?>
                            </td>
                            
                            <td class="text-center">
                            <a href="<?php echo "editar_tour.php?id=" .$dato['id'] ?>"><i  class="fas fa-pencil-alt" style="color: violet;"></i></a>
                                     &nbsp; &nbsp;&nbsp;&nbsp;
                            <a onclick="delete_tour(<?php echo $dato['id'] ?>)"><i class="fas fa-trash-alt" style="color: #ec536c;"></i></a>  
                                

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
    function delete_tour(id){
            Swal.fire({
                title: "Estas seguro de eliminar este tour?",
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
                       location.href = 'delete_tour.php?id='+id;
                        Swal.fire(
                            'Eliminado!',
                            'El Tour fue eliminado.',
                            'success'
                        )
                    }
               });
        }
</script>