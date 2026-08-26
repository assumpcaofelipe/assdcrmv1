<?php

require_once 'config.php';

// Total de registros
         $total = 0;

         $sql = "SELECT COUNT(*) as registros FROM leads";
         $sql = $db->query($sql);
         $sql = $sql->fetch();
         $total = $sql['registros'];
         $paginas = $total / 10;

         


        //$p = 0;
        $pg = 1;

        if(isset($_GET['p']) && !empty($_GET['p'])){
          
        $pg = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);

        }
        
        $offset = ($pg - 1) * 10 ;

        $sql = "SELECT * FROM leads ORDER BY id LIMIT 10 OFFSET $offset";
        $sql = $db->query($sql);
        if($sql->rowCount() > 0) {
         
          foreach($sql->fetchAll() as $lead){
             echo $lead['empresa_nome'].'<br>';
             
          }



        }
       

       for($q=0; $q < $paginas; $q++){
        echo '<a href="paginacao.php?p='.($q+1).'">['.($q+1).']</a>';
       }

  
