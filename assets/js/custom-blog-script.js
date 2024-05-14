function form_select_filter()
{
    // let checkList_<?=$slug?> = document.querySelector('#<?=$slug?>');
    //     let button_<?=$slug?> = document.querySelector('#button_<?=$slug?>');

    //     checkList_<?=$slug?>
    //         .querySelector('#<?=$slug?> .anchor')
    //         .onclick = function(evt) {
    //             if (checkList_<?=$slug?>.classList.contains('visible')) {
    //                 checkList_<?=$slug?>.classList.remove('visible');
    //             } else {
    //                 checkList_<?=$slug?>.classList.add('visible');
    //             }
    //         }

    //     button_<?=$slug?>
    //         .onclick = function(evt) {

                
    //             let select_checkbox = document.querySelectorAll('.lpcpt_input input[type="checkbox"]:checked');
               
    //             let param_id = '';
    //             let currentUrl = window.location.origin + window.location.pathname;
    //             let inline_param = '<?=$slug?>';
                
    //             select_checkbox.forEach( function(checkbox) {

    //                 let dataId = checkbox.getAttribute('data-id');
    //                 let dataType = checkbox.getAttribute('data-type');

    //                 let name_param = dataType.replace('lpcpt_', "") + '[]=';

    //                 param_id += name_param + dataId + '&';
                    
    //             });
    //             let newUrl = currentUrl + '?' + param_id;
                
    //             window.location.href = newUrl;
    //         }
}

jQuery(document).ready(function() {

    // Drop css filter layer
    jQuery('.lpcpt_section').click(function() {

        if(jQuery(this).hasClass('visible')) {
            jQuery(this).removeClass('visible');
        } else {
            jQuery(this).addClass('visible');
        }
    });

    // Check all checked fields to create url query
    jQuery('.lpcpt_submit').click(function() {

        let currentUrl = window.location.origin + window.location.pathname;
        let param_id = [];

        let fields_checked = jQuery('.lpcpt_input input[type="checkbox"]:checked').map( function() {
            return jQuery(this).data('type').replace('lpcpt_', "") + '[]=' + jQuery(this).data('id') + '&';
        }).get().join('');
        
        let newUrl = currentUrl + '?' + fields_checked;

        console.log(newUrl);

        window.location.href = newUrl;
        return;
        fields_checked.foreach( function(evt) {
            console.log(evt);
        })

        console.log(fields_checked);return;
        fields_checked.forEach( function() {
            let field_id = fields_checked.attr('data-id');
            let field_type = fields_checked.attr('data-type');
            let name_param = dataType.replace('lpcpt_', "") + '[]=';
            param_id += name_param + dataId + '&';

        })
        
        
        

        console.log(fields_checked);
        // console.log(field_id);
        // console.log(field_type);

    })


});