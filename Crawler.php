<?php

class Crawler {
    private $site;
    private $instituicao;
    private $predio;

    

    function __construct($site="", $instituicao="", $predio="") {
        $this->site = $site;
        $this->instituicao = $instituicao;
        $this->predio = $predio;
    }

    function acessaSite() {
        $chamada = curl_init($this->site);
        curl_setopt($chamada, CURLOPT_RETURNTRANSFER, TRUE);
        if ($this->instituicao != "" && $this->predio != "") {
            $post = [
                'vid_pd' => $this->predio,
                'vid_instituicao' => $this->instituicao,
            ];
            curl_setopt($chamada, CURLOPT_POST, 1);
            curl_setopt($chamada, CURLOPT_POSTFIELDS, $post);
        }
            
        $pagina = curl_exec($chamada);
        

        if(curl_errno($chamada)) {
            echo 'Erro: ' . curl_error($chamada);
            exit;
        }
        curl_close($chamada);

        return $pagina;
    }

    function buscarDisciplinas($todo_dia=false) {
        $pagina = $this->acessaSite();

        $dom = new DOMDocument;
        @$dom->loadHTML($pagina);
        $disciplinas = $dom->getElementsByTagName('tr');
        $array_disciplinas = array();
        foreach ($disciplinas as $d){
            $linha = new StdClass();
            $filhinhos = $d->childNodes;
            $data = "";
            if ($todo_dia == true) {
                $data = "00:00";
            } else {
                $data = date('H:i',strtotime(date('H:i') . ' -15 minutes'));
            }
            
            if ($filhinhos->item(1) != null && $filhinhos->item(3) != null && @$filhinhos->item(1)->getElementsByTagName("small")[0]->textContent != "" && $data < substr($filhinhos->item(2)->textContent, 0, 5)) {
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

    function buscarProfessores() {
        $this->site = "http://sistema.ufcspa.edu.br/docentes/mod/gerador_tab_docentes/view/af_joomla.php";
        $pagina_af = $this->acessaSite();
        $this->site = "http://sistema.ufcspa.edu.br/docentes/mod/gerador_tab_docentes/view/gl_joomla.php";
        $pagina_gl = $this->acessaSite();
        $this->site = "http://sistema.ufcspa.edu.br/docentes/mod/gerador_tab_docentes/view/mz_joomla.php";
        $pagina_mz = $this->acessaSite();
        $array_todos_professores = array();
        $array_todos_professores[] =  $this->trataPaginaProfessores($pagina_af);
        $array_todos_professores[] =  $this->trataPaginaProfessores($pagina_gl);
        $array_todos_professores[] =  $this->trataPaginaProfessores($pagina_mz);
        return $array_todos_professores;
    }

    function trataPaginaProfessores($pagina){
        $dom = new DOMDocument;
        @$dom->loadHTML($pagina);
        $professores = $dom->getElementsByTagName('tr');
        $array_professores = array();
        foreach ($professores as $d){
            $linha = new StdClass();
            $filhinhos = $d->childNodes;
            if ($filhinhos->item(5) != null && trim($filhinhos->item(5)->textContent) == "" && $filhinhos->item(5)->firstChild != null && $filhinhos->item(5)->firstChild->nodeName != "#text") {
                $linha->nome =  $filhinhos->item(0)->textContent;
                $linha->departamento =  $filhinhos->item(1)->textContent;
                $linha->area_conhecimento =  $filhinhos->item(2)->textContent;
                $linha->titulacao =  $filhinhos->item(3)->textContent;
                $linha->email = preg_replace("/mailto:/", "", $filhinhos->item(5)->firstChild->getAttribute("href"));
                $linha->lattes =  $filhinhos->item(6)->firstChild->getAttribute("href");  
                $array_professores[] = $linha; 
            }
        }
        return $array_professores;
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