<?php
$link = "http://salas.ufcspa.edu.br/w8_relatorio_dia.php";
$link = "http://salas.ufcspa.edu.br/w8_relatorio_dia.php?vid_pd=1&vid_instituicao=1&vdata=2019-03-02";
$chamada = curl_init($link);
curl_setopt($chamada, CURLOPT_RETURNTRANSFER, TRUE);

$pagina_predio_um = curl_exec($chamada);

if(curl_errno($chamada)) {
	echo 'Erro: ' . curl_error($chamada);
	exit;
}
curl_close($chamada);

$dom = new DOMDocument;
@$dom->loadHTML($pagina_predio_um);
$disciplinas = $dom->getElementsByTagName('tr');
//print_r($disciplinas);
echo '<pre>';
foreach ($disciplinas as $d){
    foreach ($d->childNodes as $filhos) {
        // print_r($filhos);
        // echo $filhos->textContent;
        // print_r($filhos->getElementsByTagName("small")[0]);
        // print_r($filhos->getElementsByTagName("strong")[0]);
        // echo "<br>";
    }
    $filhinhos = $d->childNodes;
    if ($filhinhos->item(1) != null && $filhinhos->item(3) != null && @$filhinhos->item(1)->getElementsByTagName("small")[0]->textContent != "") {
        echo "Disciplina: " . $filhinhos->item(0)->firstChild->firstChild->textContent. "<br>";
            echo "Atividade: " . $filhinhos->item(1)->getElementsByTagName("small")[0]->textContent;
            echo "<br>";
            echo "Curso: " . $filhinhos->item(1)->firstChild->textContent;
            echo "<br>";
        echo "Horário: " . $filhinhos->item(2)->textContent. "<br>";

        echo "Sala abreviada: ". $filhinhos->item(3)->getElementsByTagName("strong")[0]->textContent. "<br>";
        echo "Sala: " . $filhinhos->item(3)->getElementsByTagName("small")[0]->textContent. "<br>";
        //print_r($d);
        echo "<br>";
    }
    echo "<br>";
 //   echo "Curso: " . $d->item(1)->textContent;
}
echo '<pre>';
//$colunas = $d->childNodes;