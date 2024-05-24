<section class="py-3 px-2 flex flex-row justify-between items-center ">
    <div class="w-full lpcpt_section dropdown-check-list inline-block relative" tabindex="100">
        <span class="block font-['landform'] anchor relative cursor-pointer py-[5px] md:pr-[200px] pl-[10px] border-y border-<?= $color ?> text-<?= $color ?> font-bolder after:border-t-2 after:border-l-2 after:border-t-<?= $color ?> after:border-l-<?= $color ?> ">
            <?= strtolower($title) ?>
        </span>
        <ul class="items absolute z-[9999] w-full bg-white">
            <?php foreach(lpcpt_get_taxonomy($taxonomy) as $key => $value): ?>
            <li class="hover:bg-slate-100 ">
                <div class="flex items-center">
                    <label for="<?=$slug?>-checkbox-<?=$key?>" class="lpcpt_input text-sm font-medium text-<?= $color ?> w-full px-2 cursor-pointer flex flex-row items-center">
                        <input <?= lpctp_check_query_params($taxonomy, $value); ?> id="<?=$slug?>-checkbox-<?=$key?>" type="checkbox" value="<?= $value ?>" data-id="<?=$value?>" data-type="<?=$slug?>" class="w-4 h-4 text-<?= $color ?> ring-offset-<?= $color ?> bg-white checked:bg-<?= $color ?> border-<?= $color ?> focus:ring-<?= $color ?> focus:ring-1">
                        <span class="mx-2 font-['landform']">
                            <?= ucfirst($value) ?>
                        </span>
                    </label>
                </div>
            </li>
            <?php endforeach; ?>
            <li>
                <div class="lpcpt_submit relative inline-flex items-center justify-center py-1 px-2 m-2 overflow-hidden text-sm font-medium text-<?= $color ?> border border-<?= $color ?> hover:bg-<?= $color ?> hover:text-white">
                    <button class="m-0 p-0 font-['landform']">Filtrar</button>
                </div>
            </li>
        </ul>
    </div>
</section>