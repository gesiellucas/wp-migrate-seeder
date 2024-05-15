<section class="p-4 bg-slate-100 text-white flex flex-row justify-between items-center">
    <div class="lpcpt_section dropdown-check-list inline-block relative" tabindex="100">
        <span class="anchor relative cursor-pointer inline-block py-[5px] pr-[200px] pl-[10px] border border-orange-600 text-orange-600">
            <?= $title ?>
        </span>
        <ul class="items absolute z-[9999] w-full bg-slate-100 py-5">
            <?php foreach(lpcpt_get_taxonomy($taxonomy) as $key => $value): ?>
            <li class="hover:bg-orange-100">
                <div class="flex items-center">
                    <label for="<?=$slug?>-checkbox-<?=$key?>" class="lpcpt_input text-sm font-medium text-orange-600 w-full px-2 cursor-pointer flex flex-row items-center">
                        <input id="<?=$slug?>-checkbox-<?=$key?>" type="checkbox" value="" data-id="<?=$value?>" data-type="<?=$slug?>" class="w-4 h-4 text-orange-600 ring-offset-orange-600 bg-white checked:bg-orange-600 border-orange-600 focus:ring-orange-600 focus:ring-1">
                        <span class="mx-2">
                            <?= ucfirst($value) ?>
                        </span>
                    </label>
                </div>
            </li>
            <?php endforeach; ?>
            <li>
                <div class="lpcpt_submit relative inline-flex items-center justify-center py-1 px-2 m-2 overflow-hidden text-sm font-medium text-orange-600 border border-orange-600 hover:bg-orange-600 hover:text-white">
                    <button class="m-0 p-0">Filtrar</button>
                </div>
            </li>
        </ul>
    </div>
</section>