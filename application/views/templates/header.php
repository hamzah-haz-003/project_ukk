<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?= $title; ?>
  </title>

  <!-- Custom styles for this template-->
  <link href="<?= base_url('asset/sbadmin/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
    type="text/css">
  <link href="<?= base_url('asset/sbadmin/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/datatables/bootstrap4.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/datatables/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/swall/dist/sweetalert2.min.css'); ?>">

  <style>
    body {
      background-color: grey;
    }
  </style>
</head>


<body id="page-top">
  <?php $page = basename($_SERVER['PHP_SELF']); ?>