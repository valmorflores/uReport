<div class="header header-fixed unselectable header-animated">

<?php echo view('Design/head_brand'); ?>

      <section class="section">
         <div class="hero fullscreen">
            <div class="hero-body">
               <div class="content">
                     <div class="text-center">
                        <h1>Lista de Pacientes</h1>
                        <p>A seguir você pode selecionar alguém conforme sua necessidade</p>
                     </div>
                     <div class="data">
                     <table class="table app-text">
                        <thead>
                           <tr>
                              <th style="width: 150px;"></th>
                              <th style="width: 250px;"> </th>   
                              <th style="width: 50px;"></th>
                              <th style="width: 50px;"></th>
                              <th style="width: 150px;"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($resultDatarecord as $row) { ?>
                           <tr>
                              <td><?php echo $row->CD_PACIENTE; ?></td>
                              <td class="u-text-left "><?php echo $row->NM_PACIENTE; ?></td>
                              <td>
                                 <?php /* if ($row->SN_ATIVO=='N') { ?>
                                 <span class="tag tag--dark text-light">Inativo</span>
                                 <?php } else if ($row->TP_PRIVILEGIO!='U' && $row->TP_PRIVILEGIO!='') { ?>
                                 <span class="tag tag--dark text-light"></span>
                                 <?php } */ ?>
                              </td>
                              <td>                                 
                                 <a href="<?php echo base_url();?>/public/search/select/<?php echo $row->CD_PACIENTE; ?>">
                                 <span class="icon"><icon class="fa fa-check-circle">Selecionar</icon></span>
                                 </a>
                              </td>
                              <td></td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
              </div>
           </div>
         </div>
      </section>
