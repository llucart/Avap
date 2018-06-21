<?php
if ($_SESSION['rol'] != '4') {
    header('Location: ../pages/');
     die();
}