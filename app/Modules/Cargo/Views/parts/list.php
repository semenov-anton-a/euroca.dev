<div class="cargo-list-content">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Sender</th>
                <th>Recipient</th>
                <th>Status</th>
                <th>Weight</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cargos)): ?>
                <?php foreach ($cargos as $cargo): ?>
                    <tr id="cargo-<?= $cargo->id ?? $cargo['id'] ?>">
                        <td><?= $cargo->id ?? $cargo['id'] ?></td>
                        <td><a href="/cargo/<?= $cargo->id ?? $cargo['id'] ?>"><?= esc($cargo->number ?? $cargo['number']) ?></a></td>
                        <td><?= esc($cargo->sender_name ?? $cargo['sender_name']) ?></td>
                        <td><?= esc($cargo->recipient_name ?? $cargo['recipient_name']) ?></td>
                        <td><span class="badge badge-<?= $cargo->status ?? $cargo['status'] ?>"><?= $cargo->status ?? $cargo['status'] ?></span></td>
                        <td><?= esc($cargo->formatted_weight ?? ($cargo->weight ?? '0') . ' kg') ?></td>
                        <td><?= esc($cargo->formatted_cost ?? ($cargo->cost ?? '0') . ' ₽') ?></td>
                        <td>
                            <a href="/cargo/<?= $cargo->id ?? $cargo['id'] ?>/edit" class="btn btn-sm btn-secondary">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No cargo found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>