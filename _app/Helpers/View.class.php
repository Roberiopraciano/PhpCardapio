<?php

/**
 * View.class [ HELPER MVC ]
 * Reponsável por carregar o template, povoar e exibir a view, povoar e incluir arquivos PHP no sistem.
 * Arquitetura MVC!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class View {

    private $Data;
    private $Keys;
    private $Values;
    private $Template;

    /**
     * <b>Carregar Template View:</b> Dentro da pasta do seu template, crie a pasta _tpl e armazene as
     * template_views.tpl.html. Depois basta informar o APENAS O NOME do arquivo para carregar o mesmo!
     * @param STRING $Template = Nome_do_arquivo
     */
    public function Load($Template) {
        $this->Template = REQUIRE_PATH . DIRECTORY_SEPARATOR . '_tpl' . DIRECTORY_SEPARATOR . (string) $Template;
        $this->Template = file_get_contents($this->Template . '.tpl.html');
        return $this->Template;
    }

    /**
     * <b>Exibir Template View:</b> Execute um foreach com um getResult() do seu model e informe o envelope
     * neste método para configurar a view. Não esqueça de carregar a view acima do foreach com o método Load.
     * @param array $Data = Array com dados obtidos
     * @param View $View = Template carregado pelo método Load()
     */
    public function Show(array $Data, $View) {
        $this->setKeys($Data);
        $this->setValues();
        $this->ShowView($View);
    }

    /**
     * <b>Carregar PHP View:</b> Tendo um arquivo PHP com echo em variáveis extraídas, utilize esse método
     * para incluir, povoar e exibir o mesmo. Basta informar o caminho do arquivo<b>.inc.php</b> e um
     * envelope de dados dentro de um foreach!
     * @param STRING $File = Caminho / Nome_do_arquivo
     * @param ARRAY $Data = Array com dados obtidos
     */
    public function Request($File, array $Data) {
        extract($Data);
        require("{$File}.inc.php");
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Executa o tratamento dos campos para substituição de chaves na view.
    private function setKeys($Data) {
        $this->Data = $Data;
        $this->Data['HOME'] = HOME;
        
        $this->Keys = explode('&', '#' . implode("#&#", array_keys($this->Data)) . '#');
        $this->Keys[] = '#HOME#';
    }

    //Obtém os valores a serem inseridos nas chaves da view.
    private function setValues() {
        $this->Values = array_values($this->Data);
    }

    //Exibe o template view com echo!
    private function ShowView($View) {
        $this->Template = $View;
        echo str_replace($this->Keys, $this->Values, $this->Template);
    }

}
