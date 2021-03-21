<?php
$login = new Login(3);

if(!$login->CheckLogin()):
	unset($_SESSION['userlogin']);
	header("Location: {$site}");
else:
	$userlogin = $_SESSION['userlogin'];
endif;

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if(!empty($logoff) && $logoff == true):
	$updateacesso = new Update;
	$dataEhora    = date('d/m/Y H:i');
	$ip           = get_client_ip();
	$string_last = array("user_ultimoacesso" => " Último acesso em: {$dataEhora} IP: {$ip} ");
	$updateacesso->ExeUpdate("ws_users", $string_last, "WHERE user_id = :uselast", "uselast={$userlogin['user_id']}");

	unset($_SESSION['userlogin']);
	header("Location: {$site}");
endif;
?>



<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">   		 
		<div class="row"> 
			<div class="col-md-8 col-md-offset-2">  

				<div id="success"></div>
				<div id="sendnewpass" class="indent_title_in">
					<i class="icon-print-2"></i>
					<h3><strong>IMPRESSORA TÉRMICA</strong> </h3>
					<p>
						<b>Vamos configurar sua impressora...  </b>
					</p>
					<br />






					<main role="main" class="container-fluid">
						<div class="row">
							<!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->
							<div class="col-12 col-lg-6">


								<h4>1º Selecione sua impressora na lista:</h4>                                
								<div class="form-group">
									<select class="form-control" id="listaDeImpresoras"></select>
								</div>
								<button class="btn btn-primary btn-sm" id="btnRefrescarLista">Recarregar lista</button>
								<button class="btn btn-primary btn-sm" id="btnEstablecerImpresora">Salvar impressora</button>
								<h4>2º Agora vamos fazer um Teste</h4>	
                                <?php
                                $nomedaimpressora = '';
                                $nimpressora = '';
                                $lerbanco->ExeRead("ws_impressora", "WHERE user_id = :userid", "userid={$_SESSION['userlogin']['user_id']}");
                                if ($lerbanco->getResult()):
                                $nimpressora = $lerbanco->getResult();
                                $nomedaimpressora = $nimpressora[0]['nome_impressora'];
                                endif;
                                ?>
                                <p style="font-weight: bold;" id="impresoraSeleccionadaa"><?=$nomedaimpressora;?></p>							
								<p>Use o botão a seguir para imprimir um comprovante de teste na impressora padrão:</p>
								<br />
								<button class="btn btn-success" id="btnImprimir">impressão de Teste</button>

							</div>
							<div class="col-12 col-lg-6">
								<h4>Log</h4>
								<button class="btn btn-warning btn-sm" id="btnLimpiarLog">Limpar log</button>

								<pre style="margin-top: 10px;" id="estado"></pre>
							</div>
						</div>
					</main>








					<br />				
					<br />
					<br />
				</div>
			</div><!-- End col  -->
		</div><!-- End row  -->
	</div>

</div><!-- End container  -->















<script type="text/javascript">
/**
 * Una clase para interactuar con el plugin
 * 
 * @author parzibyte
 * @see https://parzibyte.me/blog
 */
const C = {
    AccionWrite: "write",
    AccionCut: "cut",
    AccionCash: "cash",
    AccionCutPartial: "cutpartial",
    AccionAlign: "align",
    AccionFontSize: "fontsize",
    AccionFont: "font",
    AccionEmphasize: "emphasize",
    AccionFeed: "feed",
    AccionQr: "qr",
    AlineacionCentro: "center",
    AlineacionDerecha: "right",
    AlineacionIzquierda: "left",
    FuenteA: "A",
    FuenteB: "B",
    AccionBarcode128: "barcode128",
    AccionBarcode39: "barcode39",
    AccionBarcode93: "barcode93",
    AccionBarcodeEAN: "barcodeEAN",
    AccionBarcodeTwoOfFiveSinInterleaved: "barcodeTwoOfFive",
    AccionBarcodeTwoOfFiveInterleaved: "barcodeTwoOfFiveInterleaved",
    AccionBarcodeCodabar: "barcodeCodabar",
    AccionBarcodeUPCA: "barcodeUPCA",
    AccionBarcodeUPCE: "barcodeUPCE",
    Medida80: 80,
    Medida100: 100,
    Medida156: 156,
    Medida200: 200,
    Medida300: 300,
    Medida350: 350,
};

