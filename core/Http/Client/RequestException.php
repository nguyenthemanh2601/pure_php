<?php

namespace Core\Http\Client;

use Core\Http\Client\Concerns\Response;

class RequestException extends HttpClientException
{
    /**
     * The response instance.
     *
     * @var \Core\Http\Client\Response
     */
    public $response;

    /**
     * Create a new exception instance.
     *
     * @param  \Core\Http\Client\Concerns\Response  $response
     * @return void
     */
    public function __construct(Response $response)
    {
        parent::__construct($this->prepareMessage($response), $response->status());

        $this->response = $response;
    }

    /**
     * Prepare the exception message.
     *
     * @param  \Core\Http\Client\Concerns\Response  $response
     * @return string
     */
    protected function prepareMessage(Response $response)
    {
        $message = "HTTP request returned status code {$response->status()}";

        $summary = class_exists(\GuzzleHttp\Psr7\Message::class)
            ? \GuzzleHttp\Psr7\Message::bodySummary($response->toPsrResponse())
            : \GuzzleHttp\Psr7\get_message_body_summary($response->toPsrResponse());

        return is_null($summary) ? $message : $message .= ":\n{$summary}\n";
    }
}
