var theme;

if(window.localStorage){

    if(window.localStorage.getItem("theme")){
        theme = window.localStorage.getItem("theme");
        $("#dn").attr("checked",(window.localStorage.getItem("theme") === "dark"));
    }else{
        theme = "light";
        $("#dn").attr("checked",false);
    }

    $("#dn").change(function(){

        window.localStorage.setItem("theme",this.checked ? "dark" : "light");
        location.reload();
    });

}else{
    theme = "light";
    $(".content-search").hide();
}
$(function () {


    if(theme === "dark"){
        $("head").append('<link rel="stylesheet" href="/Assets/v2/Assets/css/skin.dark.css">');
    }

    $(".multipleselectJs").selectize();


    $.fn.dataTable.ext.buttons.reload = {
        text: 'Veri Yenile',
        action: function ( e, dt, node, config ) {
            dt.ajax.reload();
        }
    };




    $("#menuNest").nestable().on("change", function (t) {
        t.preventDefault();
        let e = t.length ? t : $(t.target);

        $.ajax({
            type: "POST",
            url: "/ajax/update/menu-items",
            data: {uuid: $("#menuNest").data("uuid"), items: JSON.stringify(e.nestable("serialize"))},
            dataType: "json",
            success: function (response) {

                if(response.status === "success"){


                }else{
                    swal(response.title,response.message,response.status, {
                        buttons: {
                            cancel: {
                                text: "Try Again",
                                value: false,
                                visible: true
                            }
                        }
                    });
                }

            }
        });

    });


    $(".switchLanguage").click(function () {

        $.ajax({
            type: "POST",
            url: "/ajax/set/language",
            data: {prefix: $(this).data("prefix")},
            success: function (response) {

                location.reload();

            }
        });

    });

    setInterval(function () {

        $.ajax({
            type: "POST",
            url: "/ajax/user/online",
            data: { time: Math.random()},
            success: function (response) {

                localStorage.setItem("onlineList", response);


            }
        });

    },2500);

    setInterval(function () {
        $.ajax({
            type: "POST",
            url: "/ajax/user/lastlogin",
            data: { time: Math.random()},
            success: function (response) {}
        });
    },1500);

    $(".sefLinkInCategoryItem").keyup(function () {

        $(this).val(URLify($(this).val()));
    });

    $(".sefLinkInCategoryItemUp").keyup(function () {

        $(this).val(URLify($(this).val()));
    });

    $(".sefLinkInCategoryItemMaster").keyup(function () {

        $(".sefLinkInCategoryItem").val(URLify($(".sefLinkInCategoryItemMaster").val()));
    });


    $(".sefLinkInCategoryItemMasterUp").keyup(function () {

        $(".sefLinkInCategoryItemUp").val(URLify($(".sefLinkInCategoryItemMasterUp").val()));
    });


    var sites = $("#sites-table").DataTable({
        responsive: true,
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"],
        ajax: {
            url: "/ajax/get/sites",
            type: "POST"
        },
        columnDefs: [ {
            targets: -1,
            data: null,
            defaultContent: "<button class='siteRemove btn btn-danger btn-sm waves-effect waves-light'>Remove</button> <button class='siteDetails btn btn-primary btn-sm waves-effect waves-light'>Details</button>"
        } ]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $('#sites-table tbody').on( 'click', 'button.siteDetails', function () {
        let getCode = $($(this).parents('tr').children()[0]).html();
        location.href = "/app/management/" + getCode;
    });
    $('#sites-table tbody').on( 'click', 'button.siteRemove', function () {

        let getCode = $($(this).parents('tr').children()[0]).html();

        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/site/remove",
                    data: {site:getCode},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });

    });


    var crud = $("#crud-table").DataTable({
        responsive: true,
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"],
        ajax: {
            url: "/ajax/get/crud/"+$("#crud-table").data("code"),
            type: "POST"
        },
        columnDefs: [ {
            targets: -1,
            data: null,
            defaultContent: "<button class='siteEdit btn btn-info btn-sm waves-effect waves-light'>Edit</button> <button class='siteRemove btn btn-danger btn-sm waves-effect waves-light'>Remove</button>"
        } ],
        order: [[ 2, "asc" ]]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $('#crud-table tbody').on( 'click', 'button.siteRemove', function () {
        let getCode = $($(this).parents('tr').children()[0]).html();

        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/module/remove",
                    data: {modules:getCode,siteCode:siteCode},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });

    });


    $('#crud-table tbody').on( 'click', 'button.siteEdit', function () {
        let getCode = $($(this).parents('tr').children()[0]).html();

        location.href = "/app/management/"+$("#crud-table").data("code")+"/module/edit/"+getCode;


    });


    $("#manager-table").DataTable({
        responsive: true,
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"],ajax: {
            url: "/ajax/get/crud/site/manager/"+$("#manager-table").data("code"),
            type: "POST"
        },
        columnDefs: [ {
            targets: -1,
            data: null,
            defaultContent: "<button class='siteAuthRemove btn btn-danger btn-sm waves-effect waves-light'>Sil</button>"
        } ]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");



    $('#manager-table tbody').on( 'click', 'button.siteAuthRemove', function () {

        let getCode = $($(this).parents('tr').children()[0]).html();

        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/management/authorities/remove",
                    data: {record:getCode},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    window.userTable = $("#user-table").DataTable({
        responsive: true,
        dom: 'Bfrtip',
        ajax: {
            url: "/ajax/get/userlist",
            type: "POST",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: ["colvis","copy", "excel", "pdf", "reload"],
        lengthChange: !1,
        columnDefs: [ {
            targets: -1,
            data: null,
            defaultContent: "<button class='userViewAdmin btn btn-primary btn-sm waves-effect waves-light'>Details</button>"
        }
        ]
    });

    window.userTable.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");



    if($(".updatePermission").length > 0 || $(".updateType").length > 0 ){

        var $createUser_permission =  $(".updatePermission").selectize();

        var createUserSelectize_permission = $createUser_permission[0].selectize;

        var $createUser_type =  $(".updateType").selectize();

        var createUserSelectize_type = $createUser_type[0].selectize;




    }



    $('#user-table tbody').on( 'click', 'button.userViewAdmin', function () {

        let getCode = $($(this).parents('tr').children()[0]).html();


        $.ajax({
            type: "POST",
            url: "/ajax/user/get/information",
            data: {record:getCode},
            dataType: "json",
            success: function (response) {

                if(response.status === "success"){


                    $(".nameUp").val(response.data.name);
                    $(".surnameUp").val(response.data.surname);
                    $(".phoneUp").val(response.data.phone);
                    $(".emailUp").val(response.data.email);
                    $(".passwordUp").val(response.data.password);
                    $(".hiddenUserUuid").val(response.data.uuid);

                    createUserSelectize_permission.setValue(response.data.permission);

                    createUserSelectize_type.setValue(response.data.type);



                    $("#userAdminformAjaxUpdate").modal("show");


                }else{
                    swal(response.title,response.message,response.status, {
                        buttons: {
                            cancel: {
                                text: "Try Again",
                                value: false,
                                visible: true
                            }
                        }
                    });
                }

            }
        });

    });




    var record = $("#record-table").DataTable({
        responsive: true,
        dom: 'Bfrtip',
        ajax: {
            url: "/ajax/get/record/"+$("#record-table").data("code"),
            type: "POST",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: ["colvis","copy", "excel", "pdf", "reload"],
        lengthChange: !1,
        columnDefs: [ {
            targets: -1,
            data: null,
            render: function ( row, type, val, meta ) {
                return "<button data-uuid='"+row[0]+"' class='recordDelete btn btn-danger btn-sm waves-effect waves-light'>Remove</button> <button data-uuid='"+row[0]+"' class='recordDetails btn btn-primary btn-sm waves-effect waves-light'>Details</button>";
            }
        }
        ]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $('#record-table tbody').on( 'click', 'button.recordDetails', function () {
        let getCode = $(this).data("uuid");
        location.href = "/app/module/"+$("#record-table").data("code")+"/record/"+getCode;
    });

    $('#record-table tbody').on( 'click', 'button.recordDelete', function () {
        let getCode = $(this).data("uuid");


        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/modules/remove",
                    data: {record:getCode},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".edit-button-nestable").click(function (e) {
        e.preventDefault();

        let id = $(this).data("id");

        let label = $(this).data("label");

        let link = $(this).data("link");
        let uuid = $(this).data("uuid");


        $(".uuids").val(uuid);
        $(".sefLinkInCategoryItemMasterUp").val(label);
        $(".sefLinkInCategoryItemUp").val(link);
        $(".updateMenuItemFormId").val(uuid);

        let cover = $(this).data("cover");

        $("[name=coverUpdate]").val(cover);
        if(cover.length > 2 ){

            $(".coverUpdate").html("");
            $(".coverUpdate").html(' <div class="imgPreview"> <img src="'+decodeURIComponent(cover)+'" > </div>');
        }else{
            $("[name=coverUpdate]").val("");
            $(".coverUpdate").html("");
        }

        $("#updateMenuItem").modal("show");

    });


    $(".delete-button-nestable").click(function (e) {
        e.preventDefault();
        let id = $(this).data("uuid");

        let label = $(this).data("label");

        let link = $(this).data("link");

        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/remove/menu-item",
                    data: {uuid:id},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $('.dd a').on('mousedown', function(event) {
        event.preventDefault();
        return false;
    });

    $(".createMenuItemForm").submit(function () {

        $.ajax({
            type: "POST",
            url: "/ajax/create/menu-item",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {

                if(response.status === "success"){
                    location.reload();
                }else{
                    swal(response.title,response.message,response.status, {
                        buttons: {
                            cancel: {
                                text: "Try Again",
                                value: false,
                                visible: true
                            }
                        }
                    });
                }

            }
        });

    });

    $(".updateMenuItemForm").submit(function () {

        $.ajax({
            type: "POST",
            url: "/ajax/update/menu-item",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {

                if(response.status === "success"){
                    location.reload();
                }else{
                    swal(response.title,response.message,response.status, {
                        buttons: {
                            cancel: {
                                text: "Try Again",
                                value: false,
                                visible: true
                            }
                        }
                    });
                }

            }
        });

    });

    $(".createMenuCategoryForm").submit(function () {

        $.ajax({
            type: "POST",
            url: "/ajax/create/menu",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {

                if(response.status === "success"){
                    location.reload();
                }else{
                    swal(response.title,response.message,response.status, {
                        buttons: {
                            cancel: {
                                text: "Try Again",
                                value: false,
                                visible: true
                            }
                        }
                    });
                }

            }
        });

    });

    $(".editMenuCategoryForm").submit(function () {

        $.ajax({
            type: "POST",
            url: "/ajax/update/menu",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {

                if(response.status === "success"){
                    location.reload();
                }else{
                    swal(response.title,response.message,response.status, {
                        buttons: {
                            cancel: {
                                text: "Try Again",
                                value: false,
                                visible: true
                            }
                        }
                    });
                }

            }
        });

    });

    $(".categoryDelete").click(function () {

        let id = $(this).data("uuid");

        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/remove/menu",
                    data: {uuid:id},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".submitCrud").submit(function () {


        swal("Transaction Confirmation","Do you confirm the registration?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/crud/save",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".submitCrudEdit").submit(function () {


        swal("Transaction Confirmation","Do you confirm the update process?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/crud/edit",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".userAdminformAjaxUpdate").submit(function () {


        swal("Transaction Confirmation","Do you confirm the update process?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                pleaseWait();

                $.ajax({
                    type: "POST",
                    url: "/ajax/user/update",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            $("#userAdminformAjaxUpdate").modal("hide");
                            swal.close();
                            window.userTable.ajax.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });



    $(".moduleRecordForm").submit(function () {


        swal("Transaction Confirmation","Do you confirm the registration?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/modules/save",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);f

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });

    $(".moduleSingleForm").submit(function () {


        swal("Transaction Confirmation","Do you confirm the update process?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/modules/single",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });

    $(".tokenAdd").submit(function () {


        swal("Transaction Confirmation","Do you confirm the registration?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/create/token",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });

    $(".moduleUpdateForm").submit(function () {


        swal("Transaction Confirmation","Do you confirm the registration?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/modules/update",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });

    $(".settingsForm").submit(function () {


        swal("Transaction Confirmation","Do you confirm the update process?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/app/update/password",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".languageStable").click(function () {


        swal("Transaction Confirmation","Do you confirm Language Stabile?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                pleaseWait();

                $.ajax({
                    type: "POST",
                    url: "/ajax/app/language/stabilizing",
                    data: {},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });



    $(".managerForm").submit(function () {


        swal("Transaction Confirmation","Do you confirm the registration?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then( (x) => {

            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/management/authorities/add",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }

        });


    });

    $(".exitApp").click(function () {


        swal("Transaction Confirmation","Do you confirm the logout?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/app/exit",
                    data: {},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.href = "/auth/login";
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });

    $(".siteAdd").submit(function () {


        swal("Transaction Confirmation","Do you confirm the registration?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/management/add",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".siteSettings").submit(function () {


        swal("Transaction Confirmation","Do you confirm the update process?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/management/edit",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            swal(response.title,response.message,response.status, {
                                buttons: false,
                                closeOnEsc:false,
                                closeOnClickOutside:false
                            });

                            setTimeout(function () {
                                location.reload();
                            },1500);

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });


    });


    $(".categoryEdit").click(function () {

        let id      = $(this).data("id");

        let label   = $(this).data("label");

        let uuid    = $(this).data("uuid");

        $(".categoryUpId").val(id);

        $(".editMenuCategoryInput").val(label);

        $(".uuidsA").val(uuid);

        $("#editMenuCategory").modal("show");

    });


    $('.tagsIn').selectize({
        delimiter: ",",
        persist: !1,
        create: function(e) {
            return {
                value: e,
                text: e
            }
        }
    });

    $(".selectizeCreate").selectize({
        placeholder:'Make a selection',
        allowClear: true,
        create: true,
    });


    $(".componentAdd").click(function () {

        let getComponent = $(this).data("prefix");

        $(".warninShowing").remove();

        $.ajax({
            type: "POST",
            url: "/ajax/get/component",
            data: {component: getComponent, siteCode:siteCode },
            success: function (response) {

                let idC = "IN"+ Math.floor(Math.random() * 100 * Math.floor(Math.random() * 100) * 12);

                let endFrame = response.replace("_INPUT_",idC).replace("_INPUT_",idC).replace("_INPUT_",idC);

                $(".componentManager").append(endFrame);

                $("."+idC).selectize({
                    delimiter: ",",
                    persist: !1,
                    placeholder: 'Separate the data with ","',
                    create: function(e) {
                        return {
                            value: e,
                            text: e
                        }
                    }
                });

                if(types === "edit"){
                    $.each($("#"+idC).find('input, select'),function (az,za) {

                        if($(za).attr("name") === "table[]"){
                            $.each($(za).children(),function (x,a) {
                                if($(a).val() === "active"){
                                    $(a).remove();
                                }else{
                                    $(a).attr("selected",true);
                                }
                            })
                        }

                    });
                }




            }
        });

    });


    $(document).on("click",".removeComponent",function () {

        let id = $(this).data("id");

        $("#"+id).remove();

    });

    $('.iframe-btn').fancybox({
        'width'	: 880,
        'height'	: 300,
        'type'	: 'iframe',
        'autoScale'   : true
    });


    function OnMessage(e){
        var event = e.originalEvent;

        if(event.data.sender === 'responsivefilemanager'){
            if(event.data.field_id){
                var fieldID=event.data.field_id;
                var url=event.data.url;
                $('#'+fieldID).val(url).trigger('change');
                $.fancybox.close();

                $(window).off('message', OnMessage);
            }
        }
    }


    $('.iframe-btn').on('click',function(){
        $(window).on('message', OnMessage);
    });


    var editorSkinV1 = (theme === "dark" ? "oxide-dark" : "oxide") ;
    var editorSkinV2 = (theme === "dark" ? "dark" : "default");

    window.Editor = tinymce.init({
        skin:  editorSkinV1,
        content_css: editorSkinV2,
        external_filemanager_path: "/3thparty/filemanager/",
        filemanager_title: "File Manager",
        external_plugins: {
            "responsivefilemanager": "/3thparty/tinymce/plugins/responsivefilemanager/plugin.min.js",
            "filemanager": "/3thparty/filemanager/plugin.min.js"
        },
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        selector: "textarea.formEditor",
        height: 500,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        },
        language: 'en',
        autosave_ask_before_unload: false,
        plugins: ["autolink advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime  nonbreaking", "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"],
        toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor | print preview  fullpage | emoticons responsivefilemanager ",
        image_advtab: true,
        branding: false,
        style_formats: [{
            title: "Strong Text B",
            inline: "b"
        },{
            title: "Red Title Span",
            inline: "span",
            styles: {
                color: "#ff0000"
            }
        },{
            title: "Red Title H1",
            block: "h1",
            styles: {
                color: "#ff0000"
            }
        },{
            title: "Frame",
            block: "span",
            styles: {
                padding: "10px 10px",
                border:"1px solid black"
            }
        }
        ]
    });



    window.basicEditor = tinymce.init({

        skin:  editorSkinV1,
        content_css: editorSkinV2,
        selector: "textarea.basicFormEditor",
        height: 500,
        language: 'en',
        autosave_ask_before_unload: false,
        plugins: [],
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        },
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor | print preview media fullpage",
        toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor | print preview media fullpage ",
        image_advtab: true,
        branding: false,
        style_formats: [{
            title: "Strong Text B",
            inline: "b"
        },{
            title: "Red Title Span",
            inline: "span",
            styles: {
                color: "#ff0000"
            }
        },{
            title: "Red Title H1",
            block: "h1",
            styles: {
                color: "#ff0000"
            }
        },{
            title: "Frame",
            block: "span",
            styles: {
                padding: "10px 10px",
                border:"1px solid black"
            }
        }
        ]
    });

    $(".selectize").selectize({
        placeholder:'Make a selection',
        allowClear: true
    });

    $(".show-alpha").spectrum({
        preferredFormat: "rgb",
        showInput: !0,
        showAlpha: !0
    });





    $("#api-table").DataTable({
        responsive: true,
        lengthChange: !1,ajax: {
            url: "/ajax/app/get/api",
            type: "POST"
        },
        buttons: ["copy", "excel", "pdf", "colvis"]
    });


    var tokens = $("#tokens-table").DataTable({
        responsive: true,
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"],
        ajax: {
            url: "/ajax/app/get/tokens",
            type: "POST"
        },
        columnDefs: [ {
            targets: -1,
            data: null,
            defaultContent: "<button class='tokenRemove btn btn-danger btn-sm waves-effect waves-light'>Remove</button>"
        } ]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $('#tokens-table tbody').on( 'click', 'button.tokenRemove', function () {

        let getCode = $($(this).parents('tr').children()[0]).html();

        swal("Transaction Confirmation","Do you confirm the deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                $.ajax({
                    type: "POST",
                    url: "/ajax/delete/token",
                    data: {token:getCode},
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){
                            location.reload();
                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });
            }
        });

    });


    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }


    function humanFileSize(bytes, si) {
        var thresh = si ? 1000 : 1024;
        if(Math.abs(bytes) < thresh) {
            return bytes + ' B';
        }
        var units = si
            ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
            : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
        var u = -1;
        do {
            bytes /= thresh;
            ++u;
        } while(Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1)+' '+units[u];
    }


    if($("#getFile").length > 0){
        document.getElementById('getFile').addEventListener('change', function(evt) {

            var reader;

            reader = new FileReader();

            reader.onerror = function (evt) {

                switch(evt.target.error.code) {
                    case evt.target.error.NOT_FOUND_ERR:
                        alert('File Not Found!');
                        break;
                    case evt.target.error.NOT_READABLE_ERR:
                        alert('File is not readable');
                        break;
                    case evt.target.error.ABORT_ERR:
                        break; // noop
                    default:
                        alert('An error occurred reading this file.');
                }

            };

            reader.onprogress = function(evt) {

                if (evt.lengthComputable) {

                    var percentLoaded = Math.round((evt.loaded / evt.total) * 100);

                    if (percentLoaded < 100) {

                    }
                }

            };

            reader.onabort = function(e) {
                alert('File read cancelled');
            };

            reader.onloadstart = function(e) {


            };

            reader.onload = function(e) {


                if(IsJsonString(e.target.result)){

                    if(JSON.parse(e.target.result).creator === "VOBO"){

                        swal(evt.target.files[0].name.replace(".vobo",""),"Do you want to upload the file?","info", {
                            buttons: {
                                cancel: {
                                    text: "No",
                                    value: false,
                                    visible: true
                                },
                                yes: {
                                    text: "Yes",
                                    value: true
                                }
                            }
                        }).then((x)=>{
                            if(x){

                                pleaseWait();

                                $.ajax({
                                    type: "POST",
                                    url: "/ajax/backup/import",
                                    data: {content: e.target.result },
                                    dataType: "json",
                                    success: function (response) {

                                        if(response.status === "success"){

                                            swal(response.title,response.message,response.status, {
                                                buttons: false,
                                                closeOnClickOutside:false,
                                                closeOnEsc:false,
                                                showLoaderOnConfirm:true
                                            });

                                            setTimeout(function () {
                                                location.reload();
                                            },2500);
                                        }else{
                                            swal(response.title,response.message,response.status, {
                                                buttons: {
                                                    cancel: {
                                                        text: "Try Again",
                                                        value: false,
                                                        visible: true
                                                    }
                                                }
                                            });
                                        }

                                    }
                                });
                            }
                        });

                    }else{
                        swal("WARNING", "The selected file is not suitable for uploading","info", {
                            buttons: {
                                cancel: {
                                    text: "Close",
                                    value: false,
                                    visible: true
                                }
                            }
                        })
                    }

                }else{
                    swal("WARNING", "The selected file is not suitable for uploading","info", {
                        buttons: {
                            cancel: {
                                text: "Close",
                                value: false,
                                visible: true
                            }
                        }
                    })
                }

            };

            reader.readAsBinaryString(evt.target.files[0]);


        }, false);

    }



    $(".userAdminformAjax").submit(function () {

        swal("Transaction Confirmation","Do you confirm user creation?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                pleaseWait();

                $.ajax({
                    type: "POST",
                    url: "/ajax/user/create",
                    data: $(".userAdminformAjax").serialize(),
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            $("#userAdminform").modal("hide");
                            swal.close();
                            window.userTable.ajax.reload();


                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });


            }
        });

    });


    $(document).on("click",".removeUserUuid",function () {

        var getUuid = $(".hiddenUserUuid").val();

        swal("Transaction Confirmation","Do you confirm user deletion?","info", {
            buttons: {
                cancel: {
                    text: "No",
                    value: false,
                    visible: true
                },
                yes: {
                    text: "Yes",
                    value: true
                }
            }
        }).then((x)=>{
            if(x){

                pleaseWait();

                $.ajax({
                    type: "POST",
                    url: "/ajax/user/delete",
                    data: {uuid:  getUuid },
                    dataType: "json",
                    success: function (response) {

                        if(response.status === "success"){

                            $("#userAdminformAjaxUpdate").modal("hide");
                            swal.close();
                            window.userTable.ajax.reload();

                        }else{
                            swal(response.title,response.message,response.status, {
                                buttons: {
                                    cancel: {
                                        text: "Try Again",
                                        value: false,
                                        visible: true
                                    }
                                }
                            });
                        }

                    }
                });


            }
        });

    });



    if((typeof setDefaultConfigInModuleSystem) !== "undefined"){

        var actions = [];

        $.each(setDefaultConfigInModuleSystem.crud, function(x, z) {

            actions.push(function(callback) {

                let getComponent = z.component;

                $(".warninShowing").remove();

                $.ajax({
                    type: "POST",
                    url: "/ajax/get/component",
                    data: {component: getComponent, siteCode:siteCode },
                    success: function (response) {

                        let idC = "IN"+ Math.floor(Math.random() * 100 * Math.floor(Math.random() * 100) * 12);

                        let endFrame = response.replace("_INPUT_",idC).replace("_INPUT_",idC).replace("_INPUT_",idC);

                        $(".componentManager").append(endFrame);

                        $("#"+idC).addClass("draggable");

                        $.each($("#"+idC).find('input, select'),function (az,za) {

                            if($(za).attr("name") === "name[]"){
                                $(za).val(z.name);
                                $(za).attr("readonly",true);
                                $(za).css("border","1px solid red");
                                $(za).css("cursor","not-allowed");
                            }
                            if($(za).attr("name") === "title[]"){
                                $(za).val(z.title);
                            }
                            if($(za).attr("name") === "placeholder[]"){
                                $(za).val(z.placeholder);
                            }
                            if($(za).attr("name") === "values[]"){
                                $(za).val(z.values);
                            }
                            if($(za).attr("name") === "child[]"){
                                $(za).val(z.child);
                            }
                            if($(za).attr("name") === "component[]"){
                                $(za).val(z.component);
                            }
                            if($(za).attr("name") === "required[]"){

                                if(z.required === "active"){
                                    $($(za).find("[value=active]")[0]).attr("selected",true)
                                }else{
                                    $($(za).find("[value=active]")[0]).attr("selected",false)
                                }
                            }
                            if($(za).attr("name") === "table[]"){
                                if(z.table === "active"){
                                    $($(za).find("[value=active]")[0]).attr("selected",true)
                                }else{
                                    $($(za).find("[value=active]")[0]).attr("selected",false)
                                }
                            }

                        });



                        $("."+idC).selectize({
                            delimiter: ",",
                            persist: !1,
                            placeholder: 'Select Option',
                            create: function(e) {
                                return {
                                    value: e,
                                    text: e
                                }
                            }
                        });


                        Sortable.create(document.getElementById("simpleList"), { /* options */ });

                        $(".moduleEditorSettingPanel").fadeIn();

                        callback();

                    }
                });


            });
        });

        var sequencer = new Sequencer(actions);
        sequencer.start();


    }


    $(".crudSlugStatus").change(function () {
        if($(this).val() === "active"){
            $(".slugComponent").show();
        }else{
            $(".slugComponent").hide();
        }
    });



    $(".crudCreate").change(function () {
        if($(this).val() === "multiple"){
            $(".componentsModuleExt").show();
        }else{
            $(".componentsModuleExt").hide();
        }
    });



});

function checkJson(json) {

    try{
        JSON.parse(json);
        return true;
    }catch(err) {
        return false;
    }
}


function getFileExtension(filename) {
    return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
}

function responsive_filemanager_callback(field_id){

    if(checkJson($("#"+field_id).val())){
        $("."+field_id).html("");
        JSON.parse($("#"+field_id).val()).forEach(function (v) {


            if(getFileExtension(v) !== undefined){

                if(getFileExtension(v)[0] !== undefined){
                    if( (getFileExtension(v)[0] === "jpg") || (getFileExtension(v)[0] === "png") || (getFileExtension(v)[0] === "svg") ){

                        $("."+field_id).append('<div class="imgPreview" ><img src="'+v+'"  alt=""> </div>');

                    }else{
                        $("."+field_id).append('<div class="imgPreview" ><img src="/3thparty/icons/'+getFileExtension(v)[0]+'.png"  alt=""> </div>');
                    }
                }

            }


        });

    }else{

        if(getFileExtension($("#"+field_id).val()) !== undefined){

            if(getFileExtension($("#"+field_id).val())[0] !== undefined){
                if( (getFileExtension($("#"+field_id).val())[0] === "jpg") || (getFileExtension($("#"+field_id).val())[0] === "png") || (getFileExtension($("#"+field_id).val())[0] === "png") ){


                    $("."+field_id).html("");
                    $("."+field_id).append('<div class="imgPreview" ><img src="'+$("#"+field_id).val()+'" alt=""> </div>');


                }else{
                    $("."+field_id).html("");
                    $("."+field_id).append('<div class="imgPreview" ><img src="/3thparty/icons/'+getFileExtension($("#"+field_id).val())[0]+'.png"  alt=""> </div>');
                }
            }

            /* Demo */
        }

    }

}


function copyToClipboard(text) {
    if (window.clipboardData && window.clipboardData.setData) {
        return window.clipboardData.setData("Text", text);
    }
    else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");
        }
        catch (ex) {
            alert("Copy to clipboard failed.");
            return false;
        }
        finally {
            document.body.removeChild(textarea);
        }
    }
}

$.fn.extend({
    qcss: function(css) {
        return $(this).queue(function(next) {
            $(this).css(css);
            next();
        });
    }
});


$(".copyCode").click(function () {

    $(this)
        .qcss({ backgroundColor: 'skyblue' })
        .delay(70)
        .qcss({ backgroundColor: 'springgreen' })
        .delay(70)
        .qcss({ backgroundColor: 'pink' })
        .delay(70)
        .qcss({ backgroundColor: 'red' });

    copyToClipboard($(this).html());

});

