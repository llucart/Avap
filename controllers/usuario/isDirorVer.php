<?php
if ($_SESSION['rol'] != '3' && $_SESSION['rol'] != '2') {
    header('Location: ../pages/');
     die();
}