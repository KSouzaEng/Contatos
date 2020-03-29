<?php

session_start();

if (!isset($_SESSION['contatos'])) {
    $_SESSION['contatos'] = array();
}

if (isset($_POST['nome'])) {


    if($_POST['nome'] == "" || $_POST['telefone'] == "") {
        $_SESSION['msg'] = '<br>Nome e telefone são obrigatórios<br>';
        header('Location: /estudo-poo-um/');
        exit;
    }

    $contato = new Contato();
    $contato->setNome($_POST['nome']);
    $contato->setTelefone($_POST['telefone']);

    array_push($_SESSION['contatos'], array(
        'nome' => $contato->getNome(),
        'telefone' => $contato->getTelefone()
    ));

    header('Location: /estudo-poo-um/');
}

function listarContatos()
{
    echo "<table class='table table-bordered table table-striped'>";
    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Telefone</th>";
    echo "<th>Açoes</th>";
    echo "</tr>";
    foreach($_SESSION['contatos'] as $key => $value)
    {
        echo "<tr>";
        echo "<td>" . $value['nome']."</td>";
        echo "<td>" . $value['telefone']."</td>" ;
        echo "<td><br><a href='?comando=excluir&id=".$key."'class='btn btn-sm btn-danger'>Excluir</a></td>";
        echo "</tr>";
        
    }
    echo "</table>";
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if (isset($_GET['comando'])) {
    if ($_GET['comando'] == 'limparLista') {
        $_SESSION['contatos'] = array();
    }

    if($_GET['comando']== 'excluir'){

        array_splice($_SESSION['contatos'],$_GET['id'],1);
    }

    header('Location: /estudo-poo-um/');
}

