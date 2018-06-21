<?php
if ($_SESSION['rol'] != '1' && $_SESSION['rol'] != '2') {
    header('Location: ../pages/');
     die();
}