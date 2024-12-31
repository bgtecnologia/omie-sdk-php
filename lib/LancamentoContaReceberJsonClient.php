<?php
/**
 * @service LancamentoContaReceberJsonClient
 * @author omie
 */
namespace OmieSdk;
class LancamentoContaReceberJsonClient {
	/**
	 * @var string
	 */
	private $appKey;

	/**
	 * @var string
	 */
	private $appSecret;
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='https://app.omie.com.br/api/v1/financas/contareceber/?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;
	/**
	 * The endpoint URI
	 *
	 * @var string
	 */
	public static $_EndPoint='https://app.omie.com.br/api/v1/financas/contareceber/';

	public function __construct($appKey, $appSecret) {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public function _Call($method, $param) {
		$call = [
			"call" => $method,
			"param" => $param,
			"app_key" => $this->appKey,
			"app_secret" => $this->appSecret
		];
		
		$url = self::$_EndPoint;
		$body = json_encode($call);
	
		$ch = curl_init($url);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	
		$response = curl_exec($ch);
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
		if (curl_errno($ch)) {
			throw new Exception("cURL Error: " . curl_error($ch));
		}
		
		curl_close($ch);
		
		$retorno = [
			'response' => json_decode($response),
			'httpCode' => $httpCode,
			'status' => $httpCode == 200 ? true : false
		];
		return $retorno;
	}

	/**
	 * Inclui uma conta a Receber
	 *
	 * @param conta_receber_cadastro $conta_receber_cadastro Cadastro de contas a receber.
	 * @return conta_receber_cadastro_response Resposta do Cadastro de Contas a Receber
	 */
	public function IncluirContaReceber($conta_receber_cadastro){
		return self::_Call('IncluirContaReceber',Array(
			$conta_receber_cadastro
		));
	}

	/**
	 * Altera um conta a receber
	 *
	 * @param conta_receber_cadastro $conta_receber_cadastro Cadastro de contas a receber.
	 * @return conta_receber_cadastro_response Resposta do Cadastro de Contas a Receber
	 */
	public function AlterarContaReceber($conta_receber_cadastro){
		return self::_Call('AlterarContaReceber',Array(
			$conta_receber_cadastro
		));
	}

	/**
	 * Exclui uma conta a receber
	 *
	 * @param conta_receber_cadastro_chave $conta_receber_cadastro_chave Chave da conta a a receber
	 * @return conta_receber_cadastro_response Resposta do Cadastro de Contas a Receber
	 */
	public function ExcluirContaReceber($conta_receber_cadastro_chave){
		return self::_Call('ExcluirContaReceber',Array(
			$conta_receber_cadastro_chave
		));
	}

	/**
	 * Inclui uma distribuição por departamento para uma conta a receber
	 *
	 * @param rateio_cadastro $rateio_cadastro Cadastro de Distribuição por Departamento
	 * @return conta_receber_cadastro_chave Chave da conta a a receber
	 */
	public function IncluirDistribuicaoDepartamento($rateio_cadastro){
		return self::_Call('IncluirDistribuicaoDepartamento',Array(
			$rateio_cadastro
		));
	}

	/**
	 * Altera a distribuição por departamento de uma conta a receber.
	 *
	 * @param rateio_cadastro $rateio_cadastro Cadastro de Distribuição por Departamento
	 * @return conta_receber_cadastro_chave Chave da conta a a receber
	 */
	public function AlterarDistribuicaoDepartamento($rateio_cadastro){
		return self::_Call('AlterarDistribuicaoDepartamento',Array(
			$rateio_cadastro
		));
	}

	/**
	 * Exclui a distribuição de departamento da conta a receber.
	 *
	 * @param conta_receber_cadastro_chave $conta_receber_cadastro_chave Chave da conta a a receber
	 * @return conta_receber_cadastro_response Resposta do Cadastro de Contas a Receber
	 */
	public function ExcluirDistribuicaoDepartamento($conta_receber_cadastro_chave){
		return self::_Call('ExcluirDistribuicaoDepartamento',Array(
			$conta_receber_cadastro_chave
		));
	}

	/**
	 * Realiza a baixa de um título no conta a receber.
	 *
	 * @param conta_receber_lancar_recebimento $conta_receber_lancar_recebimento Informações para realizada a Baixa do Contas a Receber.
	 * @return conta_receber_lancar_recebimento_resposta Resultado da baixa realizada para um lançamento do conta a receber.
	 */
	public function LancarRecebimento($conta_receber_lancar_recebimento){
		return self::_Call('LancarRecebimento',Array(
			$conta_receber_lancar_recebimento
		));
	}

	/**
	 * Efetua o cancelamento de um recebimento de Contas a Receber.
	 *
	 * @param conta_receber_cancelar_recebimento $conta_receber_cancelar_recebimento Requisição de cancelamento de lançamento de baixa do recebimento.
	 * @return conta_receber_cancelar_recebimento_resposta Resposta do cancelamento da baixa.&nbsp;
	 */
	public function CancelarRecebimento($conta_receber_cancelar_recebimento){
		return self::_Call('CancelarRecebimento',Array(
			$conta_receber_cancelar_recebimento
		));
	}

	/**
	 * Efetua a conciliação da baixa
	 *
	 * @param conta_receber_conciliar_request $conta_receber_conciliar_request Realiza a conciliação do documento
	 * @return conta_receber_conciliar_response Response da conciliação da Conta a Pagar
	 */
	public function ConciliarRecebimento($conta_receber_conciliar_request){
		return self::_Call('ConciliarRecebimento',Array(
			$conta_receber_conciliar_request
		));
	}

	/**
	 * Desconciliar o Recebimento
	 *
	 * @param conta_receber_conciliar_request $conta_receber_conciliar_request Realiza a conciliação do documento
	 * @return conta_receber_conciliar_response Response da conciliação da Conta a Pagar
	 */
	public function DesconciliarRecebimento($conta_receber_conciliar_request){
		return self::_Call('DesconciliarRecebimento',Array(
			$conta_receber_conciliar_request
		));
	}

	/**
	 * Incluir Lançamentos de contas a receber por lote.
	 *
	 * @param conta_receber_lote $conta_receber_lote Inclusão de Contas a Receber por Lote
	 * @return conta_receber_lote_response Resposta do Lançamento de contas a receber por lote&nbsp;
	 */
	public function IncluirContaReceberPorLote($conta_receber_lote){
		return self::_Call('IncluirContaReceberPorLote',Array(
			$conta_receber_lote
		));
	}

	/**
	 * Executa o Upsert do Contas a receber
	 *
	 * @param conta_receber_cadastro $conta_receber_cadastro Cadastro de contas a receber.
	 * @return conta_receber_cadastro_response Resposta do Cadastro de Contas a Receber
	 */
	public function UpsertContaReceber($conta_receber_cadastro){
		return self::_Call('UpsertContaReceber',Array(
			$conta_receber_cadastro
		));
	}

	/**
	 * Efetua o UPSERT do Contas a Receber por Lote.
	 *
	 * @param conta_receber_lote $conta_receber_lote Inclusão de Contas a Receber por Lote
	 * @return conta_receber_lote_response Resposta do Lançamento de contas a receber por lote&nbsp;
	 */
	public function UpsertContaReceberPorLote($conta_receber_lote){
		return self::_Call('UpsertContaReceberPorLote',Array(
			$conta_receber_lote
		));
	}

	/**
	 * Consulta uma Conta a Receber
	 *
	 * @param lcrChave $lcrChave Chave de pesquisa do Lançamento de Contas a Receber
	 * @return conta_receber_cadastro Cadastro de contas a receber.
	 */
	public function ConsultarContaReceber($lcrChave){
		return self::_Call('ConsultarContaReceber',Array(
			$lcrChave
		));
	}

	/**
	 * Lista as contas a receber cadastradas.
	 *
	 * @param lcrListarRequest $lcrListarRequest Solicitação de Listagem de Contas a Receber
	 * @return lcrListarResponse Resposta da listagem de Contas a Receber
	 */
	public function ListarContasReceber($lcrListarRequest){
		return self::_Call('ListarContasReceber',Array(
			$lcrListarRequest
		));
	}

	/**
	 * Cancelamento do boleto gerado de uma conta a receber
	 *
	 * @param conta_receber_cadastro_chave $conta_receber_cadastro_chave Chave da conta a a receber
	 * @return conta_receber_cadastro_response Resposta do Cadastro de Contas a Receber
	 */
	public function CancelarContaReceber($conta_receber_cadastro_chave){
		return self::_Call('CancelarContaReceber',Array(
			$conta_receber_cadastro_chave
		));
	}
}

/**
 * Informações do boleto.
 *
 * @pw_element string $cGerado Gerou boleto (S/N)?
 * @pw_element string $dDtEmBol Data de emissão do boleto.
 * @pw_element string $cNumBoleto Número do boleto.
 * @pw_element string $cNumBancario Número bancário do boleto.
 * @pw_element decimal $nPerJuros Percentual de juros.
 * @pw_element decimal $nPerMulta Percentual de multa.
 * @pw_complex boleto
 */
class boleto{
	/**
	 * Gerou boleto (S/N)?
	 *
	 * @var string
	 */
	public $cGerado;
	/**
	 * Data de emissão do boleto.
	 *
	 * @var string
	 */
	public $dDtEmBol;
	/**
	 * Número do boleto.
	 *
	 * @var string
	 */
	public $cNumBoleto;
	/**
	 * Número bancário do boleto.
	 *
	 * @var string
	 */
	public $cNumBancario;
	/**
	 * Percentual de juros.
	 *
	 * @var decimal
	 */
	public $nPerJuros;
	/**
	 * Percentual de multa.
	 *
	 * @var decimal
	 */
	public $nPerMulta;
}

/**
 * Rateio de Categoria
 *
 * @pw_element string $codigo_categoria Código da Categoria
 * @pw_element decimal $valor Valor do Rateio
 * @pw_element decimal $percentual Percentual da categoria
 * @pw_complex categorias
 */
class categorias{
	/**
	 * Código da Categoria
	 *
	 * @var string
	 */
	public $codigo_categoria;
	/**
	 * Valor do Rateio
	 *
	 * @var decimal
	 */
	public $valor;
	/**
	 * Percentual da categoria
	 *
	 * @var decimal
	 */
	public $percentual;
}


/**
 * Cadastro de contas a receber.
 *
 * @pw_element integer $codigo_lancamento_omie Chave do Lançamento
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_element integer $codigo_cliente_fornecedor Código de Cliente / Fornecedor
 * @pw_element string $codigo_cliente_fornecedor_integracao Código do cliente informado pelo integrador.
 * @pw_element string $data_vencimento Data de Vencimento
 * @pw_element decimal $valor_documento Valor do Lançamento
 * @pw_element string $codigo_categoria Código da Categoria
 * @pw_element string $data_previsao Data de Previsão de Pagamento/Recebimento
 * @pw_element categoriasArray $categorias Rateio de Categoria
 * @pw_element integer $id_conta_corrente Id da Conta Corrente
 * @pw_element string $numero_documento Número do Documento
 * @pw_element string $numero_parcela Número da parcela "Formatada" como 999/999
 * @pw_element string $codigo_tipo_documento Código para o Tipo de Documento
 * @pw_element string $numero_documento_fiscal Número do Documento Fiscal
 * @pw_element string $numero_pedido Número do Pedido
 * @pw_element string $chave_nfe Chave de Acesso da NFE
 * @pw_element string $observacao Observação da Baixa do Contas a Receber.
 * @pw_element string $codigo_barras_ficha_compensacao Código de Barras da Ficha de Compensação
 * @pw_element string $codigo_cmc7_cheque Código CMC7 do Cheque
 * @pw_element string $data_emissao Data de Emissão
 * @pw_element string $id_origem Código da Origem.<BR>Preenchimento automático - Não informar.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Receber.<BR><BR>Os valores disponíveis são:<BR><BR>'APIR' - Integração de Conta a Receber                     <BR>'BARR' - Conta a Receber Importada por Código de Barras    <BR>'CTER' - Parcela a Receber de um CT-e                      <BR>'DEVR' - Conta a Receber da Devolução ao Fornecedor        <BR>'MANR' - Lançamento Manual de Conta a Receber              <BR>'NFER' - Conta a Receber Importada de uma NF-e             <BR>'RPTR' - Repetição de Contas a Receber                     <BR>'VENR' - Parcela a Receber de Vendas                       <BR>'XMLR' - Conta a Receber Importada de um arquivo XML
 * @pw_element string $operacao Operação
 * @pw_element decimal $valor_pis Valor do PIS
 * @pw_element string $retem_pis Indica que o Valor do PIS informado deve ser retido
 * @pw_element decimal $valor_cofins Valor do COFINS
 * @pw_element string $retem_cofins Indica que o Valor do COFINS informado deve ser retido
 * @pw_element decimal $valor_csll Valor do CSLL
 * @pw_element string $retem_csll Indica que o Valor do CSLL informado deve ser retido
 * @pw_element decimal $valor_ir Valor do Imposto de Renda
 * @pw_element string $retem_ir Indica que o Valor do Imposto de Renda  informado deve ser retido
 * @pw_element decimal $valor_iss Valor do ISS
 * @pw_element string $retem_iss Indica que o Valor do ISS informado deve ser retido
 * @pw_element decimal $valor_inss Valor do INSS
 * @pw_element string $retem_inss Indica que o Valor do INSS informado deve ser retido
 * @pw_element string $bloqueado Bloquear lançamento (S/N)
 * @pw_element string $bloquear_baixa bloquear a baixa do lançamento
 * @pw_element string $importado_api Importado pela API (S/N).
 * @pw_element string $baixar_documento Efetua a baixa automática do documento.
 * @pw_element string $conciliar_documento Efetua a conciliação do documento automaticamente.
 * @pw_element string $acao A-Adiciona Valor / S-Subtrai valor / L-Lança valor.
 * @pw_element lancamento_detalheArray $lancamento_detalhe Detalhes do lançamento
 * @pw_element distribuicaoArray $distribuicao Distribuição por Departamentos
 * @pw_element string $status_titulo Status do Título
 * @pw_element integer $codigo_vendedor Código do Vendedor
 * @pw_element integer $codigo_projeto Código do Projeto
 * @pw_element string $nsu Número Sequencial Único - Comprovante de pagamento.
 * @pw_element string $data_registro Data de Registro&nbsp;
 * @pw_element string $tipo_agrupamento Tipo de agrupamento dos lançamentos.<BR><BR>Pode ser:<BR>C-Consolidado (sintético).<BR>I-Individual (analítico).<BR><BR>Não deve ser preenchido na Inclusão/alteração pois é de preenchimento automático para lançamentos recebidos do PDV.<BR><BR><BR>
 * @pw_element info $info Informações complemetares.
 * @pw_element boleto $boleto Informações do boleto.
 * @pw_element integer $nCodPedido ID do Pedido de Venda. <BR><BR>Preenchimento opcional.<BR><BR>Quando informado na inclusão do título associa o documento a um Pedido de Venda já existente no Omie.
 * @pw_element string $bloquear_exclusao Postergar data de vencimento.<BR><BR>Indica que a data de vencimento será postergada aos Sábados, Domingos e Feriados Nacionais.<BR><BR>Preencher com 'S' ou 'N'.<BR><BR>Preencher com 'S' somente umas das tags:<BR>antecipar<BR>postergar<BR><BR>Preenchimento opcional.
 * @pw_element integer $nCodOS ID da Ordem de Serviço.<BR><BR>Preenchimento opcional.<BR><BR>Quando informado na inclusão do título associa o documento a uma Ordem de Serviço já existente no Omie.
 * @pw_element string $cPedidoCliente Número do pedido do cliente.<BR><BR>Preenchimento Opcional.
 * @pw_element string $cNumeroContrato Número do contrato do cliente.<BR><BR>Preenchimento Opcional.
 * @pw_element recebimento $recebimento Detalhes do recebimento (baixa).<BR>Informe aqui os detalhes do recebimento do lançamento.<BR><BR>Ao preencher esse campo é possível detalhar informações da baixa do documento, como: Valor Recebido, Desconto, Juros, Multa, etc.<BR>&nbsp;&nbsp;&nbsp;<BR>Quando essa tag estiver preenchida é obrigatório o preenchimento da tag 'baixar_documento' com 'S'&nbsp;<BR><BR>Caso essa tag não seja preenchida o lançamento será baixado de forma integral de acordo com os valores do lançamento.<BR><BR>Essa tag é utilizada apenas nos métodos de Inclusão e Alteração.<BR><BR>Informação localizada na Aba "Recebimentos" no cadastro do lançamento.<BR><BR>Preenchimento opcional.
 * @pw_element repeticao $repeticao Repetição do lançamento.&nbsp;&nbsp;<BR><BR>Utilize essa estrutura para cadastrar várias parcela na mesma requisição.<BR>Escolha entre as tags 'mensal', 'semanal' ou 'especifico' para definir as datas de vencimento e quantidade de parcelas.<BR><BR>Informação localizada na Aba "Repetição" do cadastro do título.<BR><BR>Essa tag é utilizada apenas nos métodos de Inclusão e Alteração.<BR><BR>Preenchimento opcional.
 * @pw_element string $aprendizado_rateio Aprendizado de rateio de departamento.<BR><BR>Preencher com "S" ou "N".<BR><BR>Default "N"<BR><BR>Quando essa tag for preenchida com 'S' será assumido o rateio de departamento para a categoria informada na tag 'codigo_categoria'.<BR><BR>Essa tag é utilizada apenas nos métodos de inclusão e alteração.
 * @pw_complex conta_receber_cadastro
 */
class conta_receber_cadastro{
	/**
	 * Chave do Lançamento
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código de Cliente / Fornecedor
	 *
	 * @var integer
	 */
	public $codigo_cliente_fornecedor;
	/**
	 * Código do cliente informado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_cliente_fornecedor_integracao;
	/**
	 * Data de Vencimento
	 *
	 * @var string
	 */
	public $data_vencimento;
	/**
	 * Valor do Lançamento
	 *
	 * @var decimal
	 */
	public $valor_documento;
	/**
	 * Código da Categoria
	 *
	 * @var string
	 */
	public $codigo_categoria;
	/**
	 * Data de Previsão de Pagamento/Recebimento
	 *
	 * @var string
	 */
	public $data_previsao;
	/**
	 * Rateio de Categoria
	 *
	 * @var categoriasArray
	 */
	public $categorias;
	/**
	 * Id da Conta Corrente
	 *
	 * @var integer
	 */
	public $id_conta_corrente;
	/**
	 * Número do Documento
	 *
	 * @var string
	 */
	public $numero_documento;
	/**
	 * Número da parcela "Formatada" como 999/999
	 *
	 * @var string
	 */
	public $numero_parcela;
	/**
	 * Código para o Tipo de Documento
	 *
	 * @var string
	 */
	public $codigo_tipo_documento;
	/**
	 * Número do Documento Fiscal
	 *
	 * @var string
	 */
	public $numero_documento_fiscal;
	/**
	 * Número do Pedido
	 *
	 * @var string
	 */
	public $numero_pedido;
	/**
	 * Chave de Acesso da NFE
	 *
	 * @var string
	 */
	public $chave_nfe;
	/**
	 * Observação da Baixa do Contas a Receber.
	 *
	 * @var string
	 */
	public $observacao;
	/**
	 * Código de Barras da Ficha de Compensação
	 *
	 * @var string
	 */
	public $codigo_barras_ficha_compensacao;
	/**
	 * Código CMC7 do Cheque
	 *
	 * @var string
	 */
	public $codigo_cmc7_cheque;
	/**
	 * Data de Emissão
	 *
	 * @var string
	 */
	public $data_emissao;
	/**
	 * Código da Origem.<BR>Preenchimento automático - Não informar.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Receber.<BR><BR>Os valores disponíveis são:<BR><BR>'APIR' - Integração de Conta a Receber                     <BR>'BARR' - Conta a Receber Importada por Código de Barras    <BR>'CTER' - Parcela a Receber de um CT-e                      <BR>'DEVR' - Conta a Receber da Devolução ao Fornecedor        <BR>'MANR' - Lançamento Manual de Conta a Receber              <BR>'NFER' - Conta a Receber Importada de uma NF-e             <BR>'RPTR' - Repetição de Contas a Receber                     <BR>'VENR' - Parcela a Receber de Vendas                       <BR>'XMLR' - Conta a Receber Importada de um arquivo XML
	 *
	 * @var string
	 */
	public $id_origem;
	/**
	 * Operação
	 *
	 * @var string
	 */
	public $operacao;
	/**
	 * Valor do PIS
	 *
	 * @var decimal
	 */
	public $valor_pis;
	/**
	 * Indica que o Valor do PIS informado deve ser retido
	 *
	 * @var string
	 */
	public $retem_pis;
	/**
	 * Valor do COFINS
	 *
	 * @var decimal
	 */
	public $valor_cofins;
	/**
	 * Indica que o Valor do COFINS informado deve ser retido
	 *
	 * @var string
	 */
	public $retem_cofins;
	/**
	 * Valor do CSLL
	 *
	 * @var decimal
	 */
	public $valor_csll;
	/**
	 * Indica que o Valor do CSLL informado deve ser retido
	 *
	 * @var string
	 */
	public $retem_csll;
	/**
	 * Valor do Imposto de Renda
	 *
	 * @var decimal
	 */
	public $valor_ir;
	/**
	 * Indica que o Valor do Imposto de Renda  informado deve ser retido
	 *
	 * @var string
	 */
	public $retem_ir;
	/**
	 * Valor do ISS
	 *
	 * @var decimal
	 */
	public $valor_iss;
	/**
	 * Indica que o Valor do ISS informado deve ser retido
	 *
	 * @var string
	 */
	public $retem_iss;
	/**
	 * Valor do INSS
	 *
	 * @var decimal
	 */
	public $valor_inss;
	/**
	 * Indica que o Valor do INSS informado deve ser retido
	 *
	 * @var string
	 */
	public $retem_inss;
	/**
	 * Bloquear lançamento (S/N)
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * bloquear a baixa do lançamento
	 *
	 * @var string
	 */
	public $bloquear_baixa;
	/**
	 * Importado pela API (S/N).
	 *
	 * @var string
	 */
	public $importado_api;
	/**
	 * Efetua a baixa automática do documento.
	 *
	 * @var string
	 */
	public $baixar_documento;
	/**
	 * Efetua a conciliação do documento automaticamente.
	 *
	 * @var string
	 */
	public $conciliar_documento;
	/**
	 * A-Adiciona Valor / S-Subtrai valor / L-Lança valor.
	 *
	 * @var string
	 */
	public $acao;
	/**
	 * Detalhes do lançamento
	 *
	 * @var lancamento_detalheArray
	 */
	public $lancamento_detalhe;
	/**
	 * Distribuição por Departamentos
	 *
	 * @var distribuicaoArray
	 */
	public $distribuicao;
	/**
	 * Status do Título
	 *
	 * @var string
	 */
	public $status_titulo;
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo_vendedor;
	/**
	 * Código do Projeto
	 *
	 * @var integer
	 */
	public $codigo_projeto;
	/**
	 * Número Sequencial Único - Comprovante de pagamento.
	 *
	 * @var string
	 */
	public $nsu;
	/**
	 * Data de Registro&nbsp;
	 *
	 * @var string
	 */
	public $data_registro;
	/**
	 * Tipo de agrupamento dos lançamentos.<BR><BR>Pode ser:<BR>C-Consolidado (sintético).<BR>I-Individual (analítico).<BR><BR>Não deve ser preenchido na Inclusão/alteração pois é de preenchimento automático para lançamentos recebidos do PDV.<BR><BR><BR>
	 *
	 * @var string
	 */
	public $tipo_agrupamento;
	/**
	 * Informações complemetares.
	 *
	 * @var info
	 */
	public $info;
	/**
	 * Informações do boleto.
	 *
	 * @var boleto
	 */
	public $boleto;
	/**
	 * ID do Pedido de Venda. <BR><BR>Preenchimento opcional.<BR><BR>Quando informado na inclusão do título associa o documento a um Pedido de Venda já existente no Omie.
	 *
	 * @var integer
	 */
	public $nCodPedido;
	/**
	 * Postergar data de vencimento.<BR><BR>Indica que a data de vencimento será postergada aos Sábados, Domingos e Feriados Nacionais.<BR><BR>Preencher com 'S' ou 'N'.<BR><BR>Preencher com 'S' somente umas das tags:<BR>antecipar<BR>postergar<BR><BR>Preenchimento opcional.
	 *
	 * @var string
	 */
	public $bloquear_exclusao;
	/**
	 * ID da Ordem de Serviço.<BR><BR>Preenchimento opcional.<BR><BR>Quando informado na inclusão do título associa o documento a uma Ordem de Serviço já existente no Omie.
	 *
	 * @var integer
	 */
	public $nCodOS;
	/**
	 * Número do pedido do cliente.<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $cPedidoCliente;
	/**
	 * Número do contrato do cliente.<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $cNumeroContrato;
	/**
	 * Detalhes do recebimento (baixa).<BR>Informe aqui os detalhes do recebimento do lançamento.<BR><BR>Ao preencher esse campo é possível detalhar informações da baixa do documento, como: Valor Recebido, Desconto, Juros, Multa, etc.<BR>&nbsp;&nbsp;&nbsp;<BR>Quando essa tag estiver preenchida é obrigatório o preenchimento da tag 'baixar_documento' com 'S'&nbsp;<BR><BR>Caso essa tag não seja preenchida o lançamento será baixado de forma integral de acordo com os valores do lançamento.<BR><BR>Essa tag é utilizada apenas nos métodos de Inclusão e Alteração.<BR><BR>Informação localizada na Aba "Recebimentos" no cadastro do lançamento.<BR><BR>Preenchimento opcional.
	 *
	 * @var recebimento
	 */
	public $recebimento;
	/**
	 * Repetição do lançamento.&nbsp;&nbsp;<BR><BR>Utilize essa estrutura para cadastrar várias parcela na mesma requisição.<BR>Escolha entre as tags 'mensal', 'semanal' ou 'especifico' para definir as datas de vencimento e quantidade de parcelas.<BR><BR>Informação localizada na Aba "Repetição" do cadastro do título.<BR><BR>Essa tag é utilizada apenas nos métodos de Inclusão e Alteração.<BR><BR>Preenchimento opcional.
	 *
	 * @var repeticao
	 */
	public $repeticao;
	/**
	 * Aprendizado de rateio de departamento.<BR><BR>Preencher com "S" ou "N".<BR><BR>Default "N"<BR><BR>Quando essa tag for preenchida com 'S' será assumido o rateio de departamento para a categoria informada na tag 'codigo_categoria'.<BR><BR>Essa tag é utilizada apenas nos métodos de inclusão e alteração.
	 *
	 * @var string
	 */
	public $aprendizado_rateio;
}


/**
 * Detalhes do lançamento
 *
 * @pw_element string $nCodInt Código de Integração&nbsp;&nbsp;
 * @pw_element string $COO COO
 * @pw_element string $CCF CCF
 * @pw_complex lancamento_detalhe
 */
class lancamento_detalhe{
	/**
	 * Código de Integração&nbsp;&nbsp;
	 *
	 * @var string
	 */
	public $nCodInt;
	/**
	 * COO
	 *
	 * @var string
	 */
	public $COO;
	/**
	 * CCF
	 *
	 * @var string
	 */
	public $CCF;
}


/**
 * Distribuição por Departamentos
 *
 * @pw_element string $cCodDep Código do Departamento
 * @pw_element string $cDesDep Descrição do Departamento
 * @pw_element decimal $nValDep Valor do rateio
 * @pw_element decimal $nPerDep Percentual do rateio
 * @pw_complex distribuicao
 */
class distribuicao{
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $cCodDep;
	/**
	 * Descrição do Departamento
	 *
	 * @var string
	 */
	public $cDesDep;
	/**
	 * Valor do rateio
	 *
	 * @var decimal
	 */
	public $nValDep;
	/**
	 * Percentual do rateio
	 *
	 * @var decimal
	 */
	public $nPerDep;
}


/**
 * Informações complemetares.
 *
 * @pw_element string $dInc Data da Inclusão.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hInc Hora da Inclusão.<BR>No formato hh:mm:ss.
 * @pw_element string $uInc Usuário da Inclusão.
 * @pw_element string $dAlt Data da Alteração.<BR>No formato dd/mm/aaaa.
 * @pw_element string $hAlt Hora da Alteração.<BR>No formato hh:mm:ss.
 * @pw_element string $uAlt Usuário da Alteração.
 * @pw_element string $cImpAPI Importado pela API (S/N).
 * @pw_complex info
 */
class info{
	/**
	 * Data da Inclusão.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dInc;
	/**
	 * Hora da Inclusão.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hInc;
	/**
	 * Usuário da Inclusão.
	 *
	 * @var string
	 */
	public $uInc;
	/**
	 * Data da Alteração.<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $dAlt;
	/**
	 * Hora da Alteração.<BR>No formato hh:mm:ss.
	 *
	 * @var string
	 */
	public $hAlt;
	/**
	 * Usuário da Alteração.
	 *
	 * @var string
	 */
	public $uAlt;
	/**
	 * Importado pela API (S/N).
	 *
	 * @var string
	 */
	public $cImpAPI;
}

/**
 * Detalhes do recebimento (baixa).
 *
 * @pw_element string $codigo_recebimento_integracao Código de integração do recebimento de contas a receber que será incluído
 * @pw_element integer $codigo_conta_corrente Código da Conta Corrente.
 * @pw_element decimal $valor Valor a ser baixado.
 * @pw_element decimal $desconto Valor do desconto.
 * @pw_element decimal $juros Valor do Juros.
 * @pw_element decimal $multa Valor da multa.
 * @pw_element string $data Data da Baixa
 * @pw_element string $observacao Observação da Baixa do Contas a Receber.
 * @pw_complex recebimento
 */
class recebimento{
	/**
	 * Código de integração do recebimento de contas a receber que será incluído
	 *
	 * @var string
	 */
	public $codigo_recebimento_integracao;
	/**
	 * Código da Conta Corrente.
	 *
	 * @var integer
	 */
	public $codigo_conta_corrente;
	/**
	 * Valor a ser baixado.
	 *
	 * @var decimal
	 */
	public $valor;
	/**
	 * Valor do desconto.
	 *
	 * @var decimal
	 */
	public $desconto;
	/**
	 * Valor do Juros.
	 *
	 * @var decimal
	 */
	public $juros;
	/**
	 * Valor da multa.
	 *
	 * @var decimal
	 */
	public $multa;
	/**
	 * Data da Baixa
	 *
	 * @var string
	 */
	public $data;
	/**
	 * Observação da Baixa do Contas a Receber.
	 *
	 * @var string
	 */
	public $observacao;
}

/**
 * Repetição do lançamento.
 *
 * @pw_element string $antecipar Antecipar data de vencimento.<BR><BR>Indica que a data de vencimento será antecipada aos Sábados, Domingos e Feriados Nacionais.<BR><BR>Preencher com 'S' ou 'N'.<BR><BR>Preencher com 'S' somente umas das tags:<BR>antecipar<BR>postergar<BR><BR>Preenchimento opcional.
 * @pw_element string $postergar Postergar data de vencimento.<BR><BR>Indica que a data de vencimento será postergada aos Sábados, Domingos e Feriados Nacionais.<BR><BR>Preencher com 'S' ou 'N'.<BR><BR>Preencher com 'S' somente umas das tags:<BR>antecipar<BR>postergar<BR><BR>Preenchimento opcional.
 * @pw_element mensal $mensal Repetição mensal.<BR>Informe aqui os detalhes da repetição mensal do lançamento.<BR><BR>É obrigatório o preenchimento de apenas umas das tags: <BR>mensal<BR>semanal<BR>especifico
 * @pw_element semanal $semanal Repetição semanal.<BR>Informe aqui os detalhes da repetição semanal do lançamento.<BR><BR>É obrigatório o preenchimento de apenas umas das tags: <BR>mensal<BR>semanal<BR>especifico
 * @pw_element especifico $especifico Repetição específica.<BR>Informe aqui os detalhes da repetição específica do lançamento.<BR><BR>É obrigatório o preenchimento de apenas umas das tags: <BR>mensal<BR>semanal<BR>especifico
 * @pw_complex repeticao
 */
class repeticao{
	/**
	 * Antecipar data de vencimento.<BR><BR>Indica que a data de vencimento será antecipada aos Sábados, Domingos e Feriados Nacionais.<BR><BR>Preencher com 'S' ou 'N'.<BR><BR>Preencher com 'S' somente umas das tags:<BR>antecipar<BR>postergar<BR><BR>Preenchimento opcional.
	 *
	 * @var string
	 */
	public $antecipar;
	/**
	 * Postergar data de vencimento.<BR><BR>Indica que a data de vencimento será postergada aos Sábados, Domingos e Feriados Nacionais.<BR><BR>Preencher com 'S' ou 'N'.<BR><BR>Preencher com 'S' somente umas das tags:<BR>antecipar<BR>postergar<BR><BR>Preenchimento opcional.
	 *
	 * @var string
	 */
	public $postergar;
	/**
	 * Repetição mensal.<BR>Informe aqui os detalhes da repetição mensal do lançamento.<BR><BR>É obrigatório o preenchimento de apenas umas das tags: <BR>mensal<BR>semanal<BR>especifico
	 *
	 * @var mensal
	 */
	public $mensal;
	/**
	 * Repetição semanal.<BR>Informe aqui os detalhes da repetição semanal do lançamento.<BR><BR>É obrigatório o preenchimento de apenas umas das tags: <BR>mensal<BR>semanal<BR>especifico
	 *
	 * @var semanal
	 */
	public $semanal;
	/**
	 * Repetição específica.<BR>Informe aqui os detalhes da repetição específica do lançamento.<BR><BR>É obrigatório o preenchimento de apenas umas das tags: <BR>mensal<BR>semanal<BR>especifico
	 *
	 * @var especifico
	 */
	public $especifico;
}

/**
 * Chave da conta a a receber
 *
 * @pw_element integer $chave_lancamento Chave do Lançamento
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_complex conta_receber_cadastro_chave
 */
class conta_receber_cadastro_chave{
	/**
	 * Chave do Lançamento
	 *
	 * @var integer
	 */
	public $chave_lancamento;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
}

/**
 * Resposta do Cadastro de Contas a Receber
 *
 * @pw_element integer $codigo_lancamento_omie Chave do Lançamento
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex conta_receber_cadastro_response
 */
class conta_receber_cadastro_response{
	/**
	 * Chave do Lançamento
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Requisição de cancelamento de lançamento de baixa do recebimento.
 *
 * @pw_element integer $codigo_baixa Código da Baixa
 * @pw_element string $codigo_baixa_integracao Código de Integração da Baixa
 * @pw_complex conta_receber_cancelar_recebimento
 */
class conta_receber_cancelar_recebimento{
	/**
	 * Código da Baixa
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código de Integração da Baixa
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
}

/**
 * Resposta do cancelamento da baixa.
 *
 * @pw_element integer $codigo_baixa Código da Baixa
 * @pw_element string $codigo_baixa_integracao Código de Integração da Baixa
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex conta_receber_cancelar_recebimento_resposta
 */
class conta_receber_cancelar_recebimento_resposta{
	/**
	 * Código da Baixa
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código de Integração da Baixa
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Realiza a conciliação do documento
 *
 * @pw_element integer $codigo_baixa Código da Baixa
 * @pw_element string $codigo_baixa_integracao Código do lançamento gerado pelo integrador.
 * @pw_complex conta_receber_conciliar_request
 */
class conta_receber_conciliar_request{
	/**
	 * Código da Baixa
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
}

/**
 * Response da conciliação da Conta a Pagar
 *
 * @pw_element integer $codigo_baixa Código da Baixa
 * @pw_element string $codigo_baixa_integracao Código de Integração da Baixa
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex conta_receber_conciliar_response
 */
class conta_receber_conciliar_response{
	/**
	 * Código da Baixa
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código de Integração da Baixa
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Informações para realizada a Baixa do Contas a Receber.
 *
 * @pw_element integer $codigo_lancamento Código do lançamento no contas a receber,
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_element integer $codigo_baixa Código da Baixa
 * @pw_element string $codigo_baixa_integracao Código de Integração da Baixa
 * @pw_element integer $codigo_conta_corrente Código da Conta Corrente.
 * @pw_element string $codigo_conta_corrente_integracao Código da Conta Corrente do Integrador.
 * @pw_element decimal $valor Valor a ser baixado.
 * @pw_element decimal $juros Valor do Juros.
 * @pw_element decimal $desconto Valor do desconto.
 * @pw_element decimal $multa Valor da multa.
 * @pw_element string $data Data da Baixa
 * @pw_element string $observacao Observação da Baixa do Contas a Receber.
 * @pw_element string $bloqueado Bloquear lançamento (S/N)
 * @pw_element string $conciliar_documento Efetua a conciliação do documento automaticamente.
 * @pw_element string $nsu Número Sequencial Único - Comprovante de pagamento.
 * @pw_complex conta_receber_lancar_recebimento
 */
class conta_receber_lancar_recebimento{
	/**
	 * Código do lançamento no contas a receber,
	 *
	 * @var integer
	 */
	public $codigo_lancamento;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código da Baixa
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código de Integração da Baixa
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Código da Conta Corrente.
	 *
	 * @var integer
	 */
	public $codigo_conta_corrente;
	/**
	 * Código da Conta Corrente do Integrador.
	 *
	 * @var string
	 */
	public $codigo_conta_corrente_integracao;
	/**
	 * Valor a ser baixado.
	 *
	 * @var decimal
	 */
	public $valor;
	/**
	 * Valor do Juros.
	 *
	 * @var decimal
	 */
	public $juros;
	/**
	 * Valor do desconto.
	 *
	 * @var decimal
	 */
	public $desconto;
	/**
	 * Valor da multa.
	 *
	 * @var decimal
	 */
	public $multa;
	/**
	 * Data da Baixa
	 *
	 * @var string
	 */
	public $data;
	/**
	 * Observação da Baixa do Contas a Receber.
	 *
	 * @var string
	 */
	public $observacao;
	/**
	 * Bloquear lançamento (S/N)
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * Efetua a conciliação do documento automaticamente.
	 *
	 * @var string
	 */
	public $conciliar_documento;
	/**
	 * Número Sequencial Único - Comprovante de pagamento.
	 *
	 * @var string
	 */
	public $nsu;
}

/**
 * Resultado da baixa realizada para um lançamento do conta a receber.
 *
 * @pw_element integer $codigo_lancamento Código do lançamento no contas a receber,
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_element integer $codigo_baixa Código da Baixa
 * @pw_element string $codigo_baixa_integracao Código de Integração da Baixa
 * @pw_element string $liquidado Indica que o recebimento liquidado.
 * @pw_element decimal $valor_baixado Valor a ser baixado.
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex conta_receber_lancar_recebimento_resposta
 */
class conta_receber_lancar_recebimento_resposta{
	/**
	 * Código do lançamento no contas a receber,
	 *
	 * @var integer
	 */
	public $codigo_lancamento;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código da Baixa
	 *
	 * @var integer
	 */
	public $codigo_baixa;
	/**
	 * Código de Integração da Baixa
	 *
	 * @var string
	 */
	public $codigo_baixa_integracao;
	/**
	 * Indica que o recebimento liquidado.
	 *
	 * @var string
	 */
	public $liquidado;
	/**
	 * Valor a ser baixado.
	 *
	 * @var decimal
	 */
	public $valor_baixado;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $descricao_status;
}

/**
 * Inclusão de Contas a Receber por Lote
 *
 * @pw_element integer $lote Número do lote processado
 * @pw_element conta_receber_cadastroArray $conta_receber_cadastro Cadastro de contas a receber.
 * @pw_complex conta_receber_lote
 */
class conta_receber_lote{
	/**
	 * Número do lote processado
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Cadastro de contas a receber.
	 *
	 * @var conta_receber_cadastroArray
	 */
	public $conta_receber_cadastro;
}

/**
 * Resposta do Lançamento de contas a receber por lote
 *
 * @pw_element integer $lote Número do lote processado
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_element status_loteArray $status_lote Detalhes da inclusão/alteração dos lançamentos.
 * @pw_complex conta_receber_lote_response
 */
class conta_receber_lote_response{
	/**
	 * Número do lote processado
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $descricao_status;
	/**
	 * Detalhes da inclusão/alteração dos lançamentos.
	 *
	 * @var status_loteArray
	 */
	public $status_lote;
}

/**
 * Detalhes da inclusão/alteração dos lançamentos.
 *
 * @pw_element integer $codigo_lancamento_omie Chave do Lançamento
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex status_lote
 */
class status_lote{
	/**
	 * Chave do Lançamento
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
	/**
	 * Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
	 *
	 * @var string
	 */
	public $descricao_status;
}


/**
 * Repetição específica.
 *
 * @pw_element integer $repetir_a_cada Informe aqui o intervalo em dias entre cada vencimento do lançamento que será cadastrado.<BR><BR>Exemplo:<BR>Caso informe uma quantidade de 10 dias, será cadastrado um lançamento com vencimento a cada 10 dias.<BR><BR>Preenchimento obrigatório.
 * @pw_element integer $repetir_por Informe aqui a quantidade de parcelas que serão cadastradas com um limite de até 120 repetições.<BR><BR>Preenchimento obrigatório.
 * @pw_complex especifico
 */
class especifico{
	/**
	 * Informe aqui o intervalo em dias entre cada vencimento do lançamento que será cadastrado.<BR><BR>Exemplo:<BR>Caso informe uma quantidade de 10 dias, será cadastrado um lançamento com vencimento a cada 10 dias.<BR><BR>Preenchimento obrigatório.
	 *
	 * @var integer
	 */
	public $repetir_a_cada;
	/**
	 * Informe aqui a quantidade de parcelas que serão cadastradas com um limite de até 120 repetições.<BR><BR>Preenchimento obrigatório.
	 *
	 * @var integer
	 */
	public $repetir_por;
}

/**
 * Chave de pesquisa do Lançamento de Contas a Receber
 *
 * @pw_element integer $codigo_lancamento_omie Chave do Lançamento
 * @pw_element string $codigo_lancamento_integracao Código do lançamento gerado pelo integrador.
 * @pw_complex lcrChave
 */
class lcrChave{
	/**
	 * Chave do Lançamento
	 *
	 * @var integer
	 */
	public $codigo_lancamento_omie;
	/**
	 * Código do lançamento gerado pelo integrador.
	 *
	 * @var string
	 */
	public $codigo_lancamento_integracao;
}

/**
 * Solicitação de Listagem de Contas a Receber
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros retornados
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordenar o resultado da página por:<BR><BR>CODIGO - Código do lançamento do Omie;<BR>CODIGO_INTEGRACAO - lançamento interno do seu sistema;<BR>DATA_EMISSAO - Data de Emissão<BR>DATA_INCLUSAO - Data de Inclusão<BR>DATA_ALTERACAO - Data de Alteração<BR>DATA_VENCIMENTO - Data de Vencimento<BR>DATA_PAGAMENTO - Data de Pagamento
 * @pw_element string $ordem_descrescente Indica se a ordem de exibição é decrescente caso seja informado "S".
 * @pw_element string $filtrar_por_data_de Filtrar lançamentos incluídos e/ou alterados até a data
 * @pw_element string $filtrar_por_data_ate Filtrar lançamentos incluídos e/ou alterados até a data
 * @pw_element string $filtrar_apenas_inclusao Filtrar apenas registros incluídos (S/N)
 * @pw_element string $filtrar_apenas_alteracao Filtrar apenas registros alterados (S/N)
 * @pw_element string $filtrar_por_emissao_de Data de alteração inicial (Filtrar os registros a partir da data especificada).<BR>No formato dd/mm/aaaa.
 * @pw_element string $filtrar_por_registro_de Filtra os registros a partir da data
 * @pw_element string $filtrar_por_emissao_ate Data de alteração final (Filtra os registros até a data especificada).<BR>No formato dd/mm/aaaa.
 * @pw_element string $filtrar_por_registro_ate Filtra os registros até a data especificada
 * @pw_element integer $filtrar_conta_corrente Código da Conta Corrente
 * @pw_element string $filtrar_apenas_titulos_em_aberto Filtra os registros exibindos apenas os titulos em aberto
 * @pw_element integer $filtrar_cliente Filtra os registros exibidos por cliente
 * @pw_element string $filtrar_por_status Filtrar por Status
 * @pw_element string $filtrar_por_cpf_cnpj Filtrar os títulos por CPF/CNPJ
 * @pw_element integer $filtrar_por_projeto Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
 * @pw_element integer $filtrar_por_vendedor Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
 * @pw_element string $exibir_obs Exibir as observações do lançamento (S/N).<BR><BR>Preencher com "S" ou "N".<BR><BR>Default "N"<BR><BR>Preenchimento Opcional.
 * @pw_complex lcrListarRequest
 */
class lcrListarRequest{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros retornados
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordenar o resultado da página por:<BR><BR>CODIGO - Código do lançamento do Omie;<BR>CODIGO_INTEGRACAO - lançamento interno do seu sistema;<BR>DATA_EMISSAO - Data de Emissão<BR>DATA_INCLUSAO - Data de Inclusão<BR>DATA_ALTERACAO - Data de Alteração<BR>DATA_VENCIMENTO - Data de Vencimento<BR>DATA_PAGAMENTO - Data de Pagamento
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Indica se a ordem de exibição é decrescente caso seja informado "S".
	 *
	 * @var string
	 */
	public $ordem_descrescente;
	/**
	 * Filtrar lançamentos incluídos e/ou alterados até a data
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * Filtrar lançamentos incluídos e/ou alterados até a data
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * Filtrar apenas registros incluídos (S/N)
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * Filtrar apenas registros alterados (S/N)
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
	/**
	 * Data de alteração inicial (Filtrar os registros a partir da data especificada).<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $filtrar_por_emissao_de;
	/**
	 * Filtra os registros a partir da data
	 *
	 * @var string
	 */
	public $filtrar_por_registro_de;
	/**
	 * Data de alteração final (Filtra os registros até a data especificada).<BR>No formato dd/mm/aaaa.
	 *
	 * @var string
	 */
	public $filtrar_por_emissao_ate;
	/**
	 * Filtra os registros até a data especificada
	 *
	 * @var string
	 */
	public $filtrar_por_registro_ate;
	/**
	 * Código da Conta Corrente
	 *
	 * @var integer
	 */
	public $filtrar_conta_corrente;
	/**
	 * Filtra os registros exibindos apenas os titulos em aberto
	 *
	 * @var string
	 */
	public $filtrar_apenas_titulos_em_aberto;
	/**
	 * Filtra os registros exibidos por cliente
	 *
	 * @var integer
	 */
	public $filtrar_cliente;
	/**
	 * Filtrar por Status
	 *
	 * @var string
	 */
	public $filtrar_por_status;
	/**
	 * Filtrar os títulos por CPF/CNPJ
	 *
	 * @var string
	 */
	public $filtrar_por_cpf_cnpj;
	/**
	 * Código do Projeto.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Detalhes" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarProjetos' da API<BR>http://app.omie.com.br/api/v1/geral/projetos/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $filtrar_por_projeto;
	/**
	 * Código do Vendedor.<BR>Preenchimento Opcional.<BR><BR>Informação localizada na Aba "Diversos" do Contas a Pagar.<BR><BR>Utilize a tag 'codigo' do método 'ListarVendedores' da API<BR>http://app.omie.com.br/api/v1/geral/vendedores/<BR>para obter essa informação.
	 *
	 * @var integer
	 */
	public $filtrar_por_vendedor;
	/**
	 * Exibir as observações do lançamento (S/N).<BR><BR>Preencher com "S" ou "N".<BR><BR>Default "N"<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $exibir_obs;
}

/**
 * Resposta da listagem de Contas a Receber
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros retornados
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element conta_receber_cadastroArray $conta_receber_cadastro Cadastro de contas a receber.
 * @pw_complex lcrListarResponse
 */
class lcrListarResponse{
	/**
	 * Número da página que será listada.
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Total de páginas encontradas.
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros retornados
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * Total de registros encontrados.
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Cadastro de contas a receber.
	 *
	 * @var conta_receber_cadastroArray
	 */
	public $conta_receber_cadastro;
}

/**
 * Repetição mensal.
 *
 * @pw_element integer $repetir_todo_dia Informe aqui o dia do mês em que cadá lançamento irá vencer .<BR><BR>Exemplo:<BR>Caso informe dia 30, será cadastrado um lançamento com vencimento para o dia 30 de cada mês.<BR><BR>Preenchimento obrigatório.
 * @pw_element integer $repetir_por Informe aqui a quantidade de parcelas que serão cadastradas com um limite de até 120 repetições.<BR><BR>Preenchimento obrigatório.
 * @pw_complex mensal
 */
class mensal{
	/**
	 * Informe aqui o dia do mês em que cadá lançamento irá vencer .<BR><BR>Exemplo:<BR>Caso informe dia 30, será cadastrado um lançamento com vencimento para o dia 30 de cada mês.<BR><BR>Preenchimento obrigatório.
	 *
	 * @var integer
	 */
	public $repetir_todo_dia;
	/**
	 * Informe aqui a quantidade de parcelas que serão cadastradas com um limite de até 120 repetições.<BR><BR>Preenchimento obrigatório.
	 *
	 * @var integer
	 */
	public $repetir_por;
}

/**
 * Cadastro de Distribuição por Departamento
 *
 * @pw_element string $codigo_tipo_credito Código do Tipo do Crédito, conforme Tabela 4.3.6.
 * @pw_element string $conta_financeira Conta Financeira
 * @pw_element string $codigo_base_calculo Código da Base de Cálculo do Crédito
 * @pw_element integer $cst_cofins Código da Situação Tributária do COFINS
 * @pw_element integer $cst_pis Código da Situação Tributária do PIS
 * @pw_element string $job Job
 * @pw_element decimal $percentual_rateio Percentual do rateio
 * @pw_element string $codigo_departamento Código do Departamento
 * @pw_element decimal $valor Valor do rateio
 * @pw_element string $valor_fixado Indica que o valor foi fixado na distribuição do rateio
 * @pw_element string $codigo_contribuicao_social Código da contribuição social apurada no período, conforme a Tabela 4.3.5.
 * @pw_element integer $chave_lancamento Chave do Lançamento na PAGREC
 * @pw_complex rateio_cadastro
 */
class rateio_cadastro{
	/**
	 * Código do Tipo do Crédito, conforme Tabela 4.3.6.
	 *
	 * @var string
	 */
	public $codigo_tipo_credito;
	/**
	 * Conta Financeira
	 *
	 * @var string
	 */
	public $conta_financeira;
	/**
	 * Código da Base de Cálculo do Crédito
	 *
	 * @var string
	 */
	public $codigo_base_calculo;
	/**
	 * Código da Situação Tributária do COFINS
	 *
	 * @var integer
	 */
	public $cst_cofins;
	/**
	 * Código da Situação Tributária do PIS
	 *
	 * @var integer
	 */
	public $cst_pis;
	/**
	 * Job
	 *
	 * @var string
	 */
	public $job;
	/**
	 * Percentual do rateio
	 *
	 * @var decimal
	 */
	public $percentual_rateio;
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $codigo_departamento;
	/**
	 * Valor do rateio
	 *
	 * @var decimal
	 */
	public $valor;
	/**
	 * Indica que o valor foi fixado na distribuição do rateio
	 *
	 * @var string
	 */
	public $valor_fixado;
	/**
	 * Código da contribuição social apurada no período, conforme a Tabela 4.3.5.
	 *
	 * @var string
	 */
	public $codigo_contribuicao_social;
	/**
	 * Chave do Lançamento na PAGREC
	 *
	 * @var integer
	 */
	public $chave_lancamento;
}

/**
 * Repetição semanal.
 *
 * @pw_element string $repetir_dia_semana Informe o dia da semana que será o vencimento do lançamento.<BR><BR>Pode ser:<BR><BR>domingo<BR>segunda<BR>terca<BR>quarta<BR>quinta<BR>sexta<BR>sabado<BR><BR>Preenchimento obrigatório.
 * @pw_element integer $repetir_por Informe aqui a quantidade de parcelas que serão cadastradas com um limite de até 120 repetições.<BR><BR>Preenchimento obrigatório.
 * @pw_complex semanal
 */
class semanal{
	/**
	 * Informe o dia da semana que será o vencimento do lançamento.<BR><BR>Pode ser:<BR><BR>domingo<BR>segunda<BR>terca<BR>quarta<BR>quinta<BR>sexta<BR>sabado<BR><BR>Preenchimento obrigatório.
	 *
	 * @var string
	 */
	public $repetir_dia_semana;
	/**
	 * Informe aqui a quantidade de parcelas que serão cadastradas com um limite de até 120 repetições.<BR><BR>Preenchimento obrigatório.
	 *
	 * @var integer
	 */
	public $repetir_por;
}

/**
 * Erro gerado pela aplicação.
 *
 * @pw_element integer $code Codigo do erro
 * @pw_element string $description Descricao do erro
 * @pw_element string $referer Origem do erro
 * @pw_element boolean $fatal Indica se eh um erro fatal
 * @pw_complex omie_fail
 */
if (!class_exists('omie_fail')) {
class omie_fail_lancamento{
	/**
	 * Codigo do erro
	 *
	 * @var integer
	 */
	public $code;
	/**
	 * Descricao do erro
	 *
	 * @var string
	 */
	public $description;
	/**
	 * Origem do erro
	 *
	 * @var string
	 */
	public $referer;
	/**
	 * Indica se eh um erro fatal
	 *
	 * @var boolean
	 */
	public $fatal;
}
}