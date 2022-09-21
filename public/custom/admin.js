
(function($){

    $(document).ready(function(){

        //alert for a delete form buitton

        $('.delete-form').submit(function(e){

            let conf= confirm('Are you sure?');

            if (conf) {
                return true;
            } else {
                e.preventDefault();
            }


        });

        //alert for a button

        $('.btn-alert').click(function(){
            let conf= confirm('Are Your sure??')
            if (conf) {
                return true
            } else {
                return false
            }
        })

        //data table 

        $('.data_table').dataTable()


        //slider photo preview management

        $('#photo-icon').change(function(e){
            const photo_url= URL.createObjectURL(e.target.files[0]);
            $('#slider-photo-preview').attr('src' , photo_url);
        });


        //add a slider button

        let btn_num = 1
        $('#add-slider-button').click(function(e){
            e.preventDefault();
            
            $('.slider-btn-opt').append(`
            <div class="btn-opt-area">
                <span>Button ${btn_num}</span>
                <span  class="badge badge-danger remove_btn" style="margin-left:200px; cursor:pointer">remove</span>
                <input name="btn_title[]" class="form-control" type="text" placeholder="button title">
                <input name="btn_link[]" class="form-control" type="text" placeholder="button link">
                <label>Button Color</label>
                <br>
                <select class="form-control" name="btn_type[]">
                    <option value="btn-light-out" >Default</option>
                    <option value="btn-color btn-full" >Red</option>
                </select>
            </div>
            `) 
            
            btn_num++
        });


        //remove btn

        $(document).on('click', '.remove_btn', function(){

           $(this).closest('.btn-opt-area').remove();



        });


        //icon page show
        $('button.show-icon').click(function(e){
            e.preventDefault();
            $('#select_icon_page').modal('show');
        });

        //select a icon by name
        $('.icon_page_row .preview-icon code').click(function(){
            let icon_name= $(this).html();
            $('.icon_name_field').val(icon_name);
            $('#select_icon_page').modal('hide');
        });


        $('#gallery_image').change(function(e){

            const files = e.target.files;
            let gallery_ui= '';

            for (let index = 0; index < files.length; index++) {
                const obj_url= URL.createObjectURL(files[index])
                gallery_ui += `<img src="${obj_url}">`;
                
            }

            $(".gallery").html(gallery_ui);



        });

        CKEDITOR.replace('ckeditor_desc');






    });



})(jQuery)