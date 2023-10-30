<?php

require 'inc/data/products.php';

function verifErrors(array $data, array $catalog): array {

    $errors= [];

    if(!array_key_exists($data['id'], $catalog)) {
        $errors[] =  "L'id n'est pas existant dans le tableau";
    }

    if($data['quantity'] <= 0) {
        $errors[] = "Donner une quantité supérieur à 0";
    }

    return $errors;
}

function searchAndAddCookie(array $data, array $catalog) {

    $errors= [];
    $data = array_map('trim', $_POST);
    $data = array_map('htmlentities', $data);
    $data['quantity'] = (int)($data["quantity"]);
    $errors = verifErrors($data, $catalog);

    if(empty($errors)) {
        if(!isset($_SESSION["cookies"])) {
            $_SESSION["cookies"][] = ["id"=>$data["id"], "quantity" => $data["quantity"]];
        } else {
            $cookiePresent = false;
            foreach($_SESSION["cookies"] as $key => $cookie) {
                if(in_array($data["id"],$cookie)) {
                    $cookiePresent = true;
                    break;
                }
            }
            
            if($cookiePresent) {
                $_SESSION["cookies"][$key]["quantity"] = $data["quantity"];
            } else {
                $_SESSION["cookies"][] = ["id"=>$data["id"], "quantity" => $data["quantity"]];
            }
            
        }
        
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

function priceCookie(int $quantity, float $price):float {

    $totalPrice = $quantity * $price;
    return $totalPrice;
}

function deleteCookie(int $id)
{
    foreach($_SESSION["cookies"] as $key => $cookie) {
        if($cookie["id"] == $id) {
            unset($_SESSION["cookies"][$key]);
        }
    }
}