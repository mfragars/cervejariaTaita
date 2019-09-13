<?php
    class Produto{
        public $id;
        public $nome;
        public $tipo;
        public $envase;
        public $valorUnitario;
        public $dataEstoque;
        public $quantidade;

        function _construct($id, $nome, $tipo, $envase, $valorUnitario, $dataEstoque, $quantidade){
            $this->id = $id;
            $this->nome = $nome;
            $this->tipo = $tipo;
            $this->envase = $envase;
            $this->valorUnitario = $valorUnitario;
            $this->dataEstoque = $dataEstoque;
            $this->quantidade = $quantidade
        }

        function getId(){
            return $this->id;
        }

        function getNome(){
            return $this->nome;
        }

        function getTipo(){
            return $this->tipo;
        }

        function getEnvase(){
            return $this->envase;
        }

        function getValorUnitario(){
            return $this->valorUnitario;
        }

        function getDataEstoque(){
            return $this->dataEstoque;
        }

        function getQuantidade(){
            return $this->quantidade;
        }

        function setNome(){
            $this->nome = $nome;
        }

        function setTipo(){
            $this->tipo = $tipo;
        }

        function setEnvase(){
            $this->envase = $envase;
        }

        function setValorUnitario(){
            $this->valorUnitario = $valorUnitario;
        }

        function setDataEstoque(){
            $this->dataEstoque = $dataEstoque;
        }

        function setQuantidade(){
            $this->quantidade = $quantidade;
        }



    }



?>