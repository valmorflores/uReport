<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
</div>      
<div class="hero">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0" action="<?php echo base_url();?>/public/user/update/<?php echo $cd_id; ?>" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                            <div class="col">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-center u-font-alt">Editar usuário</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-center">Preencha a seguir os campos para solicitação de novo usuário. Depois de encaminhar os dados você pode acompanhar o processamento de sua solicitação.
                                        <br>Registo solicitado por: <strong><?php echo $ds_solicitante;?></strong> - Usuário ativo: <strong><?php echo $username; ?></strong></p>
                                    <div class="space"></div>
                                    <div class="btn-group u-pull-right">
                                    <?php if ($is_superuser == 1){ ?>
                                        <a href="<?php echo base_url();?>/public/user/admin/<?php echo $cd_id; ?>" class="btn btn-dark">Administração</a>
                                        <?php } ?>
                                     </div>
                                     
                                 <div class="space"></div>
                                    <BR><BR>

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
                                                <select name="localtrabalho" id="localtrabalho" class="select form-group-input" placeholder="Local de trabalho">
                                                    <?php foreach($locaistrabalho as $row){ ?>
                                                        <option <?php if ($row == $ds_localtrabalho){?>selected<?php }?>>
                                                            <?php echo $row ;?>
                                                        </option>
                                                    <?php } ?>                                                    
                                                </select>
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

                                    
                                    <div class="form-group">
                                        <?php if (isProfileAdmin()){ ?>
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>Prestador</span>
                                        </label>
                                        <?php } ?>
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="cd_prestador" name="cd_prestador" value="<?php echo $cd_prestador; ?>" class="form-group-input" placeholder="Prestador"  />
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
                                    
                                    <p>
                                    <br>Marque a seguir somente os itens necessários
                                    
                                    <br>
                                    </p>
                                    <p>Sistemas</p>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check0" name="check0" class="form-ext-input" type="checkbox" <?php if($item[0]===1){ ?>checked<?php } ?>>
                                        <label class="form-ext-label" for="check0">MV2000</label>
                                    </div>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check1" name="check1" class="form-ext-input" type="checkbox" <?php if($item[1]===1){ ?>checked<?php } ?>>
                                        <label class="form-ext-label" for="check1">PersonalMed</label>                                            
                                    </div>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check2" name="check2" class="form-ext-input" type="checkbox" <?php if($item[2]===1){ ?>checked<?php } ?>> 
                                        <label class="form-ext-label" for="check2">PACS/DCE</label>                                            
                                    </div>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check3" name="check3" class="form-ext-input" type="checkbox" <?php if( $item[3]===1 ){ ?>checked<?php } ?>>
                                        <label class="form-ext-label" for="check3">DATASYS</label>                                            
                                    </div>
                                    <p></p>
                                    <p>Acessos de rede</p>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check80" name="check80" class="form-ext-input" type="checkbox" <?php if( $item[80]===1 ){ ?>checked<?php } ?>>
                                        <label class="form-ext-label" for="check80">Rede</label>                                            
                                    </div>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check81" name="check81" class="form-ext-input" type="checkbox" <?php if( $item[81]===1 ){ ?>checked<?php } ?>>
                                        <label class="form-ext-label" for="check81">Internet</label>                                            
                                    </div>
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="check82" name="check82" class="form-ext-input" type="checkbox" <?php if( $item[82]===1 ){ ?>checked<?php } ?>>
                                        <label class="form-ext-label" for="check82">E-mail</label>                                            
                                    </div>
                                    <p></p>
                                    <!--p>Observações</p>
                                    <textarea placeholder="Observações"></textarea-->

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








                                    <div class="space"></div>
                                    <div class="btn-group u-pull-right">
                                        <?php if (isProfileAdmin()){ ?>
                                        <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $cd_id; ?>" class="btn btn-warning">Comentários</a>
                                        <?php } ?>
                                        <button class="btn-info">SALVAR</button>
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

 