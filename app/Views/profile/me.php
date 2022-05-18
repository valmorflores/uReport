<div class="header header-fixed unselectable header-animated">
      <?php echo view('Design/head_brand'); ?>
      <section class="section">
         
         <div class="hero fullscreen">
            <div class="hero-body">
               <div class="content">
                  <div class="text-center">
                     <h1>Perfil : Atualização de senha</h1>
                         <form action="<?php echo base_url(); ?>/public/profile/update" method="post">
                            <p>A seguir você pode modificar sua senha de acesso.</p>
                            <div class="form-section">
                                <label>Usuário</label>
                                <div class="input-control">
                                    <input class="input-contains-icon" id="username" name="username" placeholder="Usuário" type="text" value="<?php echo $username;?>" readonly>
                                    <span class="icon">
                                        <i class="far fa-wrapper fa-user small"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-section">
                                <label>Nova senha</label>
                                <div class="input-control">
                                    <input class="input-contains-icon" id="password" name="password" placeholder="Password" type="password" value="">
                                    <span class="icon">
                                        <i class="fas fa-wrapper fa-key small"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-section u-text-right">
                                <div class="m-1 u-inline-block">
                                    <button class="btn-info">
                                        Atualizar
                                    </button>
                                </div>
                                <div class="m-1 u-inline-block">
                                    <button class="btn-light">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
</div>