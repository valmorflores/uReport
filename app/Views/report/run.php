<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
<div class="hero fullscreen">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/report/rview/<?php echo $report;?>" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                         
                            <div class="col">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-center u-font-alt">Executar</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-center">Preencha a seguir para executar
                                        <br>Este requerimento ficará vinculado à <strong><?php echo $username; ?></strong></p>
                                    
                                    <div class="divider"></div>

                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Atendimento</span>    
                                        </label>
                                        
                                        <input type="text" id="atendimento" name="atendimento" value="4779726" class="form-group-input" placeholder="Nome completo" />
                                    </div>

                                    <div class="btn-group u-pull-right">
                                        <button class="btn-info">GERAR</button>
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

</section>