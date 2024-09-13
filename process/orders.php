<?php

    include_once("conn.php");

    $method = $_SERVER["REQUEST_METHOD"];

    IF($method === "GET"){

        $pedidosQuery = $conn->query("SELECT * FROM pedidos;");

        $pedidos = $pedidosQuery->fetchAll();

        $softwares =[];

        // Montando o software
        foreach($pedidos as $pedido){

            $software = [];

            // Definindo um array para o software
            $software["id"] = $pedido["software_id"];

            // Resgatadando o software
            $softwareQuery = $conn->prepare("SELECT * FROM software WHERE id = :software_id");

            $softwareQuery->bindParam(":software_id", $pedido["software_id"]);

            $softwareQuery->execute();

            $softwareData = $softwareQuery->fetch(PDO::FETCH_ASSOC);

            //Resgatando o investimento do software
            $investimentoQuery = $conn->prepare("SELECT * FROM investimento WHERE id = :investimento_id");

            $investimentoQuery->bindParam(":investimento_id", $softwareData["investimento_id"]);

            $investimentoQuery->execute();

            $investimento = $investimentoQuery->fetch(PDO::FETCH_ASSOC);

            $software["investimento"] = $investimento["tipo"];

            //Resgatando o tipo do software
            $tipoQuery = $conn->prepare("SELECT * FROM tipo WHERE id = :tipo_id");

            $tipoQuery->bindParam(":tipo_id", $softwareData["tipo_id"]);

            $tipoQuery->execute();

            $tipo = $tipoQuery->fetch(PDO::FETCH_ASSOC);

            $software["tipo"] = $tipo["tipo"];
            
            // Resgatando os pacotes extras do software

            $pacotes_extraQuery = $conn->prepare("SELECT * FROM software_pacotes WHERE software_id = :software_id");

            $pacotes_extraQuery->bindParam(":software_id", $software["id"]);

            $pacotes_extraQuery->execute();

            $pacotes_extra = $pacotes_extraQuery->fetchAll(PDO::FETCH_ASSOC);

            // Resgatando o nome dos pacotes extras
            $nomeDosPacotes = [];

            $pacoteQuery = $conn->prepare("SELECT * FROM pacotes_extra WHERE id = :pacotes_extra_id");

            foreach($pacotes_extra as $pacotes){

                $pacoteQuery->bindParam(":pacotes_extra_id", $pacotes["pacotes_extra_id"]);

                $pacoteQuery->execute();

                $pacoteSoftware = $pacoteQuery->fetch(PDO::FETCH_ASSOC);

                array_push($nomeDosPacotes, $pacoteSoftware["nome"]);

            }

            $software["pacotes_extra"] = $nomeDosPacotes;

            // Adcionando status do pedido
            $software["status"] = $pedido["status_id"];

            // Adcionar o array de software ao array dos softwares
            array_push($softwares, $software);
        }

            // Resgatando os status
            $statusQuery = $conn->query("SELECT * FROM status;");

            $status = $statusQuery->fetchAll();

    } else if($method === "POST"){

    }
?>