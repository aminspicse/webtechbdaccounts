<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webtech Bd</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        .sidebar{
            width:150px;
            height: 100%;
            position: fixed;
        }
        .containt{
            margin-left: 150px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default bg-dark fixed-top">
        <div class="navbar-header">
            <a href="<?php echo base_url('home') ?>" class="navbar-brand">Webtech BD Accounts</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <form action="ledger" method="get" class="navbar-form">
                    <input type="text" name="keyword" class="" placeholder="Give Your Id">
                    <button name="search">Search</button>
                </form>
            </li>
        </ul>
        <div>
            <ul class="nav navbar-nav">
                <li><a href="<?= base_url('logout')?>">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="sidebar container bg-light">
        <a href="add" class="">Add Student</a>
        <a href="coursereg" class="">Course Reg.</a>
        <a href="collection" class="">Collection</a>
        <a href="statement" class="">Statement</a>
        <a href="deletecollection" class="">Delete</a>
    </div>
    