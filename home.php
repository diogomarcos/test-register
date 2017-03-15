<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 12/03/2017
 * Site: http://www.diogomarcos.com
 */

use Controller\ConfigurationDao;
include_once "Controller/ConfigurationDao.php";

session_start();

if (!isset($_SESSION['user_session'])) {
    header("Location: index.php");
}

/* inicio - informações do usuário logado */
include_once "includes/Connection.php";
$instance = Connection::getInstance();
$stmt = $instance->prepare("SELECT * FROM login WHERE id=:id");
$stmt->execute(array(":id"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
/* fim - informações do usuário logado */

$configuration_dao = new ConfigurationDao();
$configuration_data = $configuration_dao->readFirst();

include_once "template/header.php";
?>
<h2>Test Register :: <?php echo $configuration_data['website_name']; ?></h2>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
<?php endif; ?>

<div class="row">
    <div class="col-md-5"><img src="assets/images/create-8.jpg" class="img-responsive"></div>
    <div class="col-md-7">
        <p align="justify">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sagittis turpis ac ante blandit vehicula.
            Aenean a egestas neque, quis viverra mi. Phasellus vitae elit libero. Vivamus quis risus id augue gravida laoreet.
            Vivamus lobortis eros eu tincidunt ultrices. Suspendisse tristique odio vel dolor imperdiet elementum.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus euismod consequat nulla, a ullamcorper risus dictum sit amet.
            Sed fermentum magna tellus, id fringilla nisl iaculis at.
            Cras bibendum volutpat massa, ornare convallis enim.
            Phasellus auctor, ligula a tincidunt mollis, dolor tellus vestibulum purus, eu consequat libero lorem sit amet dui.
            Ut sit amet elementum massa, nec scelerisque eros. In pharetra tellus risus, a pharetra leo sollicitudin nec.
        </p>
        <p align="justify">
            Curabitur finibus ligula velit, a sodales lectus euismod non. Vivamus ac dui id est vestibulum varius at id libero.
            Curabitur varius fermentum ex non tempus. Integer rutrum a purus sed tempus.
            Sed et consectetur lectus. Pellentesque rutrum dui nec nunc vestibulum, id pellentesque nibh molestie.
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
            Pellentesque sem ligula, ullamcorper et ultrices vel, tincidunt non magna. Curabitur varius justo id interdum tempor.
        </p>
        <p align="justify">
            Etiam id dolor convallis, viverra nisl sit amet, maximus sem. Proin dapibus bibendum urna.
            Vestibulum ac quam odio. Quisque a malesuada nibh, quis ullamcorper mauris.
            Mauris non placerat risus, quis porta turpis. Morbi efficitur porta tellus. I
            n congue mollis velit ultrices volutpat. Cras quam quam, ullamcorper in porttitor quis, commodo a mi.
        </p>
    </div>
</div>

<?php include_once "template/footer.php"; ?>