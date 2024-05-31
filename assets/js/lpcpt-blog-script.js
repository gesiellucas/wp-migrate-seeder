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

