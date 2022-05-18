<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
         <div class="hero fullscreen">
            <div class="hero-body">
               <div class="content">
                  <div class="text-center">
                     <h1>Lista de usuários internos</h1>
                     <p>A seguir você pode selecionar um usuário para poder gerar uma requisição conforme sua necessidade</p>
					 <div class="form-section u-text-left">
                                <div class="m-1 u-inline-block">
                           <div class="r"><h6 class="font-alt">Usuários</h6>
                           <div class="r" style="overflow-x:scroll">
                           <table class="table"><thead><tr>
                              <th><abbr title="Title1">Id</abbr></th>
                              <th class="u-text-left "><abbr title="Title2" >Login</abbr></th>
                              <th><abbr title="Title3"> </abbr></th>
                              <th><abbr title="Title4"> </abbr></th>
                              <TH></th>
                              <th style="width: 20px;"> </th>   
                              <th style="width: 150px;"> </th>   
                           </tr>
                              </thead><tfoot><tr>
                              
                           </tr></tfoot>
                           <tbody>
                                                         
                           <?php foreach ($resultDatarecord as $row) { ?>
                               
                              <tr>
                                 <td><?php echo $row->CD_USUARIO; ?></td>
                                 <td class="u-text-left "><?php echo $row->CD_USUARIO; ?></td>
                                 <td class="u-text-left "><?php echo $row->NM_USUARIO; ?></td>                               
                                 <td class="u-text-left "><?php echo $row->CPF; ?></td>
                                 
                                 <td>
                                    <?php if ($row->SN_ATIVO=='N') { ?>
                                    <span class="tag tag--dark text-light">Inativo</span>
                                    <?php } else if ($row->TP_PRIVILEGIO!='U' && $row->TP_PRIVILEGIO!='') { ?>
                                    <span class="tag tag--dark text-light">A</span>
                                    <?php } ?>
                                 </td>
                                 <td>  
                                 <a href="<?php echo base_url();?>/public/userrequirement/new/<?php echo $row->CD_USUARIO; ?>"><span class="icon">
                                                        <i class="fa fa-plus-circle"></i>Selecionar
                                                    </span></a>
                                 </td>

                              </tr>
                               
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

