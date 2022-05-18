<div class="hero">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/user/update/<?php echo $cd_id; ?>" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                            <div class="col">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-center u-font-alt">Administrar usuário</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-center">Preencha a seguir os campos para solicitação de novo usuário. Depois de encaminhar os dados você pode acompanhar o processamento de sua solicitação.
                                        <br>Registo solicitado por: <strong><?php echo $ds_solicitante;?></strong> - Usuário ativo: <strong><?php echo $username; ?></strong></p>
                                        <div class="space"></div>
                                    <div class="btn-group u-pull-right">
                                        <?php if (isProfileAdmin()){ ?>
                                        <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $cd_id; ?>" class="btn btn-warning">Comentários</a>
                                        <?php } ?>
                                        <a href="<?php echo base_url();?>/public/user/edit/<?php echo $cd_id; ?>" class="btn btn-info">EDITAR</a>
                                    </div>
<br><br>                                    


                                        

                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Nome completo</span>    
                                        </label>
                                        
                                        <input type="text" id="nome" value="<?php echo $ds_nome; ?>" name="nome" class="form-group-input" placeholder="Nome completo" />
                                    </div>

                                    <div class="form-section section-inline">
                                        <div class="section-body row">                                                
                                            <div class="form-group col-6 pl-0">
                                                
                                                <label class="form-group-label col-5">
                                                    <span class="icon">
                                                        <i class="fa-wrapper far fa-calendar"></i>
                                                    </span>
                                                    <span>Nascimento</span>
                                                </label>
                                                <input type="text" name="nascimento" class="form-group-input" placeholder="Nascimento"  value="<?php echo $dt_nascimento; ?>" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>                                                    
                                            </span>
                                            <span>Matrícula</span>    
                                        </label>
                                        <input type="text" name="matricula" value="<?php echo $nr_matricula; ?>" class="form-group-input" placeholder="Número da matrícula" />  
                                    
                                        </div>

                                    
                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>CPF</span>
                                        </label>
                                        <input type="text" id="cpf" name="cpf" maxlength="11" size="11" value="<?php echo $cpf; ?>" class="form-group-input" placeholder="CPF (Somente números)" />
                                    </div>

                                    

                                    <div class="form-group pr-0">
                                                <label class="form-group-label col-2">
                                                    <span class="icon">
                                                        <i class="fa-wrapper fas fa-list"></i>
                                                    </span>
                                                    <span>Local</span>
                                                </label>                                                
                                            </div>

                                            <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-edit"></i>
                                            </span>
                                            <span>Cargo/Função</span>
                                        </label>
                                        <input type="text" name="cargo" value="<?php echo $ds_cargo; ?>" class="form-group-input" placeholder="Cargo ou função" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>N. conselho</span>
                                        </label>
                                        <input type="text" id="conselho" name="conselho" value="<?php echo $nr_conselho; ?>" class="form-group-input" placeholder="Número do conselho, somente para técnicos" />
                                    </div>

                                    <p>Médicos</p>
                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-calendar"></i>
                                            </span>
                                            <span>
                                                É Cirurgião?</span>
                                        </label>
                                        <input class="form-group-input" name="cirurgia" id="cirurgia" value="<?php echo $sn_cirurgia; ?>" placeholder="Sim ou não" />
                                    </div>
                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-calendar"></i>
                                            </span>
                                            <span>
                                                Cir.Especial.</span>
                                        </label>
                                        <input id="especialidade" name="especialidade" class="form-group-input" placeholder="Cirurgia / Especialidade"  value="<?php echo $ds_especialidade; ?>"/>
                                    </div>

                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-calendar"></i>
                                            </span>
                                            <span>
                                                P.Estag/Resid.</span>
                                        </label>
                                        <input class="form-group-input" id="estagresidper" name="estagresidper" value="<?php echo $ds_estagresidper; ?>" placeholder="Estágio / residência, informar período" />
                                    </div>
                                    
                                    <div class="form-section section-inline">
                                        <div class="section-body row">
                                            <div class="form-group col-6 pl-0">
                                                <label class="form-group-label col-5">
                                                    <span class="icon">
                                                        <i class="fa-wrapper far fa-calendar"></i>
                                                    </span>
                                                    <span>Dt. Admissão
                                                    </span>
                                                </label>
                                                <input type="text" class="form-group-input" name="admissao" id="admissao" value="<?php echo $dt_admissao;?>" placeholder="Data de admissão" />
                                            </div>
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-clock"></i>
                                            </span>
                                            <span>Horário</span>
                                        </label>
                                        <input name="horario" class="form-group-input" id="horario" name="horario" placeholder="Horário de trabalho" value="<?php echo $ds_horario; ?>"/>
                                    </div>

                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Perfil idêntico</span>
                                        </label>
                                        <input class="form-group-input" id="perfilsimilar" name="perfilsimilar" value="<?php echo $ds_perfilsimilar; ?>" placeholder="Login ou Nome completo de outro usuário com perfil similar" />
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
                                                                            
                                    <div class="form-group">
                                        <?php if (isProfileAdmin()){ ?>
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>Ativo/Rede</span>
                                        </label>
                                        <?php } ?>
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="rede" name="rede" value="<?php echo $sn_rede; ?>" class="form-group-input" placeholder="Ativo/Rede"  />
                                    </div>

                                    <div class="form-group">
                                        
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>Prestador</span>
                                        </label>
                                        
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="rede" name="rede" value="<?php echo $cd_prestador; ?>" class="form-group-input" placeholder="Ativo/Rede"  />
                                    </div>

                                    <div class="form-group">
                                        <?php if (isProfileAdmin()){ ?>
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>Usuário</span>
                                        </label>
                                        <?php } ?>
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="usuario" name="usuario" value="<?php echo $cd_usuario; ?>" class="form-group-input" placeholder="Usuario"  />
                                    </div>
                                    
                                    <?php 
                                    $prestadorFound = false;
                                    ?>
                                    <?php foreach ($prestador as $row) {
                                        ?>
                                        <div class="row">
                                        <h5>Registro de Prestador</h5>
                                        </div>    
                                        <?php
                                        var_dump($row);
                                        $prestadorFound = true;
                                    }
                                    ?>
                                    <?php if (($prestadorFound) && isProfileAdmin()){ ?>
                                        <?php if (isset($cd_prestador) && $cd_prestador > 0) { ?>
                                        <a href="<?php echo base_url();?>/public/user/updateproviderinfo/<?php echo $cd_id; ?>" class="btn btn-dark">Atualizar prestador no MV / <?php echo $cd_prestador; ?></a>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php if ((!$prestadorFound) && isProfileAdmin()){ ?>
                                        <?php if ($cd_prestador == 0 ) { ?>
                                        <a href="<?php echo base_url();?>/public/user/createprovider/<?php echo $cd_id; ?>" class="btn btn-warning">Adicionar prestador no MV</a>
                                        <?php } ?>
                                    <?php } ?>                                    

                                    <?php                                     
                                    ?>
                                    
                                    <?php 
                                    if (isset($prestador_porcpf)) { foreach ($prestador_porcpf as $row) {
                                        ?>
                                        <div class="row">
                                        <h5>Registro de Prestador por CPF</h5>
                                        </div>    
                                        <?php
                                        var_dump($row);
                                        $prestadorFound = true;
                                    }
                                    }
                                    ?>



                                    <?php 
                                    $userFound = false;
                                    ?>
                                    <?php foreach ($usuario as $row) {
                                        ?>
                                        <div class="row">
                                        <h5>Registro de Usuário</h5>
                                        </div> 
                                        <?php
                                        var_dump($row);
                                        $userFound = true;
                                    }
                                    ?>
                                    <?php if ((!$userFound) && isProfileAdmin()){ ?>
                                        <a href="<?php echo base_url();?>/public/user/create/<?php echo $cd_id; ?>" class="btn btn-warning">Adicionar usuário no MV</a>
                                    <?php } ?>                                    


                                    <?php 
                                    $pmedFound = false;
                                    ?>
                                    <?php foreach ($pmed_user as $row) {
                                        ?>
                                        <div class="row">
                                        <h5>Registro de Usuário pMed</h5>
                                        </div>    
                                        <?php
                                        var_dump($row);
                                        $pmedFound = true;
                                    }
                                    ?>

                                    <?php if ((!$pmedFound) && isProfileAdmin()){ ?>
                                        <a href="<?php echo base_url();?>/public/userpmed/create/<?php echo $cd_id; ?>" class="btn btn-warning">Adicionar usuário no pMed</a>
                                    <?php } ?> 
 
                                    <div class="space"></div>
                                    <div class="btn-group u-pull-right">
                                        <?php if (isProfileAdmin()){ ?>
                                        <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $cd_id; ?>" class="btn btn-warning">Comentários</a>
                                        <?php } ?>
                                        <a href="<?php echo base_url();?>/public/user/edit/<?php echo $cd_id; ?>" class="btn btn-info">EDITAR</a>
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

 