<?php if (isset($_SESSION['succes_message'])) : ?>
                    <div class="relative px-4 py-3 mx-auto text-green-700 bg-green-100 border border-green-400 rounded w-fit" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline"><?= $_SESSION['succes_message'] ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            
                        </span>
                    </div>
                    <?php unset($_SESSION['succes_message']) ?>
                <?php endif ?>

                <?php if (isset($_SESSION['succes_error'])) : ?>
                    <div class="relative px-4 py-3 mx-auto text-red-700 bg-green-100 border border-red-400 rounded w-fit" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            
                        </span>
                    </div>
                    <?php unset($_SESSION['succes_message']) ?>
                <?php endif ?>