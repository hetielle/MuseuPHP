<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro</title>

	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
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

		<div id="cadastro">
			<section id="visita">

				<h4>Marque sua visita no Museu Nacional!</h4>

				<form method="post" action="" enctype="multipart/form-data">
					<fieldset>
						
						<label for="nome">Nome</label>
						<input class="campo" type="text" id="nome" value="nome" name="nome"><br>

						<legend>Selecione uma data</legend>

						<label for="data">Data</label>
						<input class="campo" type="text" name="data" id="data" value="dd/mm/aaaa"><br>

						<label for="qtd">Quantidade de pessoas</label>
						<input class="campo" style="width:30px;" name="qtd" type="number" id="qtd" placeholder="1"><br>

						<label for="atracao">ID da atração</label>
						<input class="campo" style="width:30px;" name="atracao" type="number" id="atracao" placeholder="1"><br>
					</fieldset>

					<input class="botao" type="submit" name="Enviar" value="Marcarvisita">
					<input class="botao" type="submit" name="Mostrar" value="Mostrarvisita">

				</form>
				
			</section>
		</div>
		

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

    <?php
        $nome=isset($_POST['nome'])?$_POST['nome']:null;
        $data=isset($_POST['data'])?$_POST['data']:null;
        $qtd=isset($_POST['qtd'])?$_POST['qtd']:null;
		$atracao=isset($_POST['atracao'])?$_POST['atracao']:null;
        
    //////inserção  no BD
        include("conexao.php");
            if(isset($_POST['Enviar']) && !empty($_POST['nome'])){
                
                $db=mysqli_select_db($conexao,$banco);
                $grava=mysqli_query($conexao,"insert into grupo
                (nome_grupo, qtd) values ('$nome',$qtd)");
				$acha_codigo=mysqli_query($conexao,"select id_grupo from grupo
                where nome_grupo='$nome'");
				$grupo= mysqli_fetch_array($acha_codigo);
				echo $grupo['id_grupo'];
				$grava=mysqli_query($conexao,"insert into visita
                (id_grupo,id_atracao,data_visita) values ($grupo,$atracao,'$data')");

                if($grava==true){
                    echo"Cadastro efetuado com sucesso!";                    
                }else
                    echo"Impossível incluir!";
            }
			if(isset($_POST['Mostrar'])){

                include("conexao.php");
                $db=mysqli_select_db($conexao,$banco);
                $resultado=mysqli_query($conexao,"select * from grupo g join visita v on g.id_grupo = v.id_grupo
				join atracao a on a.id_atracao = v.id_atracao order by g.id_grupo;");
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
</body>
</html>