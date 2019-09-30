<?php
    class Cliente{
        public $id;
        public $nome;
        public $tipoDocumento;
        public $numeroDocumento;
        public $statusCliente;

        function __construct($id, $nome, $tipoDocumento, $numeroDocumento, $statusCliente){
            $this->id = $id;
            $this->nome = $nome;
            $this->tipoDocumento = $tipoDocumento;
            $this->numeroDocumento = $numeroDocumento;
            $this->statusCliente = $statusCliente;
        }

        function getId(){
            return $this->id;
        }

        function getNome(){
            return $this->nome;
        }

        function getTipoDocumento(){
            return $this->tipoDcumento;
        }

        function getNumeroDocumento(){
            return $this->numeroDocumento;
        }

        function getStatusClient(){
            return $this->statusCliente;
        }

        function setNome(){
            $this->nome = $nome;
        }

        function setTipoDocumento(){
            $this->tipoDocumento = $tipoDocumento;
        }

        function setNumeroDocumento(){
            $this->numeroDocumento = $numeroDocumento;
        }

        function setStatusCliente(){
            $this->statusCliente = $statusCliente;
        }
    }

?>