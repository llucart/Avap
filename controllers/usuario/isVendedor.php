<?php
if ($_SESSION['rol'] != '3') {
    header('Location: ../pages/');
     die();
}