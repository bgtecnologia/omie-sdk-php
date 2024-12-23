<?php
namespace OmieSdk;
/**
 * @service VendedoresCadastroJsonClient
 * @author omie
 */
class VendedoresCadastroJsonClient {
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
	public static $_WsdlUri='https://app.omie.com.br/api/v1/geral/vendedores/?WSDL';
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
	public static $_EndPoint='https://app.omie.com.br/api/v1/geral/vendedores/';

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
	 * Inclui um vendedor
	 *
	 * @param vendincluirRequest $vendincluirRequest Solicitação de Inclusão de um vendedor
	 * @return vendIncluirResponse Resposta da Solicitação de inclusão de um vendedor.
	 */
	public function IncluirVendedor($vendincluirRequest){
		return self::_Call('IncluirVendedor',Array(
			$vendincluirRequest
		));
	}

	/**
	 * Altera os dados de um vendedor
	 *
	 * @param vendAlterarRequest $vendAlterarRequest Solicitação de Alteração de um vendedor
	 * @return vendAlterarResponse Resposta da Solicitação de alteração de um vendedor.
	 */
	public function AlterarVendedor($vendAlterarRequest){
		return self::_Call('AlterarVendedor',Array(
			$vendAlterarRequest
		));
	}

	/**
	 * Inclui / Altera um vendedor
	 *
	 * @param vendUpsertRequest $vendUpsertRequest Solicitação de Inclusão/Alteração de um vendedor
	 * @return vendUpsertResponse Resposta da Solicitação de inclusão/alteração de um vendedor.
	 */
	public function UpsertVendedor($vendUpsertRequest){
		return self::_Call('UpsertVendedor',Array(
			$vendUpsertRequest
		));
	}

	/**
	 * Exclui um vendedor
	 *
	 * @param vendExcluirRequest $vendExcluirRequest Solicitação de Exclusão de um fornecedor.
	 * @return vendExcluirResponse Resposta da Solicitação de exclusão de um vendedor.
	 */
	public function ExcluirVendedor($vendExcluirRequest){
		return self::_Call('ExcluirVendedor',Array(
			$vendExcluirRequest
		));
	}

	/**
	 * Consulta os dados de um vendedor
	 *
	 * @param vendConsultarRequest $vendConsultarRequest Solicitação de Consulta de um Vendedor
	 * @return vendConsultarResponse Reposta da consulta de Vendedores
	 */
	public function ConsultarVendedor($vendConsultarRequest){
		return self::_Call('ConsultarVendedor',Array(
			$vendConsultarRequest
		));
	}

	/**
	 * Listagem de Vendedores
	 *
	 * @param vendListarRequest $vendListarRequest Solicitação de Listagem de Vendedores
	 * @return vendListarResponse Resposta da listagem de Vendedores
	 */
	public function ListarVendedores($vendListarRequest){
		return self::_Call('ListarVendedores',Array(
			$vendListarRequest
		));
	}
}

/**
 * Cadastro de Vendedores
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_element string $email E-mail do vendedor.
 * @pw_element string $fatura_pedido O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
 * @pw_element string $visualiza_pedido Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
 * @pw_element decimal $comissao Percentual de Comissão.
 * @pw_complex cadastro
 */
class cadastro{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * E-mail do vendedor.
	 *
	 * @var string
	 */
	public $email;
	/**
	 * O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
	 *
	 * @var string
	 */
	public $fatura_pedido;
	/**
	 * Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $visualiza_pedido;
	/**
	 * Percentual de Comissão.
	 *
	 * @var decimal
	 */
	public $comissao;
}


/**
 * Solicitação de Alteração de um vendedor
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_element string $email E-mail do vendedor.
 * @pw_element string $fatura_pedido O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
 * @pw_element string $visualiza_pedido Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
 * @pw_element decimal $comissao Percentual de Comissão.
 * @pw_complex vendAlterarRequest
 */
class vendAlterarRequest{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * E-mail do vendedor.
	 *
	 * @var string
	 */
	public $email;
	/**
	 * O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
	 *
	 * @var string
	 */
	public $fatura_pedido;
	/**
	 * Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $visualiza_pedido;
	/**
	 * Percentual de Comissão.
	 *
	 * @var decimal
	 */
	public $comissao;
}

/**
 * Resposta da Solicitação de alteração de um vendedor.
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendAlterarResponse
 */
class vendAlterarResponse{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
}

/**
 * Solicitação de Consulta de um Vendedor
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_complex vendConsultarRequest
 */
class vendConsultarRequest{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
}

/**
 * Reposta da consulta de Vendedores
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_element string $email E-mail do vendedor.
 * @pw_element string $fatura_pedido O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
 * @pw_element string $visualiza_pedido Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
 * @pw_element decimal $comissao Percentual de Comissão.
 * @pw_complex vendConsultarResponse
 */
class vendConsultarResponse{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * E-mail do vendedor.
	 *
	 * @var string
	 */
	public $email;
	/**
	 * O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
	 *
	 * @var string
	 */
	public $fatura_pedido;
	/**
	 * Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $visualiza_pedido;
	/**
	 * Percentual de Comissão.
	 *
	 * @var decimal
	 */
	public $comissao;
}

