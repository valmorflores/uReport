<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
         <div class="hero">
            <div class="hero-body">
               <div class="content">
                    <div class="text-center">
                       <h1>Lista de usuários internos</h1>
                       <p>A seguir você pode gerenciar os usuários que tem poderes de administração, bem como gerar requisições de senhas e acessos.
                          <br>Nesta lista constam apenas os usuários habilitados a fazer requisições
                       </p>
                    </div>
                 <div class="text">
					 <div class="form-section text-left">
                                <div class="m-1 u-inline-block">
                           <div class="r"><h6 class="font-alt">Usuários</h6>
                           <div class="r" style="overflow-x:scroll">
                           <table class="table text-white"><thead><tr>
                              <th><abbr title="Title1">Id</abbr></th>
                              <th class="u-text-left "><abbr title="Title2" >Login</abbr></th>
                              <th><abbr title="Title3">Situação</abbr></th>
                              <th><abbr title="Title4">Poderes</abbr></th>
                              <th style="width: 150px;">Ações</th>   
                           </tr>
                              </thead><tfoot><tr>
                              
                           </tr></tfoot>
                           <tbody>
                              
                           <?php foreach ($internalusersDatarecord as $row) { ?>

                              <tr>
                                 <th><?php echo $row->CD_ID; ?></th>
                                 <td class="u-text-left "><?php echo $row->CD_USUARIO; ?></td>
                                 <td>
                                 <?php if ($row->SN_ATIVO=='S') { ?>
                                       <span class="tag tag--success text-light">Ativo</span>
                                  <?php } ?>
                                   </td>
                                 <td>
                                     <?php if ($row->SN_ADMINISTRADOR=='S') { ?>
                                    <span class="tag tag--danger text-light">Administrador</span>
                                    <?php } ?>
                                 </td>
                                 <td>  
                                 
                                 <a href="<?php echo base_url();?>/public/internalusers/edit/<?php echo $row->CD_USUARIO; ?>"><span class="icon">
                                                        <i class="fa-wrapper far fa-edit"></i>
                                                    </span></a>
                                 <?php if ($row->SN_ATIVO=='S') { ?>
                                    <a href="#basic-modal" class="excluir" id="excluir" name="excluir" data-target="#confirma-deletar" data-href="id=<?php echo $row->CD_ID . ';' . $row->CD_USUARIO; ?>">
                                 <?php } ?>
                                                                 
                                 <i class="fa fa-trash-alt"></i></a>
                              
                              </td>

                              </tr>
                           <?php } ?>
                           </tbody></table>
                        <P><form action="<?php echo base_url();?>/public/internalusers/searchform">
									    <button class="btn-info">
	                                        Habilitar novo usuário
                                    	</button>
									   </form></P>
                        </div></div>   
                        </div>
                            </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
</div>

<div class="modal modal-animated--zoom-in" id="basic-modal">
    <a href="#searchModalDialog" class="modal-overlay close-btn" aria-label="Close"></a>
    <div class="modal-content" role="document">
        <div class="modal-header"><a href="#components" class="u-pull-right" aria-label="Close"><span class="icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11 fa-wrapper" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></span></a>
            <div class="modal-title">Excluir</div>
        </div>
        <form action="<?php echo base_url() . '/public/internalusers/delete';?>" method="post">
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