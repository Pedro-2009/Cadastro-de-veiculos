<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <form id="forgotPasswordForm" method="post" action="<?php echo MODULES_URL; ?>users/forgot_password.php">

        <!-- Cabeçalho -->
        <div class="modal-header">
          <h5 class="modal-title" id="forgotPasswordLabel">Recuperar Senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <!-- Corpo -->
        <div class="modal-body">
          <!-- Etapa 1: Solicita e-mail -->
          <div id="step-email">
            <p class="small text-muted">Informe seu e-mail cadastrado:</p>
            <div class="mb-3">
              <input type="email" name="email" id="forgotEmail" class="form-control" placeholder="Digite seu e-mail" required>
            </div>
          </div>

          <input type="hidden" id="hiddenEmail" name="email" value="">
          <input type="hidden" id="hiddenUserId" name="user_id" value="">

          <!-- Etapa 2: Nova senha -->
          <div id="step-password" style="display: none;">
            <div class="mb-3">
              <label for="new_password" class="form-label">Nova Senha</label>
              <div class="input-group">
                <input type="password" id="new_password" name="password" class="form-control" />
                <span class="input-group-text p-0">
                  <button type="button" class="btn btn-outline-secondary border-0 h-100" data-target="#new_password">
                    <i class="fa fa-eye"></i>
                  </button>
                </span>
              </div>
              <div id="passwordStrength" class="form-text small"></div>
            </div>

            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirmar Senha</label>
              <div class="input-group">
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                <span class="input-group-text p-0">
                  <button type="button" class="btn btn-outline-secondary border-0 h-100" data-target="#confirm_password">
                    <i class="fa fa-eye"></i>
                  </button>
                </span>
              </div>
              <div id="confirmStrength" class="form-text small"></div>
            </div>
          </div>
        </div>

        <!-- Rodapé -->
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" id="btnSubmitForgot" class="btn btn-primary">Confirmar</button>
        </div>

      </form>
    </div>
  </div>
</div>