/**
 * Solicitação de Exclusão de um fornecedor.
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_complex vendExcluirRequest
 */
class vendExcluirRequest{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
}

/**
 * Resposta da Solicitação de exclusão de um vendedor.
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendExcluirResponse
 */
class vendExcluirResponse{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
}

/**
 * Solicitação de Inclusão de um vendedor
 *
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_element string $email E-mail do vendedor.
 * @pw_element string $fatura_pedido O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
 * @pw_element string $visualiza_pedido Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
 * @pw_element decimal $comissao Percentual de Comissão.
 * @pw_complex vendincluirRequest
 */
class vendincluirRequest{
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * E-mail do vendedor.
	 *
	 * @var string
	 */
	public $email;
	/**
	 * O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
	 *
	 * @var string
	 */
	public $fatura_pedido;
	/**
	 * Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $visualiza_pedido;
	/**
	 * Percentual de Comissão.
	 *
	 * @var decimal
	 */
	public $comissao;
}

/**
 * Resposta da Solicitação de inclusão de um vendedor.
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendIncluirResponse
 */
class vendIncluirResponse{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
}

/**
 * Solicitação de Listagem de Vendedores
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $registros_por_pagina Número de registros retornados
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordenar o resultado da página por:<BR><BR>CODIGO - Código do lançamento do Omie;<BR>INTEGRACAO - Código do lançamento interno do seu sistema;<BR>DATA_LANCAMENTO - Data do lançamento.
 * @pw_element string $ordem_descrescente Indica se a ordem de exibição é decrescente caso seja informado "S".
 * @pw_element string $filtrar_por_data_de Filtrar lançamentos incluídos e/ou alterados até a data
 * @pw_element string $filtrar_por_data_ate Filtrar lançamentos incluídos e/ou alterados até a data
 * @pw_element string $filtrar_apenas_inclusao Filtrar apenas registros incluídos (S/N)
 * @pw_element string $filtrar_apenas_alteracao Filtrar apenas registros alterados (S/N)
 * @pw_element string $filtrar_por_email Filtrar os vendedores por e-mail
 * @pw_complex vendListarRequest
 */
class vendListarRequest{
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
	 * Ordenar o resultado da página por:<BR><BR>CODIGO - Código do lançamento do Omie;<BR>INTEGRACAO - Código do lançamento interno do seu sistema;<BR>DATA_LANCAMENTO - Data do lançamento.
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
	 * Filtrar os vendedores por e-mail
	 *
	 * @var string
	 */
	public $filtrar_por_email;
}

/**
 * Resposta da listagem de Vendedores
 *
 * @pw_element integer $pagina Número da página que será listada.
 * @pw_element integer $total_de_paginas Total de páginas encontradas.
 * @pw_element integer $registros Número de registros retornados
 * @pw_element integer $total_de_registros Total de registros encontrados.
 * @pw_element cadastroArray $cadastro Cadastro de Vendedores
 * @pw_complex vendListarResponse
 */
class vendListarResponse{
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
	 * Cadastro de Vendedores
	 *
	 * @var cadastroArray
	 */
	public $cadastro;
}

/**
 * Solicitação de Inclusão/Alteração de um vendedor
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $nome Nome do Vendedor
 * @pw_element string $inativo Indica se o vendedor está inativo [S/N]
 * @pw_element string $email E-mail do vendedor.
 * @pw_element string $fatura_pedido O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
 * @pw_element string $visualiza_pedido Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
 * @pw_element decimal $comissao Percentual de Comissão.
 * @pw_complex vendUpsertRequest
 */
class vendUpsertRequest{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Nome do Vendedor
	 *
	 * @var string
	 */
	public $nome;
	/**
	 * Indica se o vendedor está inativo [S/N]
	 *
	 * @var string
	 */
	public $inativo;
	/**
	 * E-mail do vendedor.
	 *
	 * @var string
	 */
	public $email;
	/**
	 * O vendedor pode faturar um pedido?<BR><BR>Informe "S" ou "N".<BR><BR>
	 *
	 * @var string
	 */
	public $fatura_pedido;
	/**
	 * Visualiza apenas os pedidos em que é o vendedor.<BR><BR>Informar "S" ou "N".<BR>
	 *
	 * @var string
	 */
	public $visualiza_pedido;
	/**
	 * Percentual de Comissão.
	 *
	 * @var decimal
	 */
	public $comissao;
}

/**
 * Resposta da Solicitação de inclusão/alteração de um vendedor.
 *
 * @pw_element integer $codigo Código do Vendedor
 * @pw_element string $codInt Código de Integração do Vendedor
 * @pw_element string $status Status do processamento
 * @pw_element string $descricao Descrição do status
 * @pw_complex vendUpsertResponse
 */
class vendUpsertResponse{
	/**
	 * Código do Vendedor
	 *
	 * @var integer
	 */
	public $codigo;
	/**
	 * Código de Integração do Vendedor
	 *
	 * @var string
	 */
	public $codInt;
	/**
	 * Status do processamento
	 *
	 * @var string
	 */
	public $status;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $descricao;
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