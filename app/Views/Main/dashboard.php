<?php 
   if ($filter_solicitante==null){ 
      $params_extra = '';
   } else { 
      $params_extra = '&solicitante=' . $filter_solicitante;
   } 
   $params = '&page=0' . $params_extra; 
?>


<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>

      <section class="section">
         <div class="hero ">
            <div class="hero-body">
               <div class="content">
                  <div class="">
                     <div class="text-center">
                        <h1>Relatórios</h1>
                        <p>A seguir você pode selecionar entre as ferramentas gerenciais sobre relatórios</p>
                     </div>
                     <div class="row">
					         <div class="form-section u-text-left">
                           <div class="m-1 u-inline-block">
                              <div class="r">
                                 <?php foreach ($routes as $row){?>
                                    <br><br><a class="btn btn-secondary" href="<?php echo $row[2]; ?>"><?php echo $row[1]; ?></a>
                                 <?php } ?>
                              <div class="r" style="overflow-x:scroll">
                                 <table class="app-text table">
                                    <thead>
                                       <tr>
                                          <th><abbr title="Title1">Id</abbr></th>
                                          <th><abbr title="Title1"> </abbr></th>
                                          <th class="u-text-left "><abbr title="Title2" >Nome</abbr></th>
                                          <th><abbr title="Title3">CPF</abbr></th>
                                          <th><abbr title="Title4">Usuario</abbr></th>
                                          <th><abbr title="Title5">Solicitante</abbr></th>
                                          <th><abbr title="Short">Ativo</abbr></th>
                                          <th>Situação</th>
                                          <th style="width: 150px;">Ações</th>   
                                       </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                       </tr>
                                    </tfoot>
                                    <tbody>
                           <?php foreach( $datatable as $row ){ ?>
                              <tr>
                                 <th><?php echo $row->CD_ID; ?></th>
                                 <th>
                                    <?php if ( $row->CD_USUARIO=='*PRESTADOR*' ) { ?>
                                       <i class="fa fa-user-md"></i>
                                    <?php } else if ( $row->CD_TIPO == '000' ) { ?>
                                       <i class="fa fa-user"></i>
                                    <?php } else { ?>
                                       <i class="fa fa-file"></i>
                                    <?php } ?>
                                 </th>
                                 <td class="u-text-left"><?php echo $row->DS_NOME; ?></td>
                                 <td><?php echo $row->CPF; ?></td>
                                 <td><div class="<?php if ($row->CD_USUARIO=='*PRESTADOR*'){ ?>tag tag--dark<?php }?>"><?php echo $row->CD_USUARIO; ?></div></td>
                                 <td><?php echo $row->DS_SOLICITANTE; ?></td>
                                 <td><?php echo $row->SN_ATIVO; ?>, <?php echo $row->SN_REDE; ?> </td>
                                 <td><?php if ($row->SN_VALIDADO=='N' && ($row->SN_ATIVO=='N') ) { ?>
                                    <?php if ( $row->CD_TIPO == '000' ) { ?>
                                    <a href="<?php echo base_url();?>/public/user/validateById/<?php echo $row->CD_ID; ?>">
                                    <span class="tag tag--danger text-light" title="Clique aqui para validar ou em edição e preencha os dados que faltam">Validar</span>
                                    </a>
                                    <?php } else if ( $row->CD_TIPO == '003' ) { ?>
                                    <a href="<?php echo base_url();?>/public/provider/validateById/<?php echo $row->CD_ID; ?>">
                                    <span class="tag tag--danger text-light" title="Clique aqui para validar ou em edição e preencha os dados que faltam">Validar</span>
                                    </a>                                    
                                    <?php } else { ?>
                                    <a href="<?php echo base_url();?>/public/userrequirement/validateById/<?php echo $row->CD_ID; ?>">
                                    <span class="tag tag--danger text-light">Validar</span>
                                    </a>
                                    <?php }  ?>

                                    <?php } else if ($row->SN_ATIVO=='S') { ?>
                                       <?php if ( $row->CD_TIPO == '000' ) { ?>
                                          <?php if ( $row->SN_REDE == '*' ) { ?>
                                             <span class="tag tag--success text-light" title="Usuário habilitado em todas as solicitações">Ativo</span>
                                          <?php } else if ( $row->SN_REDE == 'S' ) { ?>                                             
                                            <span class="tag tag--success text-light" title="Usuário habilitado em todas as solicitações">Ativo</span>
                                          <?php } else if ( $row->SN_REDE == 'P' ) { ?>
                                             <div class="btn-group u-pull-center">
                                             <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>">
                                             <span class="tag tag--info text-light" title="Está habilitado nos sistemas">Ativo</span>
                                             </a>
                                             <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>">
                                             <span class="tag tag--warning text-dark" title="Falta criar senha da internet. Clique para ler os comentários"><i class="fa fa-exclamation-triangle"></i>&nbsp;Internet</span>
                                             </a>
                                             </div>
                                          <?php } else { ?>
                                             <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>">
                                             <span class="tag tag--info text-light" title="Usuário habilitado nos sistemas">Ativo</span>
                                             </a>
                                          <?php }  ?>
                                       <?php } else { ?>
                                          <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>"> 
                                          <span class="tag tag--info text-light">Realizado</span>
                                          </a>
                                       <?php } ?>
                                    <?php } else if ($row->SN_ATIVO=='*') { ?>
                                       <?php if ( $row->CD_TIPO == '000' ) { ?>
                                       <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>">
                                       <span class="tag tag--warning text-dark" title="Existem dados faltando, leia os comentários"><i class="fa fa-exclamation-triangle"></i>&nbsp;Pendência</span>
                                       </a>
                                       <?php } else { ?>
                                       <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>">
                                       <span class="tag tag--warning text-light"><i class="fa fa-exclamation-triangle"></i>&nbsp;Pendência</span>
                                       </a>
                                       <?php } ?>                                    
                                    <?php } else { ?>
                                       <?php if ( $row->CD_TIPO == '000' ) { ?>
                                       <span class="tag tag--dark text-light" title="Equipe da TI está realizando esta solicitação">Processando</span>
                                       <?php } else { ?>
                                       
                                       <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>">
                                       <span class="tag tag--dark text-light">Requerimento</span>
                                             </a>
                                       <?php } ?>
                                    <?php } ?>
                                    
                                 </td>
                                 <td>  
                                 
                                 <?php if ($row->SN_VALIDADO=='N') { ?>
                                    <?php if ( $row->CD_TIPO == '000' ) { ?>
                                       <?php if ($row->SN_ATIVO=='S' && ($row->SN_REDE=='S'||$row->SN_REDE=='*')) { ?>
                                        <?php if ($row->COMMENTS>0) { ?>
                                          <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>"><icon class="fa fa-comment text-info" title="Comentários"></i></a>
                                        <?php } 
                                       } else { ?>
                                       <a href="<?php echo base_url();?>/public/user/validateById/<?php echo $row->CD_ID; ?>" class="validate text-danger" id="validate" name="validate">
                                          <i class="fa fa-exclamation-triangle"></i></a> 
                                       <?php } ?>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url();?>/public/userrequirement/validateById/<?php echo $row->CD_ID; ?>" class="validate text-danger" id="validate" name="validate">
                                    <i class="fa fa-exclamation-triangle"></i></a> 
                                    <?php } ?>
                                 <?php } else if ($row->SN_ATIVO=='S') { ?>
                                    <?php if ($row->COMMENTS>0) { ?>
                                       <a href="<?php echo base_url();?>/public/userrequirement/comments/<?php echo $row->CD_ID; ?>"><icon class="fa fa-comment text-info" title="Comentários"></i></a>
                                    <?php } else { ?>
                                        <i class="fa fa-check-double text-info"></i></a> 
                                    <?php } ?>
                                 <?php } else { ?>
                                    <i class="fa fa-check text-info"></i></a> 
                                 <?php } ?>
                                 
                                 <?php if ( $row->CD_TIPO == '000' ) { ?>
                                    <a href="<?php echo base_url();?>/public/user/edit/<?php echo $row->CD_ID; ?>"><span class="icon">
                                                        <i class="fa-wrapper far fa-edit" title="Editar"></i>Editar
                                                    </span></a>
                                    <?php } else { ?>
                                       <?php if ($row->CD_USUARIO=='*PRESTADOR*') { ?>
                                          <a href="<?php echo base_url();?>/public/user/edit/<?php echo $row->CD_ID; ?>"><span class="icon">
                                                        <i class="fa-wrapper far fa-edit" title="Editar"></i>Editar
                                                    </span></a>
                                       <?php } else { ?>
                                          <a href="<?php echo base_url();?>/public/userrequirement/edit/<?php echo $row->CD_ID; ?>"><span class="icon">
                                                        <i class="fa-wrapper far fa-edit" title="Editar"></i>Editar
                                                    </span></a>
                                       <?php }  ?>
                                    <?php }  ?>
                                 
                                 
                                 <?php if ($row->SN_ATIVO=='N') { ?>
                                    <a href="#basic-modal" class="excluir" id="excluir" name="excluir" data-target="#confirma-deletar" data-href="id=<?php echo $row->CD_ID . ';' . $row->DS_NOME; ?>">
                                    <i class="fa fa-trash-alt"></i></a>
                                 <?php } else { ?>
                                    <i class="fa fa-trash-alt text-gray-500"></i>
                                 <?php } ?>
                                 
                              
                                 
                              </td>

                              </tr>
                           <?php } ?>
                           </tbody></table>
                        
                        </div></div>   
                        </div>
                            </div>
                  </div>
                  <br>
                  <?php if ($maxpage>0) { ?>
                     <div class="pagination">
                  <?php } ?>
                  <?php $start = 0;
                  if ($page>10) {
                     $start=$page-10;
                  } 
                  ?>
                  <?php if ($start>0){ ?>
                     <?php $params = 'limit=' . $limit . '&page=' . ($page-1) . $params_extra; ?>
                     <div class="pagination-item short"><a href="dashboard?<?php echo $params;?>">Anterior</a></div>
                  <?php } ?>
                  <?php $items = 0; ?>
                  <?php for ($i = $start; $i < $maxpage; ++$i){?>
                     <?php 
                     $params = 'limit=' . $limit . '&page=' . $i . $params_extra;
                     ?>
                     <div class="pagination-item short <?php if ($i == $page){ echo 'selected'; } ?> "><a href="dashboard?<?php echo $params;?>"><?php echo $i+1; ?></a></div>
                     <?php if ((++$items>10)&& ($page+1<$maxpage)){ ?>
                        <?php $params = 'limit=' . $limit . '&page=' . ($page+1); ?>                        
                        <div class="pagination-item short"><a href="dashboard?<?php echo $params;?>">Próxima</a></div>
                        <?php break; ?>
                     <?php } ?>
                  <?php } ?>


