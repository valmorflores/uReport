<div class="hero fullscreen">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/user/search" method="post">
                <div class="frame__body p-0  ">
                    <div class="row p-0 level fill-height">
                         
                            <div class="col">
                                <div class="space xlarge "></div>
                                <div class="padded ">
                                    <h1 class="u-text-center u-font-alt">Buscar usuário</h1>
                                    <p class="u-text-center">Preencha a seguir para localizar.
                                   
                                    <div class="form-group ">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Usuário</span>    
                                        </label>
                                        <input style="width:600px" type="text" id="nome" name="nome" class="form-group-input" placeholder="Nome completo" />
                                    </div>                                    
                                    
                                    <div class="btn-group u-pull-right">
                                        <button class="btn-info">BUSCAR</button>
                                    </div>

                                </div>
                                <div class="space xlarge"></div>
                            </div>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>