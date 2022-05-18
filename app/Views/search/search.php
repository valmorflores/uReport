<div class="hero fullscreen">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/search/do" method="post">
                <div class="frame__body p-0  ">
                    <div class="row p-0 level fill-height">
                         
                            <div class="col">
                                <div class="space xlarge "></div>
                                <div class="padded ">
                                    <h1 class="u-text-center u-font-alt col-12" style="width:600px">Buscar paciente</h1>
                                    <p class="u-text-center">Preencha a seguir para localizar.
                                   
                                    <div class="form-group ">                                        
                                        <input type="text" id="nome" name="nome" class="form-group-input" placeholder="Nome completo" />
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