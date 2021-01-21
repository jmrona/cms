var route = document.getElementsByName('routerName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){
    // Editor options
    if(route == 'products_add' || route == 'products_edit'){
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( (error) => {
            console.error( error )
        })
    }

    // Upload image botton for Gallery
    if(route == "product_edit"){
        let input_file = document.getElementById('input_file');
        let btn_upload_image = document.getElementById('btn_upload_image');

        input_file.style.display = 'none';

        btn_upload_image.addEventListener('click', () => {
            input_file.click();
        })

        input_file.addEventListener('change', () => {
            document.getElementById('form_product_gallery').submit();
        })
    }

    // Active NAV
    var getRouteActive = route.split('_')[0];
    var route_active = document.getElementsByClassName('nav-'+getRouteActive)[0].classList.add('active');

});
