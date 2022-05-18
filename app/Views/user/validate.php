<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
         
      <section class="section">
         <div class="hero">
            <div class="hero-body">
               <div class="content">
                  <div class="text-center">
                     <h1>Validação</h1>
                     <p>A seguir você verá a lista de critério para validar o registro de usuário, caso algum item esteja faltando, edite para corrigir.</p>
					 <div class="form-section u-text-left">
                                <div class="m-1 u-inline-block">
                           <div class="r"><h6 class="font-alt">Usuários</h6>
                           <div class="r" style="overflow-x:scroll">
                           <table class="table"><thead><tr>
                              <th><abbr title="Title1">Id</abbr></th>
                              <th style="width: 80%" class="u-text-left "><abbr title="Title2" >Descrição</abbr></th>
                              <th><abbr title="Title3">Situação</abbr></th>
                              
                           </tr>
                              </thead><tfoot><tr>
                              
                           </tr></tfoot>
                           <tbody>
                              
                           <?php foreach( $validate as $row ){ ?>
                              <tr>
                                 <th><?php echo $row[0]; ?></th>                                 
                                 <td class="u-text-left"><?php echo $row[1]; ?></td>
                                 <td>
                                 <?php if ($row[2]) { ?>
                                    <span class="tag tag--success text-light">Correto</span>
                                    
                                 <?php } else { ?>
                                    <span class="tag tag--danger text-light">Erro</span>
                                 <?php } ?>
                                 </td>                                 
                                                             
                              </td>

                              </tr>
                           <?php } ?>
                           </tbody></table>
                           <div class="form-section u-text-right">
                
                        <P class="u-right"><form action="<?php echo base_url();?>/public/user/validateById/<?php echo $id;?>">
						<a href="<?php echo base_url();?>/public/user/edit/<?php echo $id;?>">Editar</a>			    
                        <button class="btn-info">
	                                        Revalidar
                                    	</button>
                                        


									   </form>
                                    </P>
 
                 
               
            </div>
                        </div></div>   
                        </div>
                            </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
</div>

