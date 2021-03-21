<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) 2017, ALEX DA SILVA LIMA
 */
class Check {

    private static $Data;
    private static $Format;

    /**
     * <b>Verifica E-mail:</b> Executa validação de formato de e-mail. Se for um email válido retorna true, ou retorna false.
     * @param STRING $Email = Uma conta de e-mail
     * @return BOOL = True para um email válido, ou false
     */
    public static function Email($Email) {
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }
    /**
     * <b>Valida CPF:</b> Executa validação de CPF. Se for um CPF válido retorna true, ou retorna false.
     * @param STRING $cpf = Um cpf
     * @return BOOL = True para um cpf válido, ou false
     */
    public static function validaCPF($cpf){
        $cpf = preg_replace('/[^0-9]/','',$cpf);
        
        $digitoA = 0;
        $digitoB = 0;
        
        for($i = 0, $x = 10; $i <= 8; $i++, $x--){
            $digitoA += $cpf[$i] * $x;
        }
        for($i = 0, $x = 11; $i <= 9; $i++, $x--){
            if(str_repeat($i, 11) == $cpf):
                return false;
            endif;
            
            $digitoB += $cpf[$i] * $x;
        }
        
        $somaA = (($digitoA%11) < 2 ) ? 0 : 11-($digitoA%11);
        $somaB = (($digitoB%11) < 2 ) ? 0 : 11-($digitoB%11);
        
        if($somaA != $cpf[9] || $somaB != $cpf[10]):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * <b>Tranforma URL:</b> Tranforma uma string no formato de URL amigável e retorna o a string convertida!
     * @param STRING $Name = Uma string qualquer
     * @return STRING = $Data = Uma URL amigável válida
     */
    public static function Name($Name) {
        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }
    /**
     * <b>Tranforma valores para enviar para o banco:</b> Transforma uma valor no formato 0.000,00 ou 000,00 no formato ideal para o banco de dados!
     * @param STRING $Valor = Valor inserido pelo usuario para enviar ao banco
     * @return STRING = $Valor = valor do inserido pelo user!
     */
       public static function Valor($valor) {
           $verificaPonto = ".";
           if(strpos("[".$valor."]", "$verificaPonto")):
               $valor = str_replace('.','', $valor);
               $valor = str_replace(',','.', $valor);
               else:
                 $valor = str_replace(',','.', $valor);   
           endif;
           
           return $valor;
    }
    /**
     * <b>Tranforma valores em real:</b> Transforma uma valor no formato do banco para real!
     * @param STRING $Valor = Valor vindo do banco para real
     * @return STRING = $Valor = valor do banco!
     */
     public static function Real($Valor) {
        return number_format($Valor,"2",",",".");
    }

     // função para calcular a porcentagem exe: (15, 380) = 57
    public static function porcentagem( $porcentagem, $total) {
      $porcentagem = round(($porcentagem / 100 ) * $total, 2);

      $verificaPonto = ".";
      if(strpos("[".$porcentagem."]", "$verificaPonto")):
       $porcentagem = str_replace('.',',', $porcentagem);
       $porcentagem = str_replace(',','.', $porcentagem);
   else:
     $porcentagem = str_replace(',','.', $porcentagem);        
 endif;

 return $porcentagem; 
}

    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato YYYY-MM-DD!
     * @param STRING $Name = Data em (d/m/Y)
     * @return STRING = $Data = Data no formato YYYY-MM-DD!
     */
    public static function Nascimento($Data) {
        self::$Format = explode(' ', $Data);
        self::$Data = explode('/', self::$Format[0]);

        if (checkdate(self::$Data[1], self::$Data[0], self::$Data[2])):
            self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0];
            return self::$Data;
        else:
            return false;
        endif;
    }

    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */
    public static function Data($Data) {
        self::$Format = explode(' ', $Data);
        self::$Data = explode('/', self::$Format[0]);

        if (empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' . self::$Format[1];
        return self::$Data;
    }

    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @return INT = $Limite = String limitada pelo $Limite
     */
    public static function Words($String, $Limite, $Pointer = null) {
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' ' . $Pointer );
        $Result = ( self::$Format < $NumWords ? $NewWords . $Pointer : self::$Data );
        return $Result;
    }

    /**
     * <b>Obter categoria:</b> Informe o name (url) de uma categoria para obter o ID da mesma.
     * @param STRING $category_name = URL da categoria
     * @return INT $category_id = id da categoria informada
     */
    public static function CatByName($CategoryName) {
        $read = new Read;
        $read->ExeRead('ws_categories', "WHERE category_name = :name", "name={$CategoryName}");
        if ($read->getRowCount()):
            return $read->getResult()[0]['category_id'];
        else:
            echo "A categoria {$CategoryName} não foi encontrada!";
            die;
        endif;
    }

    /**
     * <b>Usuários Online:</b> Ao executar este HELPER, ele automaticamente deleta os usuários expirados. Logo depois
     * executa um READ para obter quantos usuários estão realmente online no momento!
     * @return INT = Qtd de usuários online
     */
    public static function UserOnline() {
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete('ws_siteviews_online', "WHERE online_endview < :now", "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->ExeRead('ws_siteviews_online');
        return $readUserOnline->getRowCount();
    }

    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
    public static function Image($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null) {

        self::$Data = $ImageUrl;

        if (file_exists(self::$Data) && !is_dir(self::$Data)):
            $patch = HOME;
            $imagem = self::$Data;
            return "<img class=\"lightbox\" src=\"{$patch}tim.php?src={$patch}{$imagem}&w={$ImageW}&h={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"/>";
        else:
            return false;
        endif;
    }

}
