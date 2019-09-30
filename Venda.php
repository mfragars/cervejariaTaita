<?php
    class Venda{
        public $id;
        public $nomeProduto;
        public $nomeCliente;
        public $dataVenda;
        public $quantidade;
        public $valorUnitario;
        public $valorTotal;

        function __construct($id, $nomeProduto, $nomeCliente, $dataVenda, $quantidade, $valorUnitario, $valorTotal){
            $this->id = $id;
            $this->nomeProduto = $nomeProduto;
            $this->nomeCliente = $nomeCliente;
            $this->dataVenda = $dataVenda;
            $this->quantidade = $quantidade;
            $this->valorUnitario = $valorUnitario;
            $this->valorTotal = $valorTotal;
        }

        function getId(){
            return $this->id;
        }

        function getNomeProduto(){
            return $this->nomeProduto;
        }

        function getNomeCliente(){
            return $this->nomeCliente;
        }

        function getDataVenda(){
            return $this->dataVenda;
        }

        function getQuantidade(){
            return $this->quantidade;
        }

        function getValorUnitario(){
            return $this->valorUnitario;
        }

        function getValorTotal(){
            return $this->valorTotal;
        }

        function setNomeProduto(){
            $this->nomeProduto = $nomeProduto;
        }

        function setNomeCliente(){
            $this->nomeCliente = $nomeCliente;
        }

        function setDataVenda(){
            $this->dataVenda = $dataVenda;
        }

        function setQuantidade(){
            $this->quantidade = $quantidade;
        }

        function setValorUnitario(){
            $this->valorUnitario = $valorUnitario;
        }

        function setValorTotal(){
            $this->valorTotal = $valorTotal;
        }
    }

?>