const URL_PLUGIN = "http://localhost:8000";

class OperacionTicket {
    constructor(accion, datos) {
        this.accion = accion + "";
        this.datos = datos + "";
    }
}
class Impresora {
    constructor(ruta) {
        if (!ruta) ruta = URL_PLUGIN;
        this.ruta = ruta;
        this.operaciones = [];
    }

    static setImpresora(nombreImpresora, ruta) {
        if (ruta) URL_PLUGIN = ruta;
        return fetch(URL_PLUGIN + "/impresora", {
                method: "PUT",
                body: JSON.stringify(nombreImpresora),
            })
            .then(r => r.json())
            .then(respuestaDecodificada => respuestaDecodificada === nombreImpresora);
    }

    static getImpresora(ruta) {
        if (ruta) URL_PLUGIN = ruta;
        return fetch(URL_PLUGIN + "/impresora")
            .then(r => r.json());
    }

    static getImpresoras(ruta) {
        if (ruta) URL_PLUGIN = ruta;
        return fetch(URL_PLUGIN + "/impresoras")
            .then(r => r.json());
    }

    cut() {
        this.operaciones.push(new OperacionTicket(C.AccionCut, ""));
    }

    cash() {
        this.operaciones.push(new OperacionTicket(C.AccionCash, ""));
    }

    cutPartial() {
        this.operaciones.push(new OperacionTicket(C.AccionCutPartial, ""));
    }

    setFontSize(a, b) {
        this.operaciones.push(new OperacionTicket(C.AccionFontSize, `${a},${b}`));
    }

    setFont(font) {
        if (font !== C.FuenteA && font !== C.FuenteB) throw Error("Fuente inválida");
        this.operaciones.push(new OperacionTicket(C.AccionFont, font));
    }
    setEmphasize(val) {
        if (isNaN(parseInt(val)) || parseInt(val) < 0) throw Error("Valor inválido");
        this.operaciones.push(new OperacionTicket(C.AccionEmphasize, val));
    }
    setAlign(align) {
        if (align !== C.AlineacionCentro && align !== C.AlineacionDerecha && align !== C.AlineacionIzquierda) {
            throw Error(`Alineación ${align} inválida`);
        }
        this.operaciones.push(new OperacionTicket(C.AccionAlign, align));
    }

    write(text) {
        this.operaciones.push(new OperacionTicket(C.AccionWrite, text));
    }

    feed(n) {
        if (!parseInt(n) || parseInt(n) < 0) {
            throw Error("Valor para feed inválido");
        }
        this.operaciones.push(new OperacionTicket(C.AccionFeed, n));
    }

    end() {
        return fetch(this.ruta + "/imprimir", {
                method: "POST",
                body: JSON.stringify(this.operaciones),
            })
            .then(r => r.json());
    }

    imprimirEnImpresora(nombreImpresora) {
        const payload = {
            operaciones: this.operaciones,
            impresora: nombreImpresora,
        };
        return fetch(this.ruta + "/imprimir_en", {
                method: "POST",
                body: JSON.stringify(payload),
            })
            .then(r => r.json());
    }

    qr(contenido) {
        this.operaciones.push(new OperacionTicket(C.AccionQr, contenido));
    }

    validarMedida(medida) {
        medida = parseInt(medida);
        if (medida !== C.Medida80 &&
            medida !== C.Medida100 &&
            medida !== C.Medida156 &&
            medida !== C.Medida200 &&
            medida !== C.Medida300 &&
            medida !== C.Medida350) {
            throw Error("Valor para medida del barcode inválido");
        }
    }

    validarTipo(tipo) {
        if (
            [C.AccionBarcode128,
                C.AccionBarcode39,
                C.AccionBarcode93,
                C.AccionBarcodeEAN,
                C.AccionBarcodeTwoOfFiveInterleaved,
                C.AccionBarcodeTwoOfFiveSinInterleaved,
                C.AccionBarcodeCodabar,
                C.AccionBarcodeUPCA,
                C.AccionBarcodeUPCE,
            ]
            .indexOf(tipo) === -1
        ) throw Error("Tipo de código de barras no soportado");
    }

    barcode(contenido, medida, tipo) {
        this.validarMedida(medida);
        this.validarTipo(tipo);
        let payload = contenido.concat(",").concat(medida.toString());
        this.operaciones.push(new OperacionTicket(tipo, payload));
    }

}