<?php /*
                  <div class="pagination">
                     <div class="pagination-item short disabled"><a href="!#" class="disabled">Anterior</a></div>
                     <div class="pagination-item short selected"><a href="!#">1</a></div>
                     <div class="pagination-item short"><a href="dashboard?limit=25&page=2">2</a></div>
                     <div class="pagination-item short"><a href="!#">3</a></div>
                     <div class="pagination-item short"><a href="!#">4</a></div>
                     <div class="pagination-item short"><a>...</a></div>
                     <div class="pagination-item short"><a href="!#">13</a></div>
                     <div class="pagination-item short"><a href="!#">Próxima</a></div>
                  </div>
*/ ?>

<?php if ($maxpage>0) { ?>
</div>
<?php } ?>

               </div>
            </div>
         </div>
      </section>
</div>
</div>

<div class="modal modal-animated--zoom-in" id="basic-modal">
    <a href="#searchModalDialog" class="modal-overlay close-btn" aria-label="Close"></a>
    <div class="modal-content" role="document">
        <div class="modal-header"><a href="#components" class="u-pull-right" aria-label="Close"><span class="icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11 fa-wrapper" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></span></a>
            <div class="modal-title">Excluir</div>
        </div>
        <form action="<?php echo base_url() . '/public/user/delete';?>" method="post">
        <div class="modal-body">
            <div class="r">
                <h3 class="font-alt font-light u-text-center">Confirma a exclusão do registro? </h3></div>
            
                <div class="space"></div>
            <p><input id="to_exclude" name="to_exclude" class="to_exclude" readonly></input> </p>
                <div class="divider"></div>

            
        </div>
        <div class="modal-footer">
            <div class="form-section u-text-right">
                <a href="#components" class="u-inline-block" >
                     Cancelar 
                </a>
                
                <!--a href="#components"-->              
                    <button class="btn-danger btn-small u-inline-block" id="btn-ok" name="btn-ok">Confirmar Exclusão</button>
                <!--/a-->
               
            </div>
        </div>
        </form>
    </div>
</div>



<script>
 
// Link inicial de exclusão 
$('.excluir').on('click', function(e) {
       console.log('clicado excluir');
       console.log( $(e.relatedTarget).data('data-href') );
   $(this).find('.excluir').attr('href', $(e.relatedTarget).data('href'));
   var info = $(this).attr('data-href');
   console.log($(this).attr('data-href'));
   console.log($(this));
   $(".to_exclude").val(info);
   //var dataID = element.getAttribute('data-id');
   $(".to_exclude").attr('data-href');
   //$(this).find('.to_exclude').attr('text', 'VALMOR FLORES');
});

$('#btn-ok').on('click', function(e) {
       console.log('clicado');
       console.log( $(e.relatedTarget).data('data-href') );
   $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

document.addEventListener('keyup', function(e) {
    if(e.key === "Escape") {
        const modals = document.querySelectorAll('.modal-overlay');
        for (const modal of modals) {
            modal.click();
        }
    }
});

</script>