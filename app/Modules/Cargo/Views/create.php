<div class="modal" style="display: flex;">
    <div class="modal-content" style="max-width: 500px; width: 100%;">
        <div class="modal-header">
            <h2>Create Cargo</h2>
            <button type="button" class="modal-close" hx-close>×</button>
        </div>
        <div class="modal-body">
            <form id="cargo-form" hx-post="/cargo" hx-target="#cargo-list" hx-swap="prepend">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="number">Cargo Number</label>
                    <input type="text" id="number" name="number" class="form-control" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="sender_name">Sender</label>
                        <input type="text" id="sender_name" name="sender_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient_name">Recipient</label>
                        <input type="text" id="recipient_name" name="recipient_name" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost (₽)</label>
                        <input type="number" id="cost" name="cost" class="form-control" step="0.01" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Create</button>
            </form>
        </div>
    </div>
</div>