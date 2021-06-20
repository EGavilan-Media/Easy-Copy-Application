<!-- Modal -->
<div class="modal fade text-left" id="modalFormApp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormAppLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Add New Text</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formApp" name="formApp" class="form-horizontal">
        <p class="text-danger font-italic">Required *</p>
        <input type="hidden" id="id" name="id" value="">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input type="text" class="form-control valid" placeholder="Enter title" id="title" name="title" maxlength="100" autocomplete="off" onblur="checkTitle()">
          <span id="title_error_message" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label for="message-text" class="col-form-label">Text <span class="text-danger">*</></label>
          <textarea class="form-control valid" placeholder="Enter text" id="text" name="text" rows="10" maxlength="2000" autocomplete="off" onblur="checkText()"></textarea>
          <span id="text_error_message" class="text-danger"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="btnActionForm" class="btn btn-primary" type="submit"><span id="btnText">Save</span></button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>