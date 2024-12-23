<?php
/**
 * @service ProdutosCadastroJsonClient
 * @author omie
 */
namespace OmieSdk;

class ProdutosCadastroJsonClient {
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
	public static $_WsdlUri='https://app.omie.com.br/api/v1/geral/produtos/?WSDL';
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
	public static $_EndPoint='https://app.omie.com.br/api/v1/geral/produtos/';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public function __construct($appKey, $appSecret) {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }

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
	 * Incluir um produto.
	 *
	 * @param produto_servico_cadastro $produto_servico_cadastro Cadastro completo de produtos
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function IncluirProduto($produto_servico_cadastro){
		return self::_Call('IncluirProduto',Array(
			$produto_servico_cadastro
		));
	}

	/**
	 * Altera um produto já cadastrado.
	 *
	 * @param produto_servico_cadastro $produto_servico_cadastro Cadastro completo de produtos
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function AlterarProduto($produto_servico_cadastro){
		return self::_Call('AlterarProduto',Array(
			$produto_servico_cadastro
		));
	}

	/**
	 * Exclui um produto
	 *
	 * @param produto_servico_cadastro_chave $produto_servico_cadastro_chave Pesquisa de produtos
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function ExcluirProduto($produto_servico_cadastro_chave){
		return self::_Call('ExcluirProduto',Array(
			$produto_servico_cadastro_chave
		));
	}

	/**
	 * Consulta um produto.
	 *
	 * @param produto_servico_cadastro_chave $produto_servico_cadastro_chave Pesquisa de produtos
	 * @return produto_servico_cadastro Cadastro completo de produtos
	 */
	public function ConsultarProduto($produto_servico_cadastro_chave){
		return self::_Call('ConsultarProduto',Array(
			$produto_servico_cadastro_chave
		));
	}

	/**
	 * DEPRECATED
	 *
	 * @param produto_servico_lote_request $produto_servico_lote_request Importação em Lote de produtos
	 * @return produto_servico_lote_response Resposta do processamento do lote de produto importados.
	 */
	public function IncluirProdutosPorLote($produto_servico_lote_request){
		return self::_Call('IncluirProdutosPorLote',Array(
			$produto_servico_lote_request
		));
	}

	/**
	 * Lista completa do cadastro de produtos
	 *
	 * @param produto_servico_list_request $produto_servico_list_request Lista os produtos cadastrados
	 * @return produto_servico_listfull_response Lista completa de produtos encontrados no omie.
	 */
	public function ListarProdutos($produto_servico_list_request){
		return self::_Call('ListarProdutos',Array(
			$produto_servico_list_request
		));
	}

	/**
	 * Lista os produtos cadastrados
	 *
	 * @param produto_servico_list_request $produto_servico_list_request Lista os produtos cadastrados
	 * @return produto_servico_list_response Lista de produtos encontrados no omie.
	 */
	public function ListarProdutosResumido($produto_servico_list_request){
		return self::_Call('ListarProdutosResumido',Array(
			$produto_servico_list_request
		));
	}

	/**
	 * Realiza a inclusão/alteração de produtos.
	 *
	 * @param produto_servico_cadastro $produto_servico_cadastro Cadastro completo de produtos
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function UpsertProduto($produto_servico_cadastro){
		return self::_Call('UpsertProduto',Array(
			$produto_servico_cadastro
		));
	}

	/**
	 * DEPRECATED
	 *
	 * @param produto_servico_lote_request $produto_servico_lote_request Importação em Lote de produtos
	 * @return produto_servico_lote_response Resposta do processamento do lote de produto importados.
	 */
	public function UpsertProdutosPorLote($produto_servico_lote_request){
		return self::_Call('UpsertProdutosPorLote',Array(
			$produto_servico_lote_request
		));
	}

	/**
	 * Associa um código de integração do produto.
	 *
	 * @param produto_servico_cadastro_chave $produto_servico_cadastro_chave Pesquisa de produtos
	 * @return produto_servico_status Status de retorno do cadastro de produtos
	 */
	public function AssociarCodIntProduto($produto_servico_cadastro_chave){
		return self::_Call('AssociarCodIntProduto',Array(
			$produto_servico_cadastro_chave
		));
	}
}

/**
 * Detalhamento especifco para cadastro de armamentos.
 *
 * @pw_element string $serie_cano Número de série do cano
 * @pw_element string $descr_arma Descrição completa da arma
 * @pw_element string $serie_arma Número de série da arma
 * @pw_element string $tipo_arma Indicador do tipo de arma de fogo
 * @pw_complex armamento
 */
class armamento{
	/**
	 * Número de série do cano
	 *
	 * @var string
	 */
	public $serie_cano;
	/**
	 * Descrição completa da arma
	 *
	 * @var string
	 */
	public $descr_arma;
	/**
	 * Número de série da arma
	 *
	 * @var string
	 */
	public $serie_arma;
	/**
	 * Indicador do tipo de arma de fogo
	 *
	 * @var string
	 */
	public $tipo_arma;
}

/**
 * lista de caracteristicas do produto.
 *
 * @pw_element integer $nCodCaract Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
 * @pw_element string $cCodIntCaract Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cNomeCaract Nome da característica.
 * @pw_element string $cConteudo Conteúdo da característica.
 * @pw_element string $cExibirItemNF Exibir esta característica no item da NF-e emitida (S/N).
 * @pw_element string $cExibirItemPedido Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
 * @pw_element string $cExibirOrdemProd Exibe esta característica na Ordem de Produção e Mapa de Custo (S/N).
 * @pw_complex caracteristicas
 */
class caracteristicas{
	/**
	 * Código da característica de produto.<BR>(Interno, utilizado apenas na integração via API, não é exibido na tela).<BR>O conteúdo desse campo é o código interno da característica do produto gerado pelo Omie.
	 *
	 * @var integer
	 */
	public $nCodCaract;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $cCodIntCaract;
	/**
	 * Nome da característica.
	 *
	 * @var string
	 */
	public $cNomeCaract;
	/**
	 * Conteúdo da característica.
	 *
	 * @var string
	 */
	public $cConteudo;
	/**
	 * Exibir esta característica no item da NF-e emitida (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemNF;
	/**
	 * Exibir esta característica no item do Pedido, Remessa ou Devolução (S/N).
	 *
	 * @var string
	 */
	public $cExibirItemPedido;
	/**
	 * Exibe esta característica na Ordem de Produção e Mapa de Custo (S/N).
	 *
	 * @var string
	 */
	public $cExibirOrdemProd;
}


