function showUsers(sort, isASC){
    if (sort!=null) {
        users.sort(function(a,b){
            if (isASC===false) { // DESC
                if (a[sort]<b[sort]) {
                    return 1;
                } else if (a[sort]>b[sort]) {
                    return -1;
                } else {
                    return 0;
                }
            } else { // ASC
                if (a[sort]>b[sort]) {
                    return 1;
                } else if (a[sort]<b[sort]) {
                    return -1;
                } else {
                    return 0;
                }
            }
        });
    }

    var tbody = $('#user-table tbody');
    tbody.html("");
    for (var i = 0; i < users.length; i++) {
        console.log(i);
        tbody.append("<tr><td>"+users[i]['nama']+"</td><td>"+users[i]['hp']+"</td><td>"+users[i]['email']+"</td><td>"+users[i]['alamat']+"</td></tr>");
    }
}

function analyzeData() {
    var nama = $("#nama").val();
    var hp = $("#hp").val();
    var email = $("#email").val();

    var filled = true;
    filled = filled && nama!="";
    filled = filled && hp!="";
    filled = filled && email!="";
    $(".alamat").each(function(){
        filled = filled && $(this).val()!="";
    });

    if (!filled) {
        return "Semua field harus diisi!";
    }

    if (nama.length>50) {
        return "Nama tidak boleh lebih dari 50 karakter!";
    }

    if (hp.length<10) {
        return "No. HP minimal 10 karakter!";
    }

    if (isNaN(parseInt(hp))) {
        return "No. HP hanya boleh berupa angka!";
    }

    var emailValidity = true;
    $("#email").each(function(){
        emailValidity = this.checkValidity();
    });
    var emailDeconstructed = email.split("@");
    if (emailDeconstructed.length==2) {
        emailDeconstructed = emailDeconstructed[1].split(".");
        emailValidity = emailValidity && emailDeconstructed.length>=2;
        for (var i = 0; i < emailDeconstructed.length; i++) {
            emailValidity = emailValidity && emailDeconstructed[i].length>=2;
        }
    } else {
        emailValidity = false;
    }
    if (emailValidity==false) {
        return "Email harus menggunakan format xxx@xxx.xxx";
    }

    return null;
}

$(document).ready(function(){
    if ($('h1').text() == "List User") {
        showUsers();

        $('.glyphicon-triangle-top').each(function(){
            $(this).click(function(){
                showUsers($(this).parent().data("field"), true);
            });
        });

        $('.glyphicon-triangle-bottom').each(function(){
            $(this).click(function(){
                showUsers($(this).parent().data("field"), false);
            });
        });
    } else if ($('h1').text() == "Create User") {
        $(".address-btn").click(function(){
            var cloned = $(this).parent().parent().parent().clone();
            cloned.find('.address-btn').click(function(){
                cloned.remove();
            }).toggleClass("btn-success")
              .toggleClass("btn-danger")
              .find(".glyphicon-plus")
              .toggleClass("glyphicon-plus")
              .toggleClass("glyphicon-minus")
              .parent().parent().parent().find(".form-control")
              .val("");

            $(this).parent().parent().parent().parent().append(cloned);
        });

        $('#user-form').submit(function(event){
            var result = analyzeData();
            if (result!=null) {
                alert(result);
                event.preventDefault();
            }
        });
    }
});