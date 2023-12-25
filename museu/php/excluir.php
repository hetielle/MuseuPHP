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
            if(isset($_GET['x'])){
                include("conexao.php");

                $db=mysqli_select_db($conexao,$banco);
                $excluir=$_GET['x'];
                $SQL = "select * from visita where id=$excluir";
                $resultado = mysqli_query ($conexao,$SQL);
                if ($resultado==false) {
                    echo "Erro na query";
                    exit;
                }
                if (mysqli_num_rows($resultado) != 0) {
                    $SQL = "delete from visita where id=$excluir";
                    mysqli_query ($conexao,$SQL);
                    echo "<script>alert(\"Registro excluído com sucesso!\")
                    </script>";
                // header("Location:formulario_cliente.php");
                }
                else {
                    echo "<script>alert(\"Registro inexistente!\")</script>";
                } 

            }
            else{
                echo"Nada a excluir!";
                echo"<a href='marcar.php'>Voltar</a>";
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