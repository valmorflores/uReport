<div class="hero">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                            <div class="col">
                                <div class="space xlarge"></div>
                                <div class="padded">
                                    <h1 class="u-text-center u-font-alt">Visualização de dados</h1>
                                    <div class="divider"></div>
                                    <p class="u-text-center">Visualização de dados. Nesta tela você pode consultar os dados que estão registrados em seu requerimento. Somente consulta é permitida aqui.
                                        <br>Este requerimento está vinculado à <strong><?php echo $ds_solicitante; ?></strong></p>
                                    
                                    <div class="divider"></div>

                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Nome completo</span>    
                                        </label>
                                        
                                        <input type="text" id="nome" value="<?php echo $ds_nome; ?>" name="nome" class="form-group-input" placeholder="Nome completo" readonly />
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
                                                <input type="text" name="nascimento" class="form-group-input" placeholder="Nascimento"  value="<?php echo $dt_nascimento; ?>"  readonly />
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
                                        <input type="text" name="matricula" value="<?php echo $nr_matricula; ?>" class="form-group-input" placeholder="Número da matrícula"  readonly />  
                                    
                                        </div>

                                    
                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>CPF</span>
                                        </label>
                                        <input type="text" id="cpf" name="cpf" maxlength="11" size="11" value="<?php echo $cpf; ?>" class="form-group-input" placeholder="CPF (Somente números)"  readonly />
                                    </div>

                                    

                                    <div class="form-group pr-0">
                                                <label class="form-group-label col-2">
                                                    <span class="icon">
                                                        <i class="fa-wrapper fas fa-list"></i>
                                                    </span>
                                                    <span>Local</span>
                                                </label>
                                                
                                                    <?php foreach($locaistrabalho as $row){ ?>
                                                        <?php if ($row == $ds_localtrabalho){?> 
                                                        <input type="text" id="cpf" name="cpf" maxlength="11" size="11" value="<?php echo $row ;?>" readonly />                                                        
                                                        <?php }?>
                                                    <?php } ?>                                                    
                                                
                                            </div>

                                            <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-edit"></i>
                                            </span>
                                            <span>Cargo/Função</span>
                                        </label>
                                        <input type="text" name="cargo" value="<?php echo $ds_cargo; ?>" class="form-group-input" placeholder="Cargo ou função"  readonly />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-circle"></i>
                                            </span>
                                            <span>N. conselho</span>
                                        </label>
                                        <input type="text" id="conselho" name="conselho" value="<?php echo $nr_conselho; ?>" class="form-group-input" placeholder="Número do conselho, somente para técnicos" readonly />
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
                                        <input class="form-group-input" name="cirurgia" id="cirurgia" value="<?php echo $sn_cirurgia; ?>" placeholder="Sim ou não" readonly />
                                    </div>
                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-calendar"></i>
                                            </span>
                                            <span>
                                                Cir.Especial.</span>
                                        </label>
                                        <input id="especialidade" name="especialidade" class="form-group-input" placeholder="Cirurgia / Especialidade"  value="<?php echo $ds_especialidade; ?>" readonly />
                                    </div>

                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-calendar"></i>
                                            </span>
                                            <span>
                                                P.Estag/Resid.</span>
                                        </label>
                                        <input class="form-group-input" id="estagresidper" name="estagresidper" value="<?php echo $ds_estagresidper; ?>" placeholder="Estágio / residência, informar período" readonly />
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
                                                <input type="text" class="form-group-input" name="admissao" id="admissao" value="<?php echo $dt_admissao;?>" placeholder="Data de admissão" readonly />
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
                                        <input name="horario" class="form-group-input" id="horario" name="horario" placeholder="Horário de trabalho" value="<?php echo $ds_horario; ?>" readonly />
                                    </div>

                                    <div class="form-group pl-0">
                                        <label class="form-group-label col-2">
                                            <span class="icon">
                                                <i class="fa-wrapper far fa-user"></i>
                                            </span>
                                            <span>Perfil idêntico</span>
                                        </label>
                                        <input class="form-group-input" id="perfilsimilar" name="perfilsimilar" value="<?php echo $ds_perfilsimilar; ?>" placeholder="Login ou Nome completo de outro usuário com perfil similar" readonly />
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
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="ativo" name="ativo" value="<?php echo $sn_ativo; ?>" class="form-group-input" placeholder="Ativo"  readonly />
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
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="rede" name="rede" value="<?php echo $sn_rede; ?>" class="form-group-input" placeholder="Ativo"  readonly />
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
                                        <input type="<?php if (!isProfileAdmin()){ ?>hidden<?php } else { ?>text<?php } ?>" id="usuario" name="usuario" value="<?php echo $cd_usuario; ?>" class="form-group-input" placeholder="Usuario"  readonly />
                                    </div>
                                    
                                    <p>
                                    <br>Itens selecionados
                                    
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
                                    <div class="space"></div>
                                    <div class="btn-group u-pull-right">
                                        
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

 