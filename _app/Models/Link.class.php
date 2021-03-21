<?php

/**
 * Link [ MODEL ]
 * Classe responsável por organizar o SEO do sistema e realizar a navegação!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class Link {

    private $File;
    private $Link;

    /** DATA */
    private $Local;
    private $Patch;
    private $Tags;
    private $Data;

    /** @var Seo */
    private $Seo;
    
    function __construct() {
        $this->Local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->Local = ($this->Local ? $this->Local : 'index');
        $this->Local = explode('/', $this->Local);
        $this->File = (isset($this->Local[0]) ? $this->Local[0] : 'index');
        $this->Link = (isset($this->Local[1]) ? $this->Local[1] : null);
        $this->Seo = new Seo($this->File, $this->Link);
    }

    public function getTags() {
        $this->Tags = $this->Seo->getTags();
        echo $this->Tags;
    }

    public function getData() {
        $this->Data = $this->Seo->getData();
        return $this->Data;
    }

    public function getLocal() {
        return $this->Local;
    }

    public function getPatch() {
        $this->setPatch();
        return $this->Patch;
    }

    //PRIVATES
    private function setPatch() {
        if (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php';
        elseif (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php';
        else:
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . '404.php';
        endif;
    }

}
