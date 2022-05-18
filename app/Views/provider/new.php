<div class="hero fullscreen">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/provider/post" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                         
                            <div class="col">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-center u-font-alt">Novo prestador</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-center">Preencha a seguir os campos para solicitação de cadastro de um novo prestador. Depois de encaminhar os dados você pode acompanhar o processamento de sua solicitação. Prestadores não tem acesso ao sistema e caso você deseje que tenha, precisa fazer requerimento de usuário.
                                        <br>Este requerimento ficará vinculado à <strong><?php echo $username; ?></strong></p>
                                    
                                    <div class="divider"></div>

                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Nome completo</span>    
                                        </label>
                                        
                                        <input type="text" id="nome" name="nome" class="form-group-input" placeholder="Nome completo" />
                                    </div>

                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>CPF</span>
                                        </label>
                                        <input type="text" name="cpf" id="cpf" maxlength="11" size="11" class="form-group-input" placeholder="CPF (Somente números)" />
                                    </div>

                                    
                                    <div class="btn-group u-pull-right">
                                        <button class="btn-info">SALVAR & AVANÇAR</button>
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