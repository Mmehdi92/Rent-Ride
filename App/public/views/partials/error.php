
<?php if (isset($errors) && !empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="flex items-center max-w-sm p-4 mx-auto mb-4 text-white bg-red-600 rounded-lg shadow-md">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