//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------




const RUTA_API = "http://localhost:8000"
const $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnRefrescarLista = document.querySelector("#btnRefrescarLista"),
    $btnEstablecerImpresora = document.querySelector("#btnEstablecerImpresora"),
    $texto = document.querySelector("#texto"),
    $impresoraSeleccionada = document.querySelector("#impresoraSeleccionada"),
    $btnImprimir = document.querySelector("#btnImprimir");



const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);

const limpiarLista = () => {
    for (let i = $listaDeImpresoras.options.length; i >= 0; i--) {
        $listaDeImpresoras.remove(i);
    }
};


const obtenerListaDeImpresoras = () => {
    loguear("Carregando...");
    Impresora.getImpresoras()
        .then(listaDeImpresoras => {
            refrescarNombreDeImpresoraSeleccionada();
            loguear("Lista carregada");
            limpiarLista();
            listaDeImpresoras.forEach(nombreImpresora => {
                const option = document.createElement('option');
                option.value = option.text = nombreImpresora;
                $listaDeImpresoras.appendChild(option);
            })
        });
}

const establecerImpresoraComoPredeterminada = nombreImpresora => {
    loguear("configurando impressora...");
    Impresora.setImpresora(nombreImpresora)
        .then(respuesta => {
            refrescarNombreDeImpresoraSeleccionada();
            if (respuesta) {
                loguear(`Impresora ${nombreImpresora} configurada corretamente`);
                $.ajax({
                    url: '<?=$site?>includes/cadastraimperssora.php',
                    method: 'post',
                    data: {'nomeImpresora' : nombreImpresora},
                    success: function(data){
                        $('#impresoraSeleccionadaa').text(nombreImpresora);
                    }
                });
            } else {
                loguear(`Não foi possivel estabelecer conexão com a impressora ${nombreImpresora}`);
            }
        });
};

const refrescarNombreDeImpresoraSeleccionada = () => {
    Impresora.getImpresora()
        .then(nombreImpresora => {
            $impresoraSeleccionada.textContent = nombreImpresora;
        });
}


$btnRefrescarLista.addEventListener("click", obtenerListaDeImpresoras);
$btnEstablecerImpresora.addEventListener("click", () => {
    const indice = $listaDeImpresoras.selectedIndex;
    if (indice === -1) return loguear("Não há nenhuma impressora selecionada")
    const opcionSeleccionada = $listaDeImpresoras.options[indice];
    establecerImpresoraComoPredeterminada(opcionSeleccionada.value);
});

$btnImprimir.addEventListener("click", () => {
    $('#btnImprimir').prop('disabled', true);
     loguear(`Imprimindo...`);
    $.ajax({
        url: '<?=$site?>includes/impressaoDeteste.php',
        method: 'post',
        data: {'imprimir' : 'true', 'idcliente': '<?=$userlogin['user_id'];?>'},
        success: function(data){
            $('#btnImprimir').prop('disabled', false);
            if(data == 'erro1'){
                 loguear(`Ocorreu um Erro, Salve uma Impressora.`);
            }else if(data == 'erro2'){
               
                loguear(`Ocorreu um Erro ao Imprimir. Entre em contato com o suporte.`);
            }
        }
    });
    /*
    let impresora = new Impresora(RUTA_API);
    impresora.setFontSize(1, 1);
    impresora.setEmphasize(0);

    impresora.write("PEDIDO TOP\n");
    impresora.write("Site de Delivery Pedido.top\n");
    impresora.write("Telefone: 123456789\n");
    impresora.write("Fecha/Hora: 2019-08-01 13:21:22\n");
    impresora.write("--------------------------------\n");
    impresora.write("Venda lanche pelo site pedido.top\n");

    impresora.write("25 R$\n");
    impresora.write("--------------------------------\n");
    impresora.write("TOTAL: 25 R$\n");
    impresora.write("--------------------------------\n");

    impresora.write("***OBRIGADO PELA PREFERÊNCIA***");
    impresora.cut();
    impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial
    impresora.end()
        .then(valor => {
            loguear("Al imprimir: " + valor);
        })
        */

});

// En el init, obtenemos la lista
obtenerListaDeImpresoras();
// Y también la impresora seleccionada
refrescarNombreDeImpresoraSeleccionada();
</script>