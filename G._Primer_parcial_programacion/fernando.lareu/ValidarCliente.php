<?php

    require_once "./Cliente.php";

    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $contador = 0;

    $listado = TraerClientes();

    foreach($listado as $item) {

        if(trim($item->GetCorreo()) == $correo) {

            if(trim($item->GetClave()) == $clave) {

                echo "Cliente Logeado: ".$item->GetNombre();
                break;

            }
            else {

                echo "Contrasenia incorrecta";
            }

        }

        $contador++;
    }

    if($contador == count($listado)) {

        echo  "Cliente inexistente";
    }

    function TraerClientes() {

        if(!@$archivo = fopen("./clientes/clientesActuales.txt" , "r")) {

            echo "no se ha podido leer el archivo";
        }
        else {

            while(!feof($archivo)) {

                $archAux = fgets($archivo);
                $clientes = explode(" - ", $archAux);
                $clientes[0] = trim($clientes[0]);
                $clientes[1] = trim($clientes[1]);
                $clientes[2] = trim($clientes[2]);

                if($clientes[0] != ""){

                    $listaDeClientes[] = new Cliente($clientes[0] , $clientes[1] , $clientes[2]);
                }
            }

            fclose($archivo);
            return $listaDeClientes;
        }
    }
?>