
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
        <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient"> </h3>
                <div class="card-body">
                    <form action="<?php echo base_url();?>/public/login/auth" method="post">
                        <div class="content text-dark">
                            <img src="<?php echo base_url();?>/public/logo.png" style="width:150px"></img>
                            <h4> </h4>
                            <?php if ($error==1){ ?>
                                    <div class="toast toast--danger">
                                        <button class="btn-close"></button>
                                        <p><?php echo $message; ?></p>
                                    </div>
                            <?php } ?>
                            <h6 class="font-alt">Digite seu usuário e senha para acessar</h6>
                            <p>Em caso de dúvida, contacte o setor responsável pelos acessos e solicite autorização para este serviço.</p>

                            <div class="divider"></div>

                            <div class="form-section">
                                <label>Usuário</label>
                                <div class="input-control">
                                    <input class="input-contains-icon" id="username" name="username" placeholder="Usuário" type="text" value="">
                                    
                                </div>
                            </div>

                            <div class="form-section">
                                <label>Senha</label>
                                <div class="input-control">
                                    <input class="input-contains-icon" id="password" name="password" placeholder="Password" type="password" value="">
                                    
                                </div>
                            </div>

                            <br><div class="form-section u-text-right">
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Login</button>
                                </div>
                            </div>
                        </div>
                        </form>

                    </div>
                    
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <small class="text-muted">Esqueceu sua senha?
                    <a href="<?php echo base_url();?>/public/login/forgot-password" class="text-info text-gradient font-weight-bold">Clique aqui</a>
                    </small>

                    </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                    <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('<?php echo base_url();?>/public/login.jpg')"></div>
                    </div>
                    </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>