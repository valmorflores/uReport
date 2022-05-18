<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
         <div class="hero ">
            <div class="hero-body">
               <div class="content">

               <div class="placeholder">
    <div class="placeholder-icon"><span class="icon"><i class="fa fa-wrapper fa-user x-large"></i></span></div>
    <h1>Estatística de usuário</h1>
    <div class="placeholder-subtitle">Abaixo você tem as informações específicas sobre o login de usuário selecionado. </div>
    <div class="placeholder-commands u-text-left">
        <div class="form-group">
           <table>
               <tr>
                   <td>Username</td>
                   <td><?php echo $username; ?></td>
                </tr>
                <?php foreach ($userrecord as $row){ ?>
                    <tr>
                    <td>Atendimento</td>
                    <td><?php echo $row->CD_ATENDIMENTO; ?></td>
                    </tr>

                    <tr>
                    <td>Nome</td>
                    <td><?php echo $row->NM_USUARIO; ?></td>
                    </tr>                    
                     
                     
                <?php } ?>
                    <tr>
                    <td>Existe usuário no MV</td>
                    <td>
                    <?php 
                        if (isset($userrecord)){ 
                            if (count($userrecord)>0){
                                echo 'Sim';
                            } else {
                                echo 'Não';
                            }
                        } else {
                            echo 'Não';
                        }
                         ?></td>
                    </tr>
                    <tr>
                    <td>Existe usuário no pMed</td>
                    <td>
                    <?php 
                        if (isset($userpmedrecord)){ 
                            if (count($userpmedrecord)>0){
                                echo 'Sim';
                            } else {
                                echo 'Não';
                            }
                        } else {
                            echo 'Não';
                        }
                         ?></td>
                    </tr>
                    <tr>
                    <td>Existe usuário na rede</td>
                    <td>
                    <?php 
                        //if ($useractivedirectory['count']>0){ 
                        if ($useractivedirectoryExact){
                            echo 'Sim';
                        } else {
                            echo 'Não';
                        }
                         ?>
                    </td>
                    </tr>
           
                </table>
                
            </div>
            <a href="<?php echo base_url();?>/public/userrequirement/new/<?php echo $username;?>"><button class="btn btn-dark">FAZER NOVO REQUERIMENTO VINCULADO</button></a>
        </div></div>
           
           <?php if (isProfileAdmin()){?>
            
            <h2>Área administrativa</h2>
           <p>Os dados a seguir são sigilosos e visíveis apenas para equipe médica e assistencial, com habilitação específica</p>
           <div class="placeholder">
           <div class="placeholder-commands u-text-left">
           <h6>Dados básicos</h6>    
    
        <div class="form-group">           
           <table><?php foreach ($userrecord as $row){ ?>
                    <td>Atendimento</td>
                    <td><?php echo $row->CD_ATENDIMENTO; ?></td>
                    <td>
                    <a href="<?php echo base_url();?>/public/report/rviewatend/rel_mapa_dieta_por_atendimento_validade/<?php echo $row->CD_ATENDIMENTO; ?>">Relatório de mapa de dieta</a>
                    </tr>
                    <tr>
                    <td>Data de Atendimento</td>
                    <td><?php echo $row->DT_ATENDIMENTO; ?></td>
                    </tr>
                    <tr>
                    <td>Alta</td>
                    <td><?php echo $row->DT_ALTA_MEDICA; ?></td>
                    </tr>                    
                  <?php }  ?>           
           </table>       
           </div>
           </div></div>
           <?php } ?>
        </div>
           </DIV>
    </selection>
    
</div>