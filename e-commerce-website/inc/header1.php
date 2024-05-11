<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>MachinaStore</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <link href="inc\css\bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="inc\css\starter-template.css" rel="stylesheet">  
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <style>

      .table-responsive {
          margin: 30px 0;
      }
      .table-wrapper {
          min-width: 900px;
          background: #fff;
          padding: 20px;
          box-shadow: 0 1px 1px rgba(0,0,0,.05);
      }
      .table-title {
          padding-bottom: 10px;
          margin: 0 0 10px;
          min-width: 100%;
      }
      .table-title h2 {
          margin: 8px 0 0;
          font-size: 22px;
      }
      .search-box {
          position: relative;        
          float: right;
      }
      .search-box input {
          height: 34px;
          border-radius: 20px;
          padding-left: 35px;
          border-color: #ddd;
          box-shadow: none;
      }
      .search-box input:focus {
          border-color: #3FBAE4;
      }
      .search-box i {
          color: #a0a5b1;
          position: absolute;
          font-size: 19px;
          top: 8px;
          left: 10px;
      }
      table.table tr th, table.table tr td {
          border-color: #e9e9e9;
      }
      table.table-striped tbody tr:nth-of-type(odd) {
          background-color: #fcfcfc;
      }
      table.table-striped.table-hover tbody tr:hover {
          background: #f5f5f5;
      }
      table.table th i {
          font-size: 13px;
          margin: 0 5px;
          cursor: pointer;
      }
      table.table td:last-child {
          width: 130px;
      }
      table.table td a {
          color: #a0a5b1;
          display: inline-block;
          margin: 0 5px;
      }
      table.table td a.view {
          color: #03A9F4;
      }
      table.table td a.edit {
          color: #FFC107;
      }
      table.table td a.delete {
          color: #E34724;
      }
      table.table td i {
          font-size: 19px;
      }    
      .pagination {
          float: right;
          margin: 0 0 5px;
      }
      .pagination li a {
          border: none;
          font-size: 95%;
          width: 30px;
          height: 30px;
          color: #999;
          margin: 0 2px;
          line-height: 30px;
          border-radius: 30px !important;
          text-align: center;
          padding: 0;
      }
      .pagination li a:hover {
          color: #666;
      }	
      .pagination li.active a {
          background: #03A9F4;
      }
      .pagination li.active a:hover {        
          background: #0397d6;
      }
      .pagination li.disabled i {
          color: #ccc;
      }
      .pagination li i {
          font-size: 16px;
          padding-top: 6px
      }
      .hint-text {
          float: left;
          margin-top: 6px;
          font-size: 95%;
      }    
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }



      /* Style the navigation bar */
      .navbar {
        width: 100%;
        background-color: white;
        overflow: auto;
      }

      /* Navbar links */
      .navbar a {
        float: left;
        text-align: center;
        padding: 12px;
        color: black;
        text-decoration: none;
        font-size: 17px;
      }

      /* Navbar links on mouse-over */
      .navbar a:hover {
        background-color: white;
      }

      /* Current/active navbar link */
      .active {
        background-color: #04AA6D;
      }

      /* Add responsiveness - will automatically display the navbar vertically instead of horizontally on screens less than 500 pixels */
      @media screen and (max-width: 500px) {
        .navbar a {
          float: none;
          display: block;
        }
      }
    </style>
    
  </head>
  <body>
    
  <div class="col-lg-8 mx-auto p-4 py-md-5">
  <!-- <header class="d-flex align-items-center pb-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
      <img src="inc\images\logo.png" style="width:128px;height:auto;" class="me-2" viewBox="0 0 118 94" role="img">
      <span class="fs-4">My Flowers Shop</span>
    </a>

  </header>
  -->
  <div class="navbar border-bottom">
  <a href="#">
      <img src="inc\images\logo.png" style="width:128px;height:auto;" class="me-2" viewBox="0 0 118 94" role="img">
      <span class="fs-4">MachinaStore</span>
  </a>
  <div>
  <a href="logout.php"> 
  <?php if(isset($_SESSION['auth'])): echo ('Se déconnecter');?> 
  <?php endif; ?>
  </a>
  </div>
  <a href="login.php">
    <i class="fa fa-fw fa-user"></i> 
    <?php
    if (isset($_SESSION['user'])) {
        echo '<a href="logout.php" class="d-flex align-items-center justify-content-center" ><div > Se déconnecter</div></a>';
        echo '<span class="navbar-text"><i class="fa fa-fw fa-user"></i>' . $_SESSION['user'] . '</span>';
    } else {
        echo '<a href="login.php" class="ml-2"><i class="fa fa-fw fa-user"></i> Login</a>';
    }
    ?>
  </a>
  </div>
  
