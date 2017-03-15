<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 14/03/2017
 * Site: http://www.diogomarcos.com
 */

use Controller\ConfigurationDao;
use Controller\StateDao;
use Model\Configuration;

include_once "Controller/ConfigurationDao.php";
include_once "Controller/StateDao.php";
include_once "Model/Configuration.php";

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

$state_dao = new StateDao();
$state_data = $state_dao->findAll();

if (isset($_POST['btn-update'])) {
    $configuration = new Configuration($_POST['website_name'], $_POST['version'], $_POST['state_id']);
    $configuration->setId($_GET['id']);
    if ($configuration_dao->update($configuration)) {
        $_SESSION['message'] = 'Configuração atualizado com sucesso.';
        $_SESSION['type'] = 'success';

        header("Location: home.php");
        exit();
    } else {
        $_SESSION['message'] = 'Não foi possivel atualzar a Configuração.';
        $_SESSION['type'] = 'danger';

        header("Location: home.php");
        exit();
    }
}

if (isset($_GET['id'])) {
    extract($configuration_data);
} else {
    header("Location: home.php");
}

include_once "template/header.php";
?>
    <h2>Configurar WebSite</h2>
    <form action="admin.php?id=<?php echo $id; ?>" method="post">
        <div class="row">
            <div class="col-md-8 center-block">
                <table class="table table-responsive">
                    <tr>
                        <td>Nome do Website</td>
                        <td><input type="text" name="website_name" class="form-control" value="<?php echo $website_name; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Versão do Website</td>
                        <td><input type="text" name="version" class="form-control" value="<?php echo $version; ?>" required></td>
                    </tr>
                    <tr>
                        <td>Estado do Website</td>
                        <td>
                            <select name="state_id" class="form-control" id="sel1">
                                <?php
                                foreach ($state_data as $row) {
                                    $selected = "";
                                    if ($row['id'] == $state_id) {
                                        $selected = "selected=\"selected\"";
                                    }
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>" >
                                        <?php echo $row['name']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <table class="table table-responsive">
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn btn-primary" name="btn-update">
                                <span class="glyphicon glyphicon-edit"></span> &nbsp; Atualizar
                            </button>
                            <a href="home.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Voltar</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>


<?php include_once "template/footer.php"; ?>
