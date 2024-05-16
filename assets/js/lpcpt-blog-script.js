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

        let fields_checked = jQuery('.lpcpt_input input[type="checkbox"]:checked').map( function() {
            return jQuery(this).data('type').replace('lpcpt_', "") + '[]=' + jQuery(this).data('id') + '&';
        }).get().join('');
        
        let newUrl = currentUrl + '?' + fields_checked;

        window.location.href = newUrl;
    });

    // Clean Filters
    jQuery('#clean_filter').click( () => removeQueryParams());

    let el = jQuery('.lpcpt_input input').val();
    console.log(el)

    // Checked params url
    checkCheckboxes()
});

function removeQueryParams() {
    let url = window.location.href;
    let cleanUrl = url.split('?')[0];
    window.location.href = cleanUrl;
}
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.getAll(param);
}


function checkCheckboxes() {
    const itemParams = getQueryParam('territorio[]');
    if( itemParams.length > 0 ) {
        itemParams.forEach( (item) => {
            jQuery('.lpcpt_input input').attr("id");
        });
    }
}

