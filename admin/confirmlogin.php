<?php 
session_start();
if(!$_SESSION['dn']==1)
{
    header('location:../login');
}
?>