<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    

    <!----======== CSS Bootstrap======== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!----======== CSS sidebar======== -->
    <link rel="stylesheet" href="/build/assets/sidebar.css">
  
  <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <!----======== CSS ======== -->
    <link rel="stylesheet" href="/build/assets/styles.css">

</head>


    <body>
        <!----===== Sidebar HTML ===== -->
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <!--<img src="logo.png" alt="">-->
                    </span>
    
                    <div class="text logo-text">
                        <span class="name">SistemaOS</span>
                        <span class="profession">Oficina de Panelas</span>
                    </div>
                </div>
    
                <i class='bx bx-chevron-right toggle'></i>
            </header>
    
            <div class="menu-bar">
                <div class="menu">
    <!--
                    <li class="search-box">
                        <i class='bx bx-search icon'></i>
                        <input type="text" placeholder="Search...">
                    </li>
    -->
                    
                        <li class="navi-link">
                            <a href='/home'>
                                <i class='bx bx-home-alt icon' ></i>
                                <span class="text nav-text">Pagina Inicial</span>
                            </a>
                        </li>
    
                        <li class="navi-link">
                            <a href='/clients'>
                                
                                <i class='bx bx-clipboard icon'></i>
                                <span class="text nav-text">Clientes</span>
                            </a>
                        </li>
    
                        <li class="navi-link">
                            <a href='/service-order'>
                                <i class='bx bx-bell icon'></i>
                                <span class="text nav-text">Ordens de Serviço</span>
                            </a>
                        </li>
    
                        <li class="navi-link">
                            <a href="#">
                                <i class='bx bx-pie-chart-alt icon' ></i>
                                <span class="text nav-text">Analytics</span>
                            </a>
                        </li>
    
                        
    
                        <li class="navi-link">
                            <a href="#">
                                <i class='bx bx-wallet icon' ></i>
                                <span class="text nav-text">Wallets</span>
                            </a>
                        </li>
    
                    
                </div>
                <form class="" method="POST" action="{{ route('logout') }}">
                    @csrf
                <div class="bottom-content">
                    <li class="">
                        <a href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            <i class='bx bx-log-out icon' ></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                </div>  
                </form>        
                    
                    
               
            </div>
    
        </nav>
    
        <section class="home">
            <div class="text">@yield('content')</div>
        </section>
    
        <script src="/build/assets/sidebar.js"></script>
                
                    <!--JS BOOTSTRAP-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
   
    
    



</html>
          
          
          
          

                    
     
          
      
     