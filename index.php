<?php 
require_once 'adicionar.php';
$p = new acesso("NomeBancoDados","localHospedagemBanco","LoginDoBanco","SenhaBanco");//Não esqueça de substituir os devidos parametros de acesso ao banco de dados.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Telefonica</title>
    <link rel="stylesheet" href="./css./estilo.css">
    <script src="./js./jsindex.js"></script>
</head>
<body>
    <section class="adicionar">
        <h1>Adicionar Contato</h1>
        <form method="POST">
            <input type="text" id="nome" name="nome" placeholder="Nome">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone">
            <input type="email" id="email" name="email" placeholder="E-mail">
            <label for="descricaocontato">Descrição do Contato</label>
            <input type="text" id="descricaocontato" name="descricaocontato" placeholder="Descrição do Contato">
            <input type="submit" onclick="return validar_dados()" value="Salvar Contato">
        </form>
        <?php
            if (isset($_POST['email'])) {
                $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
                $descricao = addslashes($_POST['descricaocontato']);
                if (!empty($nome) && !empty($telefone) && !empty($email)) {
                    if (!$p->cadastrar_cliente($nome, $telefone, $email, $descricao)) {
                        echo "O E-mail: ".$email." já esta cadastrado.";
                    }else {
                        header("location: index.php");
                    }    
                }
            }
            
        ?>
    </section>
    <section class="listacontatos">
        <h1>Lista de Contatos</h1>
            <?php
                $respostaBanco = $p->exibir_dados();
                if (count($respostaBanco)>0) {
                    for ($i=1; $i < count($respostaBanco); $i++) { 
                        echo "<div class='informacaocontato'>";
                        foreach ($respostaBanco[$i] as $k => $v) {
                            if ($k != "id") {
                                if ($k == "nome") {
                                    echo "<p class='infonome'>".$v."</p>";
                                }
                                if ($k == "telefone") {
                                    echo "<p class='infotelefone'>".$v."</p>";
                                }
                                if ($k == "email") {
                                    echo "<p class='infoemail'>".$v."</p>";
                                }
                                if ($k == "descricao") {
                                    echo "<p class='infodescricao'>".$v."</p>";
                                }
                                //print_r($respostaBanco);
                            }
                        }
                        echo "</div>";
                    }                   
                }else {
                    echo "Começe a salvar seus contatos =)";
                }
            ?>
    </section>
    <section class="atividades">
        <h1>Atividades Recentes</h1>
        <section id="mensagens">
            <div class="mensagem">Suas Mensagens irão aparecer aqui!​</div>
        </section>
    </section>
</body>
</html>