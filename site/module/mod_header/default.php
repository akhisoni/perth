<?php 


?>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top">
        <!-- Logo -->
        <nav class="navbar">
            <a class="navbar-brand logotop logocss" href="<?php echo SITEURL; ?>">
                <img src="<?php echo TemplateUrl();?>images/Tango_Logo.png" width="150" height="150" alt="">
            </a>
        </nav>
        <!-- Logo -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
            <ul class="nav ml-auto justify-content-end">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="#">About Us <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Calender</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gallrey</a>
                    <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Tango</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Classes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Show</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Videos</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Music</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Member</a>
                    <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Text 1</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Text 2</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact Us</a>
                </li>
            </ul>
            <div class="navsearch">
                <form class="form-inline my-1 my-lg-0 searchbardiv">
                    <input class="form-control mr-sm-2 searchbar" type="search" placeholder="Search" aria-label="Search">
                    <button class="searchbtn"><i class="fas fa-search"></i></a></button>
                </form>
            </div>
        </div>
    </nav>
    </header>