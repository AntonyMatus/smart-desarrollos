
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    }
include('config.php');
if(!isset($_GET['id'])) exit();

$id = $_GET['id'];
$sql = $pdo->prepare("SELECT * FROM tours WHERE id= ?;");
$sql->execute([$id]);
$tour = $sql->fetch(PDO::FETCH_OBJ);
if($tour === FALSE){
    echo "No existe alguna persna con ese ID";
    exit(0);
}

$query = "SELECT * FROM category";
$sql_2 = $pdo->prepare($query);
$sql_2->execute();
$result = $sql_2->fetchAll(PDO::FETCH_OBJ);


?>



<?php require 'includes/header.php' ?>

<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Editar Blog</h4>
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

            
            <form class="" action="edit_tour.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="hidden" name="id" value="<?php echo $tour->id ?>">
                            <input type="text" class="form-control"  name="name" required placeholder="Escriba el nombre" value="<?php echo $tour->name?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status disponibilidad</label>
                            <div>
                                <select name="status" class="form-control">
                                    <option value="">Seleccione el status</option>
                                    <option <?php if($tour->status == 0): ?> selected <?php endif ?> value="0" >SI</option>
                                    <option <?php if($tour->status == 1): ?> selected <?php endif ?> value="1">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio por Adulto</label>
                            <input type="number" step="any" class="form-control"  name="price_adult" required placeholder="Escriba aqui el precio" value="<?php echo $tour->price_adult?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Restricción de edad</label>
                            <input type="text" class="form-control"  name="rest_year_Adult" required placeholder="Escriba aqui las restricciones" value="<?php echo $tour->rest_year_adult?> "/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio por Niños</label>
                            <input type="number" step="any" class="form-control"  name="price_child" required placeholder="Escriba aqui el precio" value="<?php echo $tour->price_child ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Restricción de edad</label>
                            <input type="text" class="form-control"  name="rest_year_child" required placeholder="Escriba aqui las restricciones" value="<?php echo $tour->rest_year_child ?> "/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <div>
                                <select name="category_id" class="form-control">
                                    <option value="">Seleccione la categoria</option>
                                    <?php foreach($result as $dato): ?>
                                    <option <?php if($dato->id === $tour->category_id): ?> selected <?php endif ?> value="<?php echo $dato->id ?>"><?php echo $dato->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de cambio</label>
                            <input type="number" step="any" class="form-control"  name="dollar_change" required placeholder="Escriba aqui el tipo de cambio" value="<?php echo $tour->dollar_change ?>"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen</label>
                            <div>
                            <input type="file" class="filestyle" name="image" data-buttonname="btn-secondary">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cuerpo</label>
                            <div>
                                <textarea name="body" id="body" required ><?php echo $tour->body ?></textarea>
                            </div>
                        
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="edit-btn" class="btn btn-brown waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_tour.php">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
            <br><br>
            <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
                <div class="flex justify-center">
                    <div style="position: relative;">
                    <div class="mt-2 ml-2" style="display: flex; position: absolute;">
                        <a
                        class="flex items-center justify-between px-2 py-2 mr-2 text-md font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray bg-white"
                        aria-label="Edit"
                        title="Imagen de portada"
                        >
                        Imagen de portada
                        </a>
                    </div>
                    <img width="300px" loading="lazy" src="assets/images/tours/<?php echo $tour->cover  ?>" />
                    </div>
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