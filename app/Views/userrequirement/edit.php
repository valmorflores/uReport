<div class="hero fullscreen">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/userrequirement/update/<?php echo $cd_id; ?>" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                            <div class="col">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-left u-font-alt">Requerimento</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-left">Preencha a seguir os campos para identificação adequada do que você deseja que seja feito.
                                        <br>Depois de validar os dados do requerimento, você pode acompanhar o processamento de sua solicitação.
                                        <br>Este requerimento está vinculado à <strong><?php echo $username; ?></strong></p>
                                    
                                    
                                        <div class="form-group pr-0">
                                                <label class="form-group-label col-2">
                                                    <span class="icon">
                                                        <i class="fa-wrapper fas fa-list"></i>
                                                    </span>
                                                    <span>Requerimento</span>
                                                </label>
                                                <select name="requerimento" id="requerimento" class="select form-group-input" placeholder="Local de trabalho">
                                                    <?php foreach($requerimentos as $row){ ?>
                                                        <option <?php if ($row[0] == $cd_requerimento){?>selected<?php }?>>
                                                            <?php echo $row[0] . ' - ' . $row[1] ;?>
                                                        </option>
                                                    <?php } ?>                                                    
                                                </select>
                                            </div>
 

                                    
                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Nome completo</span>    
                                        </label>
                                        
                                        <input type="text" id="nome" value="<?php echo $ds_nome; ?>" name="nome" class="form-group-input" placeholder="Nome completo" />
                                    </div>
                                    <div class="form-group">
                                        <?php if (isProfileAdmin()){ ?>
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>Ativo</span>
                                        </label>
                                        <?php } ?>
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="ativo" name="ativo" value="<?php echo $sn_ativo; ?>" class="form-group-input" placeholder="Ativo"  />
                                    </div>
                                    
                                    <div class="btn-group u-pull-right">
                                        <?php if ($sn_ativo=='N' || isProfileAdmin()) { ?>
                                        <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $cd_id; ?>" class="btn btn-warning">Comentários</a>
                                        <?php foreach($requerimentos as $row){ 
                                            if ($row[0] == $cd_requerimento){
                                                if ($row[2]==1){
                                        ?>
                                        <a href="<?php echo base_url();?>/public/user/edit/<?php echo $cd_id; ?>" class="btn btn-info">Editar</a>
                                        <?php
                                               }
                                           }
                                        }
                                        ?>
                                        <?php } ?>
                                        <button class="btn-info">SALVAR</button>
                                    </div>
                                    
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>

                                    <!--p>Observações</p>
                                    <textarea placeholder="Observações"></textarea-->
                                </div>
                                <div class="space xlarge"></div>
                            </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

 