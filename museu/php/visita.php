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
        /////mostra o que tem no BD
            if(isset($_POST['Mostrar'])){

                include("conexao.php");
                $db=mysqli_select_db($conexao,$banco);
                $resultado=mysqli_query($conexao,"select * from visita order by id;");
                $num_linhas=mysqli_num_rows($resultado);
                echo"<table border=\"1\">";
                echo"<tr>
                        <td>Código</td>
                        <td>Nome</td>
                        <td>Data</td>
                        <td>Qtd</td>
                        <td>Excluir registro</td>
                        <td>Alterar registro</td>
                        </tr>";

                for($i=0;$i<$num_linhas;$i++){  
                    $mostra_tabela=mysqli_fetch_array($resultado);
                    $id= $mostra_tabela['id'];
                    echo"<tr>";
                    echo"<td>";
                    echo $id;
                    echo"</td>";
                    echo"<td>";
                    echo $mostra_tabela['nome'];
                    echo"</td>";
                    echo"<td>";
                    echo $mostra_tabela['data'];
                    echo"</td>";
                    echo"<td>";
                    echo $mostra_tabela['qtd'];
                    echo"</td>";
                    echo"<td>";
                    echo"<td><a href='excluir.php?x=$codigo'>Excluir</a></td>";
                    echo"<td><a href='alterar.php?y=$codigo'>Alterar</a></td>";
                    echo"</tr>";
                }
                echo"</table>";
            }

            mysqli_close($conexao); 

        ?>



        <footer style="clear: both;">
				<p>
					<a href="index.html">Home</a>
					<a href="/php/marcar.php">Cadastro</a>
				</p>
				<p>
					2023 <a href="index.html">Museu Nacional</a> - Todos os direitos reservados.
				</p>
		</footer>

	</div>
</body>
</html>