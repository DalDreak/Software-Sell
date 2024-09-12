<?php

    include_once("conn.php");

    $method = $_SERVER["REQUEST_METHOD"];

    // Resgate dos dados e montagem do pedido
    if ($method === "GET") {

        $investimentoQuery = $conn->query("SELECT * FROM investimento;");

        $investimento = $investimentoQuery->fetchAll();

        $pacotes_extraQuery = $conn->query("SELECT * FROM pacotes_extra;");
        $pacotes_extra = $pacotes_extraQuery->fetchAll();

        $tipoQuery = $conn->query("SELECT * FROM tipo;");
        $tipo = $tipoQuery->fetchAll();


    // Criação do pedido        
    } else if ($method === "POST") {

        $data = $_POST;

        $investimentos = $data["investimentos"];
        $pacotes_extras = $data["pacotes_extras"];
        $tipos = $data["tipos"];

        // Validação de pacotes máximos
        if(count($pacotes_extras) > 3 ) {

            $_SESSION["msg"] = "Seleciona no máximo 3 pacotes extras!";
            $_SESSION["status"] = "warning";

        }else{

            // Enviando dados ao BD
            $stmt = $conn->prepare("INSERT INTO software (tipo_id, investimento_id) VALUES (:tipos, :investimentos)");

            // Filtrando inputs
            $stmt->bindParam(":tipos", $tipos, PDO::PARAM_INT);
            $stmt->bindParam("investimentos", $investimentos, PDO::PARAM_INT);

            $stmt->execute();

            // Resgatando último ID
            $softwareId = $conn->lastInsertId();

            $stmt = $conn->prepare("INSERT INTO software_pacotes (software_id, pacotes_extra_id) VALUES (:software, :pacotes_extra)");

            // Repetição até finalizar de salvar todos os pacotes.
            foreach($pacotes_extras as $pacotes_extra){

                // Filtrando inputs
                $stmt->bindParam(":software", $softwareId, PDO::PARAM_INT);
                $stmt->bindParam(":pacotes_extra", $pacotes_extra, PDO::PARAM_INT);

                $stmt->execute();

            }

            // Criar o pedido do software
            $stmt = $conn->prepare("INSERT INTO pedidos (software_id, status_id ) VALUES (:software, :status)");

            // Status -> sempre inicia com 1, produção.
            $statusId = 1;

            // Filtrar inputs
            $stmt->bindParam(":software",$softwareId);
            $stmt->bindParam(":status",$statusId);

            $stmt->execute();

            // Exibit mensagem de sucesso
            $_SESSION["msg"] = "Pedido realizado com sucesso!";
            $_SESSION["status"] = "success";
        }
        // Retorna para a página principal.
        header("Location: ..");
    }


?>