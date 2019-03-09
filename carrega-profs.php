<?php
// $link = "http://salas.ufcspa.edu.br/w8_relatorio_dia.php";
// $link = "http://sistema.ufcspa.edu.br/docentes/mod/gerador_tab_docentes/view/gl_joomla.php";

// $chamada = curl_init($link);
// curl_setopt($chamada, CURLOPT_RETURNTRANSFER, TRUE);

// $pagina_predio_um = curl_exec($chamada);

// if(curl_errno($chamada)) {
// 	echo 'Erro: ' . curl_error($chamada);
// 	exit;
// }
// curl_close($chamada);

// $dom = new DOMDocument;
// @$dom->loadHTML($pagina_predio_um);
// $professores = $dom->getElementsByTagName('tr');
// //print_r($disciplinas);
// echo '<pre>';
// foreach ($professores as $d){
//     // foreach ($d->childNodes as $filhos) {
//     //     //print_r($filhos);
//     //     echo $filhos->textContent;
//     //     if (trim($filhos->textContent) == "") {
//     //         if ($filhos->firstChild != null && $filhos->firstChild->nodeName != "#text") {
//     //             //echo print_r($filhos->firstChild);
//     //             echo $filhos->firstChild->getAttribute("href");
//     //         }
                
            
//     //     }
//     //     echo "<br>";
//     // }
//     $filhinhos = $d->childNodes;
//     if ($filhinhos->item(5) != null && trim($filhinhos->item(5)->textContent) == "" && $filhinhos->item(5)->firstChild != null && $filhinhos->item(5)->firstChild->nodeName != "#text") {
//         echo "Nome: " . $filhinhos->item(0)->textContent . "<br>";
//         echo "Departamento: " . $filhinhos->item(1)->textContent . "<br>";
//         echo "Área de Conhecimento: " . $filhinhos->item(2)->textContent . "<br>";
//         echo "Titulação: " . $filhinhos->item(3)->textContent . "<br>";
    
//         echo "Email: " . preg_replace("/mailto:/", "", $filhinhos->item(5)->firstChild->getAttribute("href")) . "<br>";
//         echo "Lattes: " . $filhinhos->item(6)->firstChild->getAttribute("href") . "<br>";   

//     }
    
//       //  print_r($d);
//         echo "<br>";
    
//     echo "<br>";
//  //   echo "Curso: " . $d->item(1)->textContent;
// }
// echo '<pre>';
//$colunas = $d->childNodes;
include_once "Crawler.php";
$crawler = new Crawler();
echo "<pre>";
print_r($crawler->buscarProfessores());
echo "</pre>";