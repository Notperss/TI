<!-- Modals add menu -->
<div id="modal-form-edit-password-{{ auth()->user()->id }}" class="modal fade" tabindex="-1"
  aria-labelledby="modal-form-edit-password-{{ auth()->user()->name }}-label" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="updatePassword" action="{{ route('backsite.profile.store') }}" method="post">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-edit-password-{{ auth()->user()->id }}-label">Change Password
          </h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
        </div>

        <div class="modal-body">
          <div class="form-group my-2">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control"
              placeholder="Enter your current password">
          </div>
          <div class="form-group my-2">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
          </div>
          <div class="form-group my-2">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
              placeholder="Enter confirm password">
          </div>

          <div class="form-group my-2 d-flex justify-content-end">
            <a onclick="updatePassword()" class="btn btn-primary">Save Changes</a>
          </div>
        </div>

      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
