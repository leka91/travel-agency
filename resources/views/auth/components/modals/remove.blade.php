<!-- The modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">
                    Remove Confirmation
                </h4>
            </div>
            <form action="{{ route('admin.removeTour') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>
                        Are you sure you want to remove this Tour?
                    </p>
                    <input type="hidden" name="tour_id" id="tour_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm">
                        Remove
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div> 
            </form>
        </div>
    </div>
</div>
<!-- End modal -->