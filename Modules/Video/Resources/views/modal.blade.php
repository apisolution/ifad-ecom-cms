<div class="modal fade" id="store_or_update_modal" tabindex="-1" role="dialog" aria-labelledby="model-1" aria-hidden="true">
    <div class="modal-dialog" role="document">

      <!-- Modal Content -->
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h3 class="modal-title text-white" id="model-1"></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <!-- /modal header -->
        <form id="store_or_update_form" method="post">
          @csrf
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="update_id" id="update_id"/>
                    <x-form.selectbox labelName="Category Name" name="gallery_category_id" required="required" col="col-md-12"
                        class="selectpicker">
                        @if (!$gallery_categories->isEmpty())
                        @foreach ($gallery_categories as $gallery_categorie)
                        <option value="{{ $gallery_categorie->id }}">{{ $gallery_categorie->name }}</option>
                        @endforeach
                        @endif
                    </x-form.selectbox>
                    <x-form.textbox labelName="Video Title" name="name" required="required" col="col-md-12" placeholder="Enter Video Title"/>
                    <x-form.textbox labelName="Video Link" name="video_link" required="required" col="col-md-12" placeholder="Enter Video Link"/>

                    <div class="form-group col-md-12">
                        <label for="video">Product Video</label>
                        <input type="hidden" name="old_video" id="old_video" class="fileName">
                        <input type="file" name="video" id="video">
                    </div>
                </div>
            </div>
            <!-- /modal body -->

            <!-- Modal Footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-sm" id="save-btn"></button>
            </div>
            <!-- /modal footer -->
        </form>
      </div>
      <!-- /modal content -->

    </div>
  </div>