<?php

    namespace App\Exceptions;

    class ApiMessages
    {
        private array $message = [];

        public function __construct(String $mensagemUsuario, String $erro)
        {
            $this->message['message'] = $mensagemUsuario;
            $this->message['erros'] = $erro;
        }

        public function getMessage(): array
        {
            return $this->message;
        }
    }