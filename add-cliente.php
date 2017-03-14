<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 14/03/2017
 * Site: http://www.diogomarcos.com
 */

session_start();

if (!isset($_SESSION['user_session'])) {
    header("Location: index.php");
}

include_once "includes/Connection.php";
$instance = Connection::getInstance();
$stmt = $instance->prepare("SELECT * FROM login WHERE id=:id");
$stmt->execute(array(":id"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

include_once "Controller/ConfigurationDao.php";
$configuration_dao = new \Controller\ConfigurationDao();
$configuration_data = $configuration_dao->readFirst();

include_once "Controller/ClientDao.php";
include_once "Model/Client.php";
include_once "Controller/PhoneDao.php";
include_once "Model/Phone.php";

if (isset($_POST['btn-save'])) {
    $created_at = date_create('now', new DateTimeZone('America/Sao_Paulo'));

    $client = new \Model\Client($_POST['name'],  $_POST['cpf'], $_POST['general_registration'], $_POST['date_of_birth'], $created_at->format("Y-m-d H:i:s"));
    $client_dao = new \Controller\ClientDao();

    if ($client_dao->create($client)) {
        $phone_data = $_POST['phone'];
        if (!empty($phone_data)) {
            foreach ($phone_data as $number) {
                if ($number!="") {
                    $phone = new \Model\Phone();
                    $phone->setClientId($client->getId());
                    $phone->setPhone($number);

                    $phone_dao = new \Controller\PhoneDao();
                    if (!$phone_dao->create($phone)) {
                        $_SESSION['message'] = 'Não foi possível salvar o telefone do Cliente.';
                        $_SESSION['type'] = 'danger';

                        header("Location: cliente.php");
                    }
                }
            }
        }

        $_SESSION['message'] = 'Cliente cadastrado com sucesso.';
        $_SESSION['type'] = 'success';

        header("Location: cliente.php");
    } else {
        $_SESSION['message'] = 'Não foi possivel cadastrar o Cliente.';
        $_SESSION['type'] = 'danger';

        header("Location: cliente.php");
    }
}

include_once "template/header.php";
?>
    <h2>Novo Cliente</h2>
    <form action="add-cliente.php" method="post">
        <div class="row">
            <div class="col-md-8 center-block">
                <table id="dynamic-phone" class="table table-responsive">
                    <tr>
                        <td>Nome</td>
                        <td><input type="text" name="name" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>CPF</td>
                        <td><input type="text" name="cpf" class="form-control" data-mask="000.000.000-00" required></td>
                    </tr>
                    <tr>
                        <td>RG</td>
                        <td><input type="text" name="general_registration" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Nascimento</td>
                        <td><input type="date" name="date_of_birth" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td>
                            <input type="text" name="phone[]" class="form-control" data-mask="(00)0000-00009">
                        </td>
                        <td>
                            <a id="add-input" class="btn btn-primary" href="javascript:void(0)">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Novo Telefone
                            </a>
                        </td>
                    </tr>
                </table>
                <table class="table table-responsive">
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn btn-primary" name="btn-save">
                                <span class="glyphicon glyphicon-plus"></span> &nbsp; Salvar
                            </button>
                            <a href="cliente.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Voltar</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="assets/scripts/phone.js"></script>

<?php include_once "template/footer.php"; ?>
