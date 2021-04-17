<style>
    td { max-width: 150px !important; overflow: overlay; font-size: 12px;  }
</style>
<table data-code="<?php echo $define["code"]; ?>" id="record-table" class="table table-striped table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>ID</th>
        <?php foreach (json_decode($define["modules"]["components"])->crud as $item): ?>
            <?php if ($item->table === "active"): ?>
                <th><?php echo $item->title; ?></th>
            <?php endif; ?>
        <?php endforeach; ?>
        <th>Date</th>
        <th>Operation</th>
    </tr>
    </thead>
</table>