/**
 * Detalhamento específico para cadastro de combustíveis.
 *
 * @pw_element string $codigo_anp Código de Produto da ANP.
 * @pw_element string $descr_anp Descrição do Produto conforme ANP.
 * @pw_element decimal $percent_glp Percentual de GLP Derivado do Petróleo.
 * @pw_element decimal $percent_gas_nac Percentual de Gás Natural Nacional.
 * @pw_element decimal $percent_gas_imp Percentual de Gás Natural Importado.
 * @pw_element decimal $valor_part Valor de partida
 * @pw_complex combustivel
 */
class combustivel{
	/**
	 * Código de Produto da ANP.
	 *
	 * @var string
	 */
	public $codigo_anp;
	/**
	 * Descrição do Produto conforme ANP.
	 *
	 * @var string
	 */
	public $descr_anp;
	/**
	 * Percentual de GLP Derivado do Petróleo.
	 *
	 * @var decimal
	 */
	public $percent_glp;
	/**
	 * Percentual de Gás Natural Nacional.
	 *
	 * @var decimal
	 */
	public $percent_gas_nac;
	/**
	 * Percentual de Gás Natural Importado.
	 *
	 * @var decimal
	 */
	public $percent_gas_imp;
	/**
	 * Valor de partida
	 *
	 * @var decimal
	 */
	public $valor_part;
}

/**
 * Componetes do KIT.
 *
 * @pw_element integer $codigo_componente Identificação do componente do KIT, deve ser utilizado para Alterar e Excluir o componente.<BR><BR>Não deve ser informado na inclusão.<BR><BR>Esse código não aparece na tela do Omie.<BR><BR>Preenchimento obrigatório na Alteração e Exclusão.
 * @pw_element integer $codigo_produto_componente Código do produto componente.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.
 * @pw_element decimal $quantidade_componente Quantidade do componente.
 * @pw_element decimal $valor_unitario_componente Valor unitário do componente.
 * @pw_element integer $local_estoque_componente Local estoque do componente.
 * @pw_complex componentes_kit
 */
class componentes_kit{
	/**
	 * Identificação do componente do KIT, deve ser utilizado para Alterar e Excluir o componente.<BR><BR>Não deve ser informado na inclusão.<BR><BR>Esse código não aparece na tela do Omie.<BR><BR>Preenchimento obrigatório na Alteração e Exclusão.
	 *
	 * @var integer
	 */
	public $codigo_componente;
	/**
	 * Código do produto componente.<BR>(Código interno utilizado apenas na API).<BR>Esse código não aparece na tela do Omie.
	 *
	 * @var integer
	 */
	public $codigo_produto_componente;
	/**
	 * Quantidade do componente.
	 *
	 * @var decimal
	 */
	public $quantidade_componente;
	/**
	 * Valor unitário do componente.
	 *
	 * @var decimal
	 */
	public $valor_unitario_componente;
	/**
	 * Local estoque do componente.
	 *
	 * @var integer
	 */
	public $local_estoque_componente;
}


/**
 * Dados do IBPT.
 *
 * @pw_element decimal $aliqFederal Carga tributária federal para os produtos nacionais.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element decimal $aliqEstadual Carga tributária estadual.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element decimal $aliqMunicipal Carga tributária municipal.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $fonte Fonte do IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $chave Número da versão do arquivo do IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $versao Versão da Tabela IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $valido_de Tabela do IBPT válilda a partir da data.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $valido_ate Tabela do IBPT valida até a data.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_complex dadosIbpt
 */
