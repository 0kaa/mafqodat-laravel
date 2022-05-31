$(document).on('click' , "#exportExcel" , function(e){

    $(".export_table").table2excel({
        exclude: ".noExl",
        name: "Worksheet Name",
        filename: "UserLogs.xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });

});
