<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 13/03/2017
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
$client_dao = new \Controller\ClientDao();
$client_data = $client_dao->findAll();

include_once "Controller/PhoneDao.php";
$phone_dao = new \Controller\PhoneDao();

include_once "template/header.php";
?>

    <header>
        <div class="row">
            <div class="col-sm-6">
                <h2>Clientes</h2>
            </div>
            <div class="col-sm-6 text-right h2">
                <a class="btn btn-primary" href="add-cliente.php"><i class="glyphicon glyphicon-plus"></i> Novo Cliente</a>
                <a class="btn btn-default" href="cliente.php"><i class="glyphicon glyphicon-refresh"></i> Atualizar</a>
            </div>
        </div>
    </header>

    <?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
    <?php endif; ?>

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th width="25%">Nome</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Nascimento</th>
                <th>Telefone</th>
                <th>Criado em</th>
                <th colspan="2" align="center">Ações</th
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($client_data)) {
                foreach ($client_data as $row) {
            ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['name']); ?></td>
                        <td><?php print($row['cpf']); ?></td>
                        <td><?php print($row['general_registration']); ?></td>
                        <td><?php print($row['date_of_birth']); ?></td>
                        <td>
                            <?php
                            $phone_data = $phone_dao->findAll($row['id']);
                            if (!empty($phone_data)) {
                                foreach ($phone_data as $phone_row) {
                                    echo "<p>{$phone_row['number']}</p>";
                                }
                            } else {
                                echo "Não informado";
                            }
                            ?>
                        </td>
                        <td><?php print($row['created_at']); ?></td>
                        <td align="center">
                            <a href="edit-cliente.php?id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                        <td align="center">
                            <a class="delete" data-id="<?php print($row['id']); ?>" href="javascript:void(0)"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="9" align="center">Nenhum registro encontrado</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" align="center"><?php echo $client_dao->pagination(); ?></td>
            </tr>
        </tfoot>
    </table>
    <script type="text/javascript" src="assets/bootbox/bootbox.min.js"></script>
    <script type="text/javascript" src="assets/scripts/delete.js"></script>

<?php include_once "template/footer.php"; ?>