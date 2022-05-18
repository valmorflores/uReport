<div class="hero fullscreen">
    <div class="hero-body">
        <div style="margin: auto">
            <form class="frame p-0"
                action="<?php echo base_url();?>/public/internalusers/post/<?php echo $cd_usuario; ?>" method="post">
                <div class="frame__body p-0">
                    <div class="row p-0 level fill-height">
                        <div class="col">
                            <div class="space xlarge"></div>
                            <div class="padded">
                                <h1 class="u-text-center u-font-alt">Usuário</h1>
                                <div class="divider"></div>
                                <p class="u-text-center">Usuário habilitado.</p>
                                <div class="divider"></div>
                                <div class="form-group">
                                    <label class="form-group-label col-2">
                                        <span class="icon">
                                            <i class="fa-wrapper far fa-user"></i>
                                        </span>
                                        <span>Login</span>
                                    </label>

                                    <span><label type="text" id="nome" class="form-group-input"
                                            placeholder="Usuario"><strong><?php echo $cd_usuario; ?></strong></label></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-group-label col-2">
                                        <span class="icon">
                                            <i class="fa-wrapper far fa-user"></i>
                                        </span>
                                        <span>Nível de poderes</span>
                                    </label>
                                    <?php if ($sn_administrador=="S"){?>
                                    <span class="tag tag--dark text-light">Usuario Administrador</span>
                                    <?php } else { ?>
                                    <span class="tag tag--light text-dark">Usuario Normal</span>
                                    <?php } ?>
                                </div>

                                <div class="space"></div>

                                <div class="btn-group u-pull-right">
                                    <div class="form-ext-control form-ext-checkbox">
                                        <input id="checkAdmin" name="checkAdmin" class="form-ext-input" type="checkbox"
                                            <?php if ($sn_administrador=="S"){?>checked<?php } ?>>
                                        <label class="form-ext-label" for="checkAdmin">Habilitar poder de
                                            administrador</label>
                                    </div>
                                    <div style="width:30px"></div>
                                    <button class="btn-info">ENVIAR</button>
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