<html>
 <head>
   <title>Ola mundo!</title>
</head>
<body>
 <?php
    $conexao = mysqli_connect ("143.102.212.100:3306", "root", "password", "meuteste") or die ("Connect?");
    $consulta = mysqli_query ($conexao, "SELECT * FROM config");
    if ($linha = mysqli_fetch_array($consulta))
      { echo "Bem vindo <b>{$linha['nome']}</b> ao seu site dinamico";}
    else
      { echo "Registro não encontrado"; }
  ?>
</body>
</html>
