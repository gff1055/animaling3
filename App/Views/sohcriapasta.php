<?php

//Fabyo Guimaraes
//se existir o arquivo
//if(isset($_FILES["arquivo"])){
//	$arquivo = $_FILES["arquivo"];
	$pasta_dir = "arquivos3/";	//diretorio dos arquivos

	//se nao existir a pasta ele cria uma
	if(!file_exists($pasta_dir)){
		mkdir($pasta_dir,0775);
		echo "mkdir";
	//echo exec('whoami');
	}

	echo "criapasta php depois elsew";

//	$arquivo_nome = $pasta_dir.$arquivo["name"];

	// Faz o upload da imagem
//	move_uploaded_file($arquivo["tmp_name"], $arquivo_nome);

	//conecta no banco
//	$cn = mysql_connect("localhost");
//	mysql_select_db("banco");


	//aqui salva no banco o path da foto

	/*echo<font face="verdana">mysql_query("INSERT INTO tabela VALUES ('', '$arquivo_nome')");
mysql_close($cn); </font>
*/ 

//}

?>