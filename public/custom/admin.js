
(function($){

    $(document).ready(function(){

        //alert for a delete button

        $('.delete-form').submit(function(e){

            let conf= confirm('Are you sure?');

            if (conf) {
                return true;
            } else {
                e.preventDefault();
            }


        });



    });



})(jQuery)