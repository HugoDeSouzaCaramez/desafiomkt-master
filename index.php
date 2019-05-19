<!DOCTYPE html>
<html lang="pt">
<head>

  <!-- Meta tags -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3, user-scalable=no">
  <meta name="Hugo de Souza Caramez" content="mobLee">
  <meta name="theme-color" content="#ed1164">
  
   
  <!-- CSS -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Title -->
  <title>Desafio 1</title>

   <!-- Biblioteca Jquery do javaScript e função tablesorter (para ordernar) da jquery  -->
   <!--ativando a biblioteca jquery para poder ativar a função tablesorter da biblioteca Jquery -->
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/jquery.tablesorter.js"></script>

   <!-- Função que ordena as colunas com JS (jquery)-->
  <script type="text/javascript">
    $(document).ready(function() //função(plugin) do jquery, bom porque não precisa ficar recarregando a pagina
      { 
        $("#tabela-pokemon").tablesorter();//ordenando a tabela "tabela-pokemon" com a função tablesort() 
      } 
    ); 
  </script>

</head>
<body>
    <h1>A tabela Pokémon</h1>
    <table id= "tabela-pokemon"><!--dando nome para tabela para ela poder ser ordenada com o tablesorter-->

      <!--cabeçalho: primeira linha da tabela-->
      <thead>
        <tr>
          <th colspan="2"><a href="#" class="is-selected">Pokémon</a></th>
          <th><a href="#" >Altura</a></th>
          <th><a href="#" >Peso</a></th>
          <th><a href="#" >Tipo</a></th>
        </tr>
      </thead>
      <!-- A imagem esperada é o sprite do Pokémon, pode ser tanto o chamado front_default quanto o front_female -->
      <!-- É esperado que o alt da imagem seja o nome do Pokémon -->

      <!--corpo da tabela-->
      <tbody>
          <?php

              $found=true;
              $id = 1;
              $urlBase = "http://pokeapi.co/api/v2/pokemon/";//$urlBase para se conectar com a api

              /*laço while com variavel $found e $id até 9, para ir trocando de pokemons a cada nova iteração*/  
              while($found&&$id<10){
                $data = file_get_contents($urlBase.$id.'/');//$data recebe em formato de string o conteudo da $urlBase com o $id corrente em formato de string com '/'

                $pokemon = json_decode($data);//retornando $data em formato de objeto e atribuindo à $pokemon

                /*Dividindo altura e o peso por 10, então altura e peso ficam corretos*/
                $pokeHeight = $pokemon->height / 10;
                $pokeWeight = $pokemon->weight / 10;

                /* A imagem esperada é o sprite do Pokémon, pode ser tanto o chamado front_default quanto o front_female*/
                /*variavel $respostaPt1 recebe nome altura e peso do pokemon*/
                $respostaPt1= "<tr><td><img src=".$pokemon->sprites->front_default." alt=".$pokemon->name."></td>"
                    ."<td><strong>".$pokemon->name."</strong></td>"
                    ."<td><span>".$pokeHeight."</span> m</td>"
                    ."<td><span>".$pokeWeight."</span> kg</td>";//tag strong no atributo nome para ficar em negrito
                
                /* Gerando tipos de pokemon*/
                /*variavel $respostaPt2 recebe o(s) tipo(s) do pokemon corrente*/
                $respostaPt2= "<td>"; 

                /*checando se o objeto $pokemon tem a propriedade (atributo) 'types'*/
                if(property_exists($pokemon, 'types')){
                  $tipos = $pokemon->types;//$tipos é um array que está recebendo todos os $tipos do pokemon corrente
                  
                  /*Para $tipos corrente do começo até o final. Variavel $tipo com o apelido $nome*/
                  foreach ($tipos as $nome) {
                    $respostaPt2 = $respostaPt2.$nome->type->name.", ";//concatena os tipos 
                  }
                  $respostaPt2 = substr($respostaPt2,0, -2);//do começo (0) até -2 para não mostrar o ultimo caractere
                  $respostaPt2 = $respostaPt2."</td></tr>";
                }else{
                  $respostaPt2 = $respostaPt2."</td></tr>";
                }
                
                /*mostrando em uma linha da figura até o tipo do pokemon*/  
                echo $respostaPt1.$respostaPt2;
                $id++;
              }
             ?>
      </tbody>
    </table>
  </body>
</html>
