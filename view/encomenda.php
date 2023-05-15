<?php
if (!session_start()) {

    session_start();
}

$codCliente = '';
require_once('../includes/header.php');

use classes\Database\Database;

$bd = new Database();

$codCliente = '';
if (!isset($_SESSION['codCliente'])) {
    header("location: login.php?login=nao_logado");
    exit;
} else {
    $codCliente = $_SESSION['codCliente'];
}

$cliente = $bd->select("SELECT * FROM cliente c JOIN utilizador u ON c.user = u.id WHERE codCliente = '$codCliente'");

$mensagem = '';
if(isset($_GET['resultado'])) {
    $resultado = $_GET['resultado'];
    if($resultado == "indefinido") {
        $mensagem = "<div class='alert alert-danger text-center'>Preencha todos os campos</div>";
    } else if($resultado == "-2") {
        $mensagem = "<div class='alert alert-danger text-center'>Saldo indisponível</div>";
    } else if($resultado == "-1") {
        $mensagem = "<div class='alert alert-danger text-center'>Cartão expirado</div>";
    } else if($resultado == "0") {
        $mensagem = "<div class='alert alert-danger text-center'>Dados incorretos</div>";
    }
    
}
?>

<main>
    <div class="categoria-title">
        <h2 class="nomeCategoria">Fazer Encomenda</h2>
    </div>

    <div class="row px-xl-5 x ">
        <div class="col-lg-8">
            <div class="bg-dark p-4 mb-5 dados-encomenda ">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Dados para entrega</span></h5>
                <?=$mensagem?>
                <?php
                    foreach ($cliente as $cli) {
                    ?>
                <div class="row">
                    
                        <div class="col-md-6">
                            <label for="nome" class="form-label fw-bold">Nome</label>
                            <input class="form-control" id="nome" type="text" value="<?= $cli->nome ?>" >
                            <input id="id" type="hidden" value="<?= $cli->codCliente ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">E-mail</label>
                            <input class="form-control" id="email" type="email" value="<?= $cli->email ?>" >
                        </div>
                        <div class="col-md-6">
                            <label for="telefone" class="form-label fw-bold">Numero de Telemovel</label>
                            <input class="form-control" id="telefone" type="tel" maxlength="7" value="<?= $cli->telefone ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="ilha" class="form-label fw-bold">Ilha</label>
                            <select id="ilha" class="form-select" >
                                <option selected style="color: black;" value="Santiago">Santiago</option>
                                <option style="color: black;" value="Fogo">Fogo</option>
                                <option style="color: black;" value="Brava">Brava</option>
                                <option style="color: black;" value="Maio">Maio</option>
                                <option style="color: black;" value="Boavista">Boavista</option>
                                <option style="color: black;" value="Sal">Sal</option>
                                <option style="color: black;" value="São Nicolau">São Nicolau</option>
                                <option style="color: black;" value="São Vicente">São Vicente</option>
                                <option style="color: black;" value="Santo Antão">Santo Antão</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="municipio" class="form-label fw-bold" >Municipio</label>
                            <input class="form-control" id="municipio" type="text" placeholder="Praia" >
                        </div>
                        <div class="col-md-6">
                            <label for="localidade" class="form-label fw-bold">Localidade</label>
                            <input class="form-control" id="localidade" type="text" >
                        </div>
                    
                </div>
                <?php } ?>
                <div class="row">
                    <h5 class="section-title position-relative text-uppercase mb-3 mt-5"><span class="pr-3">Pagamento</span></h5>
                    <div>
                    <p class="mb-0">Cartões aceites</p>
                    <img src="../includes/img/vinti4_2.png" style="width: 60px;"><br>
                    </div>
                    

                    <div class="col-md-6">
                        <label for="nome" class="form-label fw-bold">Número do cartão</label>
                        <input class="form-control" id="card_number" type="number" maxlength="16" value="<?= $cli->nome ?>" >
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Validade</label>
                        <input class="form-control" type="text" id="validade" pattern="^((0[1-9])|(1[0-2]))\/(\d{2})$" placeholder="12/26" >
                    </div>
                    <div class="col-md-6">
                        <label for="telefone" class="form-label fw-bold">CVV</label>
                        <input class="form-control" id="cvv" type="number" maxlength="4" >
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-block btn-primary border-0 fw-bold mt-4 py-3 ms-auto me-auto btn-finalizar" type="submit" style="width: 97%; background: rgb(250,100,20);" >Finalizar encomenda</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-dark pr-3">Total de ordem</span></h5> -->
            <?php
            $total_preco = 0;

            ?>
            <div class="bg-dark p-4 mb-5">
                <div class="border-bottom dados-produtos-enco">
                    <h5 class="mb-3 fw-bold">Produtos</h5>
                    <?php
                    if (isset($_SESSION['carrinho'])) {
                        $carrinho = $_SESSION['carrinho'];
                        $i = 0;
                        if (!empty($carrinho)) {
                            foreach ($carrinho as $key => $value) {
                                $total_preco += $value['item_total'];
                        ?>
                                <div class="d-flex justify-content-between">
                                    <p><?= $value['item_nome'] . '&nbsp;<span style="color: rgb(250,100,20);">(x' . $value['item_quantidade'] . ')</span>' ?></p>
                                    <p><?= number_format($value['item_total'], 2, ',', '.') ?></p>
                                    <input type="hidden" id="id_prod_<?=$i?>" value="<?=$value['item_id']?>">
                                    <input type="hidden" id="qtd_<?=$i?>" value="<?=$value['item_quantidade']?>">
                                    <input type="hidden" id="total_<?=$i?>" value="<?=$value['item_total']?>">
                                </div>
                        <?php   
                            $i++;
                            }
                        ?>
                        <input type='hidden' id='count_id' value='<?=$i?>'>
                        <?php
                        }
                    }
                    ?>
                    
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><?= number_format($total_preco, 2, ',', '.') ?></h5>
                        <input type="hidden" id="preco_total" value="<?=$total_preco?>">
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php
require_once('../includes/footer.php');
?>