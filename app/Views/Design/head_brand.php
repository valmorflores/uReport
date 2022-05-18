<div class="header-brand">
    <div class="nav-item"> 
        <h6 class="title">
            <span class="tag tag--dark text-success"> uRep</span><span class=" subtitle font-normal">
                Administração</span>
        </h6>
        <hr>
    </div>
    <div class="nav-item nav-btn" id="header-btn"> <span></span> <span></span> <span></span> </div>
</div>

<header class="p-3 app-text">
    <div class="container ">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 app-text text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo base_url();?>/public/dashboard" class="nav-link px-2 text-secondary ">Home</a></li>
          <li><a href="<?php echo base_url();?>/public/features" class="nav-link px-2 app-text">Features</a></li>
          <li><a href="<?php echo base_url();?>/public/pricing" class="nav-link px-2 app-text">Pricing</a></li>
          <li><a href="<?php echo base_url();?>/public/faqs" class="nav-link px-2 app-text">FAQs</a></li>
          <li><a href="<?php echo base_url();?>/public/about" class="nav-link px-2 app-text" class="nav-link px-2 text-white">Sobre</a></li>
          
        </ul>

        <!--form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search"-->

        <form action="http://srvm24:89/app/reports/urep/public/search/do" method="post">
            
                <div class="col-12">
                    <div class="row">
                        <div class="col-9">
                            <input type="text" id="nome" name="nome" class="form-group-input" placeholder="Busca">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            
        </form>

        <!--input type="search" class="form-control form-control-dark text-white bg-dark" placeholder="Search..." aria-label="Search"-->


        <!--/form-->

        <div class="text-end">
          
          <div class="dropdown app-text">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="<?php echo base_url();?>/public/dashboard">Dashboard</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url();?>/public/profile">Perfil</a></li>
                <?php if ( isProfileAdmin() ) { ?>
                    <li><a class="dropdown-item"href="<?php echo base_url();?>/public/internalusers">Usuários</a></li>
                <?php } ?>
                <li><a class="dropdown-item" href="<?php echo base_url();?>/documents/uadm_manual.pdf"
                        target="blank">Manual</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url();?>/public/about">Sobre</a></li>
                <li class="dropdown-menu-divider"></li>
                <li><a class="dropdown-item" href="<?php echo base_url();?>/public/login/off">Sair</a></li>
            </ul>
          </div>
        </div>
        Dark<!--input type="checkbox" id="switch"-->


        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="switch">          
        </div>




      </div>
    </div>
  </header>
  



<div class="header-nav" id="header-menu">
    <div class="nav-left">
    </div>
    <div class="nav-right">
        
    </div>
</div>
</div>