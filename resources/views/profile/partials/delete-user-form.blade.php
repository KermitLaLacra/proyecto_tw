<section class="card-profile">
    <header>
        <h2 class="titulo-profile text-danger">Eliminar Cuenta</h2>
        <p class="texto-profile">Una vez que tu cuenta sea eliminada, todos sus recursos, aportes y datos guardados en SenderoGuía se borrarán permanentemente. Por favor, descarga tus datos antes de proceder.</p>
    </header>

    <button type="button" class="btn-danger-profile" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Dar de Baja Cuenta
    </button>

    <div class="modal fade @if($errors->userDeletion->isNotEmpty()) show @endif" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" @if($errors->userDeletion->isNotEmpty()) style="display: block; background: rgba(0,0,0,0.5);" @endif>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title modal-profile-title" id="modalLabel">¿Seguro que deseas eliminar tu cuenta?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @if($errors->userDeletion->isNotEmpty()) onclick="this.closest('.modal').style.display='none'" @endif></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small">Esta acción no se puede deshacer. Para confirmar la eliminación definitiva, introduce tu contraseña actual en el campo inferior.</p>
                        
                        <div class="mt-3">
                            <label for="password" class="label-profile visually-hidden">Contraseña</label>
                            <input id="password" name="password" type="password" class="input-profile @error('password', 'userDeletion') is-invalid @enderror" placeholder="Introduce tu contraseña para confirmar">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0 d-flex gap-2">
                        <button type="button" class="btn btn-create btn-cancel" data-bs-dismiss="modal" @if($errors->userDeletion->isNotEmpty()) onclick="this.closest('.modal').style.display='none'" @endif>Cancelar</button>
                        <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold" style="border-radius: 4px;">Confirmar Eliminación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>