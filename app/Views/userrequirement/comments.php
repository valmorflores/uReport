<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
         <div class="hero ">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/userrequirement/addcomments/<?php echo $cd_id; ?>" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height ">
                            <div class="col-12">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-left u-font-alt">Comentários</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-left">
                                    <br>Aqui você pode fazer registros específicos e trocar informações com o suporte. 
                                    <br>Importante: Caso deseje informar dados complementares que sejam vinculados ao sistema você deve preencher o formulário anexo.
                                    <br>
                                    <br>Requerimento solicitado por: <strong><?php echo $ds_solicitante;?></strong>
                                    
                                    <div class="form-group">
                                        <label class="form-group-label col-3">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Nome completo</span>    
                                        </label>
                                        
                                        <input type="text" id="nome" value="<?php echo $ds_nome; ?>" name="nome" class="form-group-input" placeholder="Nome completo" readonly />
                                    </div>
                                    <div class="form-group pr-0">
                                                <label class="form-group-label col-3">
                                                    <span class="icon">
                                                        <i class="fa-wrapper fas fa-list"></i>
                                                    </span>
                                                    <span>Requerimento</span>
                                                </label>
                                                <?php if ($cd_tipo=='000'){ ?>
                                                    <input name="requerimento" id="requerimento" value="000 - Pedido de registro de novo usuário" class="select form-group-input" placeholder="Requerimento" readonly />
                                                <?php } else { ?>
                                                    <?php foreach($requerimentos as $row){ ?>
                                                        <?php if ($row[0] == $cd_requerimento){?>
                                                        <input name="requerimento" id="requerimento" value="<?php echo $row[0] . ' - ' . $row[1] ;?>" class="select form-group-input" placeholder="Requerimento" readonly />
                                                        <?php }?>

                                                    <?php } ?>                                                    
                                                <?php } ?>
                                                
                                            </div>
                                    
                                                                        <div class="space"></div>
                                    
<?php foreach ($comments as $row){ ?>

    <div class="form-group">
                                        <label class="form-group-label col-3">
                                            <?php if ($row->CD_USUARIO==$username) { ?>
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user-circle"></i>
                                            </span>
                                            <?php } else { ?>
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <?php } ?>
                                            <span>
                                            <?php if ($row->CD_USUARIO==$username) { ?><strong> <?php } ?>
                                                <?php echo $row->CD_USUARIO;?>
                                                <?php if ($row->CD_USUARIO==$username) { ?></strong> <?php } ?>
                                            <br>
                                            </span>    
                                        </label>
                                        <span class="col-8">
                                        <p class="font-bold"><?php echo $row->DS_COMMENTS; ?></p>
                                            
                                        <br>
                                        <span class="tag text-indigo-500 bg-indigo-100">
    <small>
                                        <?php
                                            setlocale(LC_TIME, "pt_BR");
                                            date_default_timezone_set("America/Sao_paulo");
                                            
                                            echo date('d/m/Y H:i:s', $row->DS_TIMESTAMP); ?>
                                            <?php //echo $row->DS_TIMESTAMP;?></small>
                                            
                                            </span>
                                            <?php if ($row->CD_USUARIO==$username) { ?>
                                            <a href="<?php echo base_url();?>/public/userrequirement/deletecomments/<?php echo $row->CD_ID; ?>" class="btn btn-xsmall">Excluir<i class="fa-wrapper fa fa-chevron-right pad-left "></i></a>
                                            <?php } ?>
                                        </span>
                                        
                                    </div>
   

<?php } ?>




<br>Novos comentários serão vinculados à <strong><?php echo $username; ?></strong> - Digite a seguir e clique em Adicionar</p>
<div class="form-group">
                                        <label class="form-group-label col-4">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>                                                    
                                            </span>
                                            <span>Comentário</span>    
                                        </label>
                                        <textarea name="comentario"  maxlength=256  value="<?php echo $ds_nome; ?>" class="form-group-input" placeholder="Descrição / Comentário"></textarea>
                                    </div>

                                    <div class="form-group">
                                    <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-post"></i>                                                    
                                            </span>
                                            <span> </span>    
                                        </label>    
                                        <div class="btn-group u-pull-right">
                                        <button class="btn-info">Adicionar</button>
                                        </div>
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
                                            </div>
                                            </section>
                                            </div>
                                            </div>
 