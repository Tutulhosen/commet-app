
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



    });



})(jQuery)