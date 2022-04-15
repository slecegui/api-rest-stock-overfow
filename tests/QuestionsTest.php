<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

require dirname(__DIR__).'/vendor/autoload.php';

class QuestionsTest extends WebTestCase
{

    protected $client;

    public function testGet_Questions_OK() {

        $this->client = new GuzzleHttp\Client([
                                                  'base_uri' => 'http://api-rest-stock-overflow_nginx_1'
                                              ]);

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTAwNjk1MzMsImV4cCI6MTY1MDEwNTUzMywicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluQGxvY2FsaG9zdC5jb20ifQ.YL3_0HOeFfVojWqtfVs-q_9OjZdFi_MbVfcSlZL90A6T1HdP1-XEE1ByuBtKuaFCx8CSQMUzBXF6I6Y-JGXCMxqIY7og4pkUwcbpLkoH-xuKSl4RDa4UcY7WLxDerk8Up_pLqfEm6U2-NQPxApPieUblgmSECPE8yJM_Y_qwzbPjmIpN4NkJ-o1xZpAHTaqmYNFOIvShKUVobucS1usUHIeYtmFMcX_t6QcHs9Rjpt3FqhvSHiDRDBuW9e9fmiV3b8h6EPbHpVl9u1OGz_LL1vCCfYPDgpJ58uqyNVVIVgNbY7-ROgM9K7cXtzENAB66TuyoQIUZ6N243uEOgHjyNg';
        $response = $this->client->get('/api/questions/getQuestionsByFilters?tagged=php;java&todate=2022-04-16&fromdate=2022-04-01',
                                       [ 'headers'=>[ 'Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json', ] ]);

        $this->assertEquals(200, $response->getStatusCode());

    }

}