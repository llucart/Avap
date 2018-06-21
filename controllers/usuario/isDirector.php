<?php
if ($_SESSION['rol'] != '2') {
    header('Location: ../pages/');
     die();
}