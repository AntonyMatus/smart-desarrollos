
<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    
    }
?>
<?php
include('includes/header.php');
include('config.php');

$query = "SELECT * FROM category";
$sql = $pdo->prepare($query);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);


?>


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Crear Tour</h4>
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

            
            <form class="" action="create_tour.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control"  name="name" required placeholder="Escriba el nombre"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status disponibilidad</label>
                            <div>
                                <select name="status" class="form-control">
                                    <option value="">Seleccione el status</option>
                                    <option value="0">SI</option>
                                    <option value="1">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio por Adulto</label>
                            <input type="text" class="form-control"  name="price_adult" required placeholder="Escriba aqui el precio" value="0"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Restricción de edad</label>
                            <input type="text" class="form-control"  name="rest_year_Adult" required placeholder="Escriba aqui las restricciones"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio por Niños</label>
                            <input type="text" class="form-control"  name="price_child" required placeholder="Escriba aqui el precio" value="0"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Restricción de edad</label>
                            <input type="text" class="form-control"  name="rest_year_child" required placeholder="Escriba aqui las restricciones"/>
                        </div>
                    </div>

                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <div>
                                <select name="category_id" class="form-control">
                                    <option value="">Seleccione la categoria</option>
                                    <?php foreach($result as $dato): ?>
                                    <option value="<?php echo $dato->id ?>"><?php echo $dato->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de cambio</label>
                            <input type="text" class="form-control"  name="dollar_change" required placeholder="Escriba aqui el tipo de cambio"/>
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
                                <textarea name="body" id="body" required ></textarea>
                            </div>
                        
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="register-btn" class="btn btn-brown waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_tour.php">
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