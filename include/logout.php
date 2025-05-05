<!-- log out -->
<div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Log out?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to log out?
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <form action="logout.php" method="post">
            <button type="button" class="btn btn-link me-5" data-bs-dismiss="modal"
              style="text-decoration: none;">No</button>
            <button type="submit" name="submit" class="btn btn-link ms-5" style="text-decoration: none;">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div> 