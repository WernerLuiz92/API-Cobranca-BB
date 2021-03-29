<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class APIController extends Controller
{
    public function token()
    {
        try {
            /* Cria um objeto Client */
            $guzzle = new Client([
                'headers' => [
                    'gw-dev-app-key' => config('apiCobranca.gw_dev_app_key'),
                    'Authorization' => config('apiCobranca.authorization'),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                /* Desativa SSL */
                'verify' => false,
            ]);

            /* Cria uma Requisição POST */
            $response = $guzzle->request(
                'POST',
                'https://oauth.sandbox.bb.com.br/oauth/token?gw_dev_app_key='.config('apiCobranca.gw_dev_app_key'),
                [
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                        'client_id' => config('apiCobranca.client_id'),
                        'client_secret' => config('apiCobranca.client_secret'),
                        'scope' => 'cobrancas.boletos-info cobrancas.boletos-requisicao',
                    ],
                ]
            );

            /* Recupera o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar os dados da resposta - JSON */
            $contents = $body->getContents();

            /* Converter o JSON em um array associativo PHP */
            $token = json_decode($contents);

            return $token->access_token;
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function register()
    {
        /* Informações do boleto */
        $body = [
            'numeroConvenio' => 3128557,
            'numeroCarteira' => 17,
            'numeroVariacaoCarteira' => 35,
            'codigoModalidade' => 1,
            'dataEmissao' => '29.03.2021',
            'dataVencimento' => '31.03.2021',
            'valorOriginal' => 123.45,
            'valorAbatimento' => 0,
            'quantidadeDiasProtesto' => 0,
            'indicadorAceiteTituloVencido' => 'N',
            'numeroDiasLimiteRecebimento' => 0,
            'codigoAceite' => 'A',
            'codigoTipoTitulo' => 4,
            'descricaoTipoTitulo' => 'DUPLICATA DE SERVICO',
            'indicadorPermissaoRecebimentoParcial' => 'N',
            'numeroTituloBeneficiario' => '000102',
            'campoUtilizacaoBeneficiario' => 'TESTE',
            'numeroTituloCliente' => '00031285579999990004',
            'mensagemBloquetoOcorrencia' => 'TESTE',
            'pagador' => [
                'tipoInscricao' => 1,
                'numeroInscricao' => 96050176876,
                'nome' => 'ALERIO DE AGUIAR ZORZATO',
                'endereco' => 'Avenida Dias Gomes 1970',
                'cep' => 98700000,
                'cidade' => 'Ijuí',
                'bairro' => 'Centro',
                'uf' => 'RS',
                'telefone' => '55991234567',
            ],
        ];

        /* Converte array em Json */
        $body = json_encode($body);

        try {
            $guzzle = new Client([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token(),
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);

            /* Requisição */
            $response = $guzzle->request(
                'POST',
                'https://api.hm.bb.com.br/cobrancas/v2/boletos'
                .'?gw-dev-app-key='
                .config('apiCobranca.gw_dev_app_key'),
                [
                    'body' => $body,
                ]
            );

            /* Recuperar o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar os dados da resposta - JSON */
            $contents = $body->getContents();

            /* Converter o JSON em um array associativo PHP */
            $boleto = json_decode($contents);

            dd($boleto);
        } catch (ClientException $e) {
            echo $e->getMessage();
        }
    }

    public function listAll()
    {
        try {
            $guzzle = new Client([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token(),
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);

            /* Requisição */
            $response = $guzzle->request(
                'GET',
                'https://api.hm.bb.com.br/cobrancas/v2/boletos?gw-dev-app-key='
                .config('apiCobranca.gw_dev_app_key')
                .'&agenciaBeneficiario='.'452'
                .'&contaBeneficiario='.'123873'
                .'&indicadorSituacao='.'A'
                .'&dataInicioRegistro='.'29.03.2021'
                .'&dataFimRegistro='.'29.03.2021'
                .'&dataInicioVencimento='.'31.03.2021'
                .'&dataFimVencimento='.'31.03.2021'
            );

            /* Recuperar o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar os dados da resposta - JSON */
            $contents = $body->getContents();

            /* Converter o JSON em um array associativo PHP */
            $boletos = json_decode($contents);

            dd($boletos);
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
        }
    }

    public function findOne()
    {
        $id = '00031285579999990004';

        try {
            $guzzle = new Client([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token(),
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);

            /* Requisição */
            $response = $guzzle->request(
                'GET',
                'https://api.hm.bb.com.br/cobrancas/v2/boletos/'
                .$id
                .'?gw-dev-app-key='.config('apiCobranca.gw_dev_app_key')
                .'&numeroConvenio='.'3128557'
            );

            /* Recuperar o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar os dados da resposta - JSON */
            $contents = $body->getContents();

            /* Converter o JSON em um array associativo PHP */
            $boleto = json_decode($contents);

            dd($boleto);
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
        }
    }

    public function update()
    {
        $id = '00031285579999990004';

        /* Dados a serem alterados */
        $body = [
            'numeroConvenio' => 3128557,
            'indicadorNovaDataVencimento' => 'S',
            'alteracaoData' => [
                'novaDataVencimento' => '05.04.2021',
            ],
        ];

        /* Converte array em Json */
        $body = json_encode($body);

        try {
            $guzzle = new Client([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token(),
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);

            /* Requisição */
            $response = $guzzle->request(
                'PATCH',
                'https://api.hm.bb.com.br/cobrancas/v2/boletos/'
                .$id
                .'?gw-dev-app-key='
                .config('apiCobranca.gw_dev_app_key'),
                [
                    'body' => $body,
                ]
            );

            /* Recuperar o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar os dados da resposta - JSON */
            $contents = $body->getContents();

            /* Converter o JSON em um array associativo PHP */
            $boleto = json_decode($contents);

            dd($boleto);
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
        }
    }

    public function terminate()
    {
        $id = '00031285579999990003';

        try {
            $guzzle = new Client([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token(),
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);

            /* Requisição */
            $response = $guzzle->request(
                'POST',
                'https://api.hm.bb.com.br/cobrancas/v2/boletos/'
                .$id
                .'/baixar'
                .'?gw-dev-app-key='.config('apiCobranca.gw_dev_app_key'),
                [
                    'body' => json_encode([
                        'numeroConvenio' => 3128557,
                    ]),
                ],
            );

            /* Recuperar o corpo da resposta da requisição */
            $body = $response->getBody();

            /* Acessar os dados da resposta - JSON */
            $contents = $body->getContents();

            /* Converter o JSON em um array associativo PHP */
            $boleto = json_decode($contents);

            dd($boleto);
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
        }
    }
}