class dadosIbpt{
	/**
	 * Carga tributária federal para os produtos nacionais.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var decimal
	 */
	public $aliqFederal;
	/**
	 * Carga tributária estadual.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var decimal
	 */
	public $aliqEstadual;
	/**
	 * Carga tributária municipal.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var decimal
	 */
	public $aliqMunicipal;
	/**
	 * Fonte do IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $fonte;
	/**
	 * Número da versão do arquivo do IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $chave;
	/**
	 * Versão da Tabela IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $versao;
	/**
	 * Tabela do IBPT válilda a partir da data.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $valido_de;
	/**
	 * Tabela do IBPT valida até a data.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $valido_ate;
}

/**
 * Lista de imagens do produto.
 *
 * @pw_element string $url_imagem URL da Imagem do produto.
 * @pw_complex imagens
 */
class imagens{
	/**
	 * URL da Imagem do produto.
	 *
	 * @var string
	 */
	public $url_imagem;
}


/**
 * Informações complemetares do cadastro do produto.
 *
 * @pw_element string $dInc Data da Inclusão.<BR>No formato dd/mm/aaaa.<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $hInc Hora da Inclusão.<BR>No formato hh:mm:ss.<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $uInc Usuário da Inclusão.<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $dAlt Data da Alteração.<BR>No formato dd/mm/aaaa.<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $hAlt Hora da Alteração.<BR>No formato hh:mm:ss.<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $uAlt Usuário da Alteração.<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $cImpAPI Importado pela API (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_complex info
 */
class info{
	/**
	 * Data da Inclusão.<BR>No formato dd/mm/aaaa.<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $dInc;
	/**
	 * Hora da Inclusão.<BR>No formato hh:mm:ss.<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $hInc;
	/**
	 * Usuário da Inclusão.<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $uInc;
	/**
	 * Data da Alteração.<BR>No formato dd/mm/aaaa.<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $dAlt;
	/**
	 * Hora da Alteração.<BR>No formato hh:mm:ss.<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $hAlt;
	/**
	 * Usuário da Alteração.<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $uAlt;
	/**
	 * Importado pela API (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $cImpAPI;
}

/**
 * Detalhamento específico para cadastro de medicamentos
 *
 * @pw_element string $cod_anvisa Código de produto Anvisa
 * @pw_element decimal $preco_max_cons Preço máximo consumidor
 * @pw_complex medicamento
 */
class medicamento{
	/**
	 * Código de produto Anvisa
	 *
	 * @var string
	 */
	public $cod_anvisa;
	/**
	 * Preço máximo consumidor
	 *
	 * @var decimal
	 */
	public $preco_max_cons;
}

/**
 * Cadastro completo de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
 * @pw_element string $descricao Descrição do produto.<BR><BR>Preenchimento Obrigatório na inclusão.
 * @pw_element string $unidade Código da Unidade.<BR><BR>Preenchimento Obrigatório.
 * @pw_element string $ncm Código da Nomenclatura Comum do Mercosul (NCM).<BR><BR>Preenchimento Obrigatório na Inclusão.
 * @pw_element string $ean Código EAN (GTIN - Global Trade Item Number).<BR><BR>Preenchimento Opcional.
 * @pw_element decimal $valor_unitario Preço Unitário de Venda.<BR><BR>Preenchimento Obrigatório.
 * @pw_element integer $codigo_familia Código da Familia do Produto.<BR><BR>Preenchimento Opcional.
 * @pw_element string $tipoItem Código do Tipo do Item para o SPED.<BR><BR>Preenchimento Opcional.<BR><BR>Pode ser:<BR><BR>00 - Mercadoria para Revenda<BR>01 - Matéria Prima<BR>02 - Embalagem<BR>03 - Produto em Processo<BR>04 - Produto Acabado<BR>05 - Subproduto<BR>06 - Produto Intermediário<BR>07 - Material de Uso e Consumo<BR>08 - Ativo Imobilizado<BR>09 - Serviços<BR>10 - Outros Insumos<BR>99 - Outras
 * @pw_element recomendacoes_fiscais $recomendacoes_fiscais Recomendações Fiscais.
 * @pw_element decimal $peso_liq Peso Líquido (Kg).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element decimal $peso_bruto Peso Bruto (Kg).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element decimal $altura Altura (centimentos).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element decimal $largura Largura (centimetros)<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element decimal $profundidade Profundidade (centimetros).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element string $marca Marca.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element string $modelo Modelo.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element integer $dias_garantia Dias de Garantia.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element integer $dias_crossdocking Dias de Crossdocking.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
 * @pw_element string $descr_detalhada Descrição Detalhada para o Produto.<BR><BR>Preenchimento Opcional.
 * @pw_element string $obs_internas Observações Internas.<BR>(ficam registradas apenas no cadastro do produto).<BR><BR>Preenchimento Opcional.
 * @pw_element imagensArray $imagens Lista de imagens do produto.
 * @pw_element videosArray $videos Lista de videos do produto.
 * @pw_element caracteristicasArray $caracteristicas lista de caracteristicas do produto.
 * @pw_element tabelas_precoArray $tabelas_preco Lista de tabelas de preço.
 * @pw_element info $info Informações complemetares do cadastro do produto.
 * @pw_element string $exibir_descricao_nfe Indica se a Descrição Detalhada deve ser exibida nas Informações Adicionais do Item da NF-e (S/N).
 * @pw_element string $exibir_descricao_pedido Indica se a Descrição Detalhada deve ser exibida na impressão do Pedido (S/N).
 * @pw_element medicamento $medicamento Detalhamento específico para cadastro de medicamentos<BR><BR>Obrigatório o preenchimento no caso de medicamentos e produtos farmacêuticos
 * @pw_element combustivel $combustivel Detalhamento específico para cadastro de combustíveis.<BR>
 * @pw_element veiculo $veiculo Detalhamento específico para cadastro de veículos<BR>
 * @pw_element armamento $armamento Detalhamento especifco para cadastro de armamentos.<BR><BR>Descrição completa da arma, de modo a permitir sua perfeita identificação.
 * @pw_element string $cst_icms Código da Situação Tributária do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element string $modalidade_icms Modalidade da Base de Cálculo do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element string $csosn_icms Código da Situação Tributária para Simples Nacional.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $aliquota_icms Alíquota de ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $red_base_icms Percentual de redução de base do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element string $motivo_deson_icms Motivo da desoneração do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $per_icms_fcp Percentual do Fundo de Combate a Pobreza do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element string $codigo_beneficio Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
 * @pw_element string $cst_pis Código da Situação Tributária do PIS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $aliquota_pis Alíquota do PIS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $red_base_pis Percentual de redução de base do PIS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element string $cst_cofins Código da Situação Tributária do COFINS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $aliquota_cofins Alíquota do COFINS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element decimal $red_base_cofins Percentual de redução de base do COFINS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element string $cfop CFOP do Produto.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
 * @pw_element dadosIbpt $dadosIbpt Dados do IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $codInt_familia Código de Integração da Familia do Produto.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $descricao_familia Descrição da Familia do Produto.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
 * @pw_element string $bloqueado Indica se o registro está bloqueado (S/N).<BR><BR>Preenchimento Opcional.
 * @pw_element string $bloquear_exclusao Indica se a exclusão do registro está bloqueada (S/N).<BR><BR>Preenchimento Opcional.
 * @pw_element string $importado_api Indica se o registro foi incluído via API (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $inativo Indica se o cadastro do produto está inativo (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element componentes_kitArray $componentes_kit Componetes do KIT.
 * @pw_element integer $lead_time Lead Time médio de ressuprimento em dias.
 * @pw_element decimal $aliquota_ibpt DEPRECATED.
 * @pw_element string $cest DEPRECATED.
 * @pw_element decimal $quantidade_estoque DEPRECATED.
 * @pw_element decimal $estoque_minimo DEPRECATED.
 * @pw_element string $origem_imposto Origem do Imposto<BR><BR>'NCM' ou 'PRD'<BR><BR>Esse campo não deve ser informado na inclusão ou alteração.<BR><BR>Finalidade: Indicar se a regra de imposto utilizada pelos PDV's foi originada de uma configuração pelo NCM ou por uma configuração específica para o produto.
 * @pw_complex produto_servico_cadastro
 */
class produto_servico_cadastro{
	/**
	 * Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Descrição do produto.<BR><BR>Preenchimento Obrigatório na inclusão.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Código da Unidade.<BR><BR>Preenchimento Obrigatório.
	 *
	 * @var string
	 */
	public $unidade;
	/**
	 * Código da Nomenclatura Comum do Mercosul (NCM).<BR><BR>Preenchimento Obrigatório na Inclusão.
	 *
	 * @var string
	 */
	public $ncm;
	/**
	 * Código EAN (GTIN - Global Trade Item Number).<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $ean;
	/**
	 * Preço Unitário de Venda.<BR><BR>Preenchimento Obrigatório.
	 *
	 * @var decimal
	 */
	public $valor_unitario;
	/**
	 * Código da Familia do Produto.<BR><BR>Preenchimento Opcional.
	 *
	 * @var integer
	 */
	public $codigo_familia;
	/**
	 * Código do Tipo do Item para o SPED.<BR><BR>Preenchimento Opcional.<BR><BR>Pode ser:<BR><BR>00 - Mercadoria para Revenda<BR>01 - Matéria Prima<BR>02 - Embalagem<BR>03 - Produto em Processo<BR>04 - Produto Acabado<BR>05 - Subproduto<BR>06 - Produto Intermediário<BR>07 - Material de Uso e Consumo<BR>08 - Ativo Imobilizado<BR>09 - Serviços<BR>10 - Outros Insumos<BR>99 - Outras
	 *
	 * @var string
	 */
	public $tipoItem;
	/**
	 * Recomendações Fiscais.
	 *
	 * @var recomendacoes_fiscais
	 */
	public $recomendacoes_fiscais;
	/**
	 * Peso Líquido (Kg).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var decimal
	 */
	public $peso_liq;
	/**
	 * Peso Bruto (Kg).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var decimal
	 */
	public $peso_bruto;
	/**
	 * Altura (centimentos).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var decimal
	 */
	public $altura;
	/**
	 * Largura (centimetros)<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var decimal
	 */
	public $largura;
	/**
	 * Profundidade (centimetros).<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var decimal
	 */
	public $profundidade;
	/**
	 * Marca.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var string
	 */
	public $marca;
	/**
	 * Modelo.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var string
	 */
	public $modelo;
	/**
	 * Dias de Garantia.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var integer
	 */
	public $dias_garantia;
	/**
	 * Dias de Crossdocking.<BR><BR>Preenchimento Opcional.<BR><BR>Localizado na aba "Informações Adicionais"
	 *
	 * @var integer
	 */
	public $dias_crossdocking;
	/**
	 * Descrição Detalhada para o Produto.<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $descr_detalhada;
	/**
	 * Observações Internas.<BR>(ficam registradas apenas no cadastro do produto).<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $obs_internas;
	/**
	 * Lista de imagens do produto.
	 *
	 * @var imagensArray
	 */
	public $imagens;
	/**
	 * Lista de videos do produto.
	 *
	 * @var videosArray
	 */
	public $videos;
	/**
	 * lista de caracteristicas do produto.
	 *
	 * @var caracteristicasArray
	 */
	public $caracteristicas;
	/**
	 * Lista de tabelas de preço.
	 *
	 * @var tabelas_precoArray
	 */
	public $tabelas_preco;
	/**
	 * Informações complemetares do cadastro do produto.
	 *
	 * @var info
	 */
	public $info;
	/**
	 * Indica se a Descrição Detalhada deve ser exibida nas Informações Adicionais do Item da NF-e (S/N).
	 *
	 * @var string
	 */
	public $exibir_descricao_nfe;
	/**
	 * Indica se a Descrição Detalhada deve ser exibida na impressão do Pedido (S/N).
	 *
	 * @var string
	 */
	public $exibir_descricao_pedido;
	/**
	 * Detalhamento específico para cadastro de medicamentos<BR><BR>Obrigatório o preenchimento no caso de medicamentos e produtos farmacêuticos
	 *
	 * @var medicamento
	 */
	public $medicamento;
	/**
	 * Detalhamento específico para cadastro de combustíveis.<BR>
	 *
	 * @var combustivel
	 */
	public $combustivel;
	/**
	 * Detalhamento específico para cadastro de veículos<BR>
	 *
	 * @var veiculo
	 */
	public $veiculo;
	/**
	 * Detalhamento especifco para cadastro de armamentos.<BR><BR>Descrição completa da arma, de modo a permitir sua perfeita identificação.
	 *
	 * @var armamento
	 */
	public $armamento;
	/**
	 * Código da Situação Tributária do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $cst_icms;
	/**
	 * Modalidade da Base de Cálculo do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $modalidade_icms;
	/**
	 * Código da Situação Tributária para Simples Nacional.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $csosn_icms;
	/**
	 * Alíquota de ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $aliquota_icms;
	/**
	 * Percentual de redução de base do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $red_base_icms;
	/**
	 * Motivo da desoneração do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $motivo_deson_icms;
	/**
	 * Percentual do Fundo de Combate a Pobreza do ICMS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $per_icms_fcp;
	/**
	 * Código de integração da característica do produto.<BR>(Interno, utilizado apenas na Integração via API, não aparece na tela).<BR>Utilize esse campo para informar o código da característica utilizado no seu aplicativo quando incluir uma característica no Omie. <BR>Assim, poderá utilizar esse campo para resgatar as informações da característica desejada.<BR>Caso informe esse campo, não informe a tag nCodCaract. Caso isso aconteça, o conteúdo dessa tag será desconsiderada.<BR>
	 *
	 * @var string
	 */
	public $codigo_beneficio;
	/**
	 * Código da Situação Tributária do PIS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $cst_pis;
	/**
	 * Alíquota do PIS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $aliquota_pis;
	/**
	 * Percentual de redução de base do PIS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $red_base_pis;
	/**
	 * Código da Situação Tributária do COFINS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $cst_cofins;
	/**
	 * Alíquota do COFINS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $aliquota_cofins;
	/**
	 * Percentual de redução de base do COFINS.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var decimal
	 */
	public $red_base_cofins;
	/**
	 * CFOP do Produto.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.<BR>Utiliza o Cenário de Impostos Padrão.
	 *
	 * @var string
	 */
	public $cfop;
	/**
	 * Dados do IBPT.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var dadosIbpt
	 */
	public $dadosIbpt;
	/**
	 * Código de Integração da Familia do Produto.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $codInt_familia;
	/**
	 * Descrição da Familia do Produto.<BR><BR>Não deve ser informado na Inclusão/Alteração.<BR>Informação retornada apenas para consultas do PDV.
	 *
	 * @var string
	 */
	public $descricao_familia;
	/**
	 * Indica se o registro está bloqueado (S/N).<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $bloqueado;
	/**
	 * Indica se a exclusão do registro está bloqueada (S/N).<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $bloquear_exclusao;
	/**
	 * Indica se o registro foi incluído via API (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $importado_api;
	/**
	 * Indica se o cadastro do produto está inativo (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * Componetes do KIT.
	 *
	 * @var componentes_kitArray
	 */
	public $componentes_kit;
	/**
	 * Lead Time médio de ressuprimento em dias.
	 *
	 * @var integer
	 */
	public $lead_time;
	/**
	 * DEPRECATED.
	 *
	 * @var decimal
	 */
	public $aliquota_ibpt;
	/**
	 * DEPRECATED.
	 *
	 * @var string
	 */
	public $cest;
	/**
	 * DEPRECATED.
	 *
	 * @var decimal
	 */
	public $quantidade_estoque;
	/**
	 * DEPRECATED.
	 *
	 * @var decimal
	 */
	public $estoque_minimo;
	/**
	 * Origem do Imposto<BR><BR>'NCM' ou 'PRD'<BR><BR>Esse campo não deve ser informado na inclusão ou alteração.<BR><BR>Finalidade: Indicar se a regra de imposto utilizada pelos PDV's foi originada de uma configuração pelo NCM ou por uma configuração específica para o produto.
	 *
	 * @var string
	 */
	public $origem_imposto;
}


/**
 * Recomendações Fiscais.
 *
 * @pw_element string $origem_mercadoria Origem da Mercadoria.<BR><BR>Preenchimento Opcional.<BR><BR>Pode ser:<BR>0 - Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8<BR>1 - Estrangeira - Importação direta, exceto a indicada no código 6<BR>2 - Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7<BR>3 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% e inferior ou igual a 70<BR>4 - Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes<BR>5 - Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40<BR>6 - Estrangeira - Importação direta, sem similar nacional, constante em lista da CAMEX e gás natural<BR>7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista da CAMEX e gás natural<BR>8 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70<BR>
 * @pw_element integer $id_preco_tabelado ID do Preço tabelado (Pauta).<BR><BR>Preenchimento Opcional.
 * @pw_element string $id_cest Código do CEST.<BR>(Código Especificador da Substituíção Tributária).<BR><BR>Preenchimento Opcional.<BR><BR>Formato: 99.999.99
 * @pw_element string $cupom_fiscal Indica se o produto é comercializado via PDV.<BR><BR>Através de emissão de Cupom Fiscal ECF, SAT ou NFC-e.<BR><BR>Preenchimento opcional.<BR><BR>Preencher com 'S' ou 'N'.
 * @pw_element string $market_place Indica se o produto será comercializado via Market Place ou e-commerce (S/N)<BR><BR>Preenchimento opcional.<BR><BR>Preencher com 'S' ou 'N'.
 * @pw_element string $indicador_escala Indicador de Produção em Escala Relevante.<BR><BR>Pode ser:<BR>"S" para Produzido em Escala Relevante.<BR>"N" para Produzido em Escala NÃO Relevante.
 * @pw_element string $cnpj_fabricante CNPJ do Fabricante da Mercadoria.<BR><BR>Preenchimento opcional.
 * @pw_complex recomendacoes_fiscais
 */
class recomendacoes_fiscais{
	/**
	 * Origem da Mercadoria.<BR><BR>Preenchimento Opcional.<BR><BR>Pode ser:<BR>0 - Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8<BR>1 - Estrangeira - Importação direta, exceto a indicada no código 6<BR>2 - Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7<BR>3 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% e inferior ou igual a 70<BR>4 - Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam as legislações citadas nos Ajustes<BR>5 - Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40<BR>6 - Estrangeira - Importação direta, sem similar nacional, constante em lista da CAMEX e gás natural<BR>7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista da CAMEX e gás natural<BR>8 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70<BR>
	 *
	 * @var string
	 */
	public $origem_mercadoria;
	/**
	 * ID do Preço tabelado (Pauta).<BR><BR>Preenchimento Opcional.
	 *
	 * @var integer
	 */
	public $id_preco_tabelado;
	/**
	 * Código do CEST.<BR>(Código Especificador da Substituíção Tributária).<BR><BR>Preenchimento Opcional.<BR><BR>Formato: 99.999.99
	 *
	 * @var string
	 */
	public $id_cest;
	/**
	 * Indica se o produto é comercializado via PDV.<BR><BR>Através de emissão de Cupom Fiscal ECF, SAT ou NFC-e.<BR><BR>Preenchimento opcional.<BR><BR>Preencher com 'S' ou 'N'.
	 *
	 * @var string
	 */
	public $cupom_fiscal;
	/**
	 * Indica se o produto será comercializado via Market Place ou e-commerce (S/N)<BR><BR>Preenchimento opcional.<BR><BR>Preencher com 'S' ou 'N'.
	 *
	 * @var string
	 */
	public $market_place;
	/**
	 * Indicador de Produção em Escala Relevante.<BR><BR>Pode ser:<BR>"S" para Produzido em Escala Relevante.<BR>"N" para Produzido em Escala NÃO Relevante.
	 *
	 * @var string
	 */
	public $indicador_escala;
	/**
	 * CNPJ do Fabricante da Mercadoria.<BR><BR>Preenchimento opcional.
	 *
	 * @var string
	 */
	public $cnpj_fabricante;
}

/**
 * Lista de videos do produto.
 *
 * @pw_element string $url_video URL do Video do produto.
 * @pw_complex videos
 */
class videos{
	/**
	 * URL do Video do produto.
	 *
	 * @var string
	 */
	public $url_video;
}


/**
 * Lista de tabelas de preço.
 *
 * @pw_element integer $nCodTabPreco Id da tabela de preço.
 * @pw_element string $cNomeTabPreco Nome da tabela de preço.
 * @pw_element decimal $nValorTabPreco Valor do produto na tabela de preço.
 * @pw_complex tabelas_preco
 */
class tabelas_preco{
	/**
	 * Id da tabela de preço.
	 *
	 * @var integer
	 */
	public $nCodTabPreco;
	/**
	 * Nome da tabela de preço.
	 *
	 * @var string
	 */
	public $cNomeTabPreco;
	/**
	 * Valor do produto na tabela de preço.
	 *
	 * @var decimal
	 */
	public $nValorTabPreco;
}


/**
 * Detalhamento específico para cadastro de veículos
 *
 * @pw_element string $ano_fabr Veículos - Ano de Fabricação
 * @pw_element string $ano_modelo Ano modelo de fabricação
 * @pw_element string $chassi Chassi do veículo
 * @pw_element string $cilin Cilindradas
 * @pw_element string $cmt Capacidade máxima de tração
 * @pw_element string $cond_veic Condição do veículo
 * @pw_element string $cod_cor_veic Código da cor do veículo
 * @pw_element string $cod_cor_den Código da cor DENATRAN
 * @pw_element string $descr_cor Descrição da cor
 * @pw_element string $dist_eixo Distância entre eixos
 * @pw_element string $especie_veic Espécie do veículo
 * @pw_element string $lota_max Capacidade máxima de lotação
 * @pw_element string $cod_modelo Código marca modelo
 * @pw_element string $motor Número do motor
 * @pw_element string $peso_bruto_veic Peso bruto
 * @pw_element string $peso_liquido_veic Peso líquido
 * @pw_element string $potencia Potência motor
 * @pw_element string $serie_veic Série do veículo
 * @pw_element string $tipo_comb Tipo de combustível
 * @pw_element string $tipo_oper Tipo da operação
 * @pw_element string $tipo_pintura Tipo de pintura
 * @pw_element string $tipo_restricao Restrição
 * @pw_element string $tipo_veic Tipo de veículo de acordo com a tabela RENAVAM
 * @pw_element string $cond_vin Condição do VIN
 * @pw_complex veiculo
 */
class veiculo{
	/**
	 * Veículos - Ano de Fabricação
	 *
	 * @var string
	 */
	public $ano_fabr;
	/**
	 * Ano modelo de fabricação
	 *
	 * @var string
	 */
	public $ano_modelo;
	/**
	 * Chassi do veículo
	 *
	 * @var string
	 */
	public $chassi;
	/**
	 * Cilindradas
	 *
	 * @var string
	 */
	public $cilin;
	/**
	 * Capacidade máxima de tração
	 *
	 * @var string
	 */
	public $cmt;
	/**
	 * Condição do veículo
	 *
	 * @var string
	 */
	public $cond_veic;
	/**
	 * Código da cor do veículo
	 *
	 * @var string
	 */
	public $cod_cor_veic;
	/**
	 * Código da cor DENATRAN
	 *
	 * @var string
	 */
	public $cod_cor_den;
	/**
	 * Descrição da cor
	 *
	 * @var string
	 */
	public $descr_cor;
	/**
	 * Distância entre eixos
	 *
	 * @var string
	 */
	public $dist_eixo;
	/**
	 * Espécie do veículo
	 *
	 * @var string
	 */
	public $especie_veic;
	/**
	 * Capacidade máxima de lotação
	 *
	 * @var string
	 */
	public $lota_max;
	/**
	 * Código marca modelo
	 *
	 * @var string
	 */
	public $cod_modelo;
	/**
	 * Número do motor
	 *
	 * @var string
	 */
	public $motor;
	/**
	 * Peso bruto
	 *
	 * @var string
	 */
	public $peso_bruto_veic;
	/**
	 * Peso líquido
	 *
	 * @var string
	 */
	public $peso_liquido_veic;
	/**
	 * Potência motor
	 *
	 * @var string
	 */
	public $potencia;
	/**
	 * Série do veículo
	 *
	 * @var string
	 */
	public $serie_veic;
	/**
	 * Tipo de combustível
	 *
	 * @var string
	 */
	public $tipo_comb;
	/**
	 * Tipo da operação
	 *
	 * @var string
	 */
	public $tipo_oper;
	/**
	 * Tipo de pintura
	 *
	 * @var string
	 */
	public $tipo_pintura;
	/**
	 * Restrição
	 *
	 * @var string
	 */
	public $tipo_restricao;
	/**
	 * Tipo de veículo de acordo com a tabela RENAVAM
	 *
	 * @var string
	 */
	public $tipo_veic;
	/**
	 * Condição do VIN
	 *
	 * @var string
	 */
	public $cond_vin;
}

/**
 * Pesquisa de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
 * @pw_complex produto_servico_cadastro_chave
 */
class produto_servico_cadastro_chave{
	/**
	 * Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
	 *
	 * @var string
	 */
	public $codigo;
}

/**
 * Lista os produtos cadastrados
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API.<BR><BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $filtrar_por_data_de Filtrar os registros a partir de uma data.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "dd/mm/aaaa"
 * @pw_element string $filtrar_por_hora_de Filtrar a partir da hora.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "hh:mm:ss"
 * @pw_element string $filtrar_por_data_ate Filtrar os registros até uma data.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "dd/mm/aaaa"
 * @pw_element string $filtrar_por_hora_ate Filtrar até a hora.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "hh:mm:ss"
 * @pw_element string $filtrar_apenas_inclusao Filtrar apenas os registros incluídos (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $filtrar_apenas_alteracao Filtrar apenas os registros alterados (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $filtrar_apenas_omiepdv Filtrar apenas produtos marcados para venda via PDV.<BR><BR>ATENÇÃO:<BR>Todos os PDVs integrados devem preencher esse campo com "S".<BR>O preenchimento desse campo é obrigatório e o seu padrão é "S".<BR>Quando preenchido como "S" filtra apenas o produtos que tenham configuração de impostos definidas para o PDV.<BR><BR>Preenchimento Obrigatório.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $filtrar_apenas_familia Filtrar por ID da Familia de Produto.<BR><BR>Preenchimento Opcional.
 * @pw_element string $filtrar_apenas_tipo Código do Tipo do Item para o SPED.<BR><BR>Preenchimento Opcional.<BR><BR>Pode ser:<BR><BR>00 - Mercadoria para Revenda<BR>01 - Matéria Prima<BR>02 - Embalagem<BR>03 - Produto em Processo<BR>04 - Produto Acabado<BR>05 - Subproduto<BR>06 - Produto Intermediário<BR>07 - Material de Uso e Consumo<BR>08 - Ativo Imobilizado<BR>09 - Serviços<BR>10 - Outros Insumos<BR>99 - Outras
 * @pw_element string $filtrar_apenas_descricao Filtro pela descrição do produto.<BR><BR>Preenchimento Opcional.<BR><BR>Para filtrar utilize:<BR><BR>"TEXTO" - Para pesquisa exata.<BR>"TEXTO%" - Para pesquisa começando com.<BR>"%TEXTO" - Para pesquisa terminando com.<BR>"%TEXTO%" - Para pesquisa contendo.
 * @pw_element string $filtrar_apenas_marketplace Filtrar apenas produtos marcados para venda via Market Place ou e-Commerce.<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $filtrar_apenas_pdv Filtrar apenas produtos marcados para venda via Ponto de Venda (PDV).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $exibir_caracteristicas Exibir as características do produto (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $exibir_tabelas_preco Exibir as tabelas de preço do produto (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element caracteristicasArray $caracteristicas lista de caracteristicas do produto.
 * @pw_element produtosPorCodigoArray $produtosPorCodigo Filtro por código do produto.<BR><BR>Preenchimento Opcional.
 * @pw_element string $inativo Indica se o cadastro do produto está inativo (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
 * @pw_element string $ncm Código da Nomenclatura Comum do Mercosul (NCM).<BR><BR>Preenchimento Obrigatório na Inclusão.
 * @pw_element string $ean Código EAN (GTIN - Global Trade Item Number).<BR><BR>Preenchimento Opcional.
 * @pw_element string $ordem_descrescente DEPRECATED.
 * @pw_element string $exibir_obs Exibir as observações do produto (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_element string $exibir_kit Exibir os componentes do KIT (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
 * @pw_complex produto_servico_list_request
 */
class produto_servico_list_request{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API.<BR><BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordem de exibição dos dados. Padrão: Código.
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Se a lista será apresentada em ordem decrescente (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $ordem_decrescente;
	/**
	 * Filtrar os registros a partir de uma data.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "dd/mm/aaaa"
	 *
	 * @var string
	 */
	public $filtrar_por_data_de;
	/**
	 * Filtrar a partir da hora.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "hh:mm:ss"
	 *
	 * @var string
	 */
	public $filtrar_por_hora_de;
	/**
	 * Filtrar os registros até uma data.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "dd/mm/aaaa"
	 *
	 * @var string
	 */
	public $filtrar_por_data_ate;
	/**
	 * Filtrar até a hora.<BR><BR>Preenchimento Opcional.<BR><BR>Formato: "hh:mm:ss"
	 *
	 * @var string
	 */
	public $filtrar_por_hora_ate;
	/**
	 * Filtrar apenas os registros incluídos (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $filtrar_apenas_inclusao;
	/**
	 * Filtrar apenas os registros alterados (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $filtrar_apenas_alteracao;
	/**
	 * Filtrar apenas produtos marcados para venda via PDV.<BR><BR>ATENÇÃO:<BR>Todos os PDVs integrados devem preencher esse campo com "S".<BR>O preenchimento desse campo é obrigatório e o seu padrão é "S".<BR>Quando preenchido como "S" filtra apenas o produtos que tenham configuração de impostos definidas para o PDV.<BR><BR>Preenchimento Obrigatório.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $filtrar_apenas_omiepdv;
	/**
	 * Filtrar por ID da Familia de Produto.<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $filtrar_apenas_familia;
	/**
	 * Código do Tipo do Item para o SPED.<BR><BR>Preenchimento Opcional.<BR><BR>Pode ser:<BR><BR>00 - Mercadoria para Revenda<BR>01 - Matéria Prima<BR>02 - Embalagem<BR>03 - Produto em Processo<BR>04 - Produto Acabado<BR>05 - Subproduto<BR>06 - Produto Intermediário<BR>07 - Material de Uso e Consumo<BR>08 - Ativo Imobilizado<BR>09 - Serviços<BR>10 - Outros Insumos<BR>99 - Outras
	 *
	 * @var string
	 */
	public $filtrar_apenas_tipo;
	/**
	 * Filtro pela descrição do produto.<BR><BR>Preenchimento Opcional.<BR><BR>Para filtrar utilize:<BR><BR>"TEXTO" - Para pesquisa exata.<BR>"TEXTO%" - Para pesquisa começando com.<BR>"%TEXTO" - Para pesquisa terminando com.<BR>"%TEXTO%" - Para pesquisa contendo.
	 *
	 * @var string
	 */
	public $filtrar_apenas_descricao;
	/**
	 * Filtrar apenas produtos marcados para venda via Market Place ou e-Commerce.<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $filtrar_apenas_marketplace;
	/**
	 * Filtrar apenas produtos marcados para venda via Ponto de Venda (PDV).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $filtrar_apenas_pdv;
	/**
	 * Exibir as características do produto (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $exibir_caracteristicas;
	/**
	 * Exibir as tabelas de preço do produto (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $exibir_tabelas_preco;
	/**
	 * lista de caracteristicas do produto.
	 *
	 * @var caracteristicasArray
	 */
	public $caracteristicas;
	/**
	 * Filtro por código do produto.<BR><BR>Preenchimento Opcional.
	 *
	 * @var produtosPorCodigoArray
	 */
	public $produtosPorCodigo;
	/**
	 * Indica se o cadastro do produto está inativo (S/N).<BR><BR>Não deve ser informado na Inclusão/Alteração.
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * Código da Nomenclatura Comum do Mercosul (NCM).<BR><BR>Preenchimento Obrigatório na Inclusão.
	 *
	 * @var string
	 */
	public $ncm;
	/**
	 * Código EAN (GTIN - Global Trade Item Number).<BR><BR>Preenchimento Opcional.
	 *
	 * @var string
	 */
	public $ean;
	/**
	 * DEPRECATED.
	 *
	 * @var string
	 */
	public $ordem_descrescente;
	/**
	 * Exibir as observações do produto (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $exibir_obs;
	/**
	 * Exibir os componentes do KIT (S/N).<BR><BR>Preenchimento Opcional.<BR><BR>Preencher com "S" ou "N".
	 *
	 * @var string
	 */
	public $exibir_kit;
}

/**
 * Filtro por código do produto.
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
 * @pw_complex produtosPorCodigo
 */
class produtosPorCodigo{
	/**
	 * Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
	 *
	 * @var string
	 */
	public $codigo;
}


/**
 * Lista de produtos encontrados no omie.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element produto_servico_resumidoArray $produto_servico_resumido Cadastro reduzido de produtos
 * @pw_complex produto_servico_list_response
 */
class produto_servico_list_response{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número total de páginas
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * total de registros encontrados
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Cadastro reduzido de produtos
	 *
	 * @var produto_servico_resumidoArray
	 */
	public $produto_servico_resumido;
}

/**
 * Cadastro reduzido de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
 * @pw_element string $descricao Descrição do produto.<BR><BR>Preenchimento Obrigatório na inclusão.
 * @pw_element decimal $valor_unitario Preço Unitário de Venda.<BR><BR>Preenchimento Obrigatório.
 * @pw_complex produto_servico_resumido
 */
class produto_servico_resumido{
	/**
	 * Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
	/**
	 * Código do Produto.<BR><BR>É um código único que identifica o produto no Omie. Se você tem um código SKU (Stock Keeping Unit = Unidade de Manutenção de Estoque) é aqui que ele deve ser informado, pois é essa informação que será exibida na tela do Omie.<BR><BR>Não recomendamos que ele seja utilizado como chave para integração, pois pode ser modificado pelo usuário a qualquer momento. No lugar deste campo, utilize o ID do produto, que você encontra na tag "codigo_produto".
	 *
	 * @var string
	 */
	public $codigo;
	/**
	 * Descrição do produto.<BR><BR>Preenchimento Obrigatório na inclusão.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Preço Unitário de Venda.<BR><BR>Preenchimento Obrigatório.
	 *
	 * @var decimal
	 */
	public $valor_unitario;
}


/**
 * Lista completa de produtos encontrados no omie.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $total_de_paginas Número total de páginas
 * @pw_element integer $registros Número de registros retornados na página.
 * @pw_element integer $total_de_registros total de registros encontrados
 * @pw_element produto_servico_cadastroArray $produto_servico_cadastro Cadastro completo de produtos
 * @pw_complex produto_servico_listfull_response
 */
class produto_servico_listfull_response{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número total de páginas
	 *
	 * @var integer
	 */
	public $total_de_paginas;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros;
	/**
	 * total de registros encontrados
	 *
	 * @var integer
	 */
	public $total_de_registros;
	/**
	 * Cadastro completo de produtos
	 *
	 * @var produto_servico_cadastroArray
	 */
	public $produto_servico_cadastro;
}

/**
 * Importação em Lote de produtos
 *
 * @pw_element integer $lote Número do lote
 * @pw_element produto_servico_cadastroArray $produto_servico_cadastro Cadastro completo de produtos
 * @pw_complex produto_servico_lote_request
 */
class produto_servico_lote_request{
	/**
	 * Número do lote
	 *
	 * @var integer
	 */
	public $lote;
	/**
	 * Cadastro completo de produtos
	 *
	 * @var produto_servico_cadastroArray
	 */
	public $produto_servico_cadastro;
}

/**
 * Resposta do processamento do lote de produto importados.
 *
 * @pw_element integer $lote Número do lote
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex produto_servico_lote_response
 */
class produto_servico_lote_response{
	/**
	 * Número do lote
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
}

/**
 * Status de retorno do cadastro de produtos
 *
 * @pw_element integer $codigo_produto Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo_produto_integracao Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
 * @pw_element string $codigo_status Código do status do processamento.<BR>Se o retorno for '0' significa que a solicitação foi executada com sucesso.<BR>Se o retorno for maior que '0' ocorreu algum erro durante o processamento da solicitação.<BR>A tag 'cDesStatus' descreve o problema ocorrido.
 * @pw_element string $descricao_status Descrição do status do processamento.<BR>Essa tag explica o resultado da tag 'cCodigoStatus'.
 * @pw_complex produto_servico_status
 */
class produto_servico_status{
	/**
	 * Código do produto.<BR>É o ID do produto e será utilizado apenas nas APIs como chave principal para localizar um produto.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>Esse campo não deve ser informado na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var integer
	 */
	public $codigo_produto;
	/**
	 * Código de integração do produto.<BR>É o código do produto no aplicativo que você está integrando ao Omie.<BR>É utilizado basicamente na Inclusão de Produtos via API, para evitar duplicidade de cadastros.<BR><BR>Quando um produto for incluído via API, você receberá um ID para esse novo produto. <BR>Recomendamos que você guarde essa informação no aplicativo que estiver integrando.<BR><BR>O preenchimento desse campo é obrigatório na inclusão de produtos. <BR><BR>Essa informação não será exibida nas telas do Omie.
	 *
	 * @var string
	 */
	public $codigo_produto_integracao;
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
 * Erro gerado pela aplicação.
 *
 * @pw_element integer $code Codigo do erro
 * @pw_element string $description Descricao do erro
 * @pw_element string $referer Origem do erro
 * @pw_element boolean $fatal Indica se eh um erro fatal
 * @pw_complex omie_fail
 */
if (!class_exists('omie_fail')) {
class omie_fail{
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