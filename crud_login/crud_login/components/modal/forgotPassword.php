<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="forgotPasswordForm" method="post" action="<?php echo MODULES_URL; ?>users/forgot_password.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="forgotPasswordLabel">Recuperar Senha</h4>
                </div>

                <div class="modal-body">
                    <!-- Etapa 1: Solicita e-mail -->
                    <div id="step-email">
                        <p>Informe seu e-mail cadastrado no sistema:</p>
                        <div class="form-group">
                            <input type="email" name="email" id="forgotEmail" class="form-control" placeholder="Digite seu e-mail" required>
                        </div>
                    </div>

                    <!-- Campo hidden para guardar email validado -->
                    <input type="hidden" id="hiddenEmail" name="email" value="">

                    <!-- Campo hidden para guardar id do usuário -->
                    <input type="hidden" id="hiddenUserId" name="user_id" value="">

                    <!-- Etapa 2: Nova senha (inicialmente oculto) -->
                    <div id="step-password" style="display: none;">
                        <div class="form-group">
                            <label for="new_password">Nova Senha</label>
                            <div class="password-wrapper input-group">
                                <input type="password" id="new_password" name="password" class="form-control" />
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default toggle-password" data-target="#new_password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </span>
                            </div>
                            <div id="passwordStrength" class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmar Senha</label>
                            <div class="input-group">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default toggle-password" data-target="#confirm_password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </span>
                            </div>
                            <div id="confirmStrength" class="help-block"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnSubmitForgot" class="btn btn-primary">Confirmar</button>
                    </div>
            </form>
        </div>
    </div>
</div>