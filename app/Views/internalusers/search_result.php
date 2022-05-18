<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
         <div class="hero">
            <div class="hero-body">
               <div class="content">
                  <div class="text-center">
                     <h1>Lista de usuários internos</h1>
                     <p>A seguir você pode gerenciar os usuários que tem poderes de administração para gerar requisições de senhas e acessos</p>
					 <div class="form-section u-text-left">
                                <div class="m-1 u-inline-block">
                           <div class="r"><h6 class="font-alt">Usuários</h6>
                           <div class="r" style="overflow-x:scroll">
                           <table class="table"><thead><tr>
                              <th><abbr title="Title1">Id</abbr></th>
                              <th class="u-text-left "><abbr title="Title2" >Login</abbr></th>
                              <th><abbr title="Title3">Situação</abbr></th>
                              <th><abbr title="Title4">Poderes</abbr></th>
                              <th style="width: 150px;">Ações</th>   
                           </tr>
                              </thead><tfoot><tr>
                              
                           </tr></tfoot>
                           <tbody>
                           <?php $count = 0;
                           $max = 10; ?>   
                           <?php foreach ($resultDatarecord as $row) { ?>
                              <?php if (++$count < $max ) { ?>   
                              <tr>
                                 <th><?php echo $row->CD_USUARIO; ?></th>
                                 <td class="u-text-left "><?php echo $row->CD_USUARIO; ?></td>
                                 <td>
                                 <th><?php echo $row->NM_USUARIO; ?></th>
                                 <td class="u-text-left "><?php echo $row->NM_USUARIO; ?></td>
                                 <td>
                                 
                                 <td class="u-text-left "><?php echo $row->CPF; ?></td>
                                 <td>
                                 <td>
                                    <?php if ($row->SN_ATIVO=='N') { ?>
                                    <span class="tag tag--dark text-light">Inativo</span>
                                    <?php } else if ($row->TP_PRIVILEGIO!='U' && $row->TP_PRIVILEGIO!='') { ?>
                                    <span class="tag tag--danger text-light">Especial: <?php echo $row->TP_PRIVILEGIO; ?></span>
                                    <?php } ?>

                                 </td>
                                 <td>  
                                 
                                 <?php if ($row->SN_ATIVO=='S') { ?>
                                 
                                 <a href="<?php echo base_url();?>/public/internalusers/add/<?php echo $row->CD_USUARIO; ?>"><span class="icon">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </span></a>
                                 <?php } ?>
                                 
                              </td>

                              </tr>
                              <?php } ?>   
                           <?php } ?>
                           </tbody></table>
                        
                        </div></div>   
                        </div>
                            </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
</div>

