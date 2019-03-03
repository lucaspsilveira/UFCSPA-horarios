<?php

class Crawler {
    private $site;
    private $instituicao;
    private $predio;

    

    function __construct($site, $instituicao="", $predio="") {
        $this->site = $site;
        $this->instituicao = $instituicao;
        $this->predio = $predio;
    }

    function acessaSite() {
        $chamada = curl_init($this->site);
        curl_setopt($chamada, CURLOPT_RETURNTRANSFER, TRUE);
        if ($this->instituicao != "" && $this->predio != "")
            curl_setopt($chamada, CURLOPT_POSTFIELDS, "vid_instituicao=".$this->instituicao."&vid_instituicao=".$this->predio);
        $pagina_predio = curl_exec($chamada);

        if(curl_errno($chamada)) {
            echo 'Erro: ' . curl_error($chamada);
            exit;
        }
        curl_close($chamada);

        return $pagina_predio;
    }

    function buscarDisciplinas() {
        $pagina = $this->acessaSite();

        $dom = new DOMDocument;
        @$dom->loadHTML($pagina);
        $disciplinas = $dom->getElementsByTagName('tr');
        $array_disciplinas = array();
        foreach ($disciplinas as $d){
            $linha = new StdClass();
            $filhinhos = $d->childNodes;
            if ($filhinhos->item(1) != null && $filhinhos->item(3) != null && @$filhinhos->item(1)->getElementsByTagName("small")[0]->textContent != "") {
                $linha->disciplina =   $filhinhos->item(0)->firstChild->firstChild->textContent;
                $linha->atividade =  $filhinhos->item(1)->getElementsByTagName("small")[0]->textContent;
                $linha->curso =  $filhinhos->item(1)->firstChild->textContent;
                $linha->horario =  $filhinhos->item(2)->textContent;
                $linha->sala =  $filhinhos->item(3)->getElementsByTagName("strong")[0]->textContent;
                $linha->sala_descricao =  $filhinhos->item(3)->getElementsByTagName("small")[0]->textContent;
                $linha->predio = $this->predio;
                $array_disciplinas[] = $linha;
            }
        }
        return $array_disciplinas;
    }


    /**
     * Get the value of site
     */ 
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Get the value of instituicao
     */ 
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Get the value of predio
     */ 
    public function getPredio()
    {
        return $this->predio;
    }

    /**
     * Set the value of site
     *
     * @return  self
     */ 
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Set the value of instituicao
     *
     * @return  self
     */ 
    public function setInstituicao($instituicao)
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    /**
     * Set the value of predio
     *
     * @return  self
     */ 
    public function setPredio($predio)
    {
        $this->predio = $predio;

        return $this;
    }
}