<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Visita</title>

	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>

	<div id="container"> 
		
		<header>

			<div id="logo">

				<h1><a href="">Museu Nacional</a></h1>
				
			</div>

			<nav>

				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="php/marcar.php">Cadastro</a></li>
				</ul>

			</nav>

		</header>

        <?php
            if(isset($_GET['y'])){
                include("conexao.php");
                $db=mysqli_select_db($conexao,$banco);
                $alterar=$_GET['y'];
                $SQL = "select * from visita where id=$alterar";
                $resultado = mysqli_query ($conexao,$SQL);
                if ($resultado==false) {
                    echo "Erro na query";
                    exit;
                }
                if (mysqli_num_rows($resultado) != 0) {
                    while($linha = mysqli_fetch_array($resultado)){
                        $mostra_nome = $linha["nome"];
                        $mostra_data = $linha["data"];
                        $mostra_qtd = $linha["qtd"];                        
                    }     
        ?>

        <h3>Você está alterando o banco de dados!</h3><br>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $alterar?>" name="codigo_altera"/>

            Nome:  <input type="text" name="nome" value="<?php echo $mostra_nome;?>" size="60"/><br>
            Data: <input type="text" name="email" value="<?php echo $mostra_data;?>" size="60"/><br> <!-- mudar -->
            Quantidade de pessoas: <input type="text" name="cidade" value="<?php echo $mostra_qtd;?>" size="60"/><br>

            <input name="Alterar" type="submit" value="Alterar"/>
        </form>

        <?php
                }
                else{
                    echo "Registro inexistente!!";
                }
            }
        
            if(isset($_POST['Alterar'])){
                $idd = $_POST['codigo_altera'];
                $nome = $_POST['nome'];
                $email = $_POST['data'];
                $cidade = $_POST['qtd'];
            
                //seleciona bando de dados//
                $sql = "UPDATE visita SET nome='$nome', data='$data', qtd='$qtd' WHERE id = $idd "; //comando SQL
                $query = mysqli_query($conexao,$sql); // executa comando SQL
                
            //verifica se a alteração está correta//
            
                if($query){
                    header("Location:marcar.php");
                }
                else {
                    echo "Não foi possivel alterar!";
                }
            } 

        ?>


        <footer style="clear: both;">
				<p>
					<a href="index.html">Home</a>
					<a href="php/marcar.php">Cadastro</a>
				</p>
				<p>
					2023 <a href="index.html">Museu Nacional</a> - Todos os direitos reservados.
				</p>
		</footer>

	</div>
</body>
</html>