<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>961LB</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet"> 
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">

<?php 
    if(isset($cssLinks)){
        echo $cssLinks;
    }  
?>
</head>

<body>
    <header>
        <div class="headerMain">
            <nav class="navbar navbar-expand-sm" style="height:55px;">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>/Home">
                        <img class="headerLogo"  src="<?php echo base_url(); ?>assets/images/realestateLogo.png" >
                    </a>
                    <button class="navbar-toggler menuBtn" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <i class="fa fa-bars menuBtnIcon"></i>                      
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav navbar-right">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>Home"  aria-expanded="false">
                                    HOME
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>ForSale"  role="button">
                                    FOR SALE
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>ForRent"   role="button">
                                    FOR RENT
                                </a>
                            </li>
                            <!-- <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    FOR SALE
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">
                                        Homes For Sale
                                    </a>
                                    <a class="dropdown-item" href="#">Open Houses</a>
                                    <a class="dropdown-item" href="#">Recently Listed Homes</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    FOR RENT
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                    <a class="dropdown-item" href="#">Homes For Rent</a>
                                    <a class="dropdown-item" href="#">Apartments For Rent</a>
                                    <a class="dropdown-item" href="#">Open Houses</a>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ABOUT
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                    <a class="dropdown-item" href="#">About Us</a>
                                    <a class="dropdown-item" href="#">Contact Us</a>
                                    <!-- <a class="dropdown-item" href="#">Code Of Ethics</a> -->
                                </div>
                            </li>
<?php
    if(isset($_SESSION["userId"])){
?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>Lb961"  role="button">
                                    MANAGE ACCOUNT
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="cursor:pointer; color:#055E20" id="logoutButton"  role="button">
                                    LOGOUT
                                </a>
                            </li>
<?php
    }else{
?>
                            <li class="nav-item dropdown">
                                <a class="nav-link "  href="<?php echo base_url(); ?>Login" role="button">
                                    LOGIN
                                </a>
                            </li>
<?php
    }
?>
                        </ul>
                    </div>  
                </div>  
            </nav>
        </div>
    </header>
    
    <div class="loader">
        <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
    </div>
    <main>