<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#formResetPassword{{ $id }}">
        <i class="fas fa-lock-open"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formResetPassword{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="{{ route('users.reset-password') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ketika Password User di reset, maka password defaultnya adalah <strong>12345678</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reset Password</button>
                </div>
            </div>
         </div>
       </form>
    </div>
</div>