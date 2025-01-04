<?php
include ('conexao.php');

$sql_clientes = "SELECT * FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    h1 {
        text-align: center;
        color: blue;
    }

    p {
        text-align: center;
        color: red;
        font-size: 20px;
    }

    table {
        margin: 0 auto;
        /* Centraliza a tabela horizontalmente */
        border: 1px solid black;
        /* Borda externa da tabela */
        border-collapse: collapse;
        /* Junta as bordas internas */
        width: 80%;
        /* Ajusta a largura da tabela */
    }

    th,
    td {
        border: 1px solid black;
        /* Borda interna das células */
        padding: 5px;
        /* Espaçamento dentro das células */
        text-align: left;
        /* Alinhamento do texto */
    }
    </style>

    <title>Lista de clientes</title>
</head>

<body>

    <h1>Lista de Clientes</h1>
    <p>Estes são os clientes cadastrados no seu sistema:</p>


    <table>
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if ($num_clientes == 0) { ?>
            <tr>
                <td colspan="7">Nenhum cliente foi encontrado</td>
            </tr>
            <?php } else { 
                    while($cliente = $query_clientes -> fetch_assoc()){    

                     //Alterando telefone da formatação americana para padrão brasileiro    
                    $telefone = "Não informado!";
                    if(!empty($cliente['telefone'])){
                        $ddd = substr ($cliente['telefone'], 0, 2);
                        $parte1 = substr ($cliente['telefone'], 2, 5);
                        $parte2 = substr ($cliente['telefone'], 7);
                        $telefone = "($ddd) $parte1-$parte2"; 
                    }
                    //Alterando nascimento da formatação americana para padrão brasileiro
                    $nascimento = "Não informada!";
                    if(!empty($cliente['nascimento'])){
                    $nascimento = implode('/', array_reverse(explode('-', $cliente['nascimento'])));
                    }
                    //Alterando data_cadastro da formatação americana para padrão brasileiro
                    // timestemp: é a quantidade de segundo contados apartir de 01/01/1970.
                    $data_cadastro = date("d/m/y H:i", strtotime($cliente['data']));
                    if(!empty($cliente['data']))
            ?>
            <tr>
                <td><?php echo $cliente ['id']; ?></td>
                <td><?php echo $cliente ['nome']; ?></td>
                <td><?php echo $cliente ['email']; ?></td>
                <td><?php echo $telefone; ?></td>
                <td><?php echo $nascimento; ?></td>
                <td><?php echo $cliente ['data']; ?></td>
                <td>
                    <a href="editar_cliente.php?id=<?php echo $cliente ['id']; ?>">Editar</a>
                    <a href="deletar_cliente.php?id=<?php echo $cliente ['id']; ?>">Deletar</a>
                </td>
            </tr>
            <?php
                }
         } ?>
        </tbody>
    </table>

    </table>
</body>

</